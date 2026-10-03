<?php
/**
 * Database Migration Script
 * Creates new tables and populates them with current hardcoded content.
 */

require_once __DIR__ . '/includes/db.php';

$db = getDbConnection();

// 1. Create Tables
$tables = [
    "CREATE TABLE IF NOT EXISTS ministries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        slug TEXT UNIQUE NOT NULL,
        title TEXT NOT NULL,
        subtitle TEXT,
        description TEXT,
        image TEXT,
        align TEXT DEFAULT 'left'
    )",
    "CREATE TABLE IF NOT EXISTS leaders (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        title TEXT NOT NULL,
        bio TEXT,
        image TEXT,
        order_index INTEGER DEFAULT 0
    )",
    "CREATE TABLE IF NOT EXISTS beliefs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        icon TEXT,
        order_index INTEGER DEFAULT 0
    )",
    "CREATE TABLE IF NOT EXISTS faqs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        category TEXT NOT NULL,
        question TEXT NOT NULL,
        answer TEXT NOT NULL,
        order_index INTEGER DEFAULT 0
    )",
    "CREATE TABLE IF NOT EXISTS give_impacts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        icon TEXT,
        order_index INTEGER DEFAULT 0
    )",
    "CREATE TABLE IF NOT EXISTS visit_expectations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        icon TEXT,
        order_index INTEGER DEFAULT 0
    )"
];

foreach ($tables as $sql) {
    $db->exec($sql);
}

// 2. Populate Ministries
$ministries = [
    ['slug' => 'kids', 'title' => 'AWM Kids', 'subtitle' => 'Raising the Next Generation', 'desc' => 'We believe in raising children who know God, love His Word, and operate in the gifts of the Spirit from an early age. Our AWM Kids ministry provides a safe, engaging, and age-appropriate environment where children from infants to 5th grade can discover their identity in Christ.', 'image' => 'https://images.unsplash.com/photo-1544427920-c49ccfb85579?w=1920&q=80', 'align' => 'left'],
    ['slug' => 'youth', 'title' => 'Chosen Generation', 'subtitle' => 'Youth Ministry (Grades 6-12)', 'desc' => 'Our youth ministry is designed to equip teenagers to navigate the modern world with an unshakeable biblical worldview. Through passionate worship, honest discussions, and fun community events, we are building disciples who aren\'t afraid to stand out for Jesus.', 'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1920&q=80', 'align' => 'right'],
    ['slug' => 'women', 'title' => 'Women of Purpose', 'subtitle' => 'Women\'s Ministry', 'desc' => 'Women of Purpose is a sisterhood dedicated to spiritual growth, prayer, and authentic connection. Whether you are a college student, a mother, or a seasoned professional, you will find a supportive community here that empowers you to walk boldly in your God-given calling.', 'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=80', 'align' => 'left'],
    ['slug' => 'men', 'title' => 'Iron Men', 'subtitle' => 'Men\'s Ministry', 'desc' => '"As iron sharpens iron, so one man sharpens another." Our Men\'s Ministry focuses on cultivating godly leadership, accountability, and strength. Through monthly breakfasts, service projects, and deep biblical study, we are raising up men who lead their families and communities well.', 'image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1920&q=80', 'align' => 'right'],
    ['slug' => 'worship', 'title' => 'Worship & Arts', 'subtitle' => 'Music, Media, and Production', 'desc' => 'Our worship teams lead the congregation into the presence of God each week. If you have a gift for singing, playing an instrument, sound engineering, or media production, we would love to have you audition to serve on this vital team.', 'image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?w=1920&q=80', 'align' => 'left']
];

$stmt = $db->prepare("INSERT OR IGNORE INTO ministries (slug, title, subtitle, description, image, align) VALUES (?, ?, ?, ?, ?, ?)");
foreach ($ministries as $min) {
    $stmt->execute([$min['slug'], $min['title'], $min['subtitle'], $min['desc'], $min['image'], $min['align']]);
}

// 3. Populate Leaders (assuming config values for now)
require_once __DIR__ . '/includes/config.php';
$stmt = $db->prepare("INSERT OR IGNORE INTO leaders (name, title, bio, image) VALUES (?, ?, ?, ?)");
$stmt->execute([
    $siteConfig['pastor']['name'], 
    $siteConfig['pastor']['title'], 
    'Apostle Joyce Cofield has been faithfully leading Anointed Word Ministries for over a decade, with a passion for systematic biblical teaching and community restoration.',
    $siteConfig['pastor']['image']
]);

// 4. Populate Beliefs
$beliefs = [
    ['title' => 'The Holy Trinity', 'desc' => 'We believe in one God, eternally existent in three persons: Father, Son, and Holy Spirit.', 'icon' => '🕊️'],
    ['title' => 'Salvation', 'desc' => 'We believe that salvation is a gift from God, received through faith in Jesus Christ and His redemptive work on the cross.', 'icon' => '✝️'],
    ['title' => 'Authority of Scripture', 'desc' => 'We believe the Bible is the inspired, infallible, and authoritative Word of God, serving as our ultimate guide for faith and living.', 'icon' => '📖'],
    ['title' => 'The Holy Spirit', 'desc' => 'We believe in the present ministry of the Holy Spirit, whose indwelling enables the Christian to live a godly life and operate in spiritual gifts.', 'icon' => '🕊️']
];
$stmt = $db->prepare("INSERT OR IGNORE INTO beliefs (title, description, icon, order_index) VALUES (?, ?, ?, ?)");
foreach ($beliefs as $i => $b) {
    $stmt->execute([$b['title'], $b['desc'], $b['icon'], $i]);
}

// 5. Populate FAQs (Give Page)
$faqs = [
    ['category' => 'give', 'q' => 'Are my donations secure?', 'a' => 'Yes, Zelle and CashApp utilize standard encryption and security protocols provided by your bank and financial institutions to ensure transactions are safe.'],
    ['category' => 'give', 'q' => 'Will I receive a giving statement?', 'a' => 'Yes. For records of your contributions via Zelle or CashApp, please make sure your full name and email are included in the payment note, or contact the church office so we can link your contributions to your profile.'],
    ['category' => 'give', 'q' => 'Can I set up recurring giving?', 'a' => 'Zelle does not support recurring schedules directly for all banks, but many banks allow recurring transfers. CashApp has options to schedule auto-deposits to your balance, which you can then send to the church.'],
    ['category' => 'give', 'q' => 'Who do I contact if I have giving questions?', 'a' => 'Please feel free to email our financial department at anointedwordministries@yahoo.com or call the church office at (302) 332-0525.']
];
$stmt = $db->prepare("INSERT OR IGNORE INTO faqs (category, question, answer, order_index) VALUES (?, ?, ?, ?)");
foreach ($faqs as $i => $f) {
    $stmt->execute([$f['category'], $f['q'], $f['a'], $i]);
}

// 6. Populate Give Impacts
$impacts = [
    ['title' => 'Local Outreach', 'desc' => 'Feeding the hungry and distributing resources to families in Delaware.', 'icon' => '❤️'],
    ['title' => 'Global Missions', 'desc' => 'Supporting missionaries and planting churches across the globe.', 'icon' => '🌍'],
    ['title' => 'Next Gen', 'desc' => 'Investing in our youth and kids ministry to raise up the next generation of leaders.', 'icon' => '👥'],
    ['title' => 'Media & Broadcast', 'desc' => 'Funding tools to stream services and spread the Gospel globally.', 'icon' => '📡']
];
$stmt = $db->prepare("INSERT OR IGNORE INTO give_impacts (title, description, icon, order_index) VALUES (?, ?, ?, ?)");
foreach ($impacts as $i => $imp) {
    $stmt->execute([$imp['title'], $imp['desc'], $imp['icon'], $i]);
}

// 7. Populate Visit Expectations
$expectCards = [
    ['title' => 'Dynamic Worship', 'desc' => "Our services are spirit-filled, authentic, and centered on the preaching of God's Word. A typical service lasts about 90 minutes.", 'icon' => '⛪'],
    ['title' => 'Come As You Are', 'desc' => "Some people wear suits and dresses, while others wear jeans and t-shirts. We care about you, not what you wear.", 'icon' => '👔'],
    ['title' => 'AWM Kids Ministry', 'desc' => "Your children will experience a safe, fun, and engaging environment where they learn about Jesus on their level.", 'icon' => '🧒']
];
$stmt = $db->prepare("INSERT OR IGNORE INTO visit_expectations (title, description, icon, order_index) VALUES (?, ?, ?, ?)");
foreach ($expectCards as $i => $ec) {
    $stmt->execute([$ec['title'], $ec['desc'], $ec['icon'], $i]);
}

echo "Migration completed successfully!\n";
