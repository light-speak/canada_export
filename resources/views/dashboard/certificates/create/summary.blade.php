@extends('layouts.dashboard')

@section('title', 'Certificate Summary')

@section('dashboard-content')
<div class="max-w-3xl mx-auto">
    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.summary') }}" method="POST" class="fixed bottom-4 right-4 z-50">
        @csrf
        <input type="hidden" name="save_draft" value="1">
        <button type="submit"
            class="flex items-center px-4 py-2 bg-[#FF0000] text-white rounded-lg shadow-lg hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            Save as Draft
        </button>
    </form>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Certificate Summary</h1>
        <a href="{{ route('certificates.create.delivery') }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
        </a>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <!-- Basic Information -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Basic Information</h2>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Certificate Type</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', session('certificate.basic_info.certificate_type'))) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Destination Country</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', session('certificate.basic_info.destination_country'))) }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Products -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Products</h2>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-[#232323]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Unit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-[#1a1a1a] divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach(session('certificate.products') as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $product['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $product['quantity'] ?? 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $product['unit'] ?? 'piece' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Options -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Certificate Options</h2>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Number of Copies</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.options.copies') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Language</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', session('certificate.options.language'))) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Manufacturer Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.options.is_manufacturer') ? 'Yes' : 'No' }}</dd>
                    </div>
                    @if(session('certificate.options.custom_wording'))
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Custom Wording</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.options.custom_wording') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Documents -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Uploaded Documents</h2>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Invoice</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.documents.invoice.file_name') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Manufacturing Statement</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.documents.manufacturing_statement.file_name') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Delivery -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Delivery Information</h2>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Delivery Type</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', session('certificate.delivery.delivery_type'))) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Shipping Method</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', session('certificate.delivery.shipping_method'))) }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Shipping Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ session('certificate.delivery.shipping_address') }}</dd>
                    </div>
                </dl>
            </div>

            <form action="{{ route('certificates.store.summary') }}" method="POST" class="mt-8">
                @csrf
                <div class="flex justify-end space-x-4">
                    <button type="submit" name="save_draft" value="1"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Save as Draft
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Submit Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 