<?php
/**
 * Give Page
 */
require_once __DIR__ . '/../../includes/config.php';

require_once __DIR__ . '/../../includes/db.php';

$db = getDbConnection();

$stmt = $db->query("SELECT * FROM faqs WHERE category = 'give' ORDER BY order_index ASC");
$faqs = $stmt->fetchAll();

$stmt2 = $db->query("SELECT * FROM give_impacts ORDER BY order_index ASC");
$impacts = $stmt2->fetchAll();
?>
<div class="min-h-screen">
    <!-- Hero -->
    <section class="relative h-[60vh] min-h-[28rem] flex items-center justify-start overflow-hidden text-left">
        <div class="absolute inset-0 z-0">
            <img src="/images/backgrounds/give-bg.jpg" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-[#0a0a0a]/95 to-[#0a0a0a]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-white max-w-[60rem] px-[clamp(2rem,5vw,6rem)]">
            <h1 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black mb-[1rem] leading-none">Supporting the Mission</h1>
            <p class="text-[clamp(1rem,2vw,1.25rem)] text-white/80 max-w-[40rem]">Your giving enables us to reconcile families, reach the lost, and minister the Word of God locally and globally.</p>
        </div>
    </section>

    <!-- Scripture -->
    <section class="relative z-20 -mt-[4rem] rounded-t-[2.5rem] shadow-[0_-1.25rem_3.125rem_rgba(0,0,0,0.5)] bg-white py-[5rem] scroll-reveal-section">
        <div class="container max-w-[50rem] text-center px-[2rem] mx-auto scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
            <blockquote class="font-serif italic leading-[1.8] text-primary-700 text-[clamp(1.1rem,2vw,1.35rem)]">&ldquo;Honor the Lord with your wealth, with the firstfruits of all your crops; then your barns will be filled to overflowing, and your vats will brim over with new wine.&rdquo;</blockquote>
        </div>
    </section>

    <!-- Giving Methods -->
    <section class="bg-primary-900 py-[8rem] relative overflow-hidden scroll-reveal-section">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-primary-900/20 rounded-full blur-[9.375rem] pointer-events-none"></div>
        <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h3 class="font-serif text-[clamp(2rem,4vw,3.5rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Ways to Give</h3>
                <p class="text-[1.1rem] text-white/70 max-w-[40rem] mx-auto font-light">Select your preferred secure payment method below.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[2.5rem] max-w-[28.125rem] md:max-w-none mx-auto items-center">
                <!-- Zelle -->
                <div class="relative w-full aspect-[1.586/1] bg-gradient-to-br from-[#0c2266] to-[#040e2d] text-white p-[1.5rem] rounded-[1rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] border border-white/10 flex flex-col justify-between overflow-hidden hover:-translate-y-[0.375rem] hover:border-accent-500/30 transition-all duration-500 scroll-reveal-right opacity-0 translate-y-[4rem]">
                    <div class="flex justify-between items-start z-[1]">
                        <div><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">Zelle Account</span><h4 class="text-[1rem] font-bold text-accent-400 tracking-[0.02em] mt-[0.125rem]">Anointed Word Ministries</h4></div>
                    </div>
                    <div class="z-[1]"><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">Zelle Mobile / Phone</span><p class="text-[1.25rem] font-mono font-bold tracking-[0.05em] text-white mt-[0.125rem]"><?= htmlspecialchars($siteConfig['giving']['zelle']['number']) ?></p></div>
                    <div class="flex justify-between items-center z-[1]"><span class="text-[0.75rem] font-semibold text-white/60">Wilmington, DE</span></div>
                </div>
                <!-- CashApp -->
                <div class="relative w-full aspect-[1.586/1] bg-gradient-to-br from-[#0c6629] to-[#042d10] text-white p-[1.5rem] rounded-[1rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] border border-white/10 flex flex-col justify-between overflow-hidden hover:-translate-y-[0.375rem] hover:border-accent-500/30 transition-all duration-500 scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: 150ms;">
                    <div class="flex justify-between items-start z-[1]">
                        <div><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">CashApp Account</span><h4 class="text-[1rem] font-bold text-accent-400 tracking-[0.02em] mt-[0.125rem]">Anointed Word</h4></div>
                    </div>
                    <div class="z-[1]"><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">CashTag ID</span><p class="text-[1.25rem] font-mono font-bold tracking-[0.05em] text-white mt-[0.125rem]"><?= htmlspecialchars($siteConfig['giving']['cashapp']) ?></p></div>
                    <div class="flex justify-between items-center z-[1]"><span class="text-[0.75rem] font-semibold text-white/60">Wilmington, DE</span></div>
                </div>
                <!-- In Person -->
                <div class="relative w-full aspect-[1.586/1] bg-gradient-to-br from-[#4b3513] to-[#201504] text-white p-[1.5rem] rounded-[1rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] border border-white/10 flex flex-col justify-between overflow-hidden hover:-translate-y-[0.375rem] hover:border-accent-500/30 transition-all duration-500 scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: 300ms;">
                    <div class="flex justify-between items-start z-[1]">
                        <div><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">In Person</span><h4 class="text-[1rem] font-bold text-accent-400 tracking-[0.02em] mt-[0.125rem]">Worship Offering</h4></div>
                    </div>
                    <div class="z-[1]"><span class="text-[0.6rem] font-bold uppercase tracking-[0.15em] opacity-60">Location / Address</span><p class="text-[0.95rem] font-bold tracking-[0.02em] text-white mt-[0.125rem] leading-snug">4727 Concord Pike,<br>Wilmington, DE 19803</p></div>
                    <div class="flex justify-between items-center z-[1]"><span class="text-[0.75rem] font-semibold text-white/60">Wilmington, DE</span><a href="https://maps.google.com/?q=4727+Concord+Pike,+Wilmington,+DE+19803" target="_blank" class="px-[1.2rem] py-[0.55rem] text-[0.8rem] font-bold uppercase tracking-[0.05em] bg-white text-[#4b3513] hover:bg-accent-500 hover:text-white transition-all duration-300 rounded-[0.25rem]">Directions</a></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact -->
    <section class="bg-primary-950 py-[8rem] relative overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60vw] h-[60vw] bg-accent-500/5 rounded-full blur-[7.5rem] pointer-events-none"></div>
        <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h3 class="font-serif text-[clamp(2rem,4vw,3.5rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Where Your Giving Goes</h3>
                <p class="text-[1.1rem] text-white/70 max-w-[45rem] mx-auto font-light">When you give at Anointed Word Ministries, your seeds go directly to work inside and outside the church walls.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[1.5rem]">
                <?php foreach ($impacts as $idx => $item): ?>
                <div class="bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] p-[2rem] hover:bg-white/[0.06] hover:border-accent-500/30 hover:-translate-y-2 hover:shadow-[0_1.25rem_3.125rem_rgba(255,106,0,0.1)] transition-all duration-500 h-full scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: <?= $idx * 150 ?>ms;">
                    <span class="text-[2rem] mb-[1rem] block"><?= $item['icon'] ?></span>
                    <h4 class="font-serif text-white text-[1.3rem] font-bold mb-[0.5rem]"><?= htmlspecialchars($item['title']) ?></h4>
                    <p class="text-[0.9rem] text-white/60 leading-[1.6]"><?= htmlspecialchars($item['desc']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="bg-primary-100 py-[6rem] scroll-reveal-section">
        <div class="container max-w-[50rem] px-[2rem] mx-auto scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
            <div class="text-center mb-[3rem]">
                <h3 class="font-serif text-[clamp(2rem,4vw,3rem)] font-black text-primary-900 mb-[1rem]">Giving FAQ</h3>
            </div>
            <div class="flex flex-col gap-[0.5rem]" x-data="{ openFaq: null }">
                <?php foreach ($faqs as $index => $faq): ?>
                <div class="bg-white border border-[#e8e6e0] rounded-[0.75rem] overflow-hidden transition-all duration-300 hover:border-accent-500/30">
                    <button class="w-full flex justify-between items-center p-[1.5rem] text-left font-semibold text-[1.05rem] text-primary-900 cursor-pointer faq-toggle" data-target="faq-<?= $index ?>">
                        <span><?= htmlspecialchars($faq['q']) ?></span>
                        <span class="text-[1.4rem] text-accent-500 transition-transform duration-300 faq-icon">+</span>
                    </button>
                    <div id="faq-<?= $index ?>" class="overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                        <p class="text-[0.95rem] leading-[1.7] text-primary-700 px-[1.5rem] pb-[1.5rem]"><?= htmlspecialchars($faq['a']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<script>
document.querySelectorAll('.faq-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('.faq-icon');
        const isOpen = target.style.maxHeight && target.style.maxHeight !== '0rem';
        
        // Close all
        document.querySelectorAll('[id^="faq-"]').forEach(el => { el.style.maxHeight = '0rem'; });
        document.querySelectorAll('.faq-icon').forEach(ic => { ic.style.transform = 'none'; });
        
        if (!isOpen) {
            target.style.maxHeight = target.scrollHeight + 'px';
            icon.style.transform = 'rotate(45deg)';
        }
    });
});
</script>
