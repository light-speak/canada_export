@extends('layouts.app')

@section('title', 'Verify Email')

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
                    Verify Your Email Address
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Before proceeding, please check your email for a verification link.
                </p>
            </div>
            
            @if (session('message'))
            <div class="rounded-md bg-green-50 dark:bg-green-900/30 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('message') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-md">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    If you did not receive the email, please check your spam folder or click below to request another.
                </p>
            </div>
            
            <form class="mt-4" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000] transition-colors">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-[#FF3333] group-hover:text-[#FF6666]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </span>
                        Resend Verification Email
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-transparent hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Sign Out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 