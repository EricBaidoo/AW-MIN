<?php
/**
 * About Page
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

$db = getDbConnection();
$stmt = $db->query("SELECT * FROM beliefs ORDER BY order_index ASC");
$beliefs = $stmt->fetchAll();
$pillars = ['Systematic Biblical Teaching', 'Fervent Corporate Prayer', 'Authentic Community'];
?>
<div class="min-h-screen">
    <!-- Cinematic Hero -->
    <section class="relative h-[60vh] md:h-[70vh] min-h-[30rem] md:min-h-[35rem] flex items-center justify-start overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/images/backgrounds/about-bg.png" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[rgba(6,14,42,0.85)] to-[#0a0a0a]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-white w-full max-w-[60rem] px-[clamp(2rem,5vw,6rem)] text-left pt-[5rem]">
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4.5rem)] font-black mb-[1.5rem] leading-[1.1]">A Place of Restoration</h1>
            <p class="text-[1.15rem] text-white/80 leading-[1.7] max-w-[40rem]">Discover the heart, vision, and beliefs that drive everything we do at Anointed Word Ministries.</p>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="relative z-20 -mt-[2rem] md:-mt-[4rem] rounded-t-[2rem] md:rounded-t-[2.5rem] shadow-[0_-1.25rem_3.125rem_rgba(0,0,0,0.5)] bg-primary-100 py-[4rem] md:py-[6rem] lg:py-[8rem] scroll-reveal-section">
        <div class="container max-w-[75rem] px-[2rem] mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-[2.5rem] md:gap-[4rem] lg:gap-[6rem]">
                <div class="w-full md:w-5/12 scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                    <div class="relative aspect-[3/4] max-w-[28rem] mx-auto rounded-[1.5rem] overflow-hidden shadow-2xl">
                        <img src="/images/leadership/pastor-cofield.jpg" alt="Church congregation worshiping" class="object-cover object-top w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/60 to-transparent mix-blend-multiply"></div>
                    </div>
                </div>
                <div class="w-full md:w-7/12 scroll-reveal-right opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out" style="transition-delay: 200ms;">
                    <h2 class="font-serif text-[clamp(2rem,4vw,3rem)] font-black text-primary-900 mb-[1.5rem] leading-tight">Reconciling Lives to Christ</h2>
                    <div class="text-[1.05rem] text-primary-700 leading-[1.8] flex flex-col gap-[1.5rem]">
                        <p>At Anointed Word Ministries, our vision is simple yet profound: <strong class="text-primary-900 font-bold">Reconciling individuals and families from dead places to resurrected life in Christ through the power of the Holy Spirit and ministering of the Word of God.</strong></p>
                        <p>We believe that no matter where you are or what you've been through, God has a purpose for your life. We are a family of believers committed to seeing that purpose fulfilled.</p>
                        <div class="mt-[1rem] flex flex-col gap-[0.75rem]">
                            <?php foreach ($pillars as $item): ?>
                            <div class="flex items-center gap-[1rem]">
                                <div class="w-[2rem] h-[2rem] rounded-full bg-accent-500/20 flex items-center justify-center shrink-0">
                                    <svg class="w-[1rem] h-[1rem] text-accent-500 stroke-current fill-none" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span class="font-semibold text-primary-900"><?= htmlspecialchars($item) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Beliefs -->
    <section class="bg-primary-900 py-[4rem] md:py-[6rem] lg:py-[8rem] relative overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60vw] h-[60vw] bg-accent-500/5 rounded-full blur-[7.5rem] pointer-events-none"></div>
        <div class="absolute bottom-0 right-[-10vw] w-[40vw] h-[40vw] bg-primary-900/20 rounded-full blur-[6.25rem] pointer-events-none"></div>
        <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h3 class="font-serif text-[clamp(2.5rem,5vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">What We Believe</h3>
                <p class="text-[1.1rem] text-white/70 max-w-[40rem] mx-auto font-light">Our core beliefs are the foundation of our ministry and guide how we live, worship, and serve.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[1.5rem]">
                <?php foreach ($beliefs as $idx => $belief): ?>
                <div class="bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] p-[2.5rem] hover:bg-white/[0.06] hover:border-accent-500/30 hover:-translate-y-2 hover:shadow-[0_1.25rem_3.125rem_rgba(255,106,0,0.1)] transition-all duration-500 h-full scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: <?= $idx * 150 ?>ms;">
                    <div class="w-[4rem] h-[4rem] bg-white/5 rounded-full flex items-center justify-center mb-[1.5rem] border border-white/10">
                        <span class="text-[1.5rem]"><?= $belief['icon'] ?></span>
                    </div>
                    <h3 class="font-serif text-[1.3rem] font-bold text-white mb-[1rem]"><?= htmlspecialchars($belief['title']) ?></h3>
                    <p class="text-[0.95rem] text-white/60 leading-[1.7]"><?= htmlspecialchars($belief['desc']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
