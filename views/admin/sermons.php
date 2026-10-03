<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$sermons = $pdo->query('SELECT * FROM sermons ORDER BY date DESC')->fetchAll();
?>
<div class="flex items-center justify-between mb-[2rem]">
    <h3 class="text-[1.25rem] font-bold text-white">All Sermons</h3>
    <a href="/admin/sermons_edit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[1rem] py-[0.5rem] rounded-[0.5rem] transition-colors">
        + Add New
    </a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Title</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Speaker</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Date</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach($sermons as $sermon): ?>
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="p-[1rem] text-white font-medium">
                    <?= htmlspecialchars($sermon['title']) ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell">
                    <?= htmlspecialchars($sermon['speaker'] ?? '') ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell">
                    <?= htmlspecialchars($sermon['date']) ?>
                </td>
                <td class="p-[1rem] text-right">
                    <a href="/admin/sermons_edit?id=<?= $sermon['id'] ?>" class="text-accent-500 hover:text-white transition-colors mr-[1rem]">Edit</a>
                    <form method="POST" action="/admin/sermons_delete" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this sermon?');">
                        <input type="hidden" name="id" value="<?= $sermon['id'] ?>">
                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($sermons)): ?>
            <tr>
                <td colspan="4" class="p-[2rem] text-center text-white/50">No sermons found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
