@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen pt-24 pb-12 flex flex-col bg-[url('/images/background.png')] bg-cover bg-center">
    <div class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/90 dark:bg-[#1a1a1a]/90 backdrop-blur-sm p-8 rounded-xl shadow-xl">
            <div>
                <div class="flex justify-center">
                    <a href="/" class="flex items-center text-2xl font-bold">
                        <span class="text-gray-900 dark:text-white">Canada</span>
                        <img src="/images/canada.png" alt="Canada Logo" class="h-10 w-auto mx-2 select-none" />
                        <span class="text-gray-900 dark:text-white">Export</span>
                    </a>
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Or 
                    <a href="{{ route('register') }}" class="font-medium text-[#FF0000] hover:text-[#CC0000]">
                        create a new account
                    </a>
                </p>
            </div>
            
            @if($errors->any())
            <div class="rounded-md bg-red-50 dark:bg-red-900/30 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            There were errors with your submission
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
            
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-500 text-gray-900 dark:text-white rounded-t-md focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] focus:z-10 sm:text-sm dark:bg-[#2a2a2a]" placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-500 text-gray-900 dark:text-white rounded-b-md focus:outline-none focus:ring-[#FF0000] focus:border-[#FF0000] focus:z-10 sm:text-sm dark:bg-[#2a2a2a]" placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-[#FF0000] focus:ring-[#FF0000] border-gray-300 dark:border-gray-700 rounded dark:bg-[#2a2a2a]">
                        <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-[#FF0000] hover:text-[#CC0000]">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] transition-colors">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-[#FF3333] group-hover:text-[#FF6666]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 