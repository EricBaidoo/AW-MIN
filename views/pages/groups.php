<?php
/**
 * Life Groups Page
 */
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$groups = $pdo->query("SELECT * FROM groups ORDER BY category ASC, name ASC")->fetchAll();
?>
<div class="min-h-screen">
    <!-- Cinematic Header -->
    <section class="relative h-[50vh] md:h-[60vh] min-h-[25rem] md:min-h-[30rem] flex items-center justify-start overflow-hidden bg-primary-950">
        <div class="absolute inset-0 z-0">
            <!-- Background Image Placeholder -->
            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=1920&q=80" alt="Life Groups Background" class="object-cover object-center w-full h-full opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-left px-[clamp(2rem,5vw,6rem)] max-w-[60rem] mt-[3rem] md:mt-[5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <span class="font-sans text-[1rem] tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] block">Community</span>
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Life Groups</h1>
            <p class="text-[1.1rem] text-white/70 max-w-[40rem]">We were not meant to do life alone. Find a community where you can grow, share, and do life together.</p>
        </div>
    </section>

    <!-- Groups Grid -->
    <section class="bg-primary-950 py-[4rem] md:py-[6rem] relative min-h-[30rem]">
        <div class="container max-w-[85rem] px-[2rem] mx-auto">
            
            <?php if (empty($groups)): ?>
                <div class="text-center py-[2rem] md:py-[4rem] bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1.5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
                    <svg class="w-16 h-16 text-white/20 mx-auto mb-[1.5rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <h3 class="font-serif text-[1.5rem] font-bold text-white mb-[0.5rem]">Check Back Soon!</h3>
                    <p class="text-white/60">Our new Life Groups semester is currently being planned. Groups will appear here shortly.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2rem]">
                    <?php foreach ($groups as $idx => $group): ?>
                    <div class="group bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1.5rem] overflow-hidden hover:-translate-y-2 hover:shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.3)] transition-all duration-500 ease-out scroll-reveal-up opacity-0 translate-y-[3rem]" style="transition-delay: <?= ($idx % 3) * 150 ?>ms;">
                        
                        <?php if (!empty($group['image'])): ?>
                        <div class="h-[12rem] overflow-hidden bg-primary-900">
                            <img src="<?= htmlspecialchars($group['image']) ?>" alt="<?= htmlspecialchars($group['name']) ?>" class="object-cover object-center w-full h-full group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <?php else: ?>
                        <div class="h-[8rem] bg-gradient-to-br from-primary-900 to-primary-800 flex items-center justify-center border-b border-white/10">
                            <span class="font-sans text-[2rem] font-black text-white/20 uppercase"><?= htmlspecialchars(substr($group['name'], 0, 2)) ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="p-[2rem]">
                            <?php if (!empty($group['category'])): ?>
                                <span class="inline-block px-[0.75rem] py-[0.25rem] bg-white/5 text-accent-500 text-[0.7rem] font-bold uppercase tracking-widest rounded-full mb-[1rem]">
                                    <?= htmlspecialchars($group['category']) ?>
                                </span>
                            <?php endif; ?>
                            
                            <h3 class="font-serif text-[1.5rem] font-bold text-white mb-[0.5rem] leading-tight">
                                <?= htmlspecialchars($group['name']) ?>
                            </h3>
                            
                            <?php if (!empty($group['leader'])): ?>
                                <p class="text-white/50 text-[0.85rem] mb-[1.5rem]">Led by <?= htmlspecialchars($group['leader']) ?></p>
                            <?php endif; ?>

                            <div class="space-y-[0.75rem] mb-[2rem]">
                                <?php if (!empty($group['day']) || !empty($group['time'])): ?>
                                <div class="flex items-center gap-[0.75rem] text-white/80 text-[0.9rem]">
                                    <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span><?= htmlspecialchars($group['day']) ?>s at <?= htmlspecialchars($group['time']) ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($group['location'])): ?>
                                <div class="flex items-center gap-[0.75rem] text-white/80 text-[0.9rem]">
                                    <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span><?= htmlspecialchars($group['location']) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <p class="text-white/60 text-[0.95rem] leading-[1.6] line-clamp-3 mb-[2rem]">
                                <?= htmlspecialchars($group['description'] ?? 'Join this life group to grow together in community.') ?>
                            </p>

                            <a href="/connect?group=<?= urlencode($group['slug']) ?>" class="block text-center px-[1.5rem] py-[1rem] bg-white/5 border border-white/10 hover:bg-white hover:text-primary-950 hover:border-white text-white rounded-[0.5rem] text-[0.875rem] font-bold uppercase tracking-wider transition-colors duration-300">
                                Join Group
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
