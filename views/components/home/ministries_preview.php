<?php
/**
 * Ministries Preview Component
 */
?>
<section class="bg-primary-950 py-[4rem] md:py-[8rem] relative overflow-hidden scroll-reveal-section">
    <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
        <div class="flex flex-col lg:flex-row items-center gap-[4rem] lg:gap-[6rem]">
            
            <!-- Left Side: Text Content -->
            <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left scroll-reveal-left opacity-0 -translate-x-[4rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black text-white tracking-tight leading-[1.1] mb-[1.5rem]">
                    Our Ministries
                </h2>
                <p class="text-[1.1rem] md:text-[1.15rem] text-primary-300 leading-[1.6] font-light mb-[3rem] max-w-[35rem]">
                    Faith grows best in community. Whether you're new or ready to take your next step, there's a place for you to connect, grow, and belong.
                </p>

                <!-- Featured Ministry Details -->
                <div class="flex flex-col items-center lg:items-start bg-glass-dark p-[2.5rem] rounded-[1.5rem] border border-white/10 shadow-sm w-full">
                    <div class="mb-[1.5rem] text-accent-500">
                        <!-- Women Icon -->
                        <svg class="w-[2.5rem] h-[2.5rem] stroke-[0.125rem] stroke-current fill-none" viewBox="0 0 24 24"><path d="M12 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 7a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-[2rem] text-white leading-[1.2] mb-[1rem] tracking-tight">
                        Women's Ministry
                    </h3>
                    <p class="text-[1rem] text-white/70 leading-[1.6] font-light mb-[2rem]">
                        Empowering women through fellowship, the Word, and authentic connection. Join a sisterhood dedicated to spiritual growth and mutual support.
                    </p>
                    
                    <a href="/connect" class="group flex items-center gap-[1rem] text-accent-500 font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:text-white transition-colors duration-300">
                        <span>Learn More</span>
                        <span class="w-[2.5rem] h-[2.5rem] rounded-full border border-accent-500/30 flex items-center justify-center group-hover:bg-accent-500 group-hover:text-white transition-all duration-300">
                            ›
                        </span>
                    </a>
                </div>
            </div>

            <!-- Right Side: Large Image -->
            <div class="w-full lg:w-1/2 relative aspect-[4/5] lg:aspect-square rounded-[2rem] overflow-hidden shadow-[0_1.25rem_3.125rem_rgba(17,36,59,0.15)] scroll-reveal-right opacity-0 translate-x-[4rem] transition-all duration-1000 delay-200 ease-out">
                <img src="/images/gallery/church-6.jpg" alt="Women's Ministry" class="object-cover w-full h-full hover:scale-105 transition-transform duration-1000">
                <div class="absolute inset-0 border-[0.125rem] border-white/10 rounded-[2rem] pointer-events-none"></div>
            </div>

        </div>
    </div>
</section>
