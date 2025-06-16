@extends('layouts.app')

@section('title', 'Registration Temporarily Closed')

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
                    Registration Temporarily Closed
                </h2>
                <div class="mt-4 text-center">
                    <svg class="mx-auto h-12 w-12 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                        We are currently not accepting new registrations at this time.
                    </p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-500">
                        Please check back later or contact our support team for more information.
                    </p>
                </div>
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Return to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection