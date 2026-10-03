<?php
/**
 * Sermons Page
 */
require_once __DIR__ . '/../../includes/db.php';

$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM sermons ORDER BY date DESC");
$stmt->execute();
$allSermons = $stmt->fetchAll();

$featuredSermon = $allSermons[0] ?? null;
?>
<div class="min-h-screen">
    <!-- Featured Sermon Hero -->
    <?php if ($featuredSermon): ?>
    <section class="relative h-[60vh] md:h-[75vh] min-h-[30rem] md:min-h-[35rem] flex items-center justify-start overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="<?= htmlspecialchars($featuredSermon['thumbnail'] ?: '/images/backgrounds/hero-bg.jpg') ?>" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[rgba(6,14,42,0.85)] to-[#0a0a0a]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-white w-full max-w-[60rem] px-[clamp(2rem,5vw,6rem)] text-left pt-[3rem] md:pt-[5rem]">
            <h1 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black mb-[1rem] leading-[1.1]"><?= htmlspecialchars($featuredSermon['title']) ?></h1>
            <p class="text-[1rem] text-accent-400 mb-[1.5rem] font-bold tracking-[0.05em] uppercase">By <?= htmlspecialchars($featuredSermon['speaker']) ?> · <?= date('F j, Y', strtotime($featuredSermon['date'])) ?></p>
            <p class="text-[1.15rem] text-white/80 leading-[1.7] max-w-[43.75rem] mb-[2.5rem]"><?= htmlspecialchars($featuredSermon['description']) ?></p>
        </div>
    </section>
    <?php endif; ?>

    <!-- All Messages -->
    <section class="relative z-20 -mt-[2rem] md:-mt-[4rem] rounded-t-[2rem] md:rounded-t-[2.5rem] shadow-[0_-1.25rem_3.125rem_rgba(0,0,0,0.5)] bg-primary-900 py-[4rem] md:py-[6rem] px-[2rem] md:px-[4rem] overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60vw] h-[60vw] bg-accent-500/5 rounded-full blur-[7.5rem] pointer-events-none"></div>
        <div class="container max-w-[85rem] px-[2rem] relative z-10 mx-auto">
            <div class="text-center mb-[2rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[clamp(2.5rem,5vw,4rem)] font-black text-white mb-[1.5rem] uppercase tracking-tighter leading-[1.1]">All Messages</h2>
                <p class="text-[1.1rem] text-white/70 max-w-[40rem] mx-auto font-light">Browse our complete library of past messages.</p>
            </div>

            <!-- Sermon Filters -->
            <div class="mb-[4rem] max-w-[50rem] mx-auto scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out" style="transition-delay: 200ms;">
                <div class="flex flex-col sm:flex-row gap-[1rem] bg-white/[0.03] backdrop-blur-md border border-white/10 p-[1rem] rounded-[1rem] shadow-lg">
                    <div class="flex-grow relative">
                        <input type="text" id="sermonSearch" placeholder="Search by title, speaker, or topic..." class="w-full bg-primary-950/50 border border-white/10 text-white placeholder-white/40 rounded-[0.5rem] px-[3rem] py-[0.875rem] focus:outline-none focus:border-accent-500 transition-colors">
                        <svg class="w-[1.25rem] h-[1.25rem] text-white/40 absolute left-[1rem] top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                
                <div class="flex flex-wrap items-center justify-center gap-[0.5rem] mt-[1.5rem]" id="sermonTags">
                    <button class="filter-btn active px-[1.25rem] py-[0.5rem] bg-accent-500 text-primary-950 rounded-full text-[0.85rem] font-bold tracking-wider uppercase transition-all" data-filter="all">All</button>
                    <?php 
                        // Extract unique speakers for filter buttons
                        $speakers = array_unique(array_column($allSermons, 'speaker'));
                        foreach ($speakers as $speaker): 
                            if (!empty($speaker)):
                    ?>
                        <button class="filter-btn px-[1.25rem] py-[0.5rem] bg-white/5 text-white border border-white/10 hover:bg-white/10 rounded-full text-[0.85rem] font-bold tracking-wider uppercase transition-all" data-filter="<?= htmlspecialchars($speaker) ?>"><?= htmlspecialchars($speaker) ?></button>
                    <?php 
                            endif;
                        endforeach; 
                    ?>
                </div>
            </div>

            <?php if (count($allSermons) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2rem]" id="sermonsGrid">
                <?php foreach ($allSermons as $idx => $sermon): ?>
                <div class="sermon-card bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] overflow-hidden shadow-lg hover:-translate-y-[0.375rem] hover:shadow-[0_1.25rem_3.125rem_rgba(255,106,0,0.1)] hover:border-accent-500/30 transition-all duration-500 flex flex-col group h-full scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: <?= ($idx % 3) * 100 ?>ms;" data-speaker="<?= htmlspecialchars($sermon['speaker']) ?>" data-title="<?= htmlspecialchars(strtolower($sermon['title'])) ?>" data-desc="<?= htmlspecialchars(strtolower($sermon['description'])) ?>" data-tags="<?= htmlspecialchars(strtolower($sermon['tags'] ?? '')) ?>">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="<?= htmlspecialchars($sermon['thumbnail']) ?>" alt="<?= htmlspecialchars($sermon['title']) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-[rgba(6,14,42,0.8)] to-transparent opacity-50 group-hover:opacity-80 transition-opacity duration-300 z-[1]"></div>
                    </div>
                    <div class="p-[2rem] flex flex-col flex-grow gap-[1rem]">
                        <div class="flex justify-between items-center text-[0.8rem] text-white/60 font-medium">
                            <span class="uppercase tracking-[0.05em]"><?= htmlspecialchars($sermon['speaker']) ?></span>
                            <span><?= date('M j', strtotime($sermon['date'])) ?></span>
                        </div>
                        <h3 class="font-serif text-[1.4rem] font-bold text-white leading-tight group-hover:text-accent-400 transition-colors duration-300"><?= htmlspecialchars($sermon['title']) ?></h3>
                        <p class="text-[0.95rem] text-white/70 leading-relaxed line-clamp-2"><?= htmlspecialchars($sermon['description']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Empty State for Filters -->
            <div id="noResults" class="hidden text-center py-[6rem] text-white/70">
                <svg class="w-16 h-16 text-white/20 mx-auto mb-[1.5rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <p class="text-[1.25rem] font-medium">No sermons match your filters.</p>
                <button onclick="document.querySelector('.filter-btn[data-filter=\'all\']').click(); document.getElementById('sermonSearch').value='';" class="mt-[1rem] text-accent-500 font-bold uppercase tracking-wider text-[0.85rem] hover:text-white transition-colors">Clear Filters</button>
            </div>
            <?php else: ?>
            <div class="text-center py-[6rem] text-white/70">
                <p class="text-[1.25rem] font-medium">No sermons available yet. Check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('sermonSearch');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const sermonCards = document.querySelectorAll('.sermon-card');
    const noResults = document.getElementById('noResults');
    
    let activeFilter = 'all';
    let searchQuery = '';

    function filterSermons() {
        if (sermonCards.length === 0) return;
        let visibleCount = 0;
        
        sermonCards.forEach(card => {
            const speaker = card.dataset.speaker;
            const title = card.dataset.title;
            const desc = card.dataset.desc;
            const tags = card.dataset.tags;
            
            const matchesFilter = (activeFilter === 'all' || speaker === activeFilter);
            const matchesSearch = (searchQuery === '' || 
                                   title.includes(searchQuery) || 
                                   desc.includes(searchQuery) || 
                                   tags.includes(searchQuery) ||
                                   speaker.toLowerCase().includes(searchQuery));
            
            if (matchesFilter && matchesSearch) {
                card.style.display = 'flex';
                visibleCount++;
                // Trigger reflow for animation
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 10);
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase();
            filterSermons();
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Update active styling
            filterBtns.forEach(b => {
                b.classList.remove('bg-accent-500', 'text-primary-950');
                b.classList.add('bg-white/5', 'text-white');
            });
            e.target.classList.remove('bg-white/5', 'text-white');
            e.target.classList.add('bg-accent-500', 'text-primary-950');
            
            activeFilter = e.target.dataset.filter;
            filterSermons();
        });
    });
});
</script>
