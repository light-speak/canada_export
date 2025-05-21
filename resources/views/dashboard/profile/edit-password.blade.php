@extends('layouts.dashboard')

@section('title', 'Change Password')

@section('dashboard-content')
<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Change Password</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update your account login password</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Profile
            </a>
        </div>
    </div>
    
    <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#232323] border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Password Settings</h2>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">新密码</label>
                    <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">确认新密码</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                </div>
                
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('profile.show') }}" class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        取消
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        更新密码
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        <p>密码安全提示：</p>
        <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>使用至少8个字符的强密码</li>
            <li>包含大写字母、小写字母、数字和特殊字符</li>
            <li>避免使用常见单词或个人信息</li>
            <li>定期更换密码以提高安全性</li>
        </ul>
    </div>
</div>
@endsection 