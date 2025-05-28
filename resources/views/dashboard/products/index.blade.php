@extends('layouts.dashboard')

@section('title', 'Products')

@section('dashboard-content')
<div class="max-w-7xl mx-auto" x-data="{ isModalOpen: false }">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Products</h1>
        <button @click="isModalOpen = true" 
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Product
        </button>
    </div>

    @if($products->isEmpty())
        <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg p-6 text-center">
            <div class="flex flex-col items-center">
                <svg class="h-12 w-12 text-gray-400 dark:text-gray-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No products found</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Get started by creating your first product.</p>
                <button @click="isModalOpen = true" 
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Add Product
                </button>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-[#232323]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Manufacturer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">SKU Code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">HS Code</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-[#1a1a1a] divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                            <tr>
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
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#FF0000] hover:text-[#CC0000]" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Add Product Modal -->
    <div x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] overflow-y-auto"
        style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- 背景遮罩 -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <!-- 模态框内容 -->
            <div class="inline-block align-bottom bg-white dark:bg-[#1a1a1a] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-[110]"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="isModalOpen = false">
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
</div>

@push('scripts')
<script>
function submitProduct(event) {
    const form = event.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    // 显示加载状态
    submitButton.disabled = true;
    submitButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    `;
    
    // 清除之前的错误提示
    const errorElements = form.querySelectorAll('.error-message');
    errorElements.forEach(el => el.remove());
    
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
            // 显示成功消息
            const successMessage = document.createElement('div');
            successMessage.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-y-0';
            successMessage.innerHTML = `
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Product added successfully
                </div>
            `;
            document.body.appendChild(successMessage);
            
            // 1秒后刷新页面
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            throw new Error(data.message || 'Failed to add product');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // 显示错误消息
        const errorMessage = document.createElement('div');
        errorMessage.className = 'mt-2 text-sm text-[#FF0000] error-message';
        errorMessage.textContent = error.message || 'An error occurred while adding the product. Please try again.';
        form.querySelector('.space-y-4').appendChild(errorMessage);
        
        // 恢复按钮状态
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    });
}

// 添加按键监听
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.querySelector('[x-data]').__x.$data;
        if (modal.isModalOpen) {
            modal.isModalOpen = false;
        }
    }
});
</script>
@endpush
@endsection 