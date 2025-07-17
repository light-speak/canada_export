<!-- Banner Component -->
<section
    x-data="{
        minH: 80, // px, banner最小高度
        maxH: 840, // px, banner最大高度
        scrollY: 0,
        get height() {
            let h = this.maxH - this.scrollY;
            if(h < this.minH) h = this.minH;
            if(h > this.maxH) h = this.maxH;
            return h;
        }
    }"
    x-init="window.addEventListener('scroll', () => { scrollY = window.scrollY || window.pageYOffset })"
    :style="'height:' + height + 'px; min-height:' + minH + 'px; max-height:' + maxH + 'px;'"
    class="relative w-full overflow-hidden flex items-center justify-center transition-all duration-200"
>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/background.png');"></div>
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 text-center text-white">
        <h1
            class="text-4xl md:text-5xl lg:text-6xl font-extrabold drop-shadow-lg opacity-0 translate-y-6 animate-fade-in-up"
            style="animation-delay:0.2s;animation-fill-mode:forwards;"
        >
            {{ $title ?? 'Export Documentation' }}<br>
            @if(isset($subtitle))
                <span class="text-[#FF0000] inline-block">{{ $subtitle }}</span>
            @endif
        </h1>
        <p class="mt-10 text-lg md:text-xl font-medium drop-shadow">
            {{ $description ?? 'The export documentation solution for your business needs.' }}
        </p>
        <div class="mt-10 flex justify-center gap-4">
            @if(isset($primaryButton) && isset($primaryButtonUrl))
            <a href="{{ $primaryButtonUrl }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#FF0000] hover:bg-[#CC0000] md:py-4 md:text-lg md:px-10 transition-colors">
                {{ $primaryButton }}
            </a>
            @endif
            
            @if(isset($secondaryButton) && isset($secondaryButtonUrl))
            <a href="{{ $secondaryButtonUrl }}" class="px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-white bg-white/20 hover:bg-white/30 md:py-4 md:text-lg md:px-10 transition-colors">
                {{ $secondaryButton }}
            </a>
            @endif
        </div>

        <!-- Verify Certification Search - 极简风格，仅首页显示 -->
        <div class="mt-10 flex justify-center">
            <form action="{{ route('guidance-center.search') }}" method="GET" class="w-full max-w-lg flex gap-2">
                <input type="text" name="certificate_number" placeholder="Enter the Certificate Number" class="flex-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#FF0000] focus:border-[#FF0000] bg-white text-gray-900 text-base shadow-sm transition-all" required />
                <button type="submit" class="px-6 py-3 rounded-md bg-[#FF0000] hover:bg-[#CC0000] text-white font-semibold transition-colors text-base shadow-sm">Validate</button>
            </form>
        </div>

        <!-- Mobile Certificate Search - Only visible on mobile -->
        <div class="mt-8 md:hidden">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                <div class="text-center mb-3">
                    <h3 class="text-lg font-bold text-white mb-1">Verify Certificate</h3>
                    <p class="text-white/80 text-xs">Enter certificate number to verify</p>
                </div>
                
                <form action="{{ route('guidance-center.search') }}" method="GET" class="space-y-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="certificate_number" 
                            placeholder="Enter certificate number (e.g., CE-COO-553)" 
                            class="w-full pl-10 pr-3 py-3 text-gray-900 placeholder-gray-500 bg-white/90 border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF0000] focus:border-transparent text-sm"
                            autocomplete="off"
                        >
                    </div>
                    <button type="submit" class="w-full py-3 px-4 bg-[#FF0000] hover:bg-[#CC0000] text-white font-semibold rounded-lg transition-colors duration-200 text-sm">
                        <span class="inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verify Certificate
                        </span>
                    </button>
                </form>
                
                <div class="mt-3 text-center">
                    <p class="text-white/60 text-xs">
                        Instant & secure verification
                    </p>
                </div>
            </div>
        </div>
    </div>
</section> 