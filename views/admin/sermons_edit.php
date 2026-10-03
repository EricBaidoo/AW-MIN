<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/upload.php';
$pdo = getDbConnection();

$id = $_GET['id'] ?? null;
$sermon = null;
$error = '';
$success = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM sermons WHERE id = ?');
    $stmt->execute([$id]);
    $sermon = $stmt->fetch();
    if (!$sermon) {
        die("Sermon not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $speaker = $_POST['speaker'] ?? '';
    $date = $_POST['date'] ?? '';
    $description = $_POST['description'] ?? '';
    $videoUrl = $_POST['videoUrl'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $thumbnail = $_POST['existing_thumbnail'] ?? '';

    // Handle file upload if present
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedUrl = handleImageUpload($_FILES['image_file']);
        if ($uploadedUrl) {
            $thumbnail = $uploadedUrl;
        } else {
            $error = "File upload failed. Ensure it is a valid image (JPG/PNG) under 5MB.";
        }
    }
    
    // Fallback to URL input if no file uploaded
    if (empty($thumbnail) && !empty($_POST['thumbnail'])) {
        $thumbnail = trim($_POST['thumbnail']);
    }

    if (empty($error)) {
        if (empty($title) || empty($date)) {
            $error = "Title and Date are required.";
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE sermons SET title=?, speaker=?, date=?, description=?, thumbnail=?, videoUrl=?, tags=? WHERE id=?');
                $stmt->execute([$title, $speaker, $date, $description, $thumbnail, $videoUrl, $tags, $id]);
                $success = "Sermon updated successfully.";
                $sermon = $_POST; // update local var for form
                $sermon['thumbnail'] = $thumbnail;
                $sermon['id'] = $id;
            } else {
                $stmt = $pdo->prepare('INSERT INTO sermons (title, speaker, date, description, thumbnail, videoUrl, tags) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$title, $speaker, $date, $description, $thumbnail, $videoUrl, $tags]);
                $id = $pdo->lastInsertId();
                $success = "Sermon created successfully.";
                $sermon = $_POST;
                $sermon['thumbnail'] = $thumbnail;
                $sermon['id'] = $id;
            }
        }
    }
}
?>

<div class="mb-[2rem]">
    <a href="/admin/sermons" class="text-white/50 hover:text-white transition-colors">&larr; Back to Sermons</a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[2rem]">
    
    <?php if ($error): ?>
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-[1.5rem]">
        
        <input type="hidden" name="existing_thumbnail" value="<?= htmlspecialchars($sermon['thumbnail'] ?? '') ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Title *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($sermon['title'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Date * (e.g., Oct 24, 2023)</label>
                <input type="text" name="date" required value="<?= htmlspecialchars($sermon['date'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Speaker</label>
                <input type="text" name="speaker" value="<?= htmlspecialchars($sermon['speaker'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Tags (comma separated)</label>
                <input type="text" name="tags" value="<?= htmlspecialchars($sermon['tags'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Description</label>
            <textarea name="description" rows="4" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors"><?= htmlspecialchars($sermon['description'] ?? '') ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Upload Thumbnail Image</label>
                <input type="file" name="image_file" accept="image/jpeg, image/png, image/webp" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-500 file:text-primary-950 hover:file:bg-white cursor-pointer">
                
                <?php if (!empty($sermon['thumbnail'])): ?>
                    <div class="mt-[1rem]">
                        <p class="text-white/50 text-[0.85rem] mb-[0.5rem]">Current Thumbnail:</p>
                        <img src="<?= htmlspecialchars($sermon['thumbnail']) ?>" class="h-[10rem] object-cover rounded-[0.5rem]">
                    </div>
                <?php endif; ?>
                
                <div class="mt-[1rem]">
                    <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Or Provide Thumbnail URL</label>
                    <input type="text" name="thumbnail" value="<?= htmlspecialchars($sermon['thumbnail'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
                    <p class="text-[0.75rem] text-white/40 mt-[0.25rem]">Only use this if you are not uploading a file.</p>
                </div>
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Video URL (YouTube/MP4)</label>
                <input type="text" name="videoUrl" value="<?= htmlspecialchars($sermon['videoUrl'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div class="pt-[1rem]">
            <button type="submit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[2rem] py-[0.75rem] rounded-[0.5rem] transition-colors">
                <?= $id ? 'Update Sermon' : 'Create Sermon' ?>
            </button>
        </div>
    </form>
</div>
