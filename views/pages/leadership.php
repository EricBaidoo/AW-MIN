<?php
/**
 * Leadership Page
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

$db = getDbConnection();
$stmt = $db->query("SELECT * FROM leaders ORDER BY order_index ASC");
$leaders = $stmt->fetchAll();
?>
<div class="min-h-screen">
    <!-- Cinematic Header -->
    <section class="relative h-[40vh] md:h-[50vh] min-h-[20rem] md:min-h-[25rem] flex items-center justify-start overflow-hidden bg-primary-950">
        <div class="absolute inset-0 z-0">
            <!-- Background Image Placeholder -->
            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1920&q=80" alt="Leadership Background" class="object-cover object-center w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-left px-[clamp(2rem,5vw,6rem)] max-w-[60rem] mt-[3rem] md:mt-[5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <span class="font-sans text-[1rem] tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] block">Our Team</span>
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1]">Leadership</h1>
        </div>
    </section>

    <!-- Leadership Grid -->
    <section class="bg-primary-950 py-[4rem] md:py-[6rem] relative">
        <div class="container max-w-[85rem] px-[2rem] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[2rem]">
                <?php foreach ($leaders as $idx => $leader): ?>
                <div class="group scroll-reveal-up opacity-0 translate-y-[3rem] transition-all duration-1000 ease-out" style="transition-delay: <?= $idx * 150 ?>ms;">
                    <!-- Image Card -->
                    <div class="relative w-full aspect-[3/4] rounded-[1.5rem] overflow-hidden mb-[1.5rem] bg-white/5 border border-white/10">
                        <img src="<?= htmlspecialchars($leader['image']) ?>" alt="<?= htmlspecialchars($leader['name']) ?>" class="object-cover object-center w-full h-full filter grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500"></div>
                        
                        <!-- Title Badge -->
                        <div class="absolute bottom-[1.5rem] left-[1.5rem] right-[1.5rem]">
                            <span class="inline-block px-[1rem] py-[0.25rem] bg-accent-500 text-primary-950 font-bold uppercase tracking-widest text-[0.7rem] rounded-full mb-[0.5rem]"><?= htmlspecialchars($leader['title']) ?></span>
                            <h3 class="font-serif text-[1.5rem] font-bold text-white"><?= htmlspecialchars($leader['name']) ?></h3>
                        </div>
                    </div>
                    
                    <!-- Bio -->
                    <p class="text-white/60 text-[0.95rem] leading-[1.7] px-[0.5rem]">
                        <?= htmlspecialchars($leader['bio']) ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Join the Team CTA -->
    <section class="bg-primary-900 py-[4rem] md:py-[6rem] lg:py-[8rem] relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('/images/backgrounds/pattern.svg')]"></div>
        <div class="container max-w-[50rem] mx-auto px-[2rem] relative z-10 text-center scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <h2 class="font-serif text-[clamp(2rem,4vw,3rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Serve With Us</h2>
            <p class="text-[1.1rem] text-white/70 mb-[3rem]">We believe everyone has a part to play in the body of Christ. Discover your purpose and join one of our serving teams today.</p>
            <a href="/volunteer" class="inline-block px-[3.5rem] py-[1.25rem] bg-accent-500 text-primary-950 font-bold uppercase tracking-[0.2em] hover:bg-white transition-colors duration-300">
                Volunteer Opportunities
            </a>
        </div>
    </section>
</div>
