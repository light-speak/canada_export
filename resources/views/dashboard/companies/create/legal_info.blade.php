@extends('layouts.dashboard')

@section('title', 'Add Company - Legal Information')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 2 of 5: Legal Information</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 2 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">40% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 40%"></div>
        </div>
    </div>
    
    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="{{ route('companies.create.basic_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Basic Info
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
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
        <form action="{{ route('companies.store.legal_info') }}" method="POST">
            @csrf
            
            <div class="mb-8">
                <label for="business_licence_number" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Business License Number</label>
                <input type="text" name="business_licence_number" id="business_licence_number" value="{{ old('business_licence_number', session('company_legal_info.business_licence_number')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
                @error('business_licence_number')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="licence_expiry_date" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">License Expiry Date</label>
                <input type="date" name="licence_expiry_date" id="licence_expiry_date" value="{{ old('licence_expiry_date', session('company_legal_info.licence_expiry_date')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
                @error('licence_expiry_date')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="incorporation_id" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Incorporation ID</label>
                <input type="text" name="incorporation_id" id="incorporation_id" value="{{ old('incorporation_id', session('company_legal_info.incorporation_id')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
                @error('incorporation_id')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <div class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">Company Type</div>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input id="is_manufacturer_1" name="is_manufacturer" type="radio" value="1" class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300" {{ old('is_manufacturer', session('company_legal_info.is_manufacturer')) == 1 ? 'checked' : '' }}>
                        <label for="is_manufacturer_1" class="ml-3 block text-base font-medium text-gray-700 dark:text-gray-300">
                            Manufacturer
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="is_manufacturer_0" name="is_manufacturer" type="radio" value="0" class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300" {{ old('is_manufacturer', session('company_legal_info.is_manufacturer')) == 0 ? 'checked' : '' }}>
                        <label for="is_manufacturer_0" class="ml-3 block text-base font-medium text-gray-700 dark:text-gray-300">
                            Exporter/Trader
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mb-8">
                <div class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">Chamber Membership</div>
                <div class="flex items-start">
                    <div class="flex items-center h-6">
                        <input id="is_chamber_member" name="is_chamber_member" type="checkbox" class="h-5 w-5 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 rounded" {{ old('is_chamber_member', session('company_legal_info.is_chamber_member')) ? 'checked' : '' }}>
                    </div>
                    <div class="ml-3 text-base">
                        <label for="is_chamber_member" class="font-medium text-gray-700 dark:text-gray-300">This company is a member of Boulder Chamber of Commerce</label>
                        <p class="text-gray-500 dark:text-gray-400">Chamber members receive expedited processing and reduced fees.</p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('companies.create.basic_info') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Basic Info
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Contacts
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 