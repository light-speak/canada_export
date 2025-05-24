@extends('layouts.dashboard')

@section('title', 'Create Certificate - Basic Information')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 1 of 5 - Basic Information</p>
    </div>

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
            <div class="h-2 bg-[#FF0000] rounded-full" style="width: 20%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
            <span class="font-medium text-[#FF0000]">Basic Info</span>
            <span>Products</span>
            <span>Options</span>
            <span>Documents</span>
            <span>Delivery</span>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('certificates.store.basic_info') }}" method="POST" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Company Selection -->
                <div class="mb-6">
                    <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                    <select id="company_id" name="company_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                        <option value="">Select a company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Destination Country -->
                <div class="mb-6">
                    <label for="destination_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">What country are you exporting to?</label>
                    <select id="destination_country" name="destination_country" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                        <option value="">Select destination country</option>
                        <option value="american_samoa" {{ old('destination_country') == 'american_samoa' ? 'selected' : '' }}>American Samoa</option>
                        <option value="canada" {{ old('destination_country') == 'canada' ? 'selected' : '' }}>Canada</option>
                        <option value="mexico" {{ old('destination_country') == 'mexico' ? 'selected' : '' }}>Mexico</option>
                        <!-- Add more countries as needed -->
                    </select>
                    @error('destination_country')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Certificate Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Which Certificates do you wish to apply for?</label>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="radio" id="cfs" name="certificate_type" value="certificate_of_free_sale" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('certificate_type') == 'certificate_of_free_sale' ? 'checked' : '' }}>
                            <label for="cfs" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">
                                Certificate of Free Sale (CFS)
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="gmp" name="certificate_type" value="gmp_certificate" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-600" {{ old('certificate_type') == 'gmp_certificate' ? 'checked' : '' }}>
                            <label for="gmp" class="ml-3 block text-sm text-gray-700 dark:text-gray-300">
                                Good Manufacturing Practices Certificate (GMP)
                            </label>
                        </div>
                    </div>
                    @error('certificate_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Continue to Products
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 