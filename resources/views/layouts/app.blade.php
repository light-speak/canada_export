<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CanadaExport - Streamline your export documentation process with our comprehensive platform">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CanadaExport') }} - @yield('title', 'Export Documentation Made Simple')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white">
        <!-- Navigation -->
        <x-navigation />

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <x-footer />

        @stack('scripts')
    </body>
</html> 