@extends('layouts.dashboard')

@section('title', 'Billing')

@section('dashboard-content')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Billing</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Manage your billing information and view transaction history.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{ route('billing.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-[#FF0000] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:ring-offset-2 sm:w-auto">
                        Add New Bill
                    </a>
                </div>
            </div>

            <!-- 账单列表 -->
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-6">Description</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Amount</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Due Date</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Status</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                    @forelse ($bills as $bill)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100 sm:pl-6">
                                                {{ $bill->description }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                ${{ number_format($bill->amount, 2) }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                {{ $bill->due_date->format('Y-m-d') }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $bill->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($bill->status) }}
                                                </span>
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="{{ route('billing.show', $bill->id) }}" class="text-[#FF0000] hover:text-[#CC0000]">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                                No bills found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 