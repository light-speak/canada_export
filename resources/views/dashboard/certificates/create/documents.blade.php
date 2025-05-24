@extends('layouts.dashboard')

@section('title', 'Create Certificate - Upload Documents')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 4 of 5 - Upload Supporting Documentation</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
            <div class="h-2 bg-[#FF0000] rounded-full" style="width: 80%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
            <span>Basic Info</span>
            <span>Products</span>
            <span>Options</span>
            <span class="font-medium text-[#FF0000]">Documents</span>
            <span>Delivery</span>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('certificates.store.documents') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Upload Supporting Documentation</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">All files uploaded must be in the PDF file format.</p>
                </div>

                <!-- U.S. Sales Invoice -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">U.S. Sales Invoice (PDF ONLY)</label>
                    <div class="mt-1 flex items-center">
                        <div class="flex-1">
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md relative">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="invoice" class="relative cursor-pointer bg-white dark:bg-[#2a2a2a] rounded-md font-medium text-[#FF0000] hover:text-[#CC0000] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#FF0000]">
                                            <span>Upload a file</span>
                                            <input id="invoice" name="invoice" type="file" class="sr-only" accept=".pdf">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PDF up to 50MB
                                    </p>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center hidden file-preview bg-black bg-opacity-50">
                                    <div class="text-white text-center p-4">
                                        <p class="file-name text-sm mb-2"></p>
                                        <button type="button" class="text-xs text-red-400 hover:text-red-500 remove-file">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-4">
                            <a href="#" class="text-sm text-[#FF0000] hover:text-[#CC0000]">Requirements</a>
                        </div>
                    </div>
                    @error('invoice')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manufacturing Statement -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Manufacturing Statement (PDF ONLY)</label>
                    <div class="mt-1 flex items-center">
                        <div class="flex-1">
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md relative">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="manufacturing_statement" class="relative cursor-pointer bg-white dark:bg-[#2a2a2a] rounded-md font-medium text-[#FF0000] hover:text-[#CC0000] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#FF0000]">
                                            <span>Upload a file</span>
                                            <input id="manufacturing_statement" name="manufacturing_statement" type="file" class="sr-only" accept=".pdf">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PDF up to 50MB
                                    </p>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center hidden file-preview bg-black bg-opacity-50">
                                    <div class="text-white text-center p-4">
                                        <p class="file-name text-sm mb-2"></p>
                                        <button type="button" class="text-xs text-red-400 hover:text-red-500 remove-file">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-4">
                            <a href="#" class="text-sm text-[#FF0000] hover:text-[#CC0000]">Required Format - (Example)</a>
                        </div>
                    </div>
                    @error('manufacturing_statement')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Required Content Format Warning -->
                <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-md mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Required Content Format</h3>
                            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                                <p>Uploading supporting documentation that is not in the required format will result in a delay in your Certificate's processing and approval. Please review examples of the format requirements before uploading or contact your local Chamber of Commerce if you have any questions.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PDF Conversion Help -->
                <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Don't have access to a PDF?</h3>
                            <div class="mt-2 text-sm text-blue-700 dark:text-blue-200">
                                <p>If your document is in a photo format (JPEG), you can <a href="#" class="underline">convert it to a PDF by clicking here</a>. (Third Party)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] flex justify-between sm:px-6">
                <a href="{{ route('certificates.create.options') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Delivery
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        const dropZone = input.closest('.border-dashed');
        const preview = dropZone.querySelector('.file-preview');
        const fileName = preview.querySelector('.file-name');
        const removeButton = preview.querySelector('.remove-file');
        
        // Handle drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-[#FF0000]', 'border-2');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-[#FF0000]', 'border-2');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            handleFile(file);
        }

        // Handle file selection
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                handleFile(this.files[0]);
            }
        });

        // Handle file preview
        function handleFile(file) {
            if (file.type !== 'application/pdf') {
                alert('Please upload a PDF file');
                return;
            }
            
            fileName.textContent = file.name;
            preview.classList.remove('hidden');
        }

        // Handle file removal
        removeButton.addEventListener('click', function() {
            input.value = '';
            preview.classList.add('hidden');
            fileName.textContent = '';
        });
    });
});
</script>
@endpush

@endsection 