<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();

$sermonsCount = $pdo->query('SELECT count(*) FROM sermons')->fetchColumn();
$eventsCount = $pdo->query('SELECT count(*) FROM events')->fetchColumn();
$heroCount = $pdo->query('SELECT count(*) FROM hero_slides')->fetchColumn();
$galleryCount = $pdo->query('SELECT count(*) FROM gallery_images')->fetchColumn();
$submissionsCount = $pdo->query('SELECT count(*) FROM form_submissions')->fetchColumn();
$recentSubmissions = $pdo->query('SELECT * FROM form_submissions ORDER BY submitted_at DESC LIMIT 5')->fetchAll();
?>
<div class="grid grid-cols-2 lg:grid-cols-5 gap-[1rem]">
    <!-- Sermons Metric -->
    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[1.5rem] shadow-sm">
        <p class="text-white/50 text-[0.75rem] uppercase tracking-widest mb-[0.5rem]">Sermons</p>
        <p class="text-white text-[2rem] font-bold"><?= $sermonsCount ?></p>
    </div>
    
    <!-- Events Metric -->
    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[1.5rem] shadow-sm">
        <p class="text-white/50 text-[0.75rem] uppercase tracking-widest mb-[0.5rem]">Events</p>
        <p class="text-white text-[2rem] font-bold"><?= $eventsCount ?></p>
    </div>

    <!-- Hero Slides Metric -->
    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[1.5rem] shadow-sm">
        <p class="text-white/50 text-[0.75rem] uppercase tracking-widest mb-[0.5rem]">Hero Slides</p>
        <p class="text-white text-[2rem] font-bold"><?= $heroCount ?></p>
    </div>

    <!-- Gallery Metric -->
    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[1.5rem] shadow-sm">
        <p class="text-white/50 text-[0.75rem] uppercase tracking-widest mb-[0.5rem]">Gallery</p>
        <p class="text-white text-[2rem] font-bold"><?= $galleryCount ?></p>
    </div>

    <!-- Submissions Metric -->
    <div class="bg-white/[0.03] backdrop-blur-xl border border-accent-500/20 rounded-[1rem] p-[1.5rem] shadow-sm">
        <p class="text-accent-500 text-[0.75rem] uppercase tracking-widest mb-[0.5rem]">Submissions</p>
        <p class="text-white text-[2rem] font-bold"><?= $submissionsCount ?></p>
    </div>
</div>

<!-- Recent Submissions -->
<div class="mt-[3rem]">
    <div class="flex items-center justify-between mb-[1.5rem]">
        <h3 class="text-[1.25rem] font-bold text-white">Recent Submissions</h3>
        <a href="/admin/submissions" class="text-accent-500 hover:text-white text-[0.85rem] font-bold uppercase tracking-wider transition-colors">View All →</a>
    </div>
    
    <?php if (!empty($recentSubmissions)): ?>
    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <tbody class="divide-y divide-white/10 text-[0.9rem]">
                <?php foreach ($recentSubmissions as $sub): ?>
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="p-[1rem]">
                        <span class="px-[0.5rem] py-[0.25rem] rounded-[0.25rem] text-[0.7rem] font-bold uppercase tracking-wider
                            <?php
                            switch($sub['form_type']) {
                                case 'visit': echo 'bg-blue-500/20 text-blue-400'; break;
                                case 'contact': echo 'bg-green-500/20 text-green-400'; break;
                                case 'volunteer': echo 'bg-purple-500/20 text-purple-400'; break;
                                default: echo 'bg-white/10 text-white/50';
                            }
                            ?>
                        "><?= htmlspecialchars($sub['form_type']) ?></span>
                    </td>
                    <td class="p-[1rem] text-white font-medium"><?= htmlspecialchars($sub['first_name'] . ' ' . $sub['last_name']) ?></td>
                    <td class="p-[1rem] text-white/50 hidden md:table-cell"><?= htmlspecialchars($sub['email']) ?></td>
                    <td class="p-[1rem] text-white/40 text-[0.85rem] text-right"><?= date('M j', strtotime($sub['submitted_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="bg-white/[0.03] border border-white/10 rounded-[1rem] p-[3rem] text-center text-white/50">
        No submissions yet. They will appear here as visitors fill out your forms.
    </div>
    <?php endif; ?>
</div>

<!-- Quick Actions -->
<div class="mt-[3rem]">
    <h3 class="text-[1.25rem] font-bold text-white mb-[1.5rem]">Quick Actions</h3>
    <div class="flex flex-wrap gap-[1rem]">
        <a href="/admin/sermons_edit" class="inline-flex items-center gap-[0.5rem] bg-accent-500 text-primary-950 font-bold px-[1.5rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white transition-colors">
            <svg class="w-[1.2rem] h-[1.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Sermon
        </a>
        <a href="/admin/events_edit" class="inline-flex items-center gap-[0.5rem] bg-white/[0.05] border border-white/10 text-white font-bold px-[1.5rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/[0.1] transition-colors">
            <svg class="w-[1.2rem] h-[1.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Event
        </a>
        <a href="/admin/gallery_edit" class="inline-flex items-center gap-[0.5rem] bg-white/[0.05] border border-white/10 text-white font-bold px-[1.5rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/[0.1] transition-colors">
            <svg class="w-[1.2rem] h-[1.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Gallery Image
        </a>
        <a href="/admin/backup" class="inline-flex items-center gap-[0.5rem] bg-white/[0.05] border border-white/10 text-white font-bold px-[1.5rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/[0.1] transition-colors">
            <svg class="w-[1.2rem] h-[1.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Database Backups
        </a>
    </div>
</div>
