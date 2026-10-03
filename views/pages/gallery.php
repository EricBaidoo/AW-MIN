<?php
/**
 * Gallery Page
 */
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$images = $pdo->query("SELECT * FROM gallery_images ORDER BY order_index ASC")->fetchAll();

// Fallback if empty (for demo purposes)
if (empty($images)) {
    $images = [
        ['image_url' => 'https://images.unsplash.com/photo-1438283173091-5dbf5c5a3206?w=800&q=80', 'caption' => 'Sunday Worship'],
        ['image_url' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=800&q=80', 'caption' => 'Life Groups'],
        ['image_url' => 'https://images.unsplash.com/photo-1544427920-c49ccfb85579?w=800&q=80', 'caption' => 'Community Outreach'],
        ['image_url' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800&q=80', 'caption' => 'Youth Ministry'],
        ['image_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800&q=80', 'caption' => 'Worship Night'],
        ['image_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80', 'caption' => 'Baptism Sunday'],
    ];
}
?>
<div class="min-h-screen">
    <!-- Cinematic Header -->
    <section class="relative h-[50vh] min-h-[25rem] flex items-center justify-start overflow-hidden bg-primary-950">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1438283173091-5dbf5c5a3206?w=1920&q=80" alt="Gallery Background" class="object-cover object-center w-full h-full opacity-30 blur-sm">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-left px-[clamp(2rem,5vw,6rem)] max-w-[60rem] mt-[5rem] scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
            <span class="font-sans text-[1rem] tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] block">Our Story</span>
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">Photo Gallery</h1>
            <p class="text-[1.1rem] text-white/70 max-w-[40rem]">A glimpse into the life and community of Anointed Word Ministries.</p>
        </div>
    </section>

    <!-- Masonry Grid -->
    <section class="bg-primary-950 py-[4rem] relative">
        <div class="container max-w-[85rem] px-[2rem] mx-auto">
            
            <!-- CSS-only Masonry Columns -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-[1.5rem] space-y-[1.5rem]">
                <?php foreach ($images as $idx => $img): ?>
                <div class="break-inside-avoid scroll-reveal-up opacity-0 translate-y-[3rem] transition-all duration-1000 ease-out" style="transition-delay: <?= ($idx % 3) * 100 ?>ms;">
                    <div class="relative group rounded-[1rem] overflow-hidden bg-primary-900 border border-white/10 cursor-pointer">
                        <img src="<?= htmlspecialchars($img['image_url']) ?>" alt="<?= htmlspecialchars($img['caption']) ?>" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <?php if (!empty($img['caption'])): ?>
                        <div class="absolute bottom-0 left-0 right-0 p-[1.5rem] translate-y-[1rem] opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <p class="text-white font-sans font-bold uppercase tracking-widest text-[0.8rem]"><?= htmlspecialchars($img['caption']) ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    </section>
</div>
