<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title ?? 'Anointed Word Ministries'); ?> | AWM</title>
    <meta name="description" content="<?php echo htmlspecialchars($siteConfig['description'] ?? ''); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/brand/logo.png">
    
    <!-- Tailwind CSS (Compiled) -->
    <link href="/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    
    <!-- Google Fonts for Web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-primary-950 text-white selection:bg-accent-500/30">
    
    <!-- Navbar Component -->
    <?php require_once __DIR__ . '/../components/navbar.php'; ?>

    <!-- Main Content injected by Front Controller -->
    <main>
        <?php 
            // $view_path is set in public/index.php
            if (isset($view_path) && file_exists($view_path)) {
                require_once $view_path;
            }
        ?>
    </main>

    <!-- Footer Component -->
    <?php require_once __DIR__ . '/../components/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const classes = Array.from(entry.target.classList);
                        const translateClasses = classes.filter(c => c.startsWith('translate-y-') || c.startsWith('translate-x-') || c.startsWith('-translate-x-') || c.startsWith('-translate-y-'));
                        entry.target.classList.remove('opacity-0', ...translateClasses);
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('[class*="scroll-reveal-"]').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
