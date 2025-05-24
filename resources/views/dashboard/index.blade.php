@extends('layouts.dashboard')

@section('title', 'Console')

@section('dashboard-content')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome to your Console</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your export documentation and certificates</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- 证书管理卡片 -->
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Certificates</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Manage your export certificates and documentation.</p>
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">0</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">Active certificates</span>
                </div>
                <a href="{{ route('certificates.index') }}" class="text-[#FF0000] hover:text-[#CC0000] text-sm font-medium transition-colors">
                    View all &rarr;
                </a>
            </div>
        </div>
        
        <!-- 公司管理卡片 -->
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Companies</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Manage your company profiles and information.</p>
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->companies->count() }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">Registered companies</span>
                </div>
                <a href="{{ route('companies.index') }}" class="text-[#FF0000] hover:text-[#CC0000] text-sm font-medium transition-colors">
                    View all &rarr;
                </a>
            </div>
        </div>
        
        <!-- 申请新证书卡片 -->
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">New Certificate</h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Create a new export certificate or document.</p>
            
            @if(Auth::user()->companies->where('status', 'approved')->count() > 0)
            <a href="{{ route('certificates.create.basic_info') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
                Create New Certificate
            </a>
            @else
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">You need at least one approved company to create certificates.</div>
            <a href="{{ route('companies.create.basic_info') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
                Add a Company
            </a>
            @endif
        </div>
    </div>
    
    <!-- 快速操作 -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('companies.create.basic_info') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[#FF0000] mb-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-900 dark:text-white font-medium">Register Company</span>
            </a>
            
            <a href="{{ route('certificates.create.basic_info') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[#FF0000] mb-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-900 dark:text-white font-medium">Create Certificate</span>
            </a>
            
            <a href="#" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[#FF0000] mb-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-900 dark:text-white font-medium">Get Support</span>
            </a>
        </div>
    </div>
</div>
@endsection 