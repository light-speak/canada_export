<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CanadaExport - Streamline your export documentation process with our comprehensive platform">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CanadaExport') }} - @yield('title', 'Console')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white">
        <!-- Navigation -->
        <x-navigation />

        <div class="pt-16">
            <!-- Dashboard Layout with Sidebar -->
            <div class="flex min-h-screen">
                <!-- Sidebar -->
                <div 
                    x-data="{ sidebarOpen: true }" 
                    class="relative"
                >
                    <!-- Sidebar Toggle Button for Mobile -->
                    <button 
                        @click="sidebarOpen = !sidebarOpen" 
                        class="md:hidden absolute right-0 top-0 mr-3 mt-3 p-1 rounded-full bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-200"
                    >
                        <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <aside 
                        x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" 
                        class="bg-white dark:bg-[#1a1a1a] w-64 fixed h-screen z-10 shadow-lg overflow-y-auto transition-transform duration-300 ease-in-out md:relative md:translate-x-0 pt-6 pb-8"
                    >
                        <nav class="px-4 pb-4">
                            <div class="mb-6">
                                <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                    Main
                                </h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="{{ route('console') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('console') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('companies.index') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('companies.*') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            Companies
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('products.index') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('products.*') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            Products
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('certificates.index') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('certificates.*') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Certificates
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('addresses.index') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('addresses.*') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Addresses
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Billing
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                    Account
                                </h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('profile.show') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Profile
                                        </a>
                                    </li>
                                    
                                    @php
                                        // Check if current user is a primary account
                                        $isPrimaryAccount = !Auth::user()->parentAccounts()->exists();
                                    @endphp
                                    
                                    @if($isPrimaryAccount)
                                    <li>
                                        <a href="{{ route('profile.sub-accounts') }}" class="flex items-center px-3 py-2 text-sm rounded-lg {{ request()->routeIs('profile.sub-accounts') ? 'bg-[#FF0000]/10 text-[#FF0000] font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            Sub Accounts
                                        </a>
                                    </li>
                                    @endif
                                    
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-3 py-2 text-sm rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </aside>
                </div>

                <!-- Main Content -->
                <div class="flex-grow p-6 md:p-8 bg-gray-50 dark:bg-[#121212]">
                    <!-- Page Content -->
                    @yield('dashboard-content')
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </body>
</html> 