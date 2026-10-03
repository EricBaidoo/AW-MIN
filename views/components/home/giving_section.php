<?php
/**
 * Giving Section Component
 */
?>
<section class="relative py-[4rem] md:py-[8rem] lg:py-[12rem] bg-primary-900 overflow-hidden scroll-reveal-section">
    <div class="absolute top-0 right-0 w-[50vw] h-[50vw] bg-accent-500/5 rounded-full blur-[7.5rem] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[40vw] h-[40vw] bg-primary-950/5 rounded-full blur-[6.25rem] pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

    <div class="container relative z-10 px-[2rem] max-w-[85rem] mx-auto">
        <div class="grid lg:grid-cols-2 gap-[4rem] lg:gap-[6rem] items-center">
            
            <div class="scroll-reveal-left opacity-0 translate-y-[3rem] transition-all duration-1000 ease-out">
                <div class="w-[4rem] h-[4rem] rounded-full bg-primary-950/5 flex items-center justify-center mb-[2rem] border border-white/10 backdrop-blur-sm">
                    <!-- Give Icon -->
                    <svg class="w-[2rem] h-[2rem] text-accent-400 stroke-current fill-none stroke-[0.125rem]" viewBox="0 0 24 24"><path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6M12 15V3M8 7l4-4 4 4"/></svg>
                </div>

                <h2 class="font-serif text-[clamp(3rem,5vw,4.5rem)] font-black text-white leading-[1.1] tracking-tight mb-[1.5rem]">
                    Partner With Us
                </h2>
                
                <p class="text-[1.1rem] md:text-[1.25rem] text-white/80 max-w-[35rem] font-light leading-[1.7] mb-[3rem]">
                    Your generosity empowers us to reconcile families, build the community, and spread the Gospel worldwide. Together, we can make an eternal impact.
                </p>

                <a href="/give" class="inline-flex items-center justify-center px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-primary-950 hover:text-accent-600 hover:scale-105 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.2)]">
                    Give Online Now
                </a>
            </div>

            <div class="relative scroll-reveal-right opacity-0 translate-x-[3rem] transition-all duration-1000 delay-300 ease-out">
                <div class="relative aspect-[4/5] w-full max-w-[35rem] mx-auto lg:ml-auto">
                    <div class="absolute inset-0 border-2 border-accent-500/30 translate-x-[1.5rem] translate-y-[1.5rem] z-0"></div>
                    <div class="absolute inset-0 z-10 overflow-hidden shadow-2xl bg-[#0a1526]">
                        <img src="/images/backgrounds/giving-clean.png" alt="Partner With Us" class="object-cover w-full h-full opacity-80 hover:opacity-100 hover:scale-105 transition-all duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
