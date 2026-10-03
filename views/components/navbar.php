<?php
/**
 * Navbar Component
 */
// Current path logic for active state
$current_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>
<header id="main-header" class="fixed top-0 left-0 right-0 z-[100] h-[5rem] flex items-center transition-all duration-300 ease-in-out bg-transparent">
    <div class="flex items-center justify-between w-full max-w-[90rem] mx-auto px-[1rem] md:px-[2rem] xl:px-[4rem]">
        
        <!-- Logo -->
        <a href="/" class="flex items-center gap-[0.75rem] z-[101] group" aria-label="Anointed Word Ministries Home">
            <div class="relative w-[3rem] h-[3rem] max-md:w-[2.5rem] max-md:h-[2.5rem] rounded-full overflow-hidden bg-white p-[0.15rem] border-[0.15rem] border-accent-500/80 shadow-[0_0_1rem_rgba(255,193,7,0.2)] group-hover:shadow-[0_0_1.5rem_rgba(255,193,7,0.4)] transition-all duration-300">
                <img src="/images/brand/logo.png" alt="AWM Logo" class="w-full h-full object-cover rounded-full">
            </div>
            <div class="flex flex-col leading-tight justify-center">
                <span class="font-serif text-[1.1rem] max-md:text-[0.95rem] font-black text-white tracking-wide uppercase whitespace-nowrap group-hover:text-accent-400 transition-colors duration-300">Anointed Word</span>
                <span class="font-sans text-[0.8rem] max-md:text-[0.7rem] font-semibold text-accent-500 tracking-[0.15em] uppercase whitespace-nowrap">Ministries</span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden xl:flex items-center gap-[1.25rem] 2xl:gap-[2rem] pt-[0.2rem]" aria-label="Main navigation">
            <div class="relative group">
                <button class="text-[0.8rem] xl:text-[0.85rem] font-semibold tracking-[0.08em] uppercase text-[rgba(255,255,255,0.85)] hover:text-white transition-colors duration-200 flex items-center gap-[0.2rem] py-[0.25rem] cursor-pointer whitespace-nowrap">
                    About Us
                    <svg class="w-[1.1rem] h-[1.1rem] stroke-[2.5] stroke-current transition-transform duration-300 group-hover:rotate-180" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="absolute top-full left-1/2 -translate-x-1/2 mt-[1.5rem] w-[20rem] bg-primary-900/95 backdrop-blur-xl border border-white/10 shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] rounded-[1rem] transition-all duration-300 ease-out transform z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-[1rem] group-hover:translate-y-0">
                    <div class="absolute top-[-1.5rem] left-0 w-full h-[1.5rem] bg-transparent"></div>
                    <div class="p-[1rem] flex flex-col gap-[0.25rem]">
                        <a href="/about" class="flex items-start gap-[1rem] p-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors duration-200 group/item">
                            <div class="w-[2.25rem] h-[2.25rem] rounded-full bg-primary-800/30 flex items-center justify-center shrink-0 border border-white/5 group-hover/item:scale-110 transition-transform duration-300">
                                <svg class="w-[1.25rem] h-[1.25rem] text-accent-500 stroke-current fill-none stroke-[2]" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[0.9rem] font-bold text-white mb-[0.125rem] group-hover/item:text-accent-400 transition-colors">About AWM</span>
                                <span class="text-[0.75rem] text-primary-300 leading-tight">Discover our mission and beliefs.</span>
                            </div>
                        </a>
                        <a href="/leadership" class="flex items-start gap-[1rem] p-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors duration-200 group/item">
                            <div class="w-[2.25rem] h-[2.25rem] rounded-full bg-primary-800/30 flex items-center justify-center shrink-0 border border-white/5 group-hover/item:scale-110 transition-transform duration-300">
                                <svg class="w-[1.25rem] h-[1.25rem] text-accent-500 stroke-current fill-none stroke-[2]" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[0.9rem] font-bold text-white mb-[0.125rem] group-hover/item:text-accent-400 transition-colors">Leadership</span>
                                <span class="text-[0.75rem] text-primary-300 leading-tight">Meet our pastoral team.</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php
            $navLinks = [
                '/visit' => 'Visit',
                '/sermons' => 'Sermons',
                '/events' => 'Events',
                '/ministries' => 'Ministries',
                '/stream' => 'Stream',
                '/give' => 'Give',
                '/connect' => 'Connect'
            ];
            foreach ($navLinks as $path => $label): 
                $isActive = $current_uri === $path;
            ?>
                <a href="<?= $path ?>" class="text-[0.8rem] xl:text-[0.85rem] font-semibold tracking-[0.08em] uppercase relative py-[0.25rem] transition-colors duration-200 whitespace-nowrap after:content-[''] after:absolute after:bottom-[-0.25rem] after:left-0 after:h-[0.125rem] after:bg-accent-500 after:transition-all after:duration-300 after:ease-in-out <?= $isActive ? 'text-white after:w-full' : 'text-[rgba(255,255,255,0.85)] hover:text-white after:w-0 hover:after:w-full' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-[1rem] z-[101]">
            <a href="/connect" class="hidden sm:inline-flex items-center justify-center gap-[0.5rem] px-[1.75rem] py-[0.65rem] rounded-full bg-accent-500 hover:bg-accent-400 text-primary-950 font-bold text-[0.8rem] uppercase tracking-[0.15em] transition-all duration-300 shadow-[0_0.25rem_1rem_rgba(255,193,7,0.25)] hover:shadow-[0_0.5rem_1.5rem_rgba(255,193,7,0.4)] hover:-translate-y-[0.125rem] whitespace-nowrap">
                Pray
            </a>
            
            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="xl:hidden text-white hover:text-accent-500 transition-colors p-[0.2rem] -mr-[0.5rem]" aria-label="Toggle Menu">
                <svg class="w-[2.2rem] h-[2.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[105] opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <div id="mobile-menu-drawer" class="fixed top-0 right-0 h-[100svh] w-[20rem] max-w-[85vw] bg-primary-950/98 backdrop-blur-xl border-l border-white/10 z-[110] translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.19,1,0.22,1)] flex flex-col">
        <div class="flex items-center justify-between p-[1.5rem] border-b border-white/10">
            <span class="font-serif text-[1.1rem] font-black tracking-widest text-white uppercase">Menu</span>
            <button id="mobile-menu-close" class="text-white hover:text-accent-500 p-[0.5rem] -mr-[0.5rem]" aria-label="Close Menu">
                <svg class="w-[1.8rem] h-[1.8rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto py-[2rem] px-[2rem] flex flex-col gap-[2rem]">
            <a href="/about" class="text-[1.2rem] font-bold text-white uppercase tracking-widest hover:text-accent-500 transition-colors">About Us</a>
            <a href="/leadership" class="text-[1.2rem] font-bold text-white uppercase tracking-widest hover:text-accent-500 transition-colors">Leadership</a>
            <?php foreach ($navLinks as $path => $label): ?>
                <a href="<?= $path ?>" class="text-[1.2rem] font-bold text-white uppercase tracking-widest hover:text-accent-500 transition-colors">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
            
            <div class="mt-auto pt-[2rem] border-t border-white/10">
                <a href="/connect" class="inline-flex items-center justify-center w-full px-[1.5rem] py-[1rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-white hover:text-primary-950 transition-colors duration-300">
                    Request Prayer
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    // Simple scroll effect for navbar
    window.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        if (window.scrollY > 50) {
            header.classList.remove('bg-transparent');
            header.classList.add('bg-[rgba(10,30,92,0.97)]', 'backdrop-blur-md', 'shadow-md');
        } else {
            header.classList.add('bg-transparent');
            header.classList.remove('bg-[rgba(10,30,92,0.97)]', 'backdrop-blur-md', 'shadow-md');
        }
    });

    // Mobile menu toggle logic
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');

    function toggleMenu() {
        if (!mobileMenuDrawer) return;
        const isOpen = mobileMenuDrawer.classList.contains('translate-x-0');
        if (isOpen) {
            mobileMenuDrawer.classList.remove('translate-x-0');
            mobileMenuDrawer.classList.add('translate-x-full');
            mobileMenuOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        } else {
            mobileMenuDrawer.classList.remove('translate-x-full');
            mobileMenuDrawer.classList.add('translate-x-0');
            mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenuOverlay.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
        }
    }

    if(mobileMenuBtn && mobileMenuClose && mobileMenuOverlay) {
        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileMenuClose.addEventListener('click', toggleMenu);
        mobileMenuOverlay.addEventListener('click', toggleMenu);
    }
</script>

