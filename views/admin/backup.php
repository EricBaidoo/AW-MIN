<?php
$backupDir = __DIR__ . '/../../db/backups/';
$backups = [];

if (is_dir($backupDir)) {
    $files = scandir($backupDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && $file !== '.htaccess' && pathinfo($file, PATHINFO_EXTENSION) === 'sqlite') {
            $backups[] = [
                'name' => $file,
                'size' => round(filesize($backupDir . $file) / 1024, 2) . ' KB',
                'date' => filemtime($backupDir . $file)
            ];
        }
    }
}

// Sort newest first
usort($backups, function($a, $b) {
    return $b['date'] - $a['date'];
});
?>

<div class="flex items-center justify-between mb-[2rem]">
    <div>
        <h1 class="text-[2rem] font-bold text-white leading-tight">Database Backups</h1>
        <p class="text-white/50 text-[0.9rem] mt-[0.5rem]">Secure your data against catastrophic loss.</p>
    </div>
    <form method="POST" action="/admin/backup_create">
        <button type="submit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[1.5rem] py-[0.75rem] rounded-[0.5rem] transition-colors flex items-center gap-[0.5rem]">
            <svg class="w-[1.2rem] h-[1.2rem]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Create New Backup
        </button>
    </form>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Filename</th>
                <th class="p-[1rem] font-medium">Size</th>
                <th class="p-[1rem] font-medium">Date Created</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach ($backups as $backup): ?>
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="p-[1rem] text-white font-medium">
                    <?= htmlspecialchars($backup['name']) ?>
                </td>
                <td class="p-[1rem] text-white/60">
                    <?= $backup['size'] ?>
                </td>
                <td class="p-[1rem] text-white/50">
                    <?= date('M j, Y H:i:s', $backup['date']) ?>
                </td>
                <td class="p-[1rem] text-right">
                    <a href="/admin/backup_download?file=<?= urlencode($backup['name']) ?>" class="text-accent-500 hover:text-white transition-colors text-[0.85rem] uppercase tracking-wider font-bold">Download</a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($backups)): ?>
            <tr>
                <td colspan="4" class="p-[2rem] text-center text-white/50">No backups found. Click "Create New Backup" to secure your data.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-[2rem] bg-accent-500/10 border border-accent-500/20 p-[1.5rem] rounded-[1rem]">
    <h3 class="text-accent-500 font-bold mb-[0.5rem]">How Backups Work</h3>
    <p class="text-white/70 text-[0.9rem] leading-relaxed">
        Because this system uses a lightweight SQLite database, all of your content (Sermons, Events, Submissions, Settings) is stored in a single file. Creating a backup simply makes a secure copy of that file. It is highly recommended that you download a backup to your personal computer at least once a month to ensure you never lose your data.
    </p>
</div>
