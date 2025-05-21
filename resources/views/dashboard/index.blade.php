@extends('layouts.app')

@section('title', 'Console')

@section('content')
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="border-b pb-6 mb-6 border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome to your Console</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage your export documentation and certificates</p>
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
                    <a href="#" class="text-[#FF0000] hover:text-[#CC0000] text-sm font-medium transition-colors">
                        View all &rarr;
                    </a>
                </div>
            </div>
            
            <!-- 申请新证书卡片 -->
            <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">New Application</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Apply for a new export certificate or document.</p>
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
                    Start New Application
                </a>
            </div>
            
            <!-- 设置卡片 -->
            <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Account Settings</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Update your profile and account preferences.</p>
                <a href="#" class="text-[#FF0000] hover:text-[#CC0000] text-sm font-medium transition-colors">
                    Manage settings &rarr;
                </a>
            </div>
        </div>
        
        <!-- 最近活动 -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Recent Activity</h2>
            <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow overflow-hidden">
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-4">No recent activity yet</p>
                    <p class="mt-2 text-sm">Your export certificate activities will appear here.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 