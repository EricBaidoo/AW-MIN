<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/upload.php';
$pdo = getDbConnection();

$id = $_GET['id'] ?? null;
$event = null;
$error = '';
$success = '';

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM events WHERE id = ?');
    $stmt->execute([$id]);
    $event = $stmt->fetch();
    if (!$event) {
        die("Event not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $location = $_POST['location'] ?? '';
    $description = $_POST['description'] ?? '';
    $recurring = isset($_POST['recurring']) ? 1 : 0;
    $image = $_POST['existing_image'] ?? '';

    // Handle file upload if present
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedUrl = handleImageUpload($_FILES['image_file']);
        if ($uploadedUrl) {
            $image = $uploadedUrl;
        } else {
            $error = "File upload failed. Ensure it is a valid image (JPG/PNG) under 5MB.";
        }
    }
    
    // Fallback to URL input if no file uploaded
    if (empty($image) && !empty($_POST['image'])) {
        $image = trim($_POST['image']);
    }

    if (empty($error)) {
        if (empty($title) || empty($date)) {
            $error = "Title and Date are required.";
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE events SET title=?, date=?, time=?, location=?, description=?, recurring=?, image=? WHERE id=?');
                $stmt->execute([$title, $date, $time, $location, $description, $recurring, $image, $id]);
                $success = "Event updated successfully.";
                $event = $_POST;
                $event['image'] = $image;
                $event['recurring'] = $recurring;
                $event['id'] = $id;
            } else {
                $stmt = $pdo->prepare('INSERT INTO events (title, date, time, location, description, recurring, image) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$title, $date, $time, $location, $description, $recurring, $image]);
                $id = $pdo->lastInsertId();
                $success = "Event created successfully.";
                $event = $_POST;
                $event['image'] = $image;
                $event['recurring'] = $recurring;
                $event['id'] = $id;
            }
        }
    }
}
?>

<div class="mb-[2rem]">
    <a href="/admin/events" class="text-white/50 hover:text-white transition-colors">&larr; Back to Events</a>
</div>

<div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1rem] p-[2rem]">
    
    <?php if ($error): ?>
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem]"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="space-y-[1.5rem]">
        
        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($event['image'] ?? '') ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Title *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($event['title'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Date * (e.g., Oct 24)</label>
                <input type="text" name="date" required value="<?= htmlspecialchars($event['date'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[1.5rem]">
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Time (e.g., 7:00 PM)</label>
                <input type="text" name="time" value="<?= htmlspecialchars($event['time'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($event['location'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Description</label>
            <textarea name="description" rows="3" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Upload Event Image</label>
            <input type="file" name="image_file" accept="image/jpeg, image/png, image/webp" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-500 file:text-primary-950 hover:file:bg-white cursor-pointer">
            
            <?php if (!empty($event['image'])): ?>
                <div class="mt-[1rem]">
                    <p class="text-white/50 text-[0.85rem] mb-[0.5rem]">Current Image:</p>
                    <img src="<?= htmlspecialchars($event['image']) ?>" class="h-[10rem] object-cover rounded-[0.5rem]">
                </div>
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Or Provide Image URL</label>
            <input type="text" name="image" value="<?= htmlspecialchars($event['image'] ?? '') ?>" class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            <p class="text-[0.75rem] text-white/40 mt-[0.25rem]">Only use this if you are not uploading a file.</p>
        </div>

        <div>
            <label class="flex items-center gap-[0.75rem] cursor-pointer">
                <input type="checkbox" name="recurring" value="1" <?= (!empty($event['recurring']) && $event['recurring'] == 1) ? 'checked' : '' ?> class="w-[1.25rem] h-[1.25rem] bg-primary-900/50 border border-white/10 rounded focus:ring-accent-500">
                <span class="text-[0.9rem] text-white/90">This is a recurring event</span>
            </label>
        </div>

        <div class="pt-[1rem]">
            <button type="submit" class="bg-accent-500 hover:bg-white text-primary-950 font-bold px-[2rem] py-[0.75rem] rounded-[0.5rem] transition-colors">
                <?= $id ? 'Update Event' : 'Create Event' ?>
            </button>
        </div>
    </form>
</div>
