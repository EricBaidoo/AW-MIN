<?php
/**
 * Admin - Form Submissions
 */
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();

$filter = $_GET['type'] ?? '';
if ($filter) {
    $stmt = $pdo->prepare('SELECT * FROM form_submissions WHERE form_type = ? ORDER BY submitted_at DESC');
    $stmt->execute([$filter]);
} else {
    $stmt = $pdo->query('SELECT * FROM form_submissions ORDER BY submitted_at DESC');
}
$submissions = $stmt->fetchAll();
?>
<div class="flex items-center justify-between mb-[2rem]">
    <h3 class="text-[1.25rem] font-bold text-white">Form Submissions</h3>
    <div class="flex gap-[0.5rem]">
        <a href="/admin/submissions" class="px-[0.75rem] py-[0.375rem] rounded-[0.5rem] text-[0.8rem] font-bold uppercase tracking-wider transition-colors <?= !$filter ? 'bg-accent-500 text-primary-950' : 'bg-white/5 text-white/70 hover:bg-white/10' ?>">All</a>
        <a href="/admin/submissions?type=visit" class="px-[0.75rem] py-[0.375rem] rounded-[0.5rem] text-[0.8rem] font-bold uppercase tracking-wider transition-colors <?= $filter === 'visit' ? 'bg-accent-500 text-primary-950' : 'bg-white/5 text-white/70 hover:bg-white/10' ?>">Visits</a>
        <a href="/admin/submissions?type=contact" class="px-[0.75rem] py-[0.375rem] rounded-[0.5rem] text-[0.8rem] font-bold uppercase tracking-wider transition-colors <?= $filter === 'contact' ? 'bg-accent-500 text-primary-950' : 'bg-white/5 text-white/70 hover:bg-white/10' ?>">Contact</a>
        <a href="/admin/submissions?type=volunteer" class="px-[0.75rem] py-[0.375rem] rounded-[0.5rem] text-[0.8rem] font-bold uppercase tracking-wider transition-colors <?= $filter === 'volunteer' ? 'bg-accent-500 text-primary-950' : 'bg-white/5 text-white/70 hover:bg-white/10' ?>">Volunteer</a>
    </div>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Type</th>
                <th class="p-[1rem] font-medium">Name</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Email</th>
                <th class="p-[1rem] font-medium hidden lg:table-cell">Message</th>
                <th class="p-[1rem] font-medium">Date</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach ($submissions as $sub): ?>
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
                <td class="p-[1rem] text-white font-medium">
                    <?= htmlspecialchars($sub['first_name'] . ' ' . $sub['last_name']) ?>
                </td>
                <td class="p-[1rem] text-white/60 hidden md:table-cell">
                    <a href="mailto:<?= htmlspecialchars($sub['email']) ?>" class="text-accent-500 hover:text-white transition-colors"><?= htmlspecialchars($sub['email']) ?></a>
                </td>
                <td class="p-[1rem] text-white/50 hidden lg:table-cell max-w-[15rem] truncate">
                    <?= htmlspecialchars($sub['message'] ?: '-') ?>
                </td>
                <td class="p-[1rem] text-white/40 text-[0.85rem]">
                    <?= date('M j, Y', strtotime($sub['submitted_at'])) ?>
                </td>
                <td class="p-[1rem] text-right">
                    <form method="POST" action="/admin/submissions_delete" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                        <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors text-[0.85rem] uppercase tracking-wider font-bold">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($submissions)): ?>
            <tr>
                <td colspan="6" class="p-[2rem] text-center text-white/50">No submissions yet.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
