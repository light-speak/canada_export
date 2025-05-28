@extends('layouts.dashboard')

@section('title', 'Addresses')

@section('dashboard-content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mailing Addresses</h1>
        <a href="{{ route('addresses.create') }}" 
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Address
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

    <div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($addresses as $address)
                <li class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ $address->recipient_name }}</h2>
                                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        <p>{{ $address->street }}</p>
                                        @if($address->street2)
                                            <p>{{ $address->street2 }}</p>
                                        @endif
                                        <p>{{ $address->city }}, {{ $address->state }} {{ $address->zip }}</p>
                                        <p>Phone: {{ $address->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('addresses.edit', $address) }}" 
                                class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                            <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this address?')"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-[#2a2a2a] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                                    <svg class="h-4 w-4 text-[#FF0000]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-6 py-4">
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <p>No addresses found.</p>
                        <p class="mt-1">Click "Add New Address" to create one.</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection 