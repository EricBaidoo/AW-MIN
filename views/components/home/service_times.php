<?php
/**
 * Service Times Component - Modern Potter's House Style
 */
require_once __DIR__ . '/../../../includes/services.php';
$services = getAllServices();
?>
<section class="relative bg-transparent py-[4rem] md:py-[8rem] lg:py-[12rem] scroll-reveal-section overflow-hidden z-10 border-t border-b border-white/5">
    
    <!-- Cinematic Background Imagery with Heavy Fade -->
    <div class="absolute inset-0 z-0">
        <img src="/images/hero/slide-1.png" alt="Service Background" class="absolute inset-0 w-full h-full object-cover opacity-20 grayscale-[50%] blur-sm scale-110" />
        <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-primary-950 via-transparent to-transparent"></div>
    </div>

    <div class="container mx-auto px-[2rem] max-w-[70rem] relative z-10">
        
        <!-- Elegant Typography Header -->
        <div class="scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out mb-[5rem] flex flex-col md:flex-row md:items-end justify-between border-b border-white/10 pb-[2rem]">
            <div>
                <span class="font-sans text-[0.8rem] tracking-[0.4em] uppercase text-accent-500 font-bold mb-[1.5rem] block drop-shadow-lg">Worship With Us</span>
                <h2 class="font-sans text-[clamp(2.5rem,5vw,4.5rem)] font-black uppercase tracking-tighter text-white leading-none">
                    Service Times
                </h2>
            </div>
            <p class="text-white/60 font-sans text-[0.95rem] font-light max-w-[20rem] mt-[2rem] md:mt-0 text-left md:text-right">
                Connect with us in person or virtually throughout the week.
            </p>
        </div>

        <!-- Sleek List Layout -->
        <div class="flex flex-col">
            <?php foreach ($services as $i => $service): ?>
                <div class="group relative flex flex-col md:flex-row md:items-center justify-between py-[3rem] border-b border-white/10 last:border-0 transition-all duration-700 hover:pl-[2rem] hover:bg-white/[0.02] scroll-reveal-up opacity-0 translate-y-[2rem]" style="transition-delay: <?= $i * 150 ?>ms;">
                    
                    <!-- Time & Name -->
                    <div class="flex-1 flex flex-col md:flex-row md:items-center gap-[1rem] md:gap-[4rem] z-10">
                        <span class="font-sans text-[1.5rem] md:text-[2rem] font-black text-white tracking-wider w-[12rem] opacity-90">
                            <?= htmlspecialchars($service['time']) ?>
                        </span>
                        
                        <div>
                            <h3 class="font-sans text-[1.2rem] md:text-[1.5rem] font-black uppercase text-white tracking-wide mb-[0.5rem] group-hover:text-accent-500 transition-colors duration-500">
                                <?= htmlspecialchars($service['name']) ?>
                            </h3>
                            <div class="text-[0.95rem] text-white/60 font-sans">
                                <?php if ($service['type'] === 'in-person'): ?>
                                    <span><?= htmlspecialchars($service['address']) ?></span>
                                <?php elseif ($service['type'] === 'conference-call'): ?>
                                    <span>
                                        Dial: <span class="text-white font-medium"><?= htmlspecialchars($service['dialIn']) ?></span>
                                        <span class="mx-[0.5rem] opacity-30">|</span>
                                        Code: <span class="text-accent-400 font-medium"><?= htmlspecialchars($service['passcode']) ?></span>
                                    </span>
                                <?php elseif ($service['type'] === 'zoom'): ?>
                                    <span>
                                        Zoom ID: <span class="text-white font-medium"><?= htmlspecialchars($service['zoomId']) ?></span>
                                        <span class="mx-[0.5rem] opacity-30">|</span>
                                        Passcode: <span class="text-accent-400 font-medium"><?= htmlspecialchars($service['zoomPasscode']) ?></span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Action Link (Text based, elegant SVG arrow) -->
                    <div class="mt-[2rem] md:mt-0 z-10 flex items-center">
                        <?php if ($service['type'] === 'in-person'): ?>
                            <a href="https://maps.google.com/?q=4727+Concord+Pike,+Wilmington,+DE+19803" target="_blank" class="font-sans text-[0.75rem] font-bold tracking-[0.2em] uppercase text-white hover:text-accent-500 transition-colors duration-500 flex items-center gap-[0.5rem] group/btn">
                                Directions
                                <svg class="w-4 h-4 transform transition-transform duration-500 group-hover/btn:translate-x-[0.25rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        <?php elseif ($service['type'] === 'conference-call'): ?>
                            <a href="tel:<?= preg_replace('/[^\d]/', '', $service['dialIn']) ?>" class="font-sans text-[0.75rem] font-bold tracking-[0.2em] uppercase text-accent-500 hover:text-white transition-colors duration-500 flex items-center gap-[0.5rem] group/btn">
                                Dial Now
                                <svg class="w-4 h-4 transform transition-transform duration-500 group-hover/btn:translate-x-[0.25rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        <?php else: ?>
                            <a href="https://zoom.us/join" target="_blank" class="font-sans text-[0.75rem] font-bold tracking-[0.2em] uppercase text-accent-500 hover:text-white transition-colors duration-500 flex items-center gap-[0.5rem] group/btn">
                                Join Zoom
                                <svg class="w-4 h-4 transform transition-transform duration-500 group-hover/btn:translate-x-[0.25rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
