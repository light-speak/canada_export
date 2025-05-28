<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of addresses
     */
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('dashboard.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address
     */
    public function create()
    {
        return view('dashboard.addresses.create');
    }

    /**
     * Store a newly created address
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'street2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
        ]);

        $address = Auth::user()->addresses()->create($validated);

        return redirect()->route('addresses.index')
            ->with('success', 'Address added successfully.');
    }

    /**
     * Show the form for editing the address
     */
    public function edit(Address $address)
    {
        // Check if user owns the address
        if ($address->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to edit this address.');
        }

        return view('dashboard.addresses.edit', compact('address'));
    }

    /**
     * Update the address
     */
    public function update(Request $request, Address $address)
    {
        // Check if user owns the address
        if ($address->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to update this address.');
        }

        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'street2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
        ]);

        $address->update($validated);

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully.');
    }

    /**
     * Delete the address
     */
    public function destroy(Address $address)
    {
        // Check if user owns the address
        if ($address->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to delete this address.');
        }

        $address->delete();

        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully.');
    }
} 