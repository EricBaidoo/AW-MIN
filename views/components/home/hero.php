<?php
/**
 * Hero Section - Dynamic Cinematic Parallax Slider
 */
require_once __DIR__ . '/../../../includes/db.php';
$pdo = getDbConnection();
$slides = $pdo->query('SELECT * FROM hero_slides ORDER BY order_index ASC')->fetchAll();

// If no slides exist in DB, fallback to a default array
if (empty($slides)) {
    $slides = [[
        'title_small' => 'Welcome To',
        'title_main' => 'The Anointed <br/> Word',
        'button_1_text' => 'Plan Your Visit',
        'button_1_link' => '/visit',
        'button_2_text' => 'Stream Live',
        'button_2_link' => '/sermons',
        'background_media' => '/videos/hero.mp4'
    ]];
}
?>
<section id="hero-slider" class="relative w-full h-[100svh] min-h-[31.25rem] md:min-h-[37.5rem] flex items-center justify-center overflow-hidden bg-primary-950">
    
    <?php foreach ($slides as $index => $slide): 
        $isVideo = str_ends_with(strtolower($slide['background_media']), '.mp4') || str_ends_with(strtolower($slide['background_media']), '.webm');
    ?>
    <!-- Slide <?php echo $index; ?> -->
    <div class="hero-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out z-0 <?php echo $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none'; ?>">
        
        <!-- Parallax Wrapper for Media -->
        <div class="absolute inset-0 w-full h-[120vh] -top-[10vh] z-0 pointer-events-none transform translate-y-[var(--scroll-y,0)] transition-transform duration-100 ease-linear hero-parallax">
            <?php if ($isVideo): ?>
                <video autoplay loop muted playsinline class="w-full h-full object-cover">
                    <source src="<?= htmlspecialchars($slide['background_media']) ?>" type="video/mp4">
                </video>
            <?php else: ?>
                <img src="<?= htmlspecialchars($slide['background_media']) ?>" class="w-full h-full object-cover" alt="Hero Background">
            <?php endif; ?>
        </div>
        
        <!-- Cinematic Vignette & Color Overlay -->
        <div class="absolute inset-0 bg-primary-900/40 mix-blend-multiply z-10"></div>
        <div class="absolute inset-0 vignette z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-950 via-primary-950/50 to-transparent z-10"></div>

        <div class="absolute inset-0 flex items-center justify-center z-20 text-center px-[1.25rem] md:px-[2rem]">
            <div class="w-full max-w-[90rem]">
                <div class="slide-content transform translate-y-[2rem] opacity-0 transition-all duration-1000 ease-out delay-300">
                    <?php if (!empty($slide['title_small'])): ?>
                    <span class="font-sans text-[0.875rem] sm:text-[1rem] md:text-[1.2rem] tracking-[0.25em] sm:tracking-[0.4em] uppercase text-accent-500 font-semibold mb-[1rem] sm:mb-[1.5rem] block drop-shadow-lg">
                        <?= htmlspecialchars($slide['title_small']) ?>
                    </span>
                    <?php endif; ?>
                    
                    <h1 class="font-serif text-[clamp(3rem,8vw,7.5rem)] font-black uppercase text-white leading-[1] tracking-tighter drop-shadow-2xl">
                        <?= $slide['title_main'] // Allow HTML for <br> ?>
                    </h1>
                </div>

                <div class="slide-buttons mt-[4rem] flex flex-col sm:flex-row items-center justify-center gap-[1.5rem] transform translate-y-[2rem] opacity-0 transition-all duration-1000 ease-out delay-500">
                    <?php if (!empty($slide['button_1_text'])): ?>
                    <a href="<?= htmlspecialchars($slide['button_1_link'] ?? '#') ?>" class="px-[3.5rem] py-[1.25rem] bg-accent-500 text-primary-950 font-serif text-[0.85rem] font-bold uppercase tracking-[0.25em] hover:bg-white hover:scale-105 transition-all duration-500 w-full sm:w-auto shadow-[0_0.625rem_1.875rem_rgba(255,215,0,0.3)]">
                        <?= htmlspecialchars($slide['button_1_text']) ?>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($slide['button_2_text'])): ?>
                    <a href="<?= htmlspecialchars($slide['button_2_link'] ?? '#') ?>" class="px-[3.5rem] py-[1.25rem] bg-glass-dark text-white font-serif text-[0.85rem] font-bold uppercase tracking-[0.25em] hover:bg-white hover:text-primary-950 transition-all duration-500 w-full sm:w-auto backdrop-blur-md">
                        <?= htmlspecialchars($slide['button_2_text']) ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Slider Controls (Dots) -->
    <?php if (count($slides) > 1): ?>
    <div class="absolute bottom-[2rem] left-0 right-0 z-30 flex justify-center gap-[0.75rem]">
        <?php foreach ($slides as $index => $slide): ?>
        <button class="slider-dot w-[3rem] h-[0.25rem] rounded-full transition-all duration-300 <?= $index === 0 ? 'bg-accent-500' : 'bg-white/30 hover:bg-white/50' ?>" data-index="<?= $index ?>" aria-label="Go to slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        const parallaxLayers = document.querySelectorAll('.hero-parallax');
        let currentSlide = 0;
        const totalSlides = slides.length;
        let slideInterval;

        // Initialize first slide animations
        setTimeout(() => triggerSlideAnimations(0), 100);

        function goToSlide(index) {
            if (index === currentSlide) return;
            
            // Fade out current
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0', 'pointer-events-none');
            resetSlideAnimations(currentSlide);
            if (dots.length > 0) {
                dots[currentSlide].classList.remove('bg-accent-500');
                dots[currentSlide].classList.add('bg-white/30');
            }

            // Fade in next
            currentSlide = index;
            slides[currentSlide].classList.remove('opacity-0', 'pointer-events-none');
            slides[currentSlide].classList.add('opacity-100');
            triggerSlideAnimations(currentSlide);
            if (dots.length > 0) {
                dots[currentSlide].classList.remove('bg-white/30');
                dots[currentSlide].classList.add('bg-accent-500');
            }
        }

        function triggerSlideAnimations(index) {
            const content = slides[index].querySelector('.slide-content');
            const buttons = slides[index].querySelector('.slide-buttons');
            
            if (content) {
                // Remove initial translate/opacity to let Tailwind transition handle it
                requestAnimationFrame(() => {
                    content.classList.remove('translate-y-[2rem]', 'opacity-0');
                });
            }
            if (buttons) {
                requestAnimationFrame(() => {
                    buttons.classList.remove('translate-y-[2rem]', 'opacity-0');
                });
            }
        }

        function resetSlideAnimations(index) {
            const content = slides[index].querySelector('.slide-content');
            const buttons = slides[index].querySelector('.slide-buttons');
            
            if (content) {
                content.classList.add('translate-y-[2rem]', 'opacity-0');
            }
            if (buttons) {
                buttons.classList.add('translate-y-[2rem]', 'opacity-0');
            }
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % totalSlides);
        }

        if (totalSlides > 1) {
            slideInterval = setInterval(nextSlide, 7000); // 7 second crossfade
            
            dots.forEach(dot => {
                dot.addEventListener('click', (e) => {
                    clearInterval(slideInterval);
                    goToSlide(parseInt(e.target.dataset.index));
                    slideInterval = setInterval(nextSlide, 7000); // Reset timer
                });
            });
        }

        // Parallax effect on scroll
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            if (scrolled < window.innerHeight) {
                parallaxLayers.forEach(layer => {
                    layer.style.setProperty('--scroll-y', `${scrolled * 0.4}px`);
                });
            }
        });
    });
</script>
