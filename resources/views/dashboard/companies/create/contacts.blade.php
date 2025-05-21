@extends('layouts.dashboard')

@section('title', 'Add Company - Contact Information')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 3 of 5: Contact Information</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 3 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">60% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 60%"></div>
        </div>
    </div>
    
    <!-- Step Navigation -->
    <div class="flex mb-6 overflow-x-auto">
        <a href="{{ route('companies.create.basic_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Basic Info
        </a>
        <a href="{{ route('companies.create.legal_info') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Legal Info
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
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
        <div class="mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Primary Contact</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This will be the main point of contact for this company.</p>
        </div>
        
        <form action="{{ route('companies.store.contacts') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="first_name" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">First Name <span class="text-[#FF0000]">*</span></label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', session('company_primary_contact.first_name')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                    @error('first_name')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="last_name" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name <span class="text-[#FF0000]">*</span></label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', session('company_primary_contact.last_name')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                    @error('last_name')
                        <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-8">
                <label for="job_title" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title', session('company_primary_contact.job_title')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base">
                @error('job_title')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="phone" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number <span class="text-[#FF0000]">*</span></label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', session('company_primary_contact.phone')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                @error('phone')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="email" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address <span class="text-[#FF0000]">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', session('company_primary_contact.email')) }}" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-[#121212] shadow-sm focus:border-[#FF0000] focus:ring-[#FF0000] py-3 px-4 text-base" required>
                @error('email')
                    <p class="mt-2 text-sm text-[#FF0000]">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    This email will receive notifications about documents, certificates, and approvals.
                </p>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('companies.create.legal_info') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Legal Info
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Documents
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    
    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        <p>You can add additional contacts after creating the company.</p>
    </div>
</div>
@endsection 