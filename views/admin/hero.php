<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$slides = $pdo->query('SELECT * FROM hero_slides ORDER BY order_index ASC')->fetchAll();
?>
<div class="flex items-center justify-between mb-[2rem]">
    <h3 class="text-[1.25rem] font-bold text-white">Hero Slides</h3>
    <a href="/admin/hero_edit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[1rem] py-[0.5rem] rounded-[0.5rem] transition-colors">
        + Add Slide
    </a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Order</th>
                <th class="p-[1rem] font-medium">Main Title</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Small Title</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Media</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach($slides as $slide): ?>
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="p-[1rem] text-white/50 font-mono">
                    <?= htmlspecialchars($slide['order_index']) ?>
                </td>
                <td class="p-[1rem] text-white font-bold text-[1.1rem]">
                    <?= strip_tags($slide['title_main']) ?>
                </td>
                <td class="p-[1rem] text-accent-500 tracking-[0.25em] uppercase text-[0.75rem] hidden md:table-cell">
                    <?= htmlspecialchars($slide['title_small']) ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell max-w-[200px] truncate">
                    <?= htmlspecialchars($slide['background_media']) ?>
                </td>
                <td class="p-[1rem] text-right">
                    <a href="/admin/hero_edit?id=<?= $slide['id'] ?>" class="text-accent-500 hover:text-white transition-colors mr-[1rem]">Edit</a>
                    <form method="POST" action="/admin/hero_delete" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                        <input type="hidden" name="id" value="<?= $slide['id'] ?>">
                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($slides)): ?>
            <tr>
                <td colspan="5" class="p-[2rem] text-center text-white/50">No slides found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
