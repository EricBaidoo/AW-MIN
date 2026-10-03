<?php
/**
 * Connect / Contact Page
 */
require_once __DIR__ . '/../../includes/config.php';
?>
<div class="min-h-screen">
    <!-- Cinematic Hero -->
    <section class="relative h-[65vh] min-h-[32rem] flex items-center justify-start overflow-hidden text-left">
        <div class="absolute inset-0 z-0">
            <img src="/images/backgrounds/connect-bg.jpg" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[rgba(6,14,42,0.85)] to-[#0a0a0a] z-[1]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-[rgba(6,14,42,0.5)] to-transparent z-[1]"></div>
        </div>
        <div class="relative z-10 text-white max-w-[60rem] px-[clamp(2rem,5vw,6rem)] pt-[5rem]">
            <h1 class="font-serif text-[clamp(2.5rem,5vw,4.5rem)] font-black mb-[1rem] leading-[1.1]">Contact Us</h1>
            <p class="text-[clamp(1.1rem,2vw,1.35rem)] text-white/80 max-w-[40rem]">Have questions or need assistance? Reach out to our team. We are here to serve you.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="relative z-20 -mt-[4rem] rounded-t-[2.5rem] shadow-[0_-1.25rem_3.125rem_rgba(0,0,0,0.5)] bg-primary-900 py-[6rem] lg:py-[8rem] overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-[-10%] w-[50vw] h-[50vw] bg-accent-500/10 rounded-full blur-[7.5rem] pointer-events-none"></div>
        <div class="container max-w-[75rem] px-[2rem] relative z-10 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[4rem] xl:gap-[6rem]">
                
                <!-- Left Column: Info -->
                <div class="flex flex-col">
                    <div class="mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                        <h3 class="font-serif text-[2rem] text-white font-bold mb-[2rem] pb-[1rem] border-b border-white/10">Service Times</h3>
                        <div class="flex flex-col gap-[1.5rem]">
                            <?php
                            $serviceTimes = [
                                ['name' => 'Sunday Worship Service', 'detail' => '11:00 AM'],
                                ['name' => 'Tuesday Prayer Conference Call', 'detail' => '(605) 472-5528 (Password: 247705)'],
                                ['name' => 'Thursday Bible Study', 'detail' => '7:00 PM via Zoom'],
                                ['name' => 'Friday Intercessory Prayer', 'detail' => '(605) 472-5528 (Password: 247705)'],
                            ];
                            foreach ($serviceTimes as $st): ?>
                            <div class="flex gap-[1.25rem] items-start group">
                                <div class="w-[3rem] h-[3rem] bg-white/[0.03] border border-white/10 rounded-full flex items-center justify-center shrink-0 group-hover:bg-accent-500/10 group-hover:border-accent-500/30 transition-all duration-300">
                                    <svg class="w-[1.4rem] h-[1.4rem] text-accent-400 fill-current" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-[1.1rem] mb-[0.25rem] group-hover:text-accent-400 transition-colors"><?= htmlspecialchars($st['name']) ?></h4>
                                    <p class="text-white/60"><?= htmlspecialchars($st['detail']) ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out" style="transition-delay: 150ms;">
                        <h3 class="font-serif text-[2rem] text-white font-bold mb-[2rem] pb-[1rem] border-b border-white/10">Office Details</h3>
                        <div class="flex flex-col gap-[2rem]">
                            <div class="flex gap-[1.25rem] items-start">
                                <div class="w-[3rem] h-[3rem] bg-white/[0.03] border border-white/10 rounded-full flex items-center justify-center shrink-0"><svg class="w-[1.4rem] h-[1.4rem] text-accent-400 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"/></svg></div>
                                <div><h4 class="font-bold text-[1.1rem] text-white mb-[0.25rem]">Main Campus</h4><p class="text-[0.95rem] text-white/60 leading-relaxed"><?= htmlspecialchars($siteConfig['address']) ?></p></div>
                            </div>
                            <div class="flex gap-[1.25rem] items-start">
                                <div class="w-[3rem] h-[3rem] bg-white/[0.03] border border-white/10 rounded-full flex items-center justify-center shrink-0"><svg class="w-[1.4rem] h-[1.4rem] text-accent-400 fill-current" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></div>
                                <div><h4 class="font-bold text-[1.1rem] text-white mb-[0.25rem]">Phone Number</h4><p class="text-[0.95rem] font-semibold"><a href="tel:<?= preg_replace('/[^\d]/', '', $siteConfig['phone']) ?>" class="text-accent-400 hover:text-white transition-colors"><?= htmlspecialchars($siteConfig['phone']) ?></a></p></div>
                            </div>
                            <div class="flex gap-[1.25rem] items-start">
                                <div class="w-[3rem] h-[3rem] bg-white/[0.03] border border-white/10 rounded-full flex items-center justify-center shrink-0"><svg class="w-[1.4rem] h-[1.4rem] text-accent-400 fill-current" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
                                <div><h4 class="font-bold text-[1.1rem] text-white mb-[0.25rem]">General Email</h4><p class="text-[0.95rem] font-semibold"><a href="mailto:<?= htmlspecialchars($siteConfig['email']) ?>" class="text-accent-400 hover:text-white transition-colors"><?= htmlspecialchars($siteConfig['email']) ?></a></p></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contact Form -->
                <div class="self-start lg:sticky lg:top-[8rem] scroll-reveal-right opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out" style="transition-delay: 300ms;">
                    <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 p-[2.5rem] sm:p-[3.5rem] rounded-[1.5rem] shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.3)]">
                        <div class="mb-[2.5rem]">
                            <h3 class="font-serif text-[2rem] text-white font-bold mb-[0.5rem]">Send a Message</h3>
                            <p class="text-[1rem] text-white/60">We would love to hear from you.</p>
                        </div>
                        <form action="/api/contact" method="POST" class="flex flex-col gap-[1.5rem]">
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Full Name</label>
                                <input type="text" name="name" placeholder="Your name" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Email Address</label>
                                <input type="email" name="email" placeholder="Your email" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Subject</label>
                                <input type="text" name="subject" placeholder="How can we help?" class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-bold text-[0.85rem] mb-[0.5rem] text-white/80">Message</label>
                                <textarea name="message" rows="5" placeholder="Write your message here..." class="w-full p-[1rem] bg-white/[0.05] border border-white/20 text-white placeholder-white/30 rounded-[0.5rem] focus:outline-none focus:border-accent-500/50 focus:bg-white/[0.08] transition-all duration-300 resize-y" required></textarea>
                            </div>
                            <button type="submit" class="w-full mt-[1rem] px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-white hover:text-accent-600 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.2)]">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
