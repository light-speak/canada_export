@extends('layouts.dashboard')

@section('title', 'Add Sub Account')

@section('dashboard-content')
<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add Sub Account</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add an existing user as a sub-account to your account</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('profile.sub-accounts') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Sub Accounts
            </a>
        </div>
    </div>
    
    <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#232323] border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Sub Account Information</h2>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('profile.store-sub-account') }}" method="POST">
                @csrf
                
                @if($errors->any())
                <div class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-300">
                                Error occurred while adding sub-account:
                            </h3>
                            <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="mb-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Sub-accounts allow other users to access your account data. You can assign different roles and permissions to each sub-account.
                    </p>
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    You can only add users who are already registered in the system. Users must create their own account before you can add them as a sub-account.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">User Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white" placeholder="Enter existing user's email address">
                </div>
                
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select name="role" id="role" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-[#2a2a2a] shadow-sm focus:border-[#FF0000] focus:ring focus:ring-[#FF0000] focus:ring-opacity-50 dark:text-white">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Regular User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="readonly" {{ old('role') == 'readonly' ? 'selected' : '' }}>Read Only</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select the role and permissions for this user in your account</p>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('profile.sub-accounts') }}" class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-[#2a2a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Add Sub Account
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
        <p>Role Description:</p>
        <ul class="list-disc pl-5 mt-2 space-y-1">
            <li><strong>Administrator</strong>: Can perform all operations, including adding and deleting resources</li>
            <li><strong>Regular User</strong>: Can view and edit existing resources, but with limited permissions</li>
            <li><strong>Read Only</strong>: Can only view information, cannot modify any content</li>
        </ul>
    </div>
</div>
@endsection 