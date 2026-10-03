<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();
$images = $pdo->query('SELECT * FROM gallery_images ORDER BY order_index ASC')->fetchAll();
?>
<div class="flex items-center justify-between mb-[2rem]">
    <h3 class="text-[1.25rem] font-bold text-white">Gallery Images</h3>
    <a href="/admin/gallery_edit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[1rem] py-[0.5rem] rounded-[0.5rem] transition-colors">
        + Add Image
    </a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-primary-900/50 border-b border-white/10 text-white/70 uppercase tracking-widest text-[0.75rem]">
                <th class="p-[1rem] font-medium">Preview</th>
                <th class="p-[1rem] font-medium">Order</th>
                <th class="p-[1rem] font-medium hidden md:table-cell">Caption</th>
                <th class="p-[1rem] font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10 text-[0.9rem]">
            <?php foreach($images as $image): ?>
            <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="p-[1rem]">
                    <div class="w-[5rem] h-[3.5rem] rounded-[0.5rem] overflow-hidden bg-primary-900">
                        <img src="<?= htmlspecialchars($image['image_url']) ?>" alt="<?= htmlspecialchars($image['caption'] ?? 'Gallery image') ?>" class="w-full h-full object-cover">
                    </div>
                </td>
                <td class="p-[1rem] text-white/50 font-mono">
                    <?= htmlspecialchars($image['order_index']) ?>
                </td>
                <td class="p-[1rem] text-white/70 hidden md:table-cell max-w-[200px] truncate">
                    <?= htmlspecialchars($image['caption'] ?? '') ?>
                </td>
                <td class="p-[1rem] text-right">
                    <a href="/admin/gallery_edit?id=<?= $image['id'] ?>" class="text-accent-500 hover:text-white transition-colors mr-[1rem]">Edit</a>
                    <form method="POST" action="/admin/gallery_delete" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                        <input type="hidden" name="id" value="<?= $image['id'] ?>">
                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($images)): ?>
            <tr>
                <td colspan="4" class="p-[2rem] text-center text-white/50">No images in the gallery.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
