@extends('layouts.dashboard')

@section('title', 'Create Certificate - Options')

@section('dashboard-content')
<div class="max-w-4xl mx-auto" x-data="{ showCustomWording: false }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Step 3 of 5 - Certificate Options</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-12">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#FF0000] to-[#FF4444] rounded-full transition-all duration-500" style="width: 60%"></div>
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
                <div class="w-8 h-8 bg-[#FF0000] rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-white text-sm font-semibold">3</span>
                </div>
                <span class="text-sm font-medium text-[#FF0000]">Options</span>
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
        <form action="{{ route('certificates.store.options') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="p-8 space-y-8">
                <!-- Number of Copies -->
                <div>
                    <label for="copies" class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Number of Copies <span class="text-[#FF0000]">*</span>
                    </label>
                    <div class="relative">
                        <select id="copies" name="copies" 
                            class="block w-full bg-white dark:bg-[#2a2a2a] border-2 border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent transition duration-200 ease-in-out">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('copies') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Select how many copies of this certificate should be issued. (Each copy of the certificate will have a unique id and cannot be replicated.)</p>
                    @error('copies')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Certificate Language -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Certificate Language <span class="text-[#FF0000]">*</span>
                    </label>
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">What language would you like your certificate to be in? (An additional charge will be applied for bilingual certificates.)</p>
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="language" value="english" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('language', 'english') == 'english' ? 'checked' : '' }}>
                            <span class="ml-3 block text-base font-medium text-gray-900 dark:text-white">English</span>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="language" value="english_spanish" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('language') == 'english_spanish' ? 'checked' : '' }}>
                            <span class="ml-3 block text-base font-medium text-gray-900 dark:text-white">English & Spanish</span>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="language" value="english_arabic" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('language') == 'english_arabic' ? 'checked' : '' }}>
                            <span class="ml-3 block text-base font-medium text-gray-900 dark:text-white">English & Arabic</span>
                        </label>
                    </div>
                    @error('language')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manufacturer Question -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Are you the manufacturer of the products included in this certificate? <span class="text-[#FF0000]">*</span>
                    </label>
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">The specific wording of your certificate will vary based on your selection.</p>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="is_manufacturer" value="1" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('is_manufacturer') == '1' ? 'checked' : '' }}>
                            <span class="ml-3 block text-base font-medium text-gray-900 dark:text-white">Yes</span>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="is_manufacturer" value="0" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('is_manufacturer', '0') == '0' ? 'checked' : '' }}>
                            <span class="ml-3 block text-base font-medium text-gray-900 dark:text-white">No</span>
                        </label>
                    </div>
                    @error('is_manufacturer')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Custom Wording Request -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-lg font-medium text-gray-900 dark:text-white">
                            Request Custom Wording for Certificate
                        </label>
                        <button type="button" 
                            @click="showCustomWording = !showCustomWording"
                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] transition-colors duration-200">
                            <span x-text="showCustomWording ? 'Cancel Request' : 'Make Request'"></span>
                        </button>
                    </div>
                    <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-lg mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Not Recommended</h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <p>Addendums and special requests can only be done in English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="showCustomWording" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="mt-4">
                        <textarea
                            name="custom_wording"
                            rows="4"
                            class="block w-full rounded-lg border-2 border-gray-200 dark:border-gray-700 dark:bg-[#2a2a2a] dark:text-white shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] sm:text-sm"
                            placeholder="Please describe your custom wording request in detail..."
                        >{{ old('custom_wording') }}</textarea>
                        @error('custom_wording')
                            <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50 dark:bg-[#232323] border-t border-gray-200 dark:border-gray-700 flex justify-between">
                <a href="{{ route('certificates.create.products') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.options') }}" method="POST" class="fixed bottom-4 right-4 z-50">
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