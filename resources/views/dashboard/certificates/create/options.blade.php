@extends('layouts.dashboard')

@section('title', 'Create Certificate - Options')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 3 of 5 - Certificate Options</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
            <div class="h-2 bg-[#FF0000] rounded-full" style="width: 60%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
            <span>Basic Info</span>
            <span>Products</span>
            <span class="font-medium text-[#FF0000]">Options</span>
            <span>Documents</span>
            <span>Delivery</span>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('certificates.store.options') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Number of Copies -->
                <div class="mb-6">
                    <label for="copies" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Copies</label>
                    <div class="mt-1">
                        <select id="copies" name="copies" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('copies') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Select how many copies of this certificate should be issued. (Each copy of the certificate will have a unique id and cannot be replicated.)</p>
                    @error('copies')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Certificate Language -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Certificate Language</label>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">What language would you like your certificate to be in? (An additional charge will be applied for bilingual certificates.)</p>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="english" name="language" type="radio" value="english" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('language', 'english') == 'english' ? 'checked' : '' }}>
                            <label for="english" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">English</label>
                        </div>
                        <div class="flex items-center">
                            <input id="english_spanish" name="language" type="radio" value="english_spanish" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('language') == 'english_spanish' ? 'checked' : '' }}>
                            <label for="english_spanish" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">English & Spanish</label>
                        </div>
                        <div class="flex items-center">
                            <input id="english_arabic" name="language" type="radio" value="english_arabic" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('language') == 'english_arabic' ? 'checked' : '' }}>
                            <label for="english_arabic" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">English & Arabic</label>
                        </div>
                    </div>
                    @error('language')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manufacturer Question -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Are you the manufacturer of the products included in this certificate?</label>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The specific wording of your certificate will vary based on your selection.</p>
                    <div class="mt-4 space-x-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <input id="manufacturer_yes" name="is_manufacturer" type="radio" value="1" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('is_manufacturer') == '1' ? 'checked' : '' }}>
                                <label for="manufacturer_yes" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">Yes</label>
                            </div>
                            <div class="flex items-center">
                                <input id="manufacturer_no" name="is_manufacturer" type="radio" value="0" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('is_manufacturer', '0') == '0' ? 'checked' : '' }}>
                                <label for="manufacturer_no" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">No</label>
                            </div>
                        </div>
                    </div>
                    @error('is_manufacturer')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apostille Service -->
                <div class="bg-yellow-50 dark:bg-yellow-900/30 p-4 rounded-md mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">This step may be required for successful export.</h3>
                            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                                <p>If you are unsure, contact a FTGS specialist at support@ftgs.us</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] flex justify-between sm:px-6">
                <a href="{{ route('certificates.create.products') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Documents
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 