<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>LuxeEstate Realty - About Us | Our Story</title>
    <!-- Google Fonts + Font Awesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --maroon-primary: #800020;
            --maroon-dark: #5C0016;
            --maroon-light: #9E2A3E;
            --gold-majestic: #C6A15B;
            --gold-soft: #DDB580;
            --beige-warm: #FCF8F0;
            --beige-mid: #F5EDE1;
            --white-pure: #FFFFFF;
            --slate-elegant: #2C3142;
            --gray-muted: #6C757D;
            --shadow-xl: 0 25px 45px -12px rgba(0,0,0,0.15);
            --shadow-card: 0 15px 35px rgba(0,0,0,0.08);
            --radius-card: 28px;
            --transition-lux: all 0.4s cubic-bezier(0.2, 0.95, 0.4, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--white-pure);
            color: var(--slate-elegant);
            line-height: 1.5;
            overflow-x: hidden;
        }

        h1, h2, h3, .section-title, .exp-label, .stat-label, .why-card h3, .team-info h3 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 32px;
        }

        .section-pad {
            padding: 90px 0;
        }

        /* Hero with maroon gradient */
        .page-hero {
            background: linear-gradient(110deg, rgba(128,0,32,0.92) 0%, rgba(92,0,22,0.85) 100%), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .page-hero-content h1 {
            font-size: 4rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.75rem;
        }
        .page-hero-content h1 span {
            color: var(--gold-majestic);
            border-bottom: 2px solid var(--gold-majestic);
            padding-bottom: 4px;
        }
        .page-hero-content p {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.88);
            margin-bottom: 1.2rem;
        }
        .breadcrumb-nav {
            display: flex;
            justify-content: center;
            gap: 12px;
            font-size: 0.9rem;
        }
        .breadcrumb-nav a {
            color: var(--gold-soft);
            text-decoration: none;
        }
        .breadcrumb-nav i {
            font-size: 12px;
            color: var(--gold-soft);
        }
        .breadcrumb-nav span {
            color: white;
        }

        /* Story Section - FIXED overflow */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .about-image {
            position: relative;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s;
        }
        .about-image:hover img {
            transform: scale(1.02);
        }
        .about-img-placeholder {
            background: linear-gradient(145deg, var(--maroon-dark), var(--maroon-primary));
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 32px;
        }
        .about-exp-badge {
            position: absolute;
            bottom: 30px;
            right: -20px;
            background: var(--maroon-primary);
            color: white;
            padding: 20px 28px;
            border-radius: 100px;
            text-align: center;
            box-shadow: 8px 12px 24px rgba(0,0,0,0.2);
            z-index: 10;
        }
        .exp-number {
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Cormorant Garamond', serif;
            display: block;
            line-height: 1;
            color: var(--gold-majestic);
        }
        .exp-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--maroon-primary);
            font-weight: 700;
            margin-bottom: 12px;
        }
        .section-title {
            font-size: 2.6rem;
            margin-bottom: 24px;
            line-height: 1.2;
            color: var(--maroon-dark);
        }
        .section-title span {
            color: var(--gold-majestic);
        }
        .about-text {
            color: var(--slate-elegant);
            margin-bottom: 32px;
            font-size: 1rem;
            line-height: 1.65;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .about-text p {
            margin-bottom: 16px;
        }
        .about-highlights {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 38px;
        }
        .highlight-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--beige-mid);
            padding: 12px 18px;
            border-radius: 60px;
            font-weight: 500;
            word-wrap: break-word;
            white-space: normal;
        }
        .highlight-item i {
            color: var(--maroon-primary);
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .highlight-item span {
            font-size: 0.9rem;
        }
        .about-cta-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .btn-gold {
            background: var(--gold-majestic);
            color: var(--maroon-dark);
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition-lux);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        .btn-gold:hover {
            background: #b48a44;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(198,161,91,0.3);
        }
        .btn-outline {
            background: transparent;
            border: 2px solid var(--maroon-primary);
            color: var(--maroon-primary);
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-lux);
        }
        .btn-outline:hover {
            background: var(--maroon-primary);
            color: white;
            border-color: var(--maroon-primary);
        }

        /* Stats Section with maroon */
        .stats-section {
            background: linear-gradient(120deg, var(--maroon-primary) 0%, var(--maroon-dark) 100%);
            color: white;
            padding: 70px 0;
        }
        .stats-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            text-align: center;
        }
        .stat-item {
            flex: 1;
            min-width: 160px;
        }
        .stat-icon {
            font-size: 2.5rem;
            color: var(--gold-majestic);
            margin-bottom: 16px;
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Cormorant Garamond', serif;
            line-height: 1;
            margin-bottom: 12px;
        }
        .stat-label {
            font-size: 1rem;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        /* Why Choose Us section */
        .why-us-section {
            background: var(--beige-warm);
        }
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }
        .section-subtitle {
            color: var(--gray-muted);
            font-size: 1.1rem;
        }
        .why-us-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
        }
        .why-card {
            background: white;
            border-radius: var(--radius-card);
            padding: 38px 28px;
            text-align: center;
            transition: var(--transition-lux);
            box-shadow: var(--shadow-card);
            border-bottom: 3px solid transparent;
            word-wrap: break-word;
        }
        .why-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-xl);
            border-bottom-color: var(--maroon-primary);
        }
        .why-icon {
            width: 75px;
            height: 75px;
            background: rgba(128,0,32,0.1);
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2rem;
            color: var(--maroon-primary);
        }
        .why-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--maroon-dark);
        }
        .why-card p {
            color: var(--gray-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Team Section */
        .team-section {
            background: var(--white-pure);
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
        }
        .team-card {
            background: var(--beige-warm);
            border-radius: 32px;
            overflow: hidden;
            transition: var(--transition-lux);
            text-align: center;
            padding-bottom: 28px;
        }
        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }
        .team-avatar img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }
        .team-avatar-placeholder {
            background: linear-gradient(135deg, var(--beige-mid), var(--beige-warm));
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--maroon-primary);
        }
        .team-info {
            padding: 24px 20px;
        }
        .team-info h3 {
            font-size: 1.5rem;
            margin-bottom: 6px;
            color: var(--maroon-dark);
        }
        .team-role {
            color: var(--maroon-primary);
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        .team-exp {
            font-size: 0.8rem;
            background: rgba(128,0,32,0.1);
            padding: 4px 12px;
            border-radius: 40px;
            display: inline-block;
            margin: 12px 0;
            color: var(--maroon-dark);
        }
        .team-social {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 18px;
        }
        .team-social a {
            background: white;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--maroon-dark);
            transition: 0.2s;
            text-decoration: none;
        }
        .team-social a:hover {
            background: var(--maroon-primary);
            color: white;
            transform: scale(1.08);
        }

        /* Testimonials - FIXED overflow */
        .testimonials-section {
            background: linear-gradient(0deg, var(--beige-warm), white);
        }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
            gap: 35px;
        }
        .testimonial-card {
            background: white;
            border-radius: 32px;
            padding: 32px;
            transition: var(--transition-lux);
            box-shadow: var(--shadow-card);
            border-left: 4px solid var(--maroon-primary);
            word-wrap: break-word;
        }
        .testimonial-card:hover {
            transform: scale(1.01);
            box-shadow: var(--shadow-xl);
        }
        .testimonial-rating i {
            color: var(--gold-majestic);
            margin-right: 3px;
            font-size: 0.9rem;
        }
        .testimonial-text {
            font-size: 0.95rem;
            line-height: 1.55;
            margin: 20px 0;
            color: var(--slate-elegant);
            font-style: italic;
            word-wrap: break-word;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
            border-top: 1px solid #ede6db;
            padding-top: 20px;
        }
        .testimonial-author img, .testimonial-avatar {
            width: 56px;
            height: 56px;
            border-radius: 100%;
            object-fit: cover;
            background: var(--beige-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--maroon-primary);
            flex-shrink: 0;
        }
        .testimonial-author div {
            word-wrap: break-word;
        }
        .testimonial-author strong {
            color: var(--maroon-dark);
            display: block;
        }
        .testimonial-author span {
            font-size: 0.8rem;
            color: var(--gray-muted);
        }

        /* fade animations */
        .fade-left, .fade-right, .fade-up {
            opacity: 0;
            transition: opacity 0.8s ease, transform 0.7s ease;
        }
        .fade-left { transform: translateX(-30px); }
        .fade-right { transform: translateX(30px); }
        .fade-up { transform: translateY(30px); }
        .fade-left.visible, .fade-right.visible, .fade-up.visible {
            opacity: 1;
            transform: translate(0,0);
        }

        /* Responsive - FIXED for mobile */
        @media (max-width: 1024px) {
            .about-grid { grid-template-columns: 1fr; gap: 50px; }
            .container { padding: 0 24px; }
            .section-title { font-size: 2rem; }
        }

        @media (max-width: 768px) {
            .about-exp-badge { right: 10px; bottom: 10px; padding: 12px 20px; }
            .exp-number { font-size: 2rem; }
            .page-hero-content h1 { font-size: 2.8rem; }
            .about-highlights { grid-template-columns: 1fr; }
            .stats-grid { justify-content: center; }
            .stats-grid .stat-item { min-width: 140px; }
            .stat-number { font-size: 2.4rem; }
            .why-card { padding: 28px 20px; }
            .testimonials-grid { gap: 25px; }
        }

        @media (max-width: 480px) {
            .container { padding: 0 20px; }
            .section-pad { padding: 60px 0; }
            .about-cta-row { flex-direction: column; align-items: stretch; }
            .btn-gold, .btn-outline { text-align: center; justify-content: center; }
            .highlight-item span { font-size: 0.85rem; }
        }
    </style>
</head>
<body>

<?php
/**
 * LuxeEstate Realty - About Page (UI enhanced, maroon theme preserved, overflow fixed)
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/functions/functions.php';

$team         = db()->query("SELECT * FROM team_members WHERE status='active' ORDER BY sort_order ASC")->fetchAll();
$testimonials = db()->query("SELECT * FROM testimonials WHERE status='active' ORDER BY RAND() LIMIT 6")->fetchAll();

$stats = [
    ['value' => getSetting('stat_properties', '500+'), 'label' => 'Properties Sold', 'icon' => 'fa-home'],
    ['value' => getSetting('stat_clients',    '1200+'), 'label' => 'Happy Clients',   'icon' => 'fa-smile'],
    ['value' => getSetting('stat_cities',     '15+'),   'label' => 'Cities Covered',  'icon' => 'fa-city'],
    ['value' => getSetting('stat_years',      '10+'),   'label' => 'Years Experience','icon' => 'fa-award'],
];

$currentPage   = 'about';
$siteName      = getSetting('site_name', 'LuxeEstate Realty');
$pageMetaTitle = "About Us | $siteName";
$pageMetaDesc  = "Learn about $siteName — our story, our team, and our mission to help you find your perfect home.";

include __DIR__ . '/includes/header.php';
?>

<!-- Page Hero with maroon -->
<section class="page-hero">
    <div class="page-hero-content">
        <h1>About <span>Us</span></h1>
        <p>Building trust through excellence in real estate</p>
        <nav class="breadcrumb-nav">
            <a href="<?= SITE_URL ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>About Us</span>
        </nav>
    </div>
</section>

<!-- Story Section -->
<section class="about-story section-pad">
    <div class="container">
        <div class="about-grid">
            <div class="about-image fade-left">
                <?php $aboutImg = getSetting('about_image'); ?>
                <?php if ($aboutImg): ?>
                <img src="<?= UPLOAD_URL . htmlspecialchars($aboutImg) ?>" alt="About <?= htmlspecialchars($siteName) ?>">
                <?php else: ?>
                <div class="about-img-placeholder">
                    <div class="about-img-inner">
                        <i class="fas fa-building" style="font-size:80px;color:var(--gold-majestic)"></i>
                        <p style="color:var(--beige-warm);margin-top:20px;font-size:18px"><?= htmlspecialchars($siteName) ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="about-exp-badge">
                    <span class="exp-number"><?= getSetting('stat_years', '10') ?></span>
                    <span class="exp-label">Years of<br>Excellence</span>
                </div>
            </div>
            <div class="about-content fade-right">
                <div class="section-label">Our Story</div>
                <h2 class="section-title"><?= htmlspecialchars(getSetting('about_tagline', 'Your Trusted Real Estate Partner')) ?></h2>
                <div class="about-text">
                    <?= getSetting('about_content', '<p>At ' . $siteName . ', we believe that finding the perfect home is one of life\'s most important journeys. Founded with a passion for real estate and a commitment to client satisfaction, we have been guiding families, investors, and businesses to their ideal properties for over a decade.</p><p>Our team of experienced professionals understands that every client has unique needs and aspirations. We combine deep market knowledge with personalized service to deliver exceptional results — from the first consultation to the final handshake.</p><p>Whether you\'re a first-time buyer, seasoned investor, or looking to sell, we\'re here to make your real estate experience seamless, transparent, and rewarding.</p>') ?>
                </div>
                <div class="about-highlights">
                    <div class="highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <span>RERA Registered & Compliant</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Transparent Pricing, Zero Hidden Charges</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <span>End-to-End Property Assistance</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Legal & Documentation Support</span>
                    </div>
                </div>
                <div class="about-cta-row">
                    <a href="<?= SITE_URL ?>/contact.php" class="btn-gold">Get in Touch</a>
                    <a href="<?= SITE_URL ?>/properties.php" class="btn-outline">Browse Properties</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section - maroon background -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $stat): ?>
            <div class="stat-item fade-up">
                <div class="stat-icon"><i class="fas <?= $stat['icon'] ?>"></i></div>
                <div class="stat-number counter" data-target="<?= preg_replace('/[^0-9]/', '', $stat['value']) ?>" data-suffix="+">
                    <?= htmlspecialchars($stat['value']) ?>
                </div>
                <div class="stat-label"><?= htmlspecialchars($stat['label']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-us-section section-pad">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Why Choose Us</div>
            <h2 class="section-title">What Sets Us <span>Apart</span></h2>
            <p class="section-subtitle">We go beyond transactions to build lasting relationships</p>
        </div>
        <div class="why-us-grid">
            <div class="why-card fade-up">
                <div class="why-icon"><i class="fas fa-medal"></i></div>
                <h3>Award-Winning Service</h3>
                <p>Recognized for excellence in customer satisfaction and industry expertise year after year.</p>
            </div>
            <div class="why-card fade-up" style="transition-delay:.1s">
                <div class="why-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Verified Properties</h3>
                <p>Every listing is thoroughly verified for legal compliance, construction quality, and fair pricing.</p>
            </div>
            <div class="why-card fade-up" style="transition-delay:.2s">
                <div class="why-icon"><i class="fas fa-handshake"></i></div>
                <h3>End-to-End Support</h3>
                <p>From property discovery to registration — we walk every step of the journey with you.</p>
            </div>
            <div class="why-card fade-up" style="transition-delay:.3s">
                <div class="why-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Market Intelligence</h3>
                <p>Data-driven insights to help you make the best investment decisions in the right locations.</p>
            </div>
            <div class="why-card fade-up" style="transition-delay:.4s">
                <div class="why-icon"><i class="fas fa-headset"></i></div>
                <h3>24/7 Support</h3>
                <p>Our dedicated team is always available to answer your questions and address your concerns.</p>
            </div>
            <div class="why-card fade-up" style="transition-delay:.5s">
                <div class="why-icon"><i class="fas fa-file-contract"></i></div>
                <h3>Legal Assistance</h3>
                <p>In-house legal experts ensure all your documentation and agreements are airtight.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<?php if (!empty($team)): ?>
<section class="team-section section-pad">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Our Team</div>
            <h2 class="section-title">Meet Our <span>Experts</span></h2>
            <p class="section-subtitle">Passionate professionals dedicated to your property success</p>
        </div>
        <div class="team-grid">
            <?php foreach ($team as $member): ?>
            <div class="team-card fade-up">
                <div class="team-avatar">
                    <?php if ($member['image']): ?>
                    <img src="<?= UPLOAD_URL . htmlspecialchars($member['image']) ?>"
                         alt="<?= htmlspecialchars($member['name']) ?>" loading="lazy">
                    <?php else: ?>
                    <div class="team-avatar-placeholder"><i class="fas fa-user-tie"></i></div>
                    <?php endif; ?>
                </div>
                <div class="team-info">
                    <h3><?= htmlspecialchars($member['name']) ?></h3>
                    <span class="team-role"><?= htmlspecialchars($member['role']) ?></span>
                    <?php if (!empty($member['experience_years'])): ?>
                    <span class="team-exp"><?= htmlspecialchars($member['experience_years']) ?> yrs experience</span>
                    <?php endif; ?>
                    <div class="team-social">
                        <?php if ($member['linkedin']): ?>
                        <a href="<?= htmlspecialchars($member['linkedin']) ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                        <?php if ($member['phone']): ?>
                        <a href="tel:<?= htmlspecialchars($member['phone']) ?>"><i class="fas fa-phone"></i></a>
                        <?php endif; ?>
                        <?php if ($member['email']): ?>
                        <a href="mailto:<?= htmlspecialchars($member['email']) ?>"><i class="fas fa-envelope"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="testimonials-section section-pad">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Client Stories</div>
            <h2 class="section-title">What Our <span>Clients Say</span></h2>
        </div>
        <div class="testimonials-grid">
            <?php foreach ($testimonials as $t): ?>
            <div class="testimonial-card fade-up">
                <div class="testimonial-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?= $i <= ($t['rating'] ?? 5) ? 'filled' : '' ?>" style="color:<?= $i <= ($t['rating'] ?? 5) ? '#C6A15B' : '#ddd' ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"<?= htmlspecialchars($t['review']) ?>"</p>
                <div class="testimonial-author">
                    <?php if ($t['image']): ?>
                    <img src="<?= UPLOAD_URL . htmlspecialchars($t['image']) ?>" alt="<?= htmlspecialchars($t['name']) ?>">
                    <?php else: ?>
                    <div class="testimonial-avatar"><i class="fas fa-user"></i></div>
                    <?php endif; ?>
                    <div>
                        <strong><?= htmlspecialchars($t['name']) ?></strong>
                        <?php if ($t['designation']): ?>
                        <span><?= htmlspecialchars($t['designation']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Counter JS and Intersection Observer -->
<script>
    // Intersection Observer for fade animations
    const fadeElements = document.querySelectorAll('.fade-up, .fade-left, .fade-right');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    fadeElements.forEach(el => observer.observe(el));

    // Counter for stats
    const counters = document.querySelectorAll('.counter');
    const activateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = parseInt(counter.innerText.replace(/[^0-9]/g, '')) || 0;
                const suffix = counter.getAttribute('data-suffix') || '';
                const increment = Math.ceil(target / 30);
                if (current < target) {
                    current += increment;
                    counter.innerText = current + suffix;
                    setTimeout(updateCount, 25);
                } else {
                    counter.innerText = target + suffix;
                }
            };
            updateCount();
        });
    };
    
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const statsObserver = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                activateCounters();
                statsObserver.unobserve(statsSection);
            }
        }, { threshold: 0.3 });
        statsObserver.observe(statsSection);
    } else {
        activateCounters();
    }
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>