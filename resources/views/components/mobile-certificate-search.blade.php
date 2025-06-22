<!-- Mobile Certificate Search Component -->
<div class="md:hidden">
    <div class="bg-white dark:bg-[#1a1a1a] rounded-xl shadow-md p-5 mx-4">
        <div class="text-center mb-4">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#FF0000] to-[#CC0000] rounded-full mb-3 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                {{ $title ?? 'Verify Your Certificate' }}
            </h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                {{ $description ?? 'Enter your certificate number for instant verification' }}
            </p>
        </div>
        
        <form action="{{ route('guidance-center.search') }}" method="GET" class="space-y-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="certificate_number" 
                    placeholder="{{ $placeholder ?? 'Enter certificate number (e.g., CE-COO-553)' }}" 
                    class="w-full pl-11 pr-4 py-4 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-[#FF0000] text-base transition-all duration-200"
                    autocomplete="off"
                >
            </div>
            <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-[#FF0000] to-[#CC0000] hover:from-[#CC0000] hover:to-[#AA0000] text-white font-bold rounded-xl transition-all duration-200 text-base shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                <span class="inline-flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    {{ $buttonText ?? 'Verify Certificate' }}
                </span>
            </button>
        </form>
        
        <div class="mt-4 text-center">
            <div class="flex items-center justify-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Instant
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Secure
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    24/7
                </div>
            </div>
        </div>
    </div>
</div> 