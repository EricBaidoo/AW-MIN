<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/upload.php';
$pdo = getDbConnection();

$id = $_GET['id'] ?? null;
$slide = null;
$error = '';
$success = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM hero_slides WHERE id = ?');
    $stmt->execute([$id]);
    $slide = $stmt->fetch();
    if (!$slide) {
        die("Slide not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_small = $_POST['title_small'] ?? '';
    $title_main = $_POST['title_main'] ?? '';
    $button_1_text = $_POST['button_1_text'] ?? '';
    $button_1_link = $_POST['button_1_link'] ?? '';
    $button_2_text = $_POST['button_2_text'] ?? '';
    $button_2_link = $_POST['button_2_link'] ?? '';
    $order_index = (int)($_POST['order_index'] ?? 0);
    $background_media = $_POST['existing_background_media'] ?? '';

    // Handle file upload if present
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedUrl = handleImageUpload($_FILES['image_file']);
        if ($uploadedUrl) {
            $background_media = $uploadedUrl;
        } else {
            $error = "File upload failed. Ensure it is a valid image (JPG/PNG) under 5MB.";
        }
    }
    
    // Fallback to URL input if no file uploaded
    if (empty($background_media) && !empty($_POST['background_media'])) {
        $background_media = trim($_POST['background_media']);
    }

    if (empty($error)) {
        if (empty($title_main)) {
            $error = "Main Title is required.";
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE hero_slides SET title_small=?, title_main=?, button_1_text=?, button_1_link=?, button_2_text=?, button_2_link=?, background_media=?, order_index=? WHERE id=?');
                $stmt->execute([$title_small, $title_main, $button_1_text, $button_1_link, $button_2_text, $button_2_link, $background_media, $order_index, $id]);
                $success = "Slide updated successfully.";
                $slide = $_POST;
                $slide['background_media'] = $background_media;
                $slide['id'] = $id;
            } else {
                $stmt = $pdo->prepare('INSERT INTO hero_slides (title_small, title_main, button_1_text, button_1_link, button_2_text, button_2_link, background_media, order_index) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$title_small, $title_main, $button_1_text, $button_1_link, $button_2_text, $button_2_link, $background_media, $order_index]);
                $id = $pdo->lastInsertId();
                $success = "Slide created successfully.";
                $slide = $_POST;
                $slide['background_media'] = $background_media;
                $slide['id'] = $id;
            }
        }
    }
}
?>

<div class="mb-[2rem]">
    <a href="/admin/hero" class="text-white/50 hover:text-white transition-colors">&larr; Back to Hero Slides</a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[2rem]">
    
    <?php if ($error): ?>
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-[1.5rem]">
        
        <input type="hidden" name="existing_background_media" value="<?= htmlspecialchars($slide['background_media'] ?? '') ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Small Title (e.g. Welcome To)</label>
                <input type="text" name="title_small" value="<?= htmlspecialchars($slide['title_small'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Order Index (Lowest shows first)</label>
                <input type="number" name="order_index" value="<?= htmlspecialchars($slide['order_index'] ?? '0') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Main Title * (Supports HTML like &lt;br/&gt;)</label>
            <input type="text" name="title_main" required value="<?= htmlspecialchars($slide['title_main'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
        </div>
        
        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Upload Background Image</label>
            <input type="file" name="image_file" accept="image/jpeg, image/png, image/webp" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-500 file:text-primary-950 hover:file:bg-white cursor-pointer">
            
            <?php if (!empty($slide['background_media'])): ?>
                <div class="mt-[1rem]">
                    <p class="text-white/50 text-[0.85rem] mb-[0.5rem]">Current Background:</p>
                    <img src="<?= htmlspecialchars($slide['background_media']) ?>" class="h-[10rem] object-cover rounded-[0.5rem]">
                </div>
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Or Provide Background URL (e.g. /videos/hero.mp4)</label>
            <input type="text" name="background_media" value="<?= htmlspecialchars($slide['background_media'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            <p class="text-[0.75rem] text-white/40 mt-[0.25rem]">Only use this if you are not uploading a file or if you are using a video.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem] border-t border-white/10 pt-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-accent-500 mb-[0.5rem]">Primary Button Text</label>
                <input type="text" name="button_1_text" value="<?= htmlspecialchars($slide['button_1_text'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-accent-500 mb-[0.5rem]">Primary Button Link</label>
                <input type="text" name="button_1_link" value="<?= htmlspecialchars($slide['button_1_link'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Secondary Button Text</label>
                <input type="text" name="button_2_text" value="<?= htmlspecialchars($slide['button_2_text'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Secondary Button Link</label>
                <input type="text" name="button_2_link" value="<?= htmlspecialchars($slide['button_2_link'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div class="pt-[1rem]">
            <button type="submit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[2rem] py-[0.75rem] rounded-[0.5rem] transition-colors">
                <?= $id ? 'Update Slide' : 'Create Slide' ?>
            </button>
        </div>
    </form>
</div>
