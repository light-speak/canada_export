@extends('layouts.dashboard')

@section('title', 'Edit Address')

@section('dashboard-content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Address</h1>
        <a href="{{ route('addresses.index') }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Addresses
        </a>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('addresses.update', $address) }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            @method('PUT')
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Recipient Name -->
                <div class="mb-6">
                    <label for="recipient_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Recipient Name <span class="text-[#FF0000]">*</span>
                    </label>
                    <input type="text" name="recipient_name" id="recipient_name" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                        value="{{ old('recipient_name', $address->recipient_name) }}" required>
                    @error('recipient_name')
                        <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Street Address -->
                <div class="mb-6">
                    <label for="street" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Street Address <span class="text-[#FF0000]">*</span>
                    </label>
                    <input type="text" name="street" id="street" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                        value="{{ old('street', $address->street) }}" required>
                    @error('street')
                        <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Street Address Line 2 -->
                <div class="mb-6">
                    <label for="street2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Street Address Line 2
                    </label>
                    <input type="text" name="street2" id="street2" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                        value="{{ old('street2', $address->street2) }}">
                    @error('street2')
                        <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div class="mb-6">
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        City <span class="text-[#FF0000]">*</span>
                    </label>
                    <input type="text" name="city" id="city" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                        value="{{ old('city', $address->city) }}" required>
                    @error('city')
                        <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State and ZIP -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            State <span class="text-[#FF0000]">*</span>
                        </label>
                        <select name="state" id="state" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                            required>
                            <option value="">Select a state</option>
                            <option value="AL" {{ old('state', $address->state) == 'AL' ? 'selected' : '' }}>Alabama</option>
                            <option value="AK" {{ old('state', $address->state) == 'AK' ? 'selected' : '' }}>Alaska</option>
                            <option value="AZ" {{ old('state', $address->state) == 'AZ' ? 'selected' : '' }}>Arizona</option>
                            <!-- Add all US states -->
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="zip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ZIP Code <span class="text-[#FF0000]">*</span>
                        </label>
                        <input type="text" name="zip" id="zip" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                            value="{{ old('zip', $address->zip) }}" required>
                        @error('zip')
                            <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Phone -->
                <div class="mt-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Phone Number <span class="text-[#FF0000]">*</span>
                    </label>
                    <input type="tel" name="phone" id="phone" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] rounded-md shadow-sm focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm"
                        value="{{ old('phone', $address->phone) }}" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] text-right sm:px-6">
                <button type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Update Address
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 