@extends('layouts.dashboard')

@section('title', 'Create Certificate - Select Products')

@section('dashboard-content')
<div class="max-w-4xl mx-auto" 
    x-data="{ 
        isModalOpen: false,
        selectAll: false,
        handleSelectAll() {
            this.selectAll = !this.selectAll;
            document.querySelectorAll('input[name=\'products[]\']').forEach(checkbox => {
                checkbox.checked = this.selectAll;
            });
        }
    }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Step 2 of 5 - Select Products</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-12">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#FF0000] to-[#FF4444] rounded-full transition-all duration-500" style="width: 40%"></div>
        </div>
        <div class="flex justify-between mt-4">
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <svg class="h-5 w-5 text-[#FF0000]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Basic Info</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-[#FF0000] rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-white text-sm font-semibold">2</span>
                </div>
                <span class="text-sm font-medium text-[#FF0000]">Products</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">3</span>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Options</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">4</span>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Documents</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">5</span>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Delivery</span>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow-lg rounded-xl overflow-hidden">
        <form action="{{ route('certificates.store.products') }}" method="POST" id="productsForm">
            @csrf
            
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Select Products</h2>
                </div>

                @if($products->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new product.</p>
                        <div class="mt-6">
                            <button type="button" @click="isModalOpen = true"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add New Product
                            </button>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-[#232323]">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                @click="handleSelectAll"
                                                :checked="selectAll"
                                                class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600 rounded cursor-pointer">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Manufacturer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">SKU Code</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">HS Code</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-[#1a1a1a] divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <input type="checkbox" 
                                                    name="products[]" 
                                                    value="{{ $product->id }}" 
                                                    @click="selectAll = false"
                                                    class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600 rounded cursor-pointer">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $product->manufacturer }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $product->sku_code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $product->hs_code }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @error('products')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-8 py-4 bg-gray-50 dark:bg-[#232323] border-t border-gray-200 dark:border-gray-700 flex justify-between">
                <a href="{{ route('certificates.create.basic_info') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Options
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Add Product Modal -->
    <div x-show="isModalOpen" 
        class="fixed inset-0 z-50 overflow-y-auto" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <div class="inline-block align-bottom bg-white dark:bg-[#1a1a1a] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <form id="add-product-form" @submit.prevent="submitProduct($event)">
                    <div class="bg-white dark:bg-[#1a1a1a] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Add New Product</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Fill in the product details below.</p>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name <span class="text-[#FF0000]">*</span></label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="text" name="name" id="name" required
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] dark:text-white px-4 py-3 focus:ring-2 focus:ring-[#FF0000]/20 focus:border-[#FF0000] transition duration-150 ease-in-out placeholder-gray-400 dark:placeholder-gray-500"
                                        placeholder="Enter product name">
                                </div>
                            </div>
                            <div>
                                <label for="manufacturer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Manufacturer</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="text" name="manufacturer" id="manufacturer"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] dark:text-white px-4 py-3 focus:ring-2 focus:ring-[#FF0000]/20 focus:border-[#FF0000] transition duration-150 ease-in-out placeholder-gray-400 dark:placeholder-gray-500"
                                        placeholder="Enter manufacturer name">
                                </div>
                            </div>
                            <div>
                                <label for="sku_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SKU Code</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="text" name="sku_code" id="sku_code"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] dark:text-white px-4 py-3 focus:ring-2 focus:ring-[#FF0000]/20 focus:border-[#FF0000] transition duration-150 ease-in-out placeholder-gray-400 dark:placeholder-gray-500"
                                        placeholder="Enter SKU code">
                                </div>
                            </div>
                            <div>
                                <label for="hs_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">HS Code</label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="text" name="hs_code" id="hs_code"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] dark:text-white px-4 py-3 focus:ring-2 focus:ring-[#FF0000]/20 focus:border-[#FF0000] transition duration-150 ease-in-out placeholder-gray-400 dark:placeholder-gray-500"
                                        placeholder="Enter HS code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-[#232323] px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-6 py-3 bg-[#FF0000] text-base font-medium text-white hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            Add Product
                        </button>
                        <button type="button" @click="isModalOpen = false"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm px-6 py-3 bg-white dark:bg-[#2a2a2a] text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-150 ease-in-out">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.products') }}" method="POST" class="fixed bottom-4 right-4 z-50">
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
</div>

@push('scripts')
<script>
function submitProduct(event) {
    const form = event.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    submitButton.disabled = true;
    submitButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    `;
    
    fetch('{{ route('products.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            Object.keys(data.errors).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                const error = document.createElement('p');
                error.className = 'mt-2 text-sm text-[#FF0000]';
                error.textContent = data.errors[key][0];
                input.parentNode.appendChild(error);
            });
            
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    });
}
</script>
@endpush

@endsection 