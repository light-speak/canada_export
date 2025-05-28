@extends('layouts.dashboard')

@section('title', 'Certificates')

@section('dashboard-content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Certificates</h1>
        <a href="{{ route('certificates.create.basic_info') }}" 
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            New Certificate
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900/30 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($certificates as $certificate)
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if($certificate->status === 'draft')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Draft
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Submitted
                                        </span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                                        Certificate #{{ $certificate->id }}
                                    </h2>
                                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Created {{ $certificate->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if($certificate->status === 'draft')
                                <a href="{{ route('certificates.resume_draft', $certificate) }}" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                                    Continue Editing
                                </a>
                            @else
                                <a href="{{ route('certificates.show', $certificate) }}" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                                    View Details
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    <p>No certificates found.</p>
                    <p class="mt-1">Click "New Certificate" to create one.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 