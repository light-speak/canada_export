<!-- Navigation Component -->
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 w-full transition-colors duration-200 
    @if(request()->is('/') || request()->is('/guidance-center/export-documentation') || request()->is('/guidance-center/legality') || request()->is('/guidance-center/trade-center')) 
        bg-transparent
    @else 
        bg-white/95 dark:bg-[#1a1a1a]/95 backdrop-blur-sm 
    @endif" 
    x-data="{ mobileOpen: false, searchOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Certificate Verification Bar - 只在移动端显示 -->
        <div x-show="searchOpen" x-transition class="md:hidden absolute inset-x-0 top-0 bg-white dark:bg-[#232323] shadow-md z-50 p-4">
            <form action="{{ route('guidance-center.search') }}" method="GET" class="flex items-center">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="certificate_number" placeholder="Verify certificate" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-[#333333] placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm">
                </div>
                <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#FF0000] hover:bg-[#CC0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF0000]">
                    Verify
                </button>
                <button @click="searchOpen = false" type="button" class="ml-2 p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center text-2xl font-bold header-link">
                    <span>Canada</span>
                    <img src="/images/canada.png" alt="Canada Logo" class="h-10 w-auto mx-2 select-none" />
                    <span>Export</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <!-- PC端直接显示验证框 -->
                <form action="{{ route('guidance-center.search') }}" method="GET" class="relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="certificate_number" placeholder="Verify certificate" class="w-48 pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-[#333333] placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#FF0000] focus:border-[#FF0000] sm:text-sm">
                    </div>
                </form>
                
                <!-- 移动端验证按钮 - 仅在移动版显示，此处隐藏 -->
                <button @click="searchOpen = !searchOpen" class="header-link transition-colors flex items-center md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Verify</span>
                </button>
                
                <!-- Document Center Dropdown -->
                <a href="{{ route('guidance-center.export-documentation') }}" class="header-link transition-colors">
                    Document Center
                </a>
                <a href="{{ route('guidance-center.legality') }}" class="header-link transition-colors">
                    Legality
                </a>
                <!-- 普通按钮 -->
                <a href="{{ route('guidance-center.trade-center') }}" class="header-link transition-colors">
                    Trade Center
                </a>
                <a href="#features" class="header-link transition-colors">
                    Press
                </a>
                <a href="/Contact" class="header-link transition-colors">
                    Contact
                </a>
                
                @guest
                <a href="/login" class="header-link transition-colors">
                    Sign In
                </a>
                <a href="/register" class="bg-[#FF0000] text-white px-4 py-2 rounded-md hover:bg-[#CC0000] transition-colors">
                    Sign Up
                </a>
                @else
                <a href="{{ route('console') }}" class="header-link flex items-center mr-4 relative group">
                    <span class="bg-[#FF0000]/10 dark:bg-[#FF0000]/20 text-[#FF0000] px-2 py-1 rounded-md inline-flex items-center transition-colors group-hover:bg-[#FF0000]/20 dark:group-hover:bg-[#FF0000]/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                        </svg>
                        Console
                    </span>
                </a>
                <div x-data="{ profileOpen: false }" class="relative">
                    <button @click="profileOpen = !profileOpen" class="flex items-center space-x-1 header-link transition-colors focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div 
                        x-show="profileOpen" 
                        x-transition 
                        @click.away="profileOpen = false"
                        class="absolute right-0 w-48 mt-2 py-2 bg-white dark:bg-[#232323] rounded-md shadow-lg z-50"
                    >
                        <a href="{{ route('console') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                            </svg>
                            Console
                        </a>
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-2">
                <button @click="searchOpen = !searchOpen" class="header-link p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <button @click="mobileOpen = !mobileOpen" type="button" class="header-link p-2 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-transition class="md:hidden fixed inset-0 z-40 bg-black/60" @click.self="mobileOpen = false" style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;">
        <div
            class="absolute top-0 right-0 w-64 bg-white dark:bg-[#232323] h-full shadow-lg p-6 flex flex-col space-y-4"
            x-init="$watch('mobileOpen', v => {
                document.querySelectorAll('.mobile-menu-link').forEach(el => {
                    if(v) {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-700', 'dark:text-gray-200');
                    } else {
                        el.classList.remove('text-gray-700', 'dark:text-gray-200');
                        el.classList.add('text-white');
                    }
                });
            })"
            style="position: fixed !important; top: 0 !important; right: 0 !important; height: 100vh !important; overflow-y: auto !important;"
        >
            <button @click="mobileOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-[#FF0000] focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <a href="{{ route('guidance-center.export-documentation') }}" class="header-link mobile-menu-link mt-8" @click="mobileOpen = false">Document Center</a>
            <a href="{{ route('guidance-center.legality') }}" class="header-link mobile-menu-link" @click="mobileOpen = false">Legality</a>
            <a href="{{ route('guidance-center.trade-center') }}" class="header-link mobile-menu-link" @click="mobileOpen = false">Trade Center</a>
            <a href="#features" class="header-link mobile-menu-link" @click="mobileOpen = false">Press</a>
            <a href="/Contact" class="header-link mobile-menu-link" @click="mobileOpen = false">Contact</a>
            
            @guest
            <a href="/login" class="header-link mobile-menu-link" @click="mobileOpen = false">Sign In</a>
            <a href="/register" class="bg-[#FF0000] text-white px-4 py-2 rounded-md hover:bg-[#CC0000] transition-colors" @click="mobileOpen = false">Sign Up</a>
            @else
            <div class="py-2 border-t border-gray-200 dark:border-gray-700 mt-2">
                <span class="block px-4 py-2 text-gray-600 dark:text-gray-400 text-sm">Signed in as</span>
                <span class="block px-4 py-2 text-gray-900 dark:text-white font-semibold">{{ Auth::user()->name }}</span>
            </div>
            <a href="{{ route('console') }}" class="flex items-center header-link mobile-menu-link mt-2" @click="mobileOpen = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#FF0000]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                </svg>
                Console
            </a>
            <a href="#" class="header-link mobile-menu-link" @click="mobileOpen = false">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#FF0000] hover:text-[#CC0000] font-medium" @click="mobileOpen = false">
                    Sign Out
                </button>
            </form>
            @endguest
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nav = document.getElementById('main-nav');
    // 选中所有需要变色的链接
    const headerLinks = () => document.querySelectorAll('.header-link:not(.mobile-menu-link)');
    
    // 初始化链接颜色
    if (window.location.pathname === '/' || window.location.pathname === '/guidance-center/export-documentation' || window.location.pathname === '/guidance-center/legality' || window.location.pathname === '/guidance-center/trade-center') {
        // 在首页，初始状态链接为白色
        headerLinks().forEach(el => {
            el.classList.add('text-white');
            el.classList.remove('text-gray-700', 'dark:text-gray-300');
        });
    } else {
        // 在其他页面，初始状态链接为深色
        headerLinks().forEach(el => {
            el.classList.remove('text-white');
            el.classList.add('text-gray-700', 'dark:text-gray-300');
        });
    }
    
    function updateNav() {
        if (window.location.pathname === '/' || window.location.pathname === '/guidance-center/export-documentation' || window.location.pathname === '/guidance-center/legality' || window.location.pathname === '/guidance-center/trade-center') {
            // 仅在首页时执行滚动变色逻辑
            if (window.scrollY > 0) {
                nav.classList.add('bg-white/95', 'dark:bg-[#1a1a1a]/95', 'backdrop-blur-sm', 'shadow-sm');
                nav.classList.remove('bg-transparent');
                headerLinks().forEach(el => {
                    el.classList.remove('text-white');
                    el.classList.add('text-gray-700', 'dark:text-gray-300');
                });
            } else {
                nav.classList.remove('bg-white/95', 'dark:bg-[#1a1a1a]/95', 'backdrop-blur-sm', 'shadow-sm');
                nav.classList.add('bg-transparent');
                headerLinks().forEach(el => {
                    el.classList.remove('text-gray-700', 'dark:text-gray-300');
                    el.classList.add('text-white');
                });
            }
        }
    }
    
    updateNav();
    window.addEventListener('scroll', updateNav);
});
</script> 