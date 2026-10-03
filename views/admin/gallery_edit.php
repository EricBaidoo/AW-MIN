<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/upload.php';
$pdo = getDbConnection();

$id = $_GET['id'] ?? null;
$image = null;
$error = '';
$success = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM gallery_images WHERE id = ?');
    $stmt->execute([$id]);
    $image = $stmt->fetch();
    if (!$image) {
        die("Image not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    $order_index = (int)($_POST['order_index'] ?? 0);
    $image_url = $_POST['existing_image_url'] ?? '';

    // Handle file upload if present
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedUrl = handleImageUpload($_FILES['image_file']);
        if ($uploadedUrl) {
            $image_url = $uploadedUrl;
        } else {
            $error = "File upload failed. Ensure it is a valid image (JPG/PNG) under 5MB.";
        }
    }
    
    // Fallback to URL input if no file uploaded
    if (empty($image_url) && !empty($_POST['image_url'])) {
        $image_url = trim($_POST['image_url']);
    }
    
    if (empty($error)) {
        if (empty($image_url)) {
            $error = "An image file or URL is required.";
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE gallery_images SET image_url=?, caption=?, order_index=? WHERE id=?');
                $stmt->execute([$image_url, $caption, $order_index, $id]);
                $success = "Image updated successfully.";
                $image = $_POST;
                $image['image_url'] = $image_url;
                $image['id'] = $id;
            } else {
                $stmt = $pdo->prepare('INSERT INTO gallery_images (image_url, caption, order_index) VALUES (?, ?, ?)');
                $stmt->execute([$image_url, $caption, $order_index]);
                $id = $pdo->lastInsertId();
                $success = "Image created successfully.";
                $image = $_POST;
                $image['image_url'] = $image_url;
                $image['id'] = $id;
            }
        }
    }
}
?>

<div class="mb-[2rem]">
    <a href="/admin/gallery" class="text-white/50 hover:text-white transition-colors">&larr; Back to Gallery</a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[2rem]">
    
    <?php if ($error): ?>
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-[1.5rem]">
        
        <input type="hidden" name="existing_image_url" value="<?= htmlspecialchars($image['image_url'] ?? '') ?>">

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Upload Image File *</label>
            <input type="file" name="image_file" accept="image/jpeg, image/png, image/webp" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-500 file:text-primary-950 hover:file:bg-white cursor-pointer">
            
            <?php if (!empty($image['image_url'])): ?>
                <div class="mt-[1rem]">
                    <p class="text-white/50 text-[0.85rem] mb-[0.5rem]">Current Image:</p>
                    <img src="<?= htmlspecialchars($image['image_url']) ?>" class="h-[10rem] object-cover rounded-[0.5rem]">
                </div>
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Or Provide Image URL</label>
            <input type="text" name="image_url" placeholder="https://..." value="<?= htmlspecialchars($image['image_url'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            <p class="text-[0.75rem] text-white/40 mt-[0.25rem]">Only use this if you are not uploading a file.</p>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Caption</label>
            <input type="text" name="caption" value="<?= htmlspecialchars($image['caption'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Order Index</label>
            <input type="number" name="order_index" value="<?= htmlspecialchars($image['order_index'] ?? '0') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
        </div>

        <div class="pt-[1rem]">
            <button type="submit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[2rem] py-[0.75rem] rounded-[0.5rem] transition-colors">
                <?= $id ? 'Update Image' : 'Add Image' ?>
            </button>
        </div>
    </form>
</div>
