<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RoleService;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = Auth::user()->products()->latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'sku_code' => 'nullable|string|max:50',
            'hs_code' => 'nullable|string|max:50',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';

        $product = Product::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'product' => $product
            ]);
        }

        return back()->with('success', 'Product created successfully');
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
} 