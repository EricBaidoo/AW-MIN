<?php
/**
 * Visit Page
 */
require_once __DIR__ . '/../../includes/config.php';

require_once __DIR__ . '/../../includes/db.php';

$db = getDbConnection();
$stmt = $db->query("SELECT * FROM visit_expectations ORDER BY order_index ASC");
$expectCards = $stmt->fetchAll();
?>
<div class="min-h-screen bg-primary-100">
    <!-- Hero -->
    <section class="relative h-[60vh] md:h-[65vh] min-h-[30rem] md:min-h-[35rem] flex items-center justify-start overflow-hidden text-left pt-[3rem] md:pt-[5rem]">
        <div class="absolute inset-0 z-0">
            <img src="/images/backgrounds/visit-bg.jpg" alt="Background" class="object-cover object-center w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[rgba(6,14,42,0.85)] to-[#0a0a0a]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-[rgba(6,14,42,0.5)] to-transparent"></div>
        </div>
        <div class="relative z-[2] text-white w-full max-w-[60rem] px-[clamp(2rem,5vw,6rem)]">
            <h1 class="font-serif text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-[1rem] leading-[1.1]">Welcome Home</h1>
            <p class="text-[clamp(1.1rem,2vw,1.35rem)] text-white/80 mb-[2.5rem] max-w-[40rem]">Plan your visit today and we will ensure you feel the love of Christ from the moment you pull into the parking lot.</p>
            <a href="#plan-visit" class="inline-flex items-center justify-center px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-white hover:text-accent-600 hover:scale-105 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.3)]">Schedule My Visit</a>
        </div>
    </section>

    <!-- What to Expect -->
    <section class="py-[4rem] md:py-[6rem] lg:py-[8rem] bg-primary-900 relative overflow-hidden scroll-reveal-section">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[60vw] h-[60vw] bg-primary-900/20 rounded-full blur-[9.375rem] pointer-events-none"></div>
        <div class="container max-w-[80rem] relative z-10 px-[2rem] mx-auto">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[clamp(2.5rem,5vw,3.5rem)] font-black text-white mb-[1rem] leading-tight">What To Expect</h2>
                <p class="text-[1.15rem] text-white/70 max-w-[40rem] mx-auto font-light">We know visiting a new church can be intimidating. Here is a quick guide to make you feel right at home.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[2rem]">
                <?php foreach ($expectCards as $i => $card): ?>
                <div class="bg-white/[0.03] backdrop-blur-md p-[3rem_2rem] text-center border border-white/10 rounded-[1rem] shadow-lg hover:shadow-[0_1.25rem_3.125rem_rgba(255,106,0,0.1)] hover:-translate-y-2 hover:bg-white/[0.06] hover:border-accent-500/30 transition-all duration-500 h-full scroll-reveal-right opacity-0 translate-y-[4rem]" style="transition-delay: <?= $i * 150 ?>ms;">
                    <div class="w-[5rem] h-[5rem] rounded-full bg-white/5 flex items-center justify-center mx-auto mb-[2rem] border border-white/10 shadow-inner">
                        <span class="text-[2.2rem]"><?= $card['icon'] ?></span>
                    </div>
                    <h3 class="font-serif text-white text-[1.4rem] font-bold mb-[1rem]"><?= htmlspecialchars($card['title']) ?></h3>
                    <p class="text-[0.95rem] text-white/60 leading-[1.7]"><?= htmlspecialchars($card['desc']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Plan Your Visit Form -->
    <section id="plan-visit" class="py-[4rem] md:py-[6rem] lg:py-[8rem] relative bg-primary-100 overflow-hidden scroll-reveal-section">
        <div class="absolute -left-[20rem] top-[10rem] w-[40rem] h-[40rem] bg-accent-500/5 rounded-full blur-[6.25rem] pointer-events-none"></div>
        <div class="container max-w-[50rem] mx-auto px-[2rem] relative z-10 scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
            <div class="text-center mb-[3rem]">
                <h2 class="font-serif text-[clamp(2rem,4vw,3rem)] font-black text-primary-900 mb-[1rem]">Let's Plan Your Visit</h2>
                <p class="text-[1.1rem] text-primary-700">We want to roll out the red carpet for you.</p>
            </div>
            <div class="bg-white/70 backdrop-blur-xl border border-white shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.05)] p-[2rem] md:p-[4rem] rounded-[1.5rem]">
                <form action="/api/visit" method="POST" class="flex flex-col gap-[1.5rem]">
                    <h3 class="font-serif font-bold text-[1.5rem] text-primary-900 mb-[0.5rem]">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[1.5rem]">
                        <div class="flex flex-col">
                            <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">First Name</label>
                            <input type="text" name="firstName" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors" required>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">Last Name</label>
                            <input type="text" name="lastName" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors" required>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">Email Address</label>
                        <input type="email" name="email" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">Phone Number</label>
                        <input type="tel" name="phone" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors" required>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[1.5rem]">
                        <div class="flex flex-col">
                            <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">Date of Visit</label>
                            <input type="date" name="date" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors" required>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[0.85rem] font-bold text-primary-900 uppercase tracking-wider mb-[0.5rem]">Service Time</label>
                            <select name="time" class="w-full p-[1rem] border border-black/10 rounded-[0.5rem] bg-white/80 focus:outline-none focus:border-accent-500 transition-colors">
                                <option value="11:00 AM">Sunday 11:00 AM</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-[1rem] px-[3rem] py-[1.25rem] bg-accent-500 text-white font-bold uppercase tracking-[0.15em] text-[0.9rem] hover:bg-primary-900 transition-all duration-300 shadow-[0_0.625rem_1.875rem_rgba(255,106,0,0.2)]">Confirm My Visit</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Location & Map -->
    <section class="py-[4rem] md:py-[6rem] lg:py-[8rem] bg-primary-950 relative overflow-hidden scroll-reveal-section">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60vw] h-[60vw] bg-accent-500/10 rounded-full blur-[9.375rem] z-0 pointer-events-none"></div>
        <div class="container relative z-10 px-[2rem] mx-auto">
            <div class="text-center mb-[4rem] scroll-reveal-left opacity-0 translate-y-[2rem] transition-all duration-1000 ease-out">
                <h2 class="font-serif text-[clamp(2.5rem,5vw,3.5rem)] font-black text-white mb-[1rem] leading-tight">Service Location</h2>
                <p class="text-[1.1rem] text-white/70 max-w-[40rem] mx-auto font-light">We are conveniently located in Wilmington, Delaware. We can't wait to worship with you this Sunday!</p>
            </div>
            <div class="grid lg:grid-cols-12 gap-[3rem] items-center">
                <div class="lg:col-span-4 flex flex-col gap-[2rem] scroll-reveal-left opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out">
                    <div class="bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] p-[2.5rem] hover:bg-white/[0.06] hover:border-accent-500/30 transition-colors duration-300">
                        <h3 class="font-serif text-[1.4rem] font-bold text-white mb-[0.5rem]">Main Campus</h3>
                        <p class="text-white/70 leading-relaxed mb-[1.5rem]">4727 Concord Pike<br>Wilmington, DE 19803</p>
                        <a href="https://maps.google.com/?q=4727+Concord+Pike,+Wilmington,+DE" target="_blank" class="text-accent-400 text-[0.9rem] font-bold hover:text-white transition-colors flex items-center gap-[0.5rem] uppercase tracking-[0.05em]">Get Directions →</a>
                    </div>
                    <div class="bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-[1rem] p-[2.5rem] hover:bg-white/[0.06] hover:border-accent-500/30 transition-colors duration-300">
                        <h3 class="font-serif text-[1.4rem] font-bold text-white mb-[0.5rem]">Contact Us</h3>
                        <p class="text-white/70 leading-relaxed">Call: <?= htmlspecialchars($siteConfig['phone']) ?><br>Email: <?= htmlspecialchars($siteConfig['email']) ?></p>
                    </div>
                </div>
                <div class="lg:col-span-8 h-full min-h-[30rem] md:min-h-[40rem] w-full relative rounded-[1.5rem] overflow-hidden border border-white/10 shadow-[0_1.25rem_3.125rem_rgba(0,0,0,0.5)] group scroll-reveal-right opacity-0 translate-y-[4rem] transition-all duration-1000 ease-out" style="transition-delay: 200ms;">
                    <iframe src="<?= htmlspecialchars($siteConfig['mapUrl']) ?>" width="100%" height="100%" class="absolute inset-0 border-0 w-full h-full grayscale group-hover:grayscale-0 transition-all duration-700" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Map showing Anointed Word Ministries location"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
