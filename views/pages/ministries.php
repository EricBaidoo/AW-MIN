<?php
/**
 * Ministries Page
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

$db = getDbConnection();
$stmt = $db->query("SELECT * FROM ministries");
$ministries = $stmt->fetchAll();
?>
<div class="min-h-screen">
    <!-- Cinematic Header -->
    <section class="relative h-[50vh] md:h-[60vh] min-h-[25rem] md:min-h-[30rem] flex items-center justify-start overflow-hidden bg-primary-950">
        <div class="absolute inset-0 z-0">
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1438032005730-c779502df39b?w=1920&q=80" alt="Ministries Background" class="object-cover object-center w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-primary-950/50 to-transparent"></div>
        </div>
        <div class="relative z-10 text-left px-[clamp(2rem,5vw,6rem)] max-w-[60rem] mt-[3rem] md:mt-[5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <span class="font-sans text-[1rem] tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] block">Find Your Place</span>
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Ministries</h1>
            <p class="text-[1.1rem] text-white/70 max-w-[40rem]">There is a place for everyone in the body of Christ. Discover the ministries of Anointed Word and get connected today.</p>
        </div>
    </section>

    <!-- Dynamic Alternating Sections -->
    <div class="bg-primary-950 relative overflow-hidden pb-[4rem] md:pb-[8rem]">
        <!-- Decorative Background Blur -->
        <div class="absolute top-[20%] right-[-10%] w-[50vw] h-[50vw] bg-accent-500/10 rounded-full blur-[10rem] pointer-events-none"></div>
        <div class="absolute bottom-[20%] left-[-10%] w-[50vw] h-[50vw] bg-white/5 rounded-full blur-[10rem] pointer-events-none"></div>
        
        <div class="container max-w-[90rem] mx-auto px-[2rem] relative z-10 space-y-[4rem] md:space-y-[10rem] pt-[2rem] md:pt-[4rem]">
            <?php foreach ($ministries as $idx => $min): ?>
            
            <div id="<?= htmlspecialchars($min['id']) ?>" class="flex flex-col <?= $min['align'] === 'right' ? 'lg:flex-row-reverse' : 'lg:flex-row' ?> gap-[3rem] lg:gap-[6rem] items-center">
                
                <!-- Image Side -->
                <div class="w-full lg:w-1/2 relative group scroll-reveal-<?= $min['align'] === 'left' ? 'left' : 'right' ?> opacity-0 <?= $min['align'] === 'left' ? 'translate-x-[-4rem]' : 'translate-x-[4rem]' ?> transition-all duration-1000 ease-out">
                    <div class="relative aspect-[4/3] rounded-[1.5rem] overflow-hidden shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)]">
                        <img src="<?= htmlspecialchars($min['image']) ?>" alt="<?= htmlspecialchars($min['title']) ?>" class="object-cover object-center w-full h-full transition-all duration-1000 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-950/80 to-transparent mix-blend-multiply opacity-60 group-hover:opacity-30 transition-opacity duration-700"></div>
                    </div>
                    <!-- Decorative Element -->
                    <div class="absolute <?= $min['align'] === 'left' ? '-bottom-[2rem] -right-[2rem]' : '-bottom-[2rem] -left-[2rem]' ?> w-[8rem] h-[8rem] bg-accent-500/20 rounded-full blur-[2rem] -z-10 transition-all duration-1000 group-hover:bg-accent-500/40 group-hover:scale-150"></div>
                </div>

                <!-- Content Side -->
                <div class="w-full lg:w-1/2 flex flex-col scroll-reveal-<?= $min['align'] === 'left' ? 'right' : 'left' ?> opacity-0 <?= $min['align'] === 'left' ? 'translate-x-[4rem]' : 'translate-x-[-4rem]' ?> transition-all duration-1000 ease-out">
                    <span class="inline-block px-[1rem] py-[0.35rem] bg-white/5 border border-white/10 text-accent-500 rounded-full text-[0.75rem] font-bold uppercase tracking-[0.2em] mb-[1.5rem] self-start">
                        <?= htmlspecialchars($min['subtitle']) ?>
                    </span>
                    <h2 class="font-serif text-[clamp(2rem,4vw,3.5rem)] font-black text-white leading-[1.1] mb-[1.5rem]">
                        <?= htmlspecialchars($min['title']) ?>
                    </h2>
                    <p class="text-[1.1rem] text-white/70 leading-[1.8] font-light mb-[2.5rem]">
                        <?= htmlspecialchars($min['desc']) ?>
                    </p>
                    
                    <div class="flex gap-[1rem]">
                        <a href="/volunteer" class="inline-flex items-center justify-center px-[2rem] py-[1rem] bg-accent-500 text-primary-950 font-bold uppercase tracking-[0.1em] text-[0.8rem] rounded-[0.25rem] hover:bg-white transition-all duration-300">
                            Join Ministry
                        </a>
                        <a href="/groups" class="inline-flex items-center justify-center px-[2rem] py-[1rem] bg-transparent border border-white/20 text-white font-bold uppercase tracking-[0.1em] text-[0.8rem] rounded-[0.25rem] hover:bg-white/10 transition-all duration-300">
                            Find a Group
                        </a>
                    </div>
                </div>
                
            </div>
            
            <?php endforeach; ?>
        </div>
    </div>
</div>
