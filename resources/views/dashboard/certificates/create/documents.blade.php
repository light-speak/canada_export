@extends('layouts.dashboard')

@section('title', 'Create Certificate - Upload Documents')

@push('scripts')
<script>
    function documentUpload() {
        return {
            init() {
                // 初始化文件上传相关的功能
            }
        }
    }
</script>
@endpush

@section('dashboard-content')
<div class="max-w-4xl mx-auto" x-data="documentUpload()">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Step 4 of 5 - Upload Supporting Documentation</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-12">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#FF0000] to-[#FF4444] rounded-full transition-all duration-500" style="width: 80%"></div>
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
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <svg class="h-5 w-5 text-[#FF0000]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Products</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <svg class="h-5 w-5 text-[#FF0000]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Options</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-[#FF0000] rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-white text-sm font-semibold">4</span>
                </div>
                <span class="text-sm font-medium text-[#FF0000]">Documents</span>
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
        <form action="{{ route('certificates.store.documents') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200 dark:divide-gray-700" x-data="documentUpload()">
            @csrf
            
            <div class="p-8 space-y-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Upload Supporting Documentation</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">All files uploaded must be in the PDF file format.</p>
                </div>

                <!-- U.S. Sales Invoice -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        U.S. Sales Invoice <span class="text-[#FF0000]">*</span>
                    </label>
                    <div 
                        x-data="{ isHovered: false, fileName: '' }"
                        @dragover.prevent="isHovered = true"
                        @dragleave.prevent="isHovered = false"
                        @drop.prevent="
                            isHovered = false;
                            if ($event.dataTransfer.files.length && $event.dataTransfer.files[0].type === 'application/pdf') {
                                $refs.invoice.files = $event.dataTransfer.files;
                                fileName = $event.dataTransfer.files[0].name;
                            }
                        "
                        :class="{ 'border-[#FF0000] bg-[#FF0000]/5': isHovered }"
                        class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 transition-all duration-200"
                    >
                        <input 
                            type="file" 
                            name="invoice" 
                            x-ref="invoice"
                            accept=".pdf"
                            @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            required
                        >
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4 flex text-sm text-gray-600 dark:text-gray-400">
                                <template x-if="!fileName">
                                    <div>
                                        <span class="relative cursor-pointer rounded-md font-medium text-[#FF0000] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#FF0000] focus-within:ring-offset-2 hover:text-[#CC0000]">
                                            Upload a file
                                        </span>
                                        <span class="pl-1">or drag and drop</span>
                                    </div>
                                </template>
                                <template x-if="fileName">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span x-text="fileName"></span>
                                        <button type="button" @click.prevent="fileName = ''; $refs.invoice.value = ''" class="text-[#FF0000] hover:text-[#CC0000]">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PDF up to 50MB</p>
                        </div>
                    </div>
                    @error('invoice')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manufacturing Statement -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Manufacturing Statement <span class="text-[#FF0000]">*</span>
                    </label>
                    <div 
                        x-data="{ isHovered: false, fileName: '' }"
                        @dragover.prevent="isHovered = true"
                        @dragleave.prevent="isHovered = false"
                        @drop.prevent="
                            isHovered = false;
                            if ($event.dataTransfer.files.length && $event.dataTransfer.files[0].type === 'application/pdf') {
                                $refs.manufacturing.files = $event.dataTransfer.files;
                                fileName = $event.dataTransfer.files[0].name;
                            }
                        "
                        :class="{ 'border-[#FF0000] bg-[#FF0000]/5': isHovered }"
                        class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 transition-all duration-200"
                    >
                        <input 
                            type="file" 
                            name="manufacturing_statement" 
                            x-ref="manufacturing"
                            accept=".pdf"
                            @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            required
                        >
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4 flex text-sm text-gray-600 dark:text-gray-400">
                                <template x-if="!fileName">
                                    <div>
                                        <span class="relative cursor-pointer rounded-md font-medium text-[#FF0000] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#FF0000] focus-within:ring-offset-2 hover:text-[#CC0000]">
                                            Upload a file
                                        </span>
                                        <span class="pl-1">or drag and drop</span>
                                    </div>
                                </template>
                                <template x-if="fileName">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span x-text="fileName"></span>
                                        <button type="button" @click.prevent="fileName = ''; $refs.manufacturing.value = ''" class="text-[#FF0000] hover:text-[#CC0000]">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PDF up to 50MB</p>
                        </div>
                    </div>
                    @error('manufacturing_statement')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warning Message -->
                <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-lg">
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
            </div>

            <div class="px-8 py-4 bg-gray-50 dark:bg-[#232323] border-t border-gray-200 dark:border-gray-700 flex justify-between">
                <a href="{{ route('certificates.create.options') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Previous Step
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Delivery
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.documents') }}" method="POST" class="fixed bottom-4 right-4 z-50">
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
@endsection 