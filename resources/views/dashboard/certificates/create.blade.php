@extends('layouts.dashboard')

@section('title', 'Create Certificate')

@section('dashboard-content')
<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Certificate</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Fill out the form below to create a new export certificate</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('certificates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Certificates
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200 dark:divide-gray-700">
            @csrf
            
            <div class="px-4 py-5 sm:p-6">
                <!-- Company Selection -->
                <div class="mb-6">
                    <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                    <select id="company_id" name="company_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
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

                <!-- Certificate Type -->
                <div class="mb-6">
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Certificate Type</label>
                    <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm rounded-md">
                        <option value="">Select certificate type</option>
                        <option value="certificate_of_free_sale" {{ old('type') == 'certificate_of_free_sale' ? 'selected' : '' }}>Certificate of Free Sale</option>
                        <option value="gmp_certificate" {{ old('type') == 'gmp_certificate' ? 'selected' : '' }}>Good Manufacturing Practice Certificate</option>
                        <option value="certificate_of_origin" {{ old('type') == 'certificate_of_origin' ? 'selected' : '' }}>Certificate of Origin</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Document Upload -->
                <div class="mb-6">
                    <label for="document_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supporting Document</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="document_path" class="relative cursor-pointer bg-white dark:bg-[#2a2a2a] rounded-md font-medium text-[#FF0000] hover:text-[#CC0000] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#FF0000]">
                                    <span>Upload a file</span>
                                    <input id="document_path" name="document_path" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PDF, JPG, JPEG or PNG up to 50MB
                            </p>
                        </div>
                    </div>
                    @error('document_path')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 dark:bg-[#232323] text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Create Certificate
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 