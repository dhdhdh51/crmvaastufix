<?php
/**
 * LuxeEstate Realty - Careers Page (UI Enhanced - Text Visible)
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/functions/functions.php';

$currentPage   = 'careers';
$siteName      = getSetting('site_name', 'LuxeEstate Realty');
$pageMetaTitle = "Careers | $siteName";
$pageMetaDesc  = "Join the $siteName team. Explore exciting career opportunities in real estate.";

// Load active jobs from DB
$jobs = [];
try {
    $jobs = db()->query("SELECT * FROM job_postings WHERE status='active' ORDER BY sort_order ASC, featured DESC, created_at DESC")->fetchAll();
} catch (PDOException $e) { /* table not yet created */ }

include __DIR__ . '/includes/header.php';
?>

<style>
    /* Additional styles for careers page - text visibility fix */
    .careers-hero {
        background: linear-gradient(135deg, #5C0016 0%, #800020 60%, #C6A15B 100%);
        padding: 120px 0 60px;
        text-align: center;
        color: #ffffff;
        position: relative;
    }
    .careers-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 12px;
        font-family: 'Cormorant Garamond', serif;
        color: #ffffff;
    }
    .careers-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 560px;
        margin: 0 auto;
        color: #f5e6d3;
    }
    .breadcrumb-careers {
        margin-top: 20px;
        font-size: 13px;
        opacity: 0.8;
    }
    .breadcrumb-careers a {
        color: #ffd700;
        text-decoration: none;
    }
    .breadcrumb-careers span {
        color: #ffffff;
    }
    
    /* Section titles visible */
    .section-title-careers {
        font-size: 2.2rem;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 600;
        color: #5C0016;
        margin-bottom: 12px;
    }
    .section-title-careers span {
        color: #C6A15B;
    }
    .section-subtitle-careers {
        color: #6C757D;
        max-width: 560px;
        margin: 0 auto;
        font-size: 1rem;
    }
    
    /* Why Join Us Cards - text visible fix */
    .why-card-careers {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px 24px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        text-align: center;
        transition: all 0.3s ease;
    }
    .why-card-careers:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(128,0,32,0.1);
    }
    .why-icon-careers {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #C6A15B, #DDB580);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .why-icon-careers i {
        color: #5C0016;
        font-size: 22px;
    }
    .why-title-careers {
        font-size: 1rem;
        font-weight: 700;
        color: #800020;
        margin-bottom: 8px;
    }
    .why-desc-careers {
        font-size: 13px;
        color: #6C757D;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Job cards - text visibility enhanced */
    .job-card {
        text-decoration: none;
        display: flex;
        gap: 20px;
        align-items: flex-start;
        background: #ffffff;
        border: 1px solid #e5e0d8;
        border-radius: 16px;
        padding: 24px 28px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .job-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: translateY(-2px);
        border-color: #C6A15B;
    }
    .job-featured {
        border-left: 4px solid #C6A15B;
    }
    .job-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #800020;
        margin: 0 0 8px 0;
    }
    .job-department {
        background: #fff8e1;
        color: #7A5C1A;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        border: 1px solid #C6A15B;
    }
    .job-urgent {
        background: #fee2e2;
        color: #dc2626;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
    }
    .job-description {
        font-size: 13px;
        color: #4a5568;
        margin: 0 0 12px 0;
        line-height: 1.6;
    }
    .job-meta {
        display: flex;
        gap: 20px;
        font-size: 12px;
        color: #6C757D;
        flex-wrap: wrap;
    }
    .job-meta i {
        margin-right: 4px;
    }
    .job-meta .location-icon {
        color: #800020;
    }
    .job-meta .exp-icon {
        color: #C6A15B;
    }
    .job-apply-btn {
        white-space: nowrap;
        background: #800020;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        align-self: center;
        transition: background 0.2s;
    }
    .job-card:hover .job-apply-btn {
        background: #C6A15B;
        color: #5C0016;
    }
    
    /* No jobs placeholder - text visible */
    .no-jobs-placeholder {
        text-align: center;
        padding: 60px 20px;
        max-width: 500px;
        margin: 0 auto;
        background: #FCF8F0;
        border-radius: 24px;
    }
    .no-jobs-icon {
        width: 72px;
        height: 72px;
        background: #F5EDE1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .no-jobs-icon i {
        font-size: 28px;
        color: #800020;
        opacity: 0.6;
    }
    .no-jobs-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #800020;
        margin-bottom: 10px;
    }
    .no-jobs-text {
        font-size: 14px;
        color: #6C757D;
        line-height: 1.7;
    }
    .no-jobs-text a {
        color: #800020;
        font-weight: 600;
        text-decoration: none;
    }
    .no-jobs-text a:hover {
        text-decoration: underline;
    }
    
    /* Background colors */
    .bg-beige-light {
        background: #FCF8F0;
    }
    .section-padding {
        padding: 80px 0;
    }
    
    @media (max-width: 768px) {
        .job-card {
            flex-direction: column;
            padding: 20px;
        }
        .job-apply-btn {
            width: 100%;
            text-align: center;
        }
        .careers-hero h1 {
            font-size: 2.2rem;
        }
        .section-title-careers {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section - Text visible -->
<section class="careers-hero">
    <div class="container">
        <h1>Join Our Team</h1>
        <p>Be part of a passionate team redefining luxury real estate across India.</p>
        <div class="breadcrumb-careers">
            <a href="<?= SITE_URL ?>">Home</a>
            <span style="margin:0 8px">›</span>
            <span>Careers</span>
        </div>
    </div>
</section>

<!-- Why Join Us Section - Text visible -->
<section class="bg-beige-light section-padding">
    <div class="container">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 class="section-title-careers">Why Work With <span>Us</span></h2>
            <p class="section-subtitle-careers">We invest in our people just as we invest in properties — with care, vision, and commitment.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px;">
            <?php foreach ([
                ['fas fa-rupee-sign',    'Competitive Pay',       'Industry-leading compensation with performance bonuses.'],
                ['fas fa-chart-line',    'Growth Opportunities',  'Clear career progression with senior mentorship.'],
                ['fas fa-users',         'Team Culture',          'A supportive, diverse team that celebrates wins together.'],
                ['fas fa-graduation-cap','Continuous Learning',   'Regular training, workshops, and industry resources.'],
                ['fas fa-star',          'Premium Brand',         'Represent one of the most respected real estate names.'],
                ['fas fa-heart',         'Work-Life Balance',     'Flexible schedules and a healthy work environment.'],
            ] as [$icon, $title, $desc]): ?>
            <div class="why-card-careers">
                <div class="why-icon-careers">
                    <i class="<?= $icon ?>"></i>
                </div>
                <h3 class="why-title-careers"><?= $title ?></h3>
                <p class="why-desc-careers"><?= $desc ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Open Positions Section - Text visible -->
<section class="section-padding">
    <div class="container">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 class="section-title-careers">Open <span>Positions</span></h2>
            <p class="section-subtitle-careers">We're hiring across multiple roles. Click on any role to view details and apply.</p>
        </div>

        <?php if (empty($jobs)): ?>
        <div class="no-jobs-placeholder">
            <div class="no-jobs-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h3 class="no-jobs-title">No Open Positions Right Now</h3>
            <p class="no-jobs-text">
                We don't have any openings at the moment, but we're always looking for great talent. Send your resume to
                <a href="mailto:<?= getSetting('contact_email','careers@luxeestate.com') ?>"><?= getSetting('contact_email','careers@luxeestate.com') ?></a>
                and we'll reach out when something comes up.
            </p>
        </div>
        <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 16px; max-width: 860px; margin: 0 auto;">
            <?php foreach ($jobs as $j): ?>
            <a href="<?= SITE_URL ?>/job/<?= $j['id'] ?>" class="job-card <?= $j['featured'] ? 'job-featured' : '' ?>">
                <div style="flex: 1;">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-bottom: 8px;">
                        <h3 class="job-title"><?= htmlspecialchars($j['title']) ?></h3>
                        <?php if ($j['department']): ?>
                        <span class="job-department"><?= htmlspecialchars($j['department']) ?></span>
                        <?php endif; ?>
                        <?php if ($j['featured']): ?>
                        <span class="job-urgent"><i class="fas fa-fire"></i> Urgent Hiring</span>
                        <?php endif; ?>
                    </div>
                    <?php if ($j['description']): ?>
                    <p class="job-description"><?= mb_substr(strip_tags($j['description']), 0, 150) ?>…</p>
                    <?php endif; ?>
                    <div class="job-meta">
                        <?php if ($j['location']): ?>
                        <span><i class="fas fa-map-marker-alt location-icon"></i> <?= htmlspecialchars($j['location']) ?></span>
                        <?php endif; ?>
                        <?php if ($j['experience']): ?>
                        <span><i class="fas fa-briefcase exp-icon"></i> <?= htmlspecialchars($j['experience']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <span class="job-apply-btn">View &amp; Apply →</span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>