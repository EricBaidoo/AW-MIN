<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$events = $pdo->query('SELECT * FROM events ORDER BY date ASC')->fetchAll();
?>
<div class="flex items-center justify-between mb-[2rem]">
    <h3 class="text-[1.25rem] font-bold text-white">All Events</h3>
    <a href="/admin/events_edit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[1rem] py-[0.5rem] rounded-[0.5rem] transition-colors">
        + Add New
    </a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Title</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Date & Time</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Location</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach($events as $event): ?>
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="p-[1rem] text-white font-medium">
                    <?= htmlspecialchars($event['title']) ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell">
                    <?= htmlspecialchars($event['date']) ?> <?= htmlspecialchars($event['time'] ? 'at '.$event['time'] : '') ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell">
                    <?= htmlspecialchars($event['location'] ?? 'TBD') ?>
                </td>
                <td class="p-[1rem] text-right">
                    <a href="/admin/events_edit?id=<?= $event['id'] ?>" class="text-accent-500 hover:text-white transition-colors mr-[1rem]">Edit</a>
                    <form method="POST" action="/admin/events_delete" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        <input type="hidden" name="id" value="<?= $event['id'] ?>">
                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($events)): ?>
            <tr>
                <td colspan="4" class="p-[2rem] text-center text-white/50">No events found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
