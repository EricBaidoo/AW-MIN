<?php
/**
 * Welcome Section - Cinematic Version
 */
?>
<section class="relative bg-transparent py-[4rem] md:py-[8rem] lg:py-[12rem] overflow-hidden scroll-reveal-section z-10">
    
    <!-- Cinematic Lighting / Glow -->
    <div class="absolute top-0 right-0 w-[60vw] h-[60vw] bg-accent-500/5 rounded-full blur-[9.375rem] pointer-events-none translate-x-[30%] -translate-y-[30%]"></div>
    <div class="absolute bottom-0 left-0 w-[40vw] h-[40vw] bg-primary-500/10 rounded-full blur-[7.5rem] pointer-events-none -translate-x-[20%] translate-y-[20%]"></div>

    <div class="container mx-auto px-[2rem] max-w-[80rem] relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-[4rem] lg:gap-[8rem]">
            
            <!-- Text Content -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center">
                <div class="scroll-reveal-left opacity-0 translate-x-[-3rem] transition-all duration-1000 ease-out">
                    <span class="font-sans text-[0.85rem] tracking-[0.3em] uppercase text-accent-500 font-bold mb-[1.5rem] block">
                        Welcome Home
                    </span>
                    <h2 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black tracking-tight text-white mb-[2.5rem] leading-[1.1]">
                        A Place of <br/> <span class="text-gradient-gold">Reconciliation</span>
                    </h2>
                    
                    <div class="space-y-[1.5rem] text-[1.1rem] text-primary-200/80 font-light leading-relaxed max-w-[35rem] font-sans mb-[3rem]">
                        <p>
                            We believe that every individual has a unique purpose and calling. Here at Anointed Word Ministries, our vision is reconciling individuals and families from dead places to resurrected life in Christ through the power of the Holy Spirit.
                        </p>
                        <p>
                            Whether you're just starting to ask questions about God, or you're a committed Christian looking for a place to put down deep roots, you have a place here.
                        </p>
                    </div>

                    <div class="flex flex-col gap-[0.5rem] pl-[1.5rem] border-l-2 border-accent-500/50">
                        <span class="font-serif text-[1.5rem] text-white font-bold tracking-wide">Apostle Joyce Cofield</span>
                        <span class="font-sans text-[0.75rem] uppercase tracking-[0.2em] text-accent-500 font-semibold">Senior Pastor</span>
                    </div>
                </div>
            </div>

            <!-- Image Composition -->
            <div class="w-full lg:w-1/2 relative mt-[4rem] lg:mt-0">
                <div class="scroll-reveal-right opacity-0 translate-x-[3rem] transition-all duration-1000 ease-out delay-200 relative mx-auto max-w-[35rem]">
                    
                    <!-- Glow Behind Image -->
                    <div class="absolute inset-0 bg-accent-500/20 rounded-full blur-[5rem] -z-10 animate-pulse"></div>
                    
                    <!-- The Cutout Image with a gradient mask at the bottom so it fades perfectly into the dark background -->
                    <div class="relative w-full aspect-[4/5] [mask-image:linear-gradient(to_bottom,white_70%,transparent_100%)] -webkit-[mask-image:linear-gradient(to_bottom,white_70%,transparent_100%)]">
                        <img 
                            src="/images/leadership/pastor-cofield.jpg" 
                            alt="Apostle Joyce Cofield" 
                            class="w-full h-full object-cover object-top drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-500 grayscale-[20%] contrast-[1.1]"
                        />
                    </div>
                    
                    <!-- Decorative Element -->
                    <div class="absolute -bottom-[2rem] -right-[2rem] w-[15rem] h-[15rem] border border-accent-500/20 rounded-full -z-20 animate-[spin_60s_linear_infinite]"></div>
                    <div class="absolute -top-[2rem] -left-[2rem] w-[10rem] h-[10rem] border border-white/10 rounded-full -z-20 animate-[spin_40s_linear_infinite_reverse]"></div>
                </div>
            </div>

        </div>
    </div>
</section>
