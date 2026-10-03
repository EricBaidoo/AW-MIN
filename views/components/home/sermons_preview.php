<?php
/**
 * Sermons Preview Component
 * Fetches latest 3 sermons from DB
 */
require_once __DIR__ . '/../../../includes/db.php';

$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM sermons ORDER BY date DESC LIMIT 3");
$stmt->execute();
$recentSermons = $stmt->fetchAll();

if (empty($recentSermons)) return;
?>
<section class="bg-primary-950 py-[4rem] md:py-[8rem] relative overflow-hidden scroll-reveal-section">
    
    <!-- Dynamic Theater Spotlight Gradients -->
    <div class="absolute top-[-10%] right-[-10%] w-[50vw] h-[50vw] bg-primary-900/30 rounded-full blur-[9.375rem] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[40vw] h-[40vw] bg-accent-500/10 rounded-full blur-[7.5rem] pointer-events-none"></div>

    <div class="container max-w-[85rem] relative z-10 px-[2rem] mx-auto">
        
        <!-- Main Heading -->
        <div class="text-center mb-[5rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
            <h2 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black text-white tracking-tight leading-[1.1] mb-[1.5rem] drop-shadow-2xl">
                Latest Messages From The House
            </h2>
            <p class="text-[1.1rem] md:text-[1.15rem] text-white/70 leading-[1.6] max-w-[50rem] mx-auto font-light">
                There is always a word in season. Discover sermons and teachings designed to inspire, connect, and empower you in every season of life.
            </p>
        </div>

        <!-- Landscape Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[2.5rem]">
            <?php foreach ($recentSermons as $i => $sermon): ?>
                <?php 
                    $timestamp = strtotime($sermon['date']);
                    $month = strtoupper(date('M', $timestamp));
                    $day = date('d', $timestamp);
                ?>
                <a 
                    href="/sermons/<?= htmlspecialchars((string)$sermon['id']) ?>"
                    class="group flex flex-col rounded-[1rem] overflow-hidden bg-primary-950/[0.03] backdrop-blur-xl shadow-[0_1.875rem_3.75rem_rgba(0,0,0,0.6)] hover:-translate-y-3 hover:shadow-[0_2.5rem_5rem_rgba(255,106,0,0.15)] transition-all duration-700 ease-out border border-white/10 scroll-reveal-right opacity-0 translate-y-[4rem]"
                    style="transition-delay: <?= $i * 150 ?>ms;"
                >
                    <!-- Image Half -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden">
                        <img
                            src="<?= htmlspecialchars($sermon['thumbnail']) ?>"
                            alt="<?= htmlspecialchars($sermon['title']) ?>"
                            class="object-cover object-top w-full h-full transition-transform duration-1000 group-hover:scale-110 opacity-90 group-hover:opacity-100"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050b14] via-transparent to-transparent opacity-80"></div>
                    </div>
                    
                    <!-- Content Half -->
                    <div class="flex p-[1.5rem] md:p-[2rem] relative bg-gradient-to-t from-[#050b14]/50 to-transparent flex-grow">
                        
                        <!-- Floating Date Left -->
                        <div class="flex flex-col items-center mr-[1.5rem] pt-[0.25rem]">
                            <span class="font-serif text-[1.85rem] font-black text-white leading-none drop-shadow-md">
                                <?= $day ?>
                            </span>
                        </div>

                        <!-- Details Right -->
                        <div class="flex flex-col flex-grow">
                            <h3 class="font-serif font-bold text-[1.2rem] text-white leading-tight mb-[0.5rem] group-hover:text-accent-400 transition-colors">
                                <?= htmlspecialchars($sermon['title']) ?>
                            </h3>
                            <div class="flex items-center gap-[0.5rem] mb-[0.5rem] text-white/50 group-hover:text-white/80 transition-colors duration-300">
                                <!-- Time Icon -->
                                <svg class="w-[1rem] h-[1rem] fill-current" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                                <span class="text-[0.8rem] font-medium"><?= htmlspecialchars($sermon['speaker']) ?></span>
                            </div>
                            
                            <div class="flex items-center gap-[0.5rem] text-white/50 group-hover:text-white/80 transition-colors duration-300 mb-[1rem]">
                                <!-- Location Icon -->
                                <svg class="w-[1rem] h-[1rem] fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"/></svg>
                                <span class="text-[0.8rem] font-medium">AWM Sanctuary</span>
                            </div>
                        </div>

                        <!-- Arrow Bottom Right -->
                        <div class="absolute bottom-[2rem] right-[2rem] w-[2.5rem] h-[2.5rem] rounded-full bg-primary-950/5 flex items-center justify-center group-hover:bg-accent-500 transition-all duration-500 border border-white/20 group-hover:border-accent-500 group-hover:shadow-[0_0_1.25rem_rgba(255,106,0,0.5)]">
                            <span class="text-white text-[1.2rem] leading-none mb-[0.15rem] transition-colors">›</span>
                        </div>

                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
