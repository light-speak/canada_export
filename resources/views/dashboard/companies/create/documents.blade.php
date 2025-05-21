@extends('layouts.dashboard')

@section('title', 'Add Company - Document Upload')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 4 of 5: Document Upload</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 4 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">80% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 80%"></div>
        </div>
    </div>
    
    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="{{ route('companies.create.basic_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Basic Info
        </a>
        <a href="{{ route('companies.create.legal_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Legal Info
        </a>
        <a href="{{ route('companies.create.contacts') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Contacts
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
            Documents
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Summary
        </a>
    </div>
    
    <!-- Form -->
    <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg p-8">
        <div class="mb-8">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Company Documents</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Upload supporting documents for your company. Allowed file types: PDF, images (JPG, PNG, GIF), or ZIP (max 50MB).</p>
        </div>
        
        <form action="{{ route('companies.store.documents') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-8">
                <label for="business_licence" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Business License</label>
                <div class="mt-2 flex justify-center px-6 pt-7 pb-7 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-14 w-14 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-base text-gray-600 dark:text-gray-400">
                            <label for="business_licence" class="relative cursor-pointer bg-white dark:bg-[#1a1a1a] rounded-md font-medium text-[#FF0000] hover:text-[#CC0000] focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="business_licence" name="business_licence" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png,.gif,.zip">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">PDF, images, or ZIP up to 50MB</p>
                    </div>
                </div>
                @error('business_licence')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('companies.create.contacts') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Contacts
                </a>
                <div>
                    <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Continue to Summary
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-right">You can also proceed without uploading documents</p>
                </div>
            </div>
        </form>
    </div>
    
    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        <p>Documents help verify your company information and speed up the approval process.</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('#business_licence');
        const dropZone = fileInput.closest('.border-dashed');
        
        // 显示文件选择后的文件名
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const textElement = dropZone.querySelector('.text-sm');
                textElement.textContent = `Selected: ${fileName}`;
                dropZone.classList.add('border-[#FF0000]');
                dropZone.classList.remove('border-gray-300', 'dark:border-gray-600');
            }
        });
        
        // 拖放功能
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, function() {
                dropZone.classList.add('border-[#FF0000]', 'bg-[#FF0000]/5');
                dropZone.classList.remove('border-gray-300', 'dark:border-gray-600');
            }, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function() {
                dropZone.classList.remove('bg-[#FF0000]/5');
                if (!fileInput.files.length) {
                    dropZone.classList.remove('border-[#FF0000]');
                    dropZone.classList.add('border-gray-300', 'dark:border-gray-600');
                }
            }, false);
        });
        
        dropZone.addEventListener('drop', function(e) {
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        }, false);
    });
</script>
@endsection 