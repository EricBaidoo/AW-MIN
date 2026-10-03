<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Admin Dashboard') ?> - AWM CMS</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body class="bg-primary-950 text-white font-sans min-h-screen flex bg-gradient-to-br from-primary-950 via-[#0a1526] to-primary-950">

    <!-- Sidebar -->
    <aside class="w-[16rem] flex-shrink-0 bg-primary-900/50 border-r border-white/10 flex flex-col">
        <div class="p-[1.5rem] border-b border-white/10">
            <h1 class="font-serif font-black text-[1.25rem] uppercase tracking-tighter text-white">
                AWM <span class="text-accent-500">Admin</span>
            </h1>
        </div>
        
        <nav class="flex-1 py-[1.5rem] px-[1rem] flex flex-col gap-[0.5rem]">
            <a href="/admin" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= $admin_page === 'dashboard.php' ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Dashboard
            </a>
            <a href="/admin/sermons" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= strpos($admin_page, 'sermons') === 0 ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Sermons
            </a>
            <a href="/admin/events" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= strpos($admin_page, 'events') === 0 ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Events
            </a>
            <a href="/admin/hero" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= strpos($admin_page, 'hero') === 0 ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Hero Slides
            </a>
            <a href="/admin/gallery" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= strpos($admin_page, 'gallery') === 0 ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Gallery
            </a>
            <a href="/admin/submissions" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors <?= strpos($admin_page, 'submissions') === 0 ? 'bg-white/10 text-accent-500 font-bold' : 'text-white/80' ?>">
                Submissions
            </a>
            
            <a href="/" target="_blank" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-white/5 transition-colors text-white/50 mt-auto">
                View Live Site &#8599;
            </a>
            <a href="/admin/logout" class="px-[1rem] py-[0.75rem] rounded-[0.5rem] hover:bg-red-500/20 hover:text-red-400 transition-colors text-white/50">
                Log Out
            </a>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <!-- Topbar -->
        <header class="h-[4.5rem] flex-shrink-0 bg-primary-900/30 border-b border-white/10 flex items-center px-[2rem] justify-between">
            <h2 class="font-serif text-[1.25rem] font-bold text-white tracking-wide">
                <?= htmlspecialchars($page_title ?? 'Dashboard') ?>
            </h2>
            <div class="flex items-center gap-[1rem]">
                <span class="text-white/60 text-[0.875rem]">Logged in as <strong class="text-white">Admin</strong></span>
            </div>
        </header>

        <!-- Content -->
        <div class="p-[2rem] flex-1">
            <?php require_once $view_path; ?>
        </div>
    </main>

</body>
</html>
