<?php
/**
 * Thank You Page
 */
$formType = $_GET['form'] ?? 'contact';

$messages = [
    'visit' => [
        'heading' => 'We Can't Wait to See You!',
        'body' => 'Your visit has been scheduled. Our hospitality team will be ready to welcome you with open arms. You should receive a confirmation email shortly.',
        'icon' => '🙏'
    ],
    'contact' => [
        'heading' => 'Message Received!',
        'body' => 'Thank you for reaching out. Our team will review your message and get back to you within 24-48 hours.',
        'icon' => '✉️'
    ],
    'volunteer' => [
        'heading' => 'Thank You for Serving!',
        'body' => 'Your heart to serve is a blessing. A ministry leader will follow up with you soon to help you find the perfect place to plug in.',
        'icon' => '💛'
    ],
];

$msg = $messages[$formType] ?? $messages['contact'];
?>
<div class="min-h-screen flex items-center justify-center px-[2rem] py-[8rem]">
    <div class="max-w-[35rem] text-center scroll-reveal-up opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
        
        <!-- Icon -->
        <div class="w-[6rem] h-[6rem] bg-accent-500/10 border border-accent-500/30 rounded-full flex items-center justify-center mx-auto mb-[2rem]">
            <span class="text-[2.5rem]"><?= $msg['icon'] ?></span>
        </div>

        <!-- Heading -->
        <h1 class="font-serif text-[clamp(2rem,5vw,3rem)] font-black text-white uppercase tracking-tighter leading-[1.1] mb-[1.5rem]">
            <?= htmlspecialchars($msg['heading']) ?>
        </h1>

        <!-- Body -->
        <p class="text-[1.1rem] text-white/70 leading-relaxed mb-[3rem]">
            <?= htmlspecialchars($msg['body']) ?>
        </p>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-[1rem]">
            <a href="/" class="px-[2rem] py-[1rem] bg-accent-500 hover:bg-white text-primary-950 font-bold uppercase tracking-widest text-[0.85rem] rounded-[0.5rem] transition-colors">
                Return Home
            </a>
            <a href="/sermons" class="px-[2rem] py-[1rem] bg-white/5 hover:bg-white/10 text-white font-bold uppercase tracking-widest text-[0.85rem] rounded-[0.5rem] transition-colors border border-white/10">
                Watch a Sermon
            </a>
        </div>
    </div>
</div>
