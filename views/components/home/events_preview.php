<?php
/**
 * Events Preview Component - Potter's House Style Vertical Cards
 * Fetches latest 3 events from DB
 */
require_once __DIR__ . '/../../../includes/db.php';

$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM events ORDER BY date ASC LIMIT 3");
$stmt->execute();
$upcomingEvents = $stmt->fetchAll();

if (empty($upcomingEvents)) return;
?>
<section class="bg-primary-950 py-[4rem] md:py-[8rem] relative overflow-hidden scroll-reveal-section">
    <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
        <div class="flex justify-between items-end mb-[4rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <h2 class="font-sans text-[clamp(2.5rem,5vw,4.5rem)] font-black text-primary-950 uppercase tracking-tighter leading-[1.1]">
                Upcoming <br/> Events
            </h2>
            <a href="/connect" class="hidden md:flex items-center justify-center px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-primary-950 transition-all duration-300">
                View All
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2rem]">
            <?php foreach ($upcomingEvents as $i => $event): ?>
                <?php 
                    $timestamp = strtotime($event['date']);
                    $month = strtoupper(date('M', $timestamp));
                    $day = date('d', $timestamp);
                ?>
                <a href="/connect" class="group flex flex-col bg-glass-dark rounded-[1.5rem] overflow-hidden hover:shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.3)] transition-all duration-500 ease-out scroll-reveal-up opacity-0 translate-y-[3rem]" style="transition-delay: <?= $i * 150 ?>ms;">
                    
                    <!-- Top Half: Image -->
                    <div class="relative w-full h-[18rem] overflow-hidden bg-white">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="object-cover object-center w-full h-full transition-transform duration-1000 group-hover:scale-105">
                    </div>

                    <!-- Bottom Half: Content -->
                    <div class="flex flex-col flex-grow p-[2.5rem] relative bg-transparent text-white">
                        
                        <div class="flex gap-[2rem]">
                            <!-- Left: Date Stack -->
                            <div class="flex flex-col items-center flex-shrink-0">
                                <span class="font-sans font-bold text-[1rem] text-white tracking-[0.1em] uppercase"><?= $month ?></span>
                                <span class="font-sans font-black text-[3rem] text-white leading-[1] tracking-tighter"><?= $day ?></span>
                            </div>

                            <!-- Right: Title & Details -->
                            <div class="flex flex-col flex-grow">
                                <h3 class="font-sans font-black text-[1.4rem] uppercase leading-[1.2] tracking-tight mb-[2rem] group-hover:text-accent-500 transition-colors duration-300">
                                    <?= htmlspecialchars($event['title']) ?>
                                </h3>
                                
                                <div class="flex items-center gap-[0.75rem] text-white/80 text-[0.9rem] mb-[0.75rem]">
                                    <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="font-medium"><?= htmlspecialchars($event['time']) ?></span>
                                </div>
                                <div class="flex items-center gap-[0.75rem] text-white/80 text-[0.9rem]">
                                    <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="font-medium truncate max-w-[12.5rem]"><?= htmlspecialchars($event['location']) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Right Arrow Button -->
                        <div class="absolute bottom-[2.5rem] right-[2.5rem] w-[3rem] h-[3rem] rounded-full bg-black/50 flex items-center justify-center group-hover:bg-accent-500 transition-colors duration-300">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-[4rem] md:hidden scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 delay-500 ease-out">
            <a href="/connect" class="inline-flex items-center justify-center w-full px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-primary-950 transition-all duration-300">
                View All Events
            </a>
        </div>
    </div>
</section>
