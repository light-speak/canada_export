<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RoleService;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates
     */
    public function index()
    {
        $certificates = Auth::user()->certificates;
        return view('dashboard.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating basic certificate info
     */
    public function createBasicInfo()
    {
        // Check if user has permission to create certificates
        if (RoleService::isReadOnly(Auth::user())) {
            abort(403, 'You do not have permission to create certificates.');
        }

        return view('dashboard.certificates.create.basic_info');
    }

    /**
     * Store basic certificate info
     */
    public function storeBasicInfo(Request $request)
    {
        $validated = $request->validate([
            'destination_country' => 'required|string',
            'certificate_type' => 'required|string|in:origin,free_sale,health',
            'purpose' => 'required|string|max:500',
        ]);

        // Store in session for later use
        $request->session()->put('certificate.basic_info', $validated);

        return redirect()->route('certificates.create.products');
    }

    /**
     * Show the form for selecting products
     */
    public function createProducts(Request $request)
    {
        if (!$request->session()->has('certificate.basic_info')) {
            return redirect()->route('certificates.create.basic_info');
        }

        $products = Product::where('user_id', Auth::id())->get();
        return view('dashboard.certificates.create.products', compact('products'));
    }

    /**
     * Store selected products
     */
    public function storeProducts(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id'
        ]);

        $request->session()->put('certificate.products', $validated['products']);

        return redirect()->route('certificates.create.options');
    }

    /**
     * Show the form for certificate options
     */
    public function createOptions(Request $request)
    {
        if (!$request->session()->has('certificate.products')) {
            return redirect()->route('certificates.create.products');
        }

        return view('dashboard.certificates.create.options');
    }

    /**
     * Store certificate options
     */
    public function storeOptions(Request $request)
    {
        $validated = $request->validate([
            'copies' => 'required|integer|min:1|max:10',
            'language' => 'required|string|in:english,english_spanish,english_arabic',
            'is_manufacturer' => 'required|boolean',
        ]);

        $request->session()->put('certificate.options', $validated);

        return redirect()->route('certificates.create.documents');
    }

    /**
     * Show the form for document upload
     */
    public function createDocuments(Request $request)
    {
        if (!$request->session()->has('certificate.options')) {
            return redirect()->route('certificates.create.options');
        }

        return view('dashboard.certificates.create.documents');
    }

    /**
     * Store uploaded documents
     */
    public function storeDocuments(Request $request)
    {
        $validated = $request->validate([
            'invoice' => 'required|file|mimes:pdf|max:51200', // 50MB max
            'manufacturing_statement' => 'required|file|mimes:pdf|max:51200',
        ]);

        // Store files
        $invoicePath = $request->file('invoice')->store('certificates/documents');
        $statementPath = $request->file('manufacturing_statement')->store('certificates/documents');

        $request->session()->put('certificate.documents', [
            'invoice' => $invoicePath,
            'manufacturing_statement' => $statementPath,
        ]);

        return redirect()->route('certificates.create.delivery');
    }

    /**
     * Show the form for delivery options
     */
    public function createDelivery(Request $request)
    {
        if (!$request->session()->has('certificate.documents')) {
            return redirect()->route('certificates.create.documents');
        }

        return view('dashboard.certificates.create.delivery');
    }

    /**
     * Store delivery options and create certificate
     */
    public function storeDelivery(Request $request)
    {
        $validated = $request->validate([
            'delivery_type' => 'required|string|in:mail_only,mail_and_digital',
            'shipping_method' => 'required|string|in:usps_first,usps_priority,usps_express,fedex_ground,fedex_express',
            'address_id' => 'required|exists:addresses,id',
        ]);

        // Get all data from session
        $basicInfo = $request->session()->get('certificate.basic_info');
        $products = $request->session()->get('certificate.products');
        $options = $request->session()->get('certificate.options');
        $documents = $request->session()->get('certificate.documents');

        // Create certificate
        $certificate = Certificate::create([
            'user_id' => Auth::id(),
            'destination_country' => $basicInfo['destination_country'],
            'certificate_type' => $basicInfo['certificate_type'],
            'purpose' => $basicInfo['purpose'],
            'copies' => $options['copies'],
            'language' => $options['language'],
            'is_manufacturer' => $options['is_manufacturer'],
            'invoice_path' => $documents['invoice'],
            'manufacturing_statement_path' => $documents['manufacturing_statement'],
            'delivery_type' => $validated['delivery_type'],
            'shipping_method' => $validated['shipping_method'],
            'address_id' => $validated['address_id'],
            'status' => 'pending_payment',
        ]);

        // Attach products
        $certificate->products()->attach($products);

        // Clear session data
        $request->session()->forget('certificate');

        return redirect()->route('certificates.show', $certificate)
            ->with('success', 'Certificate application created successfully. Please proceed with payment to complete the process.');
    }

    /**
     * Display the specified certificate
     */
    public function show(Certificate $certificate)
    {
        // Check if user owns the certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to view this certificate.');
        }

        return view('dashboard.certificates.show', compact('certificate'));
    }
} 