<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CanadaExport - Streamline your export documentation process with our comprehensive platform">

        <title>CanadaExport - Export Documentation Made Simple</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white">
        <!-- Navigation -->
        <x-navigation />

        <!-- Banner Section -->
        <x-banner 
            title="Export Documentation" 
            subtitle="Made Simple"
            description="Streamline your export documentation process with our comprehensive platform. Fast, secure, and compliant."
            primaryButton="{{ Auth::check() ? 'Go to Console' : 'Sign Up for Free' }}"
            primaryButtonUrl="{{ Auth::check() ? route('console') : route('register') }}"
            secondaryButton="Learn More"
            secondaryButtonUrl="#about"
        />

        <!-- Verify Certification Section -->
        <!-- 已移入Banner区，原位置删除 -->


        <!-- How It Works Section -->
        <x-how-it-works />

        <!-- Features Section -->
        <x-features />


        <!-- About Section -->
        <x-about />

        <!-- Partners Section -->
        <x-partners />


        <!-- Footer -->
        <x-footer />
    </body>
</html>
