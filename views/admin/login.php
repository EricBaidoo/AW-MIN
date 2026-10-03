<?php
require_once __DIR__ . '/../../includes/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $pdo = getDbConnection();
    $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        // Prevent session fixation
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        global $base_path;
        header('Location: ' . $base_path . '/admin/dashboard');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AWM</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body class="bg-primary-950 text-white font-sans min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-[#0a1526] to-primary-950 -z-20"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[31.25rem] h-[31.25rem] bg-accent-500/10 rounded-full blur-[9.375rem] -z-10 pointer-events-none"></div>

    <div class="w-full max-w-md p-[2rem] bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-[1.5rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)]">
        <div class="text-center mb-[2rem]">
            <h1 class="font-serif font-black text-[2rem] uppercase tracking-tighter text-white">AWM <span class="text-accent-500">Admin</span></h1>
            <p class="text-white/60 text-[0.9rem] mt-[0.5rem]">Sign in to manage your content</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-[1rem] rounded-[0.5rem] mb-[1.5rem] text-center text-[0.9rem]">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-[1.5rem]">
            <div>
                <label for="username" class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Username</label>
                <input type="text" id="username" name="username" required class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <div>
                <label for="password" class="block text-[0.8rem] uppercase tracking-widest text-white/70 mb-[0.5rem]">Password</label>
                <input type="password" id="password" name="password" required class="w-full bg-primary-900/50 border border-white/10 rounded-[0.5rem] px-[1rem] py-[0.75rem] text-white focus:outline-none focus:border-accent-500 transition-colors">
            </div>
            <button type="submit" class="w-full bg-accent-500 hover:bg-white text-primary-950 font-bold uppercase tracking-widest py-[1rem] rounded-[0.5rem] transition-colors mt-[1rem]">
                Log In
            </button>
        </form>
    </div>
</body>
</html>
