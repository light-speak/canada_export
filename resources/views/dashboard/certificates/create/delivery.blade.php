@extends('layouts.dashboard')

@section('title', 'New Certificate - Delivery Options')

@section('dashboard-content')
<div class="max-w-4xl mx-auto">
    <!-- 固定在右下角的保存按钮 -->
    <form action="{{ route('certificates.store.delivery') }}" method="POST" class="fixed bottom-4 right-4 z-50">
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
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Step 5 of 5 - Delivery Options</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-12">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#FF0000] to-[#FF4444] rounded-full transition-all duration-500" style="width: 100%"></div>
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
                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                    <svg class="h-5 w-5 text-[#FF0000]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Documents</span>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 bg-[#FF0000] rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-white text-sm font-semibold">5</span>
                </div>
                <span class="text-sm font-medium text-[#FF0000]">Delivery</span>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow-lg rounded-xl overflow-hidden">
        <form action="{{ route('certificates.store.delivery') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            <div class="p-8 space-y-8">
                <!-- Delivery Type -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Delivery Options <span class="text-[#FF0000]">*</span>
                    </label>
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">Choose how you would like to receive your certificate.</p>
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="delivery_type" value="mail_only" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('delivery_type') == 'mail_only' ? 'checked' : '' }} required>
                            <div class="ml-3">
                                <span class="block text-base font-medium text-gray-900 dark:text-white">Mail Only</span>
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Receive your certificate via postal mail only</span>
                            </div>
                        </label>
                        <label class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg hover:border-[#FF0000] dark:hover:border-[#FF0000] cursor-pointer transition-all duration-200">
                            <input type="radio" name="delivery_type" value="mail_and_digital" 
                                class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600"
                                {{ old('delivery_type') == 'mail_and_digital' ? 'checked' : '' }}>
                            <div class="ml-3">
                                <span class="block text-base font-medium text-gray-900 dark:text-white">Mail & Digital Copy</span>
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Receive both a physical copy via mail and a scanned digital copy</span>
                            </div>
                        </label>
                    </div>
                    @error('delivery_type')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shipping Method -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Shipping Method <span class="text-[#FF0000]">*</span>
                    </label>
                    <div x-data="{ open: false, selected: '', selectedName: '' }" class="relative">
                        <button 
                            @click="open = !open" 
                            @click.away="open = false"
                            type="button"
                            class="relative w-full bg-white dark:bg-[#2a2a2a] border-2 border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-3 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent transition duration-200 ease-in-out"
                        >
                            <span x-text="selectedName || 'Select shipping method'" class="block truncate text-gray-900 dark:text-white"></span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <input type="hidden" name="shipping_method" x-model="selected" required>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-100" 
                            x-transition:enter-start="transform opacity-0 scale-95" 
                            x-transition:enter-end="transform opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-75" 
                            x-transition:leave-start="transform opacity-100 scale-100" 
                            x-transition:leave-end="transform opacity-0 scale-95" 
                            class="absolute z-10 mt-1 w-full bg-white dark:bg-[#2a2a2a] shadow-lg rounded-lg py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                            style="max-height: 200px;"
                        >
                            <div @click="selected = 'usps_first'; selectedName = 'USPS First Class Mail'; open = false" 
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === 'usps_first' }"
                            >
                                <span class="block truncate text-gray-900 dark:text-white">USPS First Class Mail</span>
                            </div>
                            <div @click="selected = 'usps_priority'; selectedName = 'USPS Priority Mail'; open = false" 
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === 'usps_priority' }"
                            >
                                <span class="block truncate text-gray-900 dark:text-white">USPS Priority Mail</span>
                            </div>
                            <div @click="selected = 'usps_express'; selectedName = 'USPS Priority Mail Express'; open = false" 
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === 'usps_express' }"
                            >
                                <span class="block truncate text-gray-900 dark:text-white">USPS Priority Mail Express</span>
                            </div>
                            <div @click="selected = 'fedex_ground'; selectedName = 'FedEx Ground'; open = false" 
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === 'fedex_ground' }"
                            >
                                <span class="block truncate text-gray-900 dark:text-white">FedEx Ground</span>
                            </div>
                            <div @click="selected = 'fedex_express'; selectedName = 'FedEx Express'; open = false" 
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === 'fedex_express' }"
                            >
                                <span class="block truncate text-gray-900 dark:text-white">FedEx Express</span>
                            </div>
                        </div>
                    </div>
                    @error('shipping_method')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shipping Address -->
                <div>
                    <label class="block text-lg font-medium text-gray-900 dark:text-white mb-3">
                        Shipping Address <span class="text-[#FF0000]">*</span>
                    </label>
                    <div x-data="{ open: false, selected: '', selectedName: '' }" class="relative">
                        <button 
                            @click="open = !open" 
                            @click.away="open = false"
                            type="button"
                            class="relative w-full bg-white dark:bg-[#2a2a2a] border-2 border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-3 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent transition duration-200 ease-in-out"
                        >
                            <span x-text="selectedName || 'Select shipping address'" class="block truncate text-gray-900 dark:text-white"></span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <input type="hidden" name="address_id" x-model="selected" required>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-100" 
                            x-transition:enter-start="transform opacity-0 scale-95" 
                            x-transition:enter-end="transform opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-75" 
                            x-transition:leave-start="transform opacity-100 scale-100" 
                            x-transition:leave-end="transform opacity-0 scale-95" 
                            class="absolute z-10 mt-1 w-full bg-white dark:bg-[#2a2a2a] shadow-lg rounded-lg py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                            style="max-height: 200px;"
                        >
                            @foreach($addresses as $address)
                                <div @click="selected = '{{ $address->id }}'; selectedName = '{{ $address->recipient_name }} - {{ $address->street }}, {{ $address->city }}, {{ $address->state }} {{ $address->zip }}'; open = false" 
                                    class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-[#FF0000]/5 dark:hover:bg-[#FF0000]/10"
                                    :class="{ 'bg-[#FF0000]/5 dark:bg-[#FF0000]/10': selected === '{{ $address->id }}' }"
                                >
                                    <span class="block truncate text-gray-900 dark:text-white">{{ $address->recipient_name }} - {{ $address->street }}, {{ $address->city }}, {{ $address->state }} {{ $address->zip }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('address_id')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror

                    <!-- USA Mailing Warning -->
                    <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">USA Mailing Addresses Only</h3>
                                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                                    <p>We only accept USA mailing addresses for regular USPS mailing options. For non-USA mailing, you may upload a prepaid shipping label.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50 dark:bg-[#232323] border-t border-gray-200 dark:border-gray-700 flex justify-between">
                <a href="{{ route('certificates.create.documents') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Previous Step
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Summary
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 