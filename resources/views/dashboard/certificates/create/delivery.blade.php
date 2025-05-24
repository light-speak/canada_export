@extends('layouts.dashboard')

@section('title', 'Create Certificate - Delivery Options')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 5 of 5 - Delivery Options</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
            <div class="h-2 bg-[#FF0000] rounded-full" style="width: 100%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
            <span>Basic Info</span>
            <span>Products</span>
            <span>Options</span>
            <span>Documents</span>
            <span class="font-medium text-[#FF0000]">Delivery</span>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('certificates.store.delivery') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Delivery Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Delivery Options</label>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="mail_only" name="delivery_type" type="radio" value="mail_only" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('delivery_type', 'mail_only') == 'mail_only' ? 'checked' : '' }}>
                            <label for="mail_only" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">
                                Mail Only
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="mail_and_digital" name="delivery_type" type="radio" value="mail_and_digital" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('delivery_type') == 'mail_and_digital' ? 'checked' : '' }}>
                            <label for="mail_and_digital" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">
                                Mail & Scanned digital copy
                            </label>
                        </div>
                    </div>
                    @error('delivery_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shipping Method -->
                <div class="mb-6">
                    <label for="shipping_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">How would you like to receive your certificate?</label>
                    <select id="shipping_method" name="shipping_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                        <option value="">Select shipping method</option>
                        <option value="usps_first" {{ old('shipping_method') == 'usps_first' ? 'selected' : '' }}>USPS First-Class Mail</option>
                        <option value="usps_priority" {{ old('shipping_method') == 'usps_priority' ? 'selected' : '' }}>USPS Priority Mail</option>
                        <option value="usps_express" {{ old('shipping_method') == 'usps_express' ? 'selected' : '' }}>USPS Priority Mail Express</option>
                        <option value="fedex_ground" {{ old('shipping_method') == 'fedex_ground' ? 'selected' : '' }}>FedEx Ground</option>
                        <option value="fedex_express" {{ old('shipping_method') == 'fedex_express' ? 'selected' : '' }}>FedEx Express</option>
                    </select>
                    @error('shipping_method')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shipping Address -->
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <label for="address_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select an address</label>
                        <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-[#FF0000] bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New
                        </button>
                    </div>
                    <select id="address_id" name="address_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                        <option value="">Select an address</option>
                        @foreach(Auth::user()->addresses as $address)
                            <option value="{{ $address->id }}" {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                {{ $address->name }} - {{ $address->street }}, {{ $address->city }}, {{ $address->state }} {{ $address->zip }}
                            </option>
                        @endforeach
                    </select>
                    @error('address_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- USA Address Warning -->
                <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-md">
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

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] flex justify-between sm:px-6">
                <a href="{{ route('certificates.create.documents') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Summary
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 