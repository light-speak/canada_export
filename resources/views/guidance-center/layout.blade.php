<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CanadaExport - Export Documentation and Guidance Center">

        <title>@yield('title') - CanadaExport</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-white">
        <!-- Navigation -->
        <x-navigation />

        <!-- Page Content -->
        <main>
            @if(request()->routeIs('guidance-center.export-documentation'))
                <!-- Export Documentation Banner -->
                <x-banner 
                    title="Export Documentation" 
                    description="The mechanics behind export documentation are complex, leaving many companies struggling to ensure they have the right documents for customs authorities."
                    primaryButton="GET YOUR DOCUMENT ONLINE"
                    primaryButtonUrl="/register"
                    secondaryButtonUrl="#what-is-export-documentation"
                />
            @elseif(request()->routeIs('guidance-center.legality'))
                <!-- Legality Banner -->
                <x-banner 
                    title="Legality" 
                    subtitle="Documentation Compliance"
                    description="Ensuring the legal validity and compliance of your export documentation in today's global trade environment."
                    primaryButton="GET STARTED TODAY"
                    primaryButtonUrl="/register"
                    secondaryButton="Learn More"
                    secondaryButtonUrl="#regulatory-compliance"
                />
            @elseif(request()->routeIs('guidance-center.trade-center'))
                <!-- Trade Center Banner -->
                <x-banner 
                    title="EXPORTCANADA Admin" 
                    subtitle="Solutions for Export From Canada To Worldwide"
                    description="Empower your trade organization with powerful tools to issue and manage export documentation with complete security and compliance."
                    primaryButton="REQUEST MORE INFO"
                    primaryButtonUrl="/contact"
                    secondaryButton="Learn More"
                    secondaryButtonUrl="#what-is-exportcanada-admin"
                />
            @else
                <!-- Standard page header for other pages -->
                <section class="relative bg-[#FDFDFC] dark:bg-[#0a0a0a] pt-24 pb-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="relative z-10">
                            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">
                                @yield('page-title')
                            </h1>
                            <p class="mt-4 text-xl text-gray-500 dark:text-gray-400 max-w-3xl">
                                @yield('page-description')
                            </p>
                            @yield('page-cta')
                        </div>
                    </div>
                </section>
            @endif

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="space-y-6">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <x-footer />
    </body>
</html> 