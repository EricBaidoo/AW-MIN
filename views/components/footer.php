<?php
/**
 * Footer Component
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/services.php';
$services = getAllServices();
$currentYear = date('Y');
?>
<footer class="bg-[#0f0f0f] text-white pt-[4rem] md:pt-[6rem] pb-[2rem] relative overflow-hidden border-t border-white/5">
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60rem] h-[60rem] bg-white/[0.01] rounded-full blur-[6.25rem] pointer-events-none"></div>

    <div class="container max-w-[85rem] px-[2rem] relative z-10 mx-auto">
        
        <div class="flex flex-col lg:flex-row justify-between gap-[4rem] lg:gap-0 mb-[6rem]">
            
            <div class="flex flex-col max-w-[40rem]">
                <div class="mb-[3rem]">
                    <a href="/">
                        <span class="font-serif font-black text-[2rem] tracking-tighter uppercase text-white">
                            ANOINTED WORD
                        </span>
                    </a>
                </div>

                <div class="mb-[4rem]">
                    <h4 class="font-bold text-[1rem] uppercase tracking-wider mb-[1.5rem]">Quick Links</h4>
                    <div class="flex flex-wrap gap-x-[1rem] gap-y-[1rem] text-[0.85rem] font-medium text-white/70">
                        <a href="/about" class="hover:text-white transition-colors">About Us</a>
                        <span class="text-white/20">|</span>
                        <a href="/sermons" class="hover:text-white transition-colors">Sermons</a>
                        <span class="text-white/20">|</span>
                        <a href="/sermons" class="hover:text-white transition-colors">Watch</a>
                        <span class="text-white/20">|</span>
                        <a href="/give" class="hover:text-white transition-colors">Giving</a>
                        <span class="text-white/20">|</span>
                        <a href="/connect" class="hover:text-white transition-colors">Visit</a>
                    </div>
                </div>

                <div class="border-t border-white/10 pt-[2rem] flex items-center gap-[1.5rem]">
                    <h4 class="font-bold text-[1rem] uppercase tracking-wider">Follow Us:</h4>
                    <div class="flex items-center gap-[1rem]">
                        <a href="<?= htmlspecialchars($siteConfig['social']['facebook'] ?? '#') ?>" class="w-[2.5rem] h-[2.5rem] rounded-full border border-white/30 flex items-center justify-center hover:bg-white hover:text-black transition-all">FB</a>
                        <a href="<?= htmlspecialchars($siteConfig['social']['whatsapp'] ?? '#') ?>" class="w-[2.5rem] h-[2.5rem] rounded-full border border-white/30 flex items-center justify-center hover:bg-white hover:text-black transition-all">WA</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-[4rem] lg:gap-[6rem]">
                <div>
                    <div class="flex items-center gap-[0.75rem] mb-[1.5rem] border-b border-white/10 pb-[1rem]">
                        <h4 class="font-bold text-[1rem] uppercase tracking-wider">Service Times</h4>
                    </div>
                    <ul class="space-y-[0.75rem] text-[0.85rem] font-medium text-white/70">
                        <?php foreach ($services as $service): ?>
                        <li><?= htmlspecialchars($service['shortName']) ?>: <?= htmlspecialchars($service['time']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <div class="flex items-center gap-[0.75rem] mb-[1.5rem] border-b border-white/10 pb-[1rem]">
                        <h4 class="font-bold text-[1rem] uppercase tracking-wider">Location</h4>
                    </div>
                    <ul class="space-y-[0.75rem] text-[0.85rem] font-medium text-white/70">
                        <li>4727 Concord Pike</li>
                        <li>Wilmington, DE 19803</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="text-center pt-[4rem] text-[0.75rem] font-medium text-white/40">
            <p>© <?= $currentYear ?> Anointed Word Ministries - All rights reserved</p>
        </div>

    </div>
</footer>
