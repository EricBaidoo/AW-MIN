<?php
/**
 * Volunteer Page
 */
require_once __DIR__ . '/../../includes/config.php';

$departments = [
    'Women\'s Ministry',
    'Youth & Kids Ministry',
    'Worship & Arts',
    'Media & Production',
    'Guest Services / Ushers',
    'Outreach & Missions'
];
?>
<div class="min-h-screen">
    <!-- Cinematic Hero -->
    <section class="relative h-[65vh] min-h-[32rem] flex items-center justify-center overflow-hidden text-center">
        <div class="absolute inset-0 z-0">
            <img src="/images/backgrounds/volunteer-bg.png" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[rgba(6,14,42,0.85)] to-[#0a0a0a] z-[1]"></div>
        </div>
        <div class="relative z-10 text-white max-w-[50rem] px-[2rem] pt-[5rem]">
            <h1 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black mb-[1rem] leading-[1.1]">Join the Team</h1>
            <p class="text-[clamp(1.1rem,2vw,1.35rem)] text-white/80">Use your God-given gifts to serve the house and impact our community.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="relative z-20 -mt-[4rem] rounded-t-[2.5rem] shadow-[0_-1.25rem_3.125rem_rgba(0,0,0,0.5)] bg-primary-900 py-[6rem] lg:py-[8rem] overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-[-10%] w-[50vw] h-[50vw] bg-accent-500/10 rounded-full blur-[7.5rem] pointer-events-none"></div>
        <div class="container max-w-[60rem] px-[2rem] relative z-10 mx-auto">
            
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[2.5rem] font-bold text-white mb-[1.5rem]">Volunteer Sign-Up</h2>
                <p class="text-[1.1rem] text-white/70">We are always looking for passionate individuals to serve. Please fill out the form below and a ministry leader will be in touch with you shortly.</p>
            </div>

            <!-- Volunteer Form -->
            <div class="scroll-reveal-right opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out" style="transition-delay: 200ms;">
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 p-[2.5rem] sm:p-[3.5rem] rounded-[1.5rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.3)]">
                    <form action="/api/volunteer" method="POST" class="flex flex-col gap-[1.5rem]">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[1.5rem]">
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">First Name</label>
                                <input type="text" name="first_name" placeholder="First Name" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Last Name</label>
                                <input type="text" name="last_name" placeholder="Last Name" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-[1.5rem]">
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Email Address</label>
                                <input type="email" name="email" placeholder="Your email" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Phone Number</label>
                                <input type="tel" name="phone" placeholder="Your phone number" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Area of Interest</label>
                            <select name="department" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300 [&>option]:bg-primary-900" required>
                                <option value="" disabled selected>Select a ministry department...</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= htmlspecialchars($dept) ?>"><?= htmlspecialchars($dept) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Additional Information or Questions</label>
                            <textarea name="message" rows="4" placeholder="Tell us a bit about your experience or why you'd like to serve..." class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300 resize-y"></textarea>
                        </div>
                        <button type="submit" class="w-full mt-[1rem] px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-white hover:text-accent-600 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.2)]">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
