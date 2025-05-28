@extends('layouts.dashboard')

@section('title', 'Create Certificate - Basic Information')

@section('dashboard-content')
<div class="max-w-4xl mx-auto">
    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.basic_info') }}" method="POST" class="fixed bottom-4 right-4 z-50">
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

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Step 1 of 5 - Basic Information</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-12">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#FF0000] to-[#FF4444] rounded-full transition-all duration-500" style="width: 20%"></div>
        </div>
        <div class="flex justify-between mt-4">
            <div class="text-center">
                <div class="w-8 h-8 bg-[#FF0000] rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-white text-sm font-semibold">1</span>
                </div>
                <span class="text-sm font-medium text-[#FF0000]">Basic Info</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-gray-600 dark:text-gray-400 text-sm">2</span>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Products</span>
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
        <form action="{{ route('certificates.store.basic_info') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="p-8 space-y-8">
                <!-- Company Selection -->
                <div>
                    <label for="company_id" class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Company <span class="text-[#FF0000]">*</span>
                    </label>
                    <div x-data="{ open: false, selected: '', selectedName: '' }" class="relative">
                        <button 
                            @click="open = !open" 
                            @click.away="open = false"
                            type="button"
                            class="relative w-full bg-white dark:bg-[#2a2a2a] border-2 border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-3 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent transition duration-200 ease-in-out"
                        >
                            <span x-text="selectedName || 'Select a company'" class="block truncate text-gray-900 dark:text-white"></span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <input type="hidden" name="company_id" x-model="selected" required>

                        <div 
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute z-50 w-full mt-1 bg-white dark:bg-[#2a2a2a] rounded-lg shadow-lg max-h-60 overflow-auto border border-gray-200 dark:border-gray-700"
                            style="display: none;"
                        >
                            <ul class="py-1">
                                @foreach($companies as $company)
                                <li>
                                    <button
                                        type="button"
                                        @click="selected = '{{ $company->id }}'; selectedName = '{{ $company->name }}'; open = false"
                                        class="w-full text-left px-4 py-3 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10 focus:bg-[#FF0000] focus:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == '{{ $company->id }}' }"
                                    >
                                        {{ $company->name }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @error('company_id')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Destination Country -->
                <div>
                    <label for="destination_country" class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        What country are you exporting to? <span class="text-[#FF0000]">*</span>
                    </label>
                    <div x-data="{ open: false, selected: '', selectedName: '' }" class="relative">
                        <button 
                            @click="open = !open" 
                            @click.away="open = false"
                            type="button"
                            class="relative w-full bg-white dark:bg-[#2a2a2a] border-2 border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-3 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent transition duration-200 ease-in-out"
                        >
                            <span x-text="selectedName || 'Select destination country'" class="block truncate text-gray-900 dark:text-white"></span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <input type="hidden" name="destination_country" x-model="selected" required>

                        <div 
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute z-50 w-full mt-1 bg-white dark:bg-[#2a2a2a] rounded-lg shadow-lg max-h-60 overflow-auto border border-gray-200 dark:border-gray-700"
                            style="display: none;"
                        >
                            <ul class="py-1">
                                <li class="px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800">North America</li>
                                <li>
                                    <button type="button" @click="selected = 'canada'; selectedName = 'Canada'; open = false" 
                                        class="w-full text-left px-4 py-2 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == 'canada' }">Canada</button>
                                </li>
                                <li>
                                    <button type="button" @click="selected = 'mexico'; selectedName = 'Mexico'; open = false"
                                        class="w-full text-left px-4 py-2 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == 'mexico' }">Mexico</button>
                                </li>
                                <li>
                                    <button type="button" @click="selected = 'united_states'; selectedName = 'United States'; open = false"
                                        class="w-full text-left px-4 py-2 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == 'united_states' }">United States</button>
                                </li>

                                <li class="px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 mt-2">Asia</li>
                                <li>
                                    <button type="button" @click="selected = 'china'; selectedName = 'China'; open = false"
                                        class="w-full text-left px-4 py-2 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == 'china' }">China</button>
                                </li>
                                <!-- Add other Asian countries similarly -->

                                <li class="px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 mt-2">Europe</li>
                                <li>
                                    <button type="button" @click="selected = 'france'; selectedName = 'France'; open = false"
                                        class="w-full text-left px-4 py-2 text-gray-900 dark:text-white hover:bg-[#FF0000] hover:bg-opacity-10"
                                        :class="{ 'bg-[#FF0000] bg-opacity-10': selected == 'france' }">France</button>
                                </li>
                                <!-- Add other European countries similarly -->

                                <!-- Add other regions and countries similarly -->
                            </ul>
                        </div>
                    </div>
                    @error('destination_country')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Certificate Type -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Which Certificates do you wish to apply for? <span class="text-[#FF0000]">*</span>
                    </label>
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="certificate_type" value="free_sale" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('certificate_type') == 'free_sale' ? 'checked' : '' }}>
                            <div class="ml-4">
                                <span class="block text-base font-medium text-gray-900 dark:text-white">Certificate of Free Sale (CFS)</span>
                                <span class="block mt-1 text-sm text-gray-500 dark:text-gray-400">Certifies that your products are freely sold in the United States</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="certificate_type" value="gmp" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('certificate_type') == 'gmp' ? 'checked' : '' }}>
                            <div class="ml-4">
                                <span class="block text-base font-medium text-gray-900 dark:text-white">Good Manufacturing Practices Certificate (GMP)</span>
                                <span class="block mt-1 text-sm text-gray-500 dark:text-gray-400">Certifies that your manufacturing facility follows GMP guidelines</span>
                            </div>
                        </label>
                    </div>
                    @error('certificate_type')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-8 py-6 bg-gray-50 dark:bg-[#232323] flex justify-end">
                <button type="submit" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg 
                    text-white bg-gradient-to-r from-[#FF0000] to-[#FF4444] hover:from-[#FF1111] hover:to-[#FF5555]
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] transform hover:scale-105
                    transition-all duration-200 shadow-lg hover:shadow-xl">
                    Continue to Products
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    /* 自定义单选框样式 */
    input[type="radio"]:checked + div {
        @apply text-[#FF0000];
    }
    
    input[type="radio"]:checked + div span:first-child {
        @apply text-[#FF0000];
    }
    
    /* 选中时的边框样式 */
    input[type="radio"]:checked ~ div {
        @apply border-[#FF0000];
    }

    /* 自定义下拉框样式 */
    select {
        background-image: none !important;
    }

    select option {
        padding: 8px;
    }

    select optgroup {
        font-weight: 600;
        background-color: #f3f4f6;
    }

    .dark select optgroup {
        background-color: #2a2a2a;
    }

    select option:hover,
    select option:focus,
    select option:active,
    select option:checked {
        background-color: #FF0000 !important;
        color: white !important;
    }

    /* 美化下拉框在 Safari 中的外观 */
    select::-webkit-scrollbar {
        width: 8px;
    }

    select::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    select::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    select::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* 暗色模式滚动条 */
    .dark select::-webkit-scrollbar-track {
        background: #2a2a2a;
    }

    .dark select::-webkit-scrollbar-thumb {
        background: #666;
    }

    .dark select::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
</style>
@endpush
@endsection 