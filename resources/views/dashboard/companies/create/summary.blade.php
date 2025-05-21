@extends('layouts.dashboard')

@section('title', 'Add Company - Summary')

@section('dashboard-content')
<div>
    <!-- 成功消息 -->
    @if(session('success'))
    <div class="mb-4 p-4 rounded-md bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Success</h3>
                <div class="mt-2 text-sm text-green-700 dark:text-green-300">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Step 5 of 5: Review and Submit</p>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-[#FF0000]">Step 5 of 5</span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">100% complete</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#FF0000] h-2.5 rounded-full" style="width: 100%"></div>
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
        <a href="{{ route('companies.create.contacts') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Contacts
        </a>
        <a href="{{ route('companies.create.documents') }}" class="px-4 py-2 border-b-2 border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
            Documents
        </a>
        <a href="#" class="px-4 py-2 border-b-2 border-[#FF0000] text-[#FF0000] font-medium text-sm">
            Summary
        </a>
    </div>
    
    <!-- Summary -->
    <div class="bg-white dark:bg-[#1a1a1a] shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#232323] border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Company Information Summary</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Please review all the information before submitting</p>
        </div>
        
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                Basic Information
                <a href="{{ route('companies.create.basic_info') }}" class="ml-2 text-[#FF0000] text-sm font-normal hover:text-[#CC0000]">Edit</a>
            </h3>
            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Company Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $basicInfo['name'] }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Website</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $basicInfo['website'] ?? 'Not provided' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $basicInfo['registered_address'] }}</dd>
                </div>
                @if(isset($basicInfo['building_suite']) && !empty($basicInfo['building_suite']))
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Building/Suite</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $basicInfo['building_suite'] }}</dd>
                </div>
                @endif
                @if(isset($basicInfo['operations_address']) && !empty($basicInfo['operations_address']))
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Operations Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $basicInfo['operations_address'] }}</dd>
                </div>
                @endif
            </dl>
        </div>
        
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                Legal Information
                <a href="{{ route('companies.create.legal_info') }}" class="ml-2 text-[#FF0000] text-sm font-normal hover:text-[#CC0000]">Edit</a>
            </h3>
            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Business License Number</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $legalInfo['business_licence_number'] ?? 'Not provided' }}</dd>
                </div>
                @if(isset($legalInfo['licence_expiry_date']) && !empty($legalInfo['licence_expiry_date']))
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">License Expiry Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($legalInfo['licence_expiry_date'])->format('M d, Y') }}</dd>
                </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Incorporation ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $legalInfo['incorporation_id'] ?? 'Not provided' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Company Type</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ isset($legalInfo['is_manufacturer']) && $legalInfo['is_manufacturer'] ? 'Manufacturer' : 'Exporter/Trader' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Chamber Membership</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        {{ isset($legalInfo['is_chamber_member']) && $legalInfo['is_chamber_member'] ? 'Yes' : 'No' }}
                    </dd>
                </div>
            </dl>
        </div>
        
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                Primary Contact
                <a href="{{ route('companies.create.contacts') }}" class="ml-2 text-[#FF0000] text-sm font-normal hover:text-[#CC0000]">Edit</a>
            </h3>
            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $primaryContact['first_name'] }} {{ $primaryContact['last_name'] }}</dd>
                </div>
                @if(isset($primaryContact['job_title']) && !empty($primaryContact['job_title']))
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Job Title</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $primaryContact['job_title'] }}</dd>
                </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $primaryContact['phone'] }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $primaryContact['email'] }}</dd>
                </div>
            </dl>
        </div>
        
        <div class="px-6 py-4">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                Documents
                <a href="{{ route('companies.create.documents') }}" class="ml-2 text-[#FF0000] text-sm font-normal hover:text-[#CC0000]">Edit</a>
            </h3>
            @if(count($documents) > 0)
            <ul class="mt-4 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($documents as $document)
                <li class="py-3 flex justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FF0000] mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $document['file_name'] }}</span>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ round($document['size'] / 1024) }} KB
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">No documents uploaded</p>
            @endif
        </div>
    </div>
    
    <div class="mt-8 flex justify-between">
        <a href="{{ route('companies.create.documents') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Documents
        </a>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                Submit Company
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>
    
    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        <p>By submitting, you certify that all information provided is accurate. Your company will be reviewed for approval by Boulder Chamber of Commerce.</p>
    </div>
</div>
@endsection 