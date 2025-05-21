@extends('layouts.dashboard')

@section('title', 'Your Companies')

@section('dashboard-content')
<div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Your Companies</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your company profiles and documentation</p>
        </div>
        <a href="{{ route('companies.create.basic_info') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Company
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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
    
    @if(count($companies) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($companies as $company)
        <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 transition-all duration-200 hover:shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white truncate">{{ $company->name }}</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $company->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' }}">
                    {{ ucfirst($company->status) }}
                </span>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-4 truncate">
                {{ $company->registered_address }}
            </p>
            
            @if($company->documents->count() > 0)
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                <span class="font-medium">{{ $company->documents->count() }}</span> document(s) uploaded
            </p>
            @endif
            
            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('companies.show', $company) }}" class="text-[#FF0000] hover:text-[#CC0000] text-sm font-medium transition-colors">
                        View details &rarr;
                    </a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-600 hover:text-[#FF0000] text-sm font-medium transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No companies yet</h3>
        <p class="mt-2 text-gray-500 dark:text-gray-400">Get started by adding your first company profile.</p>
        <div class="mt-6">
            <a href="{{ route('companies.create.basic_info') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Company
            </a>
        </div>
    </div>
    @endif
</div>
@endsection 