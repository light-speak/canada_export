@extends('layouts.dashboard')

@section('title', 'Add Company - Basic Information')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 1 of 5: Basic Information</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 1 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">20% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 20%"></div>
        </div>
    </div>
    
    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
            Basic Info
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Legal Info
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Contacts
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Documents
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Summary
        </a>
    </div>
    
    <!-- Form -->
    <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg p-8">
        <form action="{{ route('companies.store.basic_info') }}" method="POST">
            @csrf
            
            <div class="mb-8">
                <label for="name" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Company Name <span class="text-[#FF0000]">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', session('company_basic_info.name')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                @error('name')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="website" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Website</label>
                <input type="url" name="website" id="website" value="{{ old('website', session('company_basic_info.website')) }}" placeholder="https://example.com" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
                @error('website')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="registered_address" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Registered Address <span class="text-[#FF0000]">*</span></label>
                <input type="text" name="registered_address" id="registered_address" value="{{ old('registered_address', session('company_basic_info.registered_address')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                @error('registered_address')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="building_suite" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Building/Suite (Optional)</label>
                <input type="text" name="building_suite" id="building_suite" value="{{ old('building_suite', session('company_basic_info.building_suite')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
            </div>
            
            <div class="mb-8">
                <label for="operations_address" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Operations Address (if different)</label>
                <input type="text" name="operations_address" id="operations_address" value="{{ old('operations_address', session('company_basic_info.operations_address')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('companies.index') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] mr-4">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Legal Info
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 