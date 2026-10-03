<?php
/**
 * Live Stream Page
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/services.php';
$services = getAllServices();
?>
<div class="min-h-screen pt-[6rem]">
    <!-- Header -->
    <section class="relative py-[4rem] px-[2rem] text-center">
        <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1rem]">Live <span class="text-accent-500">Stream</span></h1>
        <p class="text-[1.1rem] text-white/70 max-w-[40rem] mx-auto">Join us online for our live worship experiences and teachings.</p>
    </section>

    <!-- Main Stream Layout -->
    <section class="container max-w-[85rem] px-[2rem] mx-auto pb-[8rem]">
        <div class="flex flex-col lg:flex-row gap-[2rem]">
            
            <!-- Video Player (Left/Main) -->
            <div class="w-full lg:w-2/3 flex flex-col gap-[1.5rem]">
                <!-- 16:9 Aspect Ratio Container for Iframe -->
                <div class="relative w-full rounded-[1rem] overflow-hidden shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] border border-white/10 bg-black aspect-video flex items-center justify-center group">
                    <!-- Placeholder Content (Replace with actual YouTube/Vimeo iframe) -->
                    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1544427920-c49ccfb85579?w=1920&q=80')] bg-cover bg-center opacity-40"></div>
                    <div class="absolute inset-0 bg-primary-950/60 mix-blend-multiply"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-[5rem] h-[5rem] bg-accent-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform cursor-pointer">
                            <svg class="w-8 h-8 text-primary-950 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <p class="mt-[1.5rem] font-bold text-white uppercase tracking-widest text-[0.9rem]">Stream is offline</p>
                    </div>
                </div>

                <!-- Stream Info -->
                <div class="bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] p-[2rem]">
                    <h3 class="font-serif text-[1.5rem] font-bold text-white mb-[0.5rem]">Live Broadcast</h3>
                    <p class="text-white/60 mb-[1.5rem]"><?= htmlspecialchars($siteConfig['pastor']['name']) ?></p>
                    <div class="flex flex-wrap gap-[1rem]">
                        <a href="/sermons" class="px-[1.5rem] py-[0.75rem] bg-white/5 hover:bg-white/10 text-white rounded-[0.5rem] text-[0.875rem] font-bold uppercase tracking-wider transition-colors inline-flex items-center gap-[0.5rem]">
                            <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Past Sermons
                        </a>
                        <a href="/give" class="px-[1.5rem] py-[0.75rem] bg-accent-500 hover:bg-white text-primary-950 rounded-[0.5rem] text-[0.875rem] font-bold uppercase tracking-wider transition-colors inline-flex items-center gap-[0.5rem]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Give Online
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="w-full lg:w-1/3 flex flex-col gap-[2rem]">
                <!-- Upcoming Schedule -->
                <div class="bg-primary-900/50 border border-white/10 rounded-[1rem] p-[2rem]">
                    <h3 class="font-serif text-[1.2rem] font-bold text-white mb-[1.5rem] uppercase tracking-wider">Weekly Schedule</h3>
                    <ul class="space-y-[1rem]">
                        <?php foreach ($services as $service): ?>
                        <li class="flex justify-between items-center text-[0.95rem] border-b border-white/5 pb-[1rem] last:border-0 last:pb-0">
                            <span class="text-white/80 font-medium"><?= htmlspecialchars($service['shortName']) ?></span>
                            <span class="text-accent-500 font-bold"><?= htmlspecialchars($service['time']) ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Connect Card -->
                <div class="bg-accent-500 rounded-[1rem] p-[2rem] text-primary-950 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                    <h3 class="font-serif text-[1.5rem] font-black uppercase tracking-tight mb-[1rem]">New Here?</h3>
                    <p class="text-[0.95rem] font-medium opacity-90 mb-[2rem]">We would love to connect with you. Let us know you're worshiping with us today!</p>
                    <a href="/connect" class="block text-center px-[1.5rem] py-[1rem] bg-primary-950 text-white rounded-[0.5rem] text-[0.875rem] font-bold uppercase tracking-wider hover:bg-black transition-colors">
                        Fill Out Connect Card
                    </a>
                </div>
            </div>

        </div>
    </section>
</div>
