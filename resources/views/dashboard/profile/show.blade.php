@extends('layouts.dashboard')

@section('title', '个人资料')

@section('dashboard-content')
<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">个人资料</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">管理您的账户信息和安全设置</p>
        </div>
    </div>
    
    @if(session('success'))
    <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-md p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- 个人资料卡片 -->
        <div class="md:col-span-2 bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-[#232323] border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">基本信息</h2>
            </div>
            <div class="px-6 py-4">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">姓名</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full h-10 px-3 py-2 rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">电子邮箱</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full h-10 px-3 py-2 rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                            保存修改
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- 账户安全卡片 -->
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-[#232323] border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">账户安全</h2>
            </div>
            <div class="px-6 py-4">
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">密码</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">您可以更改您的登录密码</p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('profile.edit-password') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        修改密码
                    </a>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">子账户</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">管理可以访问您账户的用户</p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('profile.sub-accounts') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        管理子账户
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 