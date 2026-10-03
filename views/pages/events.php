<?php
/**
 * Events Page
 */
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();

// Fetch all upcoming events (date >= today)
$stmt = $pdo->prepare("SELECT * FROM events WHERE date >= date('now') ORDER BY date ASC");
$stmt->execute();
$events = $stmt->fetchAll();

// Get the very next event for the Hero section
$nextEvent = $events[0] ?? null;
?>
<div class="min-h-screen bg-primary-100">
    <!-- Hero / Next Event -->
    <section class="relative h-[60vh] md:h-[65vh] min-h-[30rem] md:min-h-[35rem] flex items-center justify-start overflow-hidden text-left pt-[3rem] md:pt-[5rem] bg-primary-950">
        <?php if ($nextEvent): ?>
        <div class="absolute inset-0 z-0">
            <img src="<?= htmlspecialchars($nextEvent['image'] ?: '/images/backgrounds/hero-bg.jpg') ?>" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-primary-950/80 to-primary-100"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-white w-full max-w-[60rem] px-[clamp(2rem,5vw,6rem)]">
            <span class="font-sans text-[1rem] tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] block scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">Up Next</span>
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-[1rem] leading-[1.1] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 delay-100 ease-out"><?= htmlspecialchars($nextEvent['title']) ?></h1>
            <p class="text-[clamp(1.1rem,2vw,1.35rem)] text-white/80 mb-[2.5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 delay-200 ease-out">
                <?= date('l, F jS', strtotime($nextEvent['date'])) ?> at <?= htmlspecialchars($nextEvent['time']) ?>
            </p>
            <div class="scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 delay-300 ease-out">
                <a href="#all-events" class="inline-flex items-center justify-center px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-white hover:text-accent-600 hover:scale-105 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.3)]">View Calendar</a>
            </div>
        </div>
        <?php else: ?>
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=1920&q=80" alt="Background" class="object-cover object-center w-full h-full opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-100 to-primary-950/80"></div>
        </div>
        <div class="relative z-10 text-center px-[2rem] mt-[3rem] md:mt-[5rem]">
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1]">Events</h1>
        </div>
        <?php endif; ?>
    </section>

    <!-- Calendar View -->
    <section id="all-events" class="py-[4rem] md:py-[6rem] relative overflow-hidden z-20">
        <div class="container max-w-[85rem] mx-auto px-[2rem]">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[clamp(2.5rem,5vw,3.5rem)] font-black text-primary-900 mb-[1rem] leading-tight">Church Calendar</h2>
                <p class="text-[1.15rem] text-primary-700 max-w-[40rem] mx-auto font-light">Mark your calendars and join us for our upcoming gatherings, conferences, and outreach initiatives.</p>
            </div>
            
            <?php if (empty($events)): ?>
            <div class="bg-white rounded-[1.5rem] p-[4rem] text-center border border-black/5 shadow-xl scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
                <span class="text-[3rem] mb-[1rem] block">📅</span>
                <h3 class="font-serif text-[1.5rem] font-bold text-primary-900 mb-[0.5rem]">No upcoming events right now.</h3>
                <p class="text-primary-700">Check back later for our new calendar season!</p>
            </div>
            <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2rem]">
                <?php foreach ($events as $i => $event): 
                    $timestamp = strtotime($event['date']);
                    $month = strtoupper(date('M', $timestamp));
                    $day = date('d', $timestamp);
                ?>
                <div class="bg-white rounded-[1.5rem] overflow-hidden shadow-xl border border-black/5 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 flex flex-col group scroll-reveal-up opacity-0 translate-y-[3rem]" style="transition-delay: <?= ($i % 3) * 150 ?>ms;">
                    <!-- Image -->
                    <div class="relative h-[16rem] overflow-hidden">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        
                        <!-- Date Badge Overlay -->
                        <div class="absolute bottom-[1.5rem] left-[1.5rem] flex flex-col items-center bg-white text-primary-900 rounded-[0.75rem] px-[1rem] py-[0.5rem] shadow-lg shadow-black/20">
                            <span class="font-sans font-bold text-[0.8rem] tracking-[0.1em] uppercase text-accent-600"><?= $month ?></span>
                            <span class="font-serif font-black text-[1.8rem] leading-[1]"><?= $day ?></span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-[2rem] flex flex-col flex-grow">
                        <h3 class="font-serif text-[1.4rem] font-bold text-primary-900 mb-[1rem] leading-tight group-hover:text-accent-600 transition-colors duration-300"><?= htmlspecialchars($event['title']) ?></h3>
                        
                        <div class="space-y-[0.5rem] mb-[1.5rem]">
                            <div class="flex items-center gap-[0.75rem] text-primary-700 text-[0.95rem]">
                                <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-medium"><?= htmlspecialchars($event['time']) ?></span>
                            </div>
                            <div class="flex items-center gap-[0.75rem] text-primary-700 text-[0.95rem]">
                                <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium"><?= htmlspecialchars($event['location']) ?></span>
                            </div>
                        </div>
                        
                        <p class="text-primary-600 text-[0.95rem] leading-[1.6] line-clamp-3 mb-[2rem] flex-grow">
                            <?= htmlspecialchars($event['description'] ?? 'Join us for this special event. Click below for more details.') ?>
                        </p>
                        
                        <!-- CTA -->
                        <a href="/visit" class="inline-flex items-center justify-center w-full px-[1.5rem] py-[1rem] bg-primary-900 text-white font-bold uppercase tracking-[0.1em] text-[0.8rem] rounded-[0.5rem] hover:bg-accent-500 transition-colors duration-300">
                            Register / RSVP
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>
