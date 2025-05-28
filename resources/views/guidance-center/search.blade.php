@extends('guidance-center.layout')

@section('title', 'Certificate Search')

@section('page-title', 'Certificate Search')

@section('page-description')
Search and verify your export certificates
@endsection

@section('content')
<div class="bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Certificate Search Results
            </h2>
            <div class="mt-4 md:mt-0">
                <form action="{{ route('guidance-center.search') }}" method="GET" class="flex items-center">
                    <div class="relative rounded-md shadow-sm flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="certificate_number" 
                            value="{{ $query }}"
                            placeholder="Enter certificate number" 
                            class="focus:ring-[#FF0000] focus:border-[#FF0000] block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md"
                        >
                    </div>
                    <button type="submit" class="ml-3 inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-base font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        @if(!$query)
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Please enter a certificate number to search</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You can verify the authenticity of documents using the certificate number</p>
            </div>
        @elseif(count($results) == 0)
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Certificate Not Found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No certificate was found with the number "{{ $query }}", please check if the number is correct</p>
            </div>
        @else
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Certificate Number
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Issue Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($results as $result)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $result->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $result['type'] }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $result->created_at }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                    Active
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="mt-10 bg-white dark:bg-[#1a1a1a] shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            How to Verify Your Certificate
        </h2>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="prose dark:prose-invert max-w-none">
            <p>All certificates issued by CanadaExport have a unique certificate number. You can verify the authenticity of a certificate by following these steps:</p>
            
            <ol class="mt-4 space-y-2">
                <li>Enter the complete certificate number in the search box</li>
                <li>Check if the information displayed in the search results matches your physical certificate</li>
                <li>Verify the certificate status to ensure it is valid</li>
                <li>If needed, you can download the electronic version of the certificate for comparison</li>
            </ol>
            
            <p class="mt-4">If you cannot find your certificate or have any questions, please <a href="/contact" class="text-[#FF0000] hover:text-[#CC0000]">contact us</a> for assistance.</p>
        </div>
    </div>
</div>

@include('components.apply-now-card')
@endsection 