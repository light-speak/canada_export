<!-- About Component -->
<section id="about" class="py-20 bg-gray-50 dark:bg-[#0a0a0a]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                What is CanadaExport?
            </h2>
        </div>

        <div class="mt-16">
            <div class="bg-white dark:bg-[#1a1a1a] rounded-lg shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Left side: Image -->
                    <div class="relative h-64 lg:h-auto">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="Export documentation" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    
                    <!-- Right side: Text content -->
                    <div class="p-8 lg:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                            Your Export Documentation Solution
                        </h3>
                        
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                            CanadaExport is a web-browser based software service that allows exporters and freight-forwarders to obtain essential export documentation electronically.
                        </p>
                        
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                            It's the premier platform in Canada that provides built-in legalization/apostille options. Whether you're new to exporting or an expert, our platform will streamline your global operations.
                        </p>
                        
                        <div class="mt-8">
                            <a href="/register" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] transition-colors">
                                Get Started Today
                                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Certificate Verification Section - Only visible on mobile -->
        <div class="mt-16 md:hidden">
            <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-lg p-6">
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-[#FF0000] rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Quick Certificate Verification</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Already have a certificate? Verify it here instantly</p>
                </div>
                
                <form action="{{ route('guidance-center.search') }}" method="GET" class="space-y-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="certificate_number" 
                            placeholder="Enter your certificate number" 
                            class="w-full pl-12 pr-4 py-4 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent text-base"
                            autocomplete="off"
                        >
                    </div>
                    <button type="submit" class="w-full py-4 px-6 bg-[#FF0000] hover:bg-[#CC0000] text-white font-semibold rounded-xl transition-colors duration-200 text-base shadow-md">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Verify Now
                        </span>
                    </button>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-xs">
                        ✓ Instant verification • ✓ Secure & encrypted • ✓ Available 24/7
                    </p>
                </div>
            </div>
        </div>
    </div>
</section> 