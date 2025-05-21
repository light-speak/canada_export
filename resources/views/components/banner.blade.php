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
    </div>
</section> 