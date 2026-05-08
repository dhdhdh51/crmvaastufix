<?php
/**
 * LuxeEstate Realty - Contact Page (Social Icons Fixed)
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/functions/functions.php';

$csrf          = generateCSRF();
$currentPage   = 'contact';
$siteName      = getSetting('site_name', 'LuxeEstate Realty');
$pageMetaTitle = "Contact Us | $siteName";
$pageMetaDesc  = "Get in touch with $siteName. We're here to help you find your perfect property.";

include __DIR__ . '/includes/header.php';
?>

<style>
    /* Contact Page Specific Styles - Social Icons Visible */
    .contact-hero {
        background: linear-gradient(110deg, rgba(128,0,32,0.92) 0%, rgba(92,0,22,0.85) 100%), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .contact-hero h1 {
        font-size: 4rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.75rem;
        font-family: 'Cormorant Garamond', serif;
    }
    .contact-hero h1 span {
        color: #C6A15B;
        border-bottom: 2px solid #C6A15B;
        padding-bottom: 4px;
    }
    .contact-hero p {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.88);
        margin-bottom: 1.2rem;
    }
    .breadcrumb-contact {
        display: flex;
        justify-content: center;
        gap: 12px;
        font-size: 0.9rem;
    }
    .breadcrumb-contact a {
        color: #DDB580;
        text-decoration: none;
    }
    .breadcrumb-contact span {
        color: white;
    }
    
    /* Contact Grid */
    .contact-grid-new {
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        gap: 60px;
        align-items: start;
        padding: 90px 0;
    }
    .section-label-contact {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #800020;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .section-title-contact {
        font-size: 2.6rem;
        margin-bottom: 24px;
        line-height: 1.2;
        color: #5C0016;
        font-family: 'Cormorant Garamond', serif;
    }
    .section-title-contact span {
        color: #C6A15B;
    }
    .contact-intro {
        margin-bottom: 32px;
        color: #2C3142;
        font-size: 1.05rem;
    }
    
    /* Contact Details */
    .contact-details-new {
        margin: 40px 0 32px;
    }
    .contact-detail-item-new {
        display: flex;
        gap: 20px;
        margin-bottom: 28px;
        align-items: flex-start;
    }
    .contact-detail-icon-new {
        width: 54px;
        height: 54px;
        background: #F5EDE1;
        border-radius: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #800020;
        transition: all 0.3s ease;
    }
    .contact-detail-item-new:hover .contact-detail-icon-new {
        background: #800020;
        color: white;
        transform: scale(1.02);
    }
    .contact-detail-body-new strong {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 6px;
        font-weight: 600;
        color: #5C0016;
        font-family: 'Cormorant Garamond', serif;
    }
    .contact-detail-body-new a, .contact-detail-body-new span {
        color: #6C757D;
        text-decoration: none;
        transition: color 0.2s;
    }
    .contact-detail-body-new a:hover {
        color: #800020;
    }
    
    /* Social Icons - FIXED: Now visible */
    .contact-social-new {
        display: flex;
        gap: 18px;
        margin-top: 30px;
        flex-wrap: wrap;
    }
    .social-link-new {
        background: #F5EDE1;
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #800020;
        font-size: 1.3rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .social-link-new:hover {
        background: #800020;
        color: white;
        transform: translateY(-4px);
    }
    
    /* Contact Form Card */
    .contact-form-card-new {
        background: #ffffff;
        padding: 40px 36px;
        border-radius: 28px;
        box-shadow: 0 25px 45px -12px rgba(0,0,0,0.15);
        border-top: 4px solid #800020;
    }
    .contact-form-card-new h3 {
        font-size: 1.9rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
        font-weight: 600;
        color: #5C0016;
        font-family: 'Cormorant Garamond', serif;
    }
    .contact-form-card-new h3 i {
        color: #800020;
        font-size: 1.8rem;
    }
    .form-row-new {
        display: flex;
        gap: 24px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .form-group-new {
        flex: 1;
        margin-bottom: 20px;
    }
    .form-group-new label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #800020;
    }
    .form-control-new {
        width: 100%;
        padding: 14px 18px;
        border: 1.5px solid #E5DFD3;
        border-radius: 60px;
        font-family: 'Inter', sans-serif;
        transition: 0.25s;
        background: #ffffff;
    }
    textarea.form-control-new {
        border-radius: 28px;
        resize: vertical;
    }
    .form-control-new:focus {
        outline: none;
        border-color: #800020;
        box-shadow: 0 0 0 3px rgba(128,0,32,0.15);
    }
    .btn-gold-new {
        background: #C6A15B;
        color: #5C0016;
        padding: 14px 28px;
        border: none;
        border-radius: 60px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    .btn-gold-new:hover {
        background: #b48a44;
        transform: translateY(-3px);
        box-shadow: 0 12px 22px rgba(198,161,91,0.3);
    }
    .form-success-new {
        background: #f0f9ef;
        border-radius: 28px;
        margin-top: 20px;
        padding: 18px;
        text-align: center;
    }
    .form-success-new h4 {
        color: #5C0016;
        margin-top: 10px;
    }
    
    /* Map Section */
    .map-section-new {
        margin-top: 70px;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 25px 45px -12px rgba(0,0,0,0.15);
    }
    .map-section-new iframe {
        width: 100%;
        height: 380px;
        border: 0;
        display: block;
    }
    
    /* CTA Strip */
    .cta-strip-new {
        background: linear-gradient(135deg, #800020 0%, #5C0016 100%);
        padding: 60px 0;
        margin-top: 30px;
    }
    .cta-strip-new .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 30px;
    }
    .cta-strip-content-new h2 {
        color: white;
        font-size: 2rem;
        margin-bottom: 12px;
        font-family: 'Cormorant Garamond', serif;
    }
    .cta-strip-content-new p {
        color: #f0cfcf;
    }
    .cta-strip-actions-new {
        display: flex;
        gap: 20px;
    }
    .btn-white-outline-new {
        border: 2px solid #C6A15B;
        background: transparent;
        color: #C6A15B;
        padding: 12px 28px;
        border-radius: 60px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-white-outline-new:hover {
        background: #C6A15B;
        color: #5C0016;
    }
    
    /* Fade Animations */
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
    
    @media (max-width: 1024px) {
        .contact-grid-new { grid-template-columns: 1fr; gap: 50px; }
        .container { padding: 0 24px; }
        .section-title-contact { font-size: 2rem; }
    }
    @media (max-width: 768px) {
        .contact-hero h1 { font-size: 2.8rem; }
        .contact-form-card-new { padding: 28px 20px; }
        .cta-strip-new .container { flex-direction: column; text-align: center; }
        .cta-strip-actions-new { justify-content: center; }
        .contact-social-new { justify-content: center; }
    }
</style>

<!-- Page Hero -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1>Contact <span>Us</span></h1>
            <p>We'd love to hear from you</p>
            <nav class="breadcrumb-contact">
                <a href="<?= SITE_URL ?>">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>Contact</span>
            </nav>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid-new">

            <!-- Contact Info -->
            <div class="contact-info fade-left">
                <div class="section-label-contact">Get In Touch</div>
                <h2 class="section-title-contact">Let's Start a <span>Conversation</span></h2>
                <p class="contact-intro">
                    Whether you're looking to buy, sell, or invest — our experts are ready to guide you every step of the way.
                </p>

                <div class="contact-details-new">
                    <div class="contact-detail-item-new">
                        <div class="contact-detail-icon-new"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-detail-body-new">
                            <strong>Office Address</strong>
                            <span><?= nl2br(htmlspecialchars(getSetting('contact_address', '123 Real Estate Tower, MG Road, Bangalore - 560001'))) ?></span>
                        </div>
                    </div>
                    <div class="contact-detail-item-new">
                        <div class="contact-detail-icon-new"><i class="fas fa-phone-alt"></i></div>
                        <div class="contact-detail-body-new">
                            <strong>Phone</strong>
                            <a href="tel:<?= preg_replace('/[^0-9+]/', '', getSetting('contact_phone', '+91 98765 43210')) ?>">
                                <?= htmlspecialchars(getSetting('contact_phone', '+91 98765 43210')) ?>
                            </a>
                        </div>
                    </div>
                    <div class="contact-detail-item-new">
                        <div class="contact-detail-icon-new"><i class="fas fa-envelope"></i></div>
                        <div class="contact-detail-body-new">
                            <strong>Email</strong>
                            <a href="mailto:<?= htmlspecialchars(getSetting('contact_email', 'info@luxestate.com')) ?>">
                                <?= htmlspecialchars(getSetting('contact_email', 'info@luxestate.com')) ?>
                            </a>
                        </div>
                    </div>
                    <div class="contact-detail-item-new">
                        <div class="contact-detail-icon-new"><i class="fas fa-clock"></i></div>
                        <div class="contact-detail-body-new">
                            <strong>Office Hours</strong>
                            <span><?= htmlspecialchars(getSetting('office_hours', 'Mon – Sat: 9:00 AM – 7:00 PM')) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Social Links - NOW VISIBLE -->
                <div class="contact-social-new">
                    <?php 
                    $fb = getSetting('facebook_url'); 
                    $ig = getSetting('instagram_url'); 
                    $li = getSetting('linkedin_url'); 
                    $yt = getSetting('youtube_url'); 
                    ?>
                    <?php if ($fb): ?>
                    <a href="<?= htmlspecialchars($fb) ?>" target="_blank" class="social-link-new" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ($ig): ?>
                    <a href="<?= htmlspecialchars($ig) ?>" target="_blank" class="social-link-new" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ($li): ?>
                    <a href="<?= htmlspecialchars($li) ?>" target="_blank" class="social-link-new" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ($yt): ?>
                    <a href="<?= htmlspecialchars($yt) ?>" target="_blank" class="social-link-new" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endif; ?>
                    
                    <!-- Fallback agar koi setting nahi hai toh dummy icons dikhane ke liye -->
                    <?php if (!$fb && !$ig && !$li && !$yt): ?>
                    <a href="#" class="social-link-new" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link-new" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link-new" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-link-new" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrap fade-right">
                <div class="contact-form-card-new">
                    <h3><i class="fas fa-paper-plane"></i> Send Us a Message</h3>
                    <form id="contactForm" novalidate>
                        <input type="hidden" name="action" value="contact_message">
                        <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
                        <div class="form-row-new">
                            <div class="form-group-new">
                                <label>Full Name *</label>
                                <input type="text" name="name" placeholder="Your name" required class="form-control-new">
                            </div>
                            <div class="form-group-new">
                                <label>Phone Number *</label>
                                <input type="tel" name="phone" placeholder="+91 98765 43210" required class="form-control-new">
                            </div>
                        </div>
                        <div class="form-row-new">
                            <div class="form-group-new">
                                <label>Email Address</label>
                                <input type="email" name="email" placeholder="your@email.com" class="form-control-new">
                            </div>
                            <div class="form-group-new">
                                <label>Subject</label>
                                <select name="subject" class="form-control-new">
                                    <option value="General Enquiry">General Enquiry</option>
                                    <option value="Buy Property">Buy Property</option>
                                    <option value="Sell Property">Sell Property</option>
                                    <option value="Rent Property">Rent Property</option>
                                    <option value="Investment Advice">Investment Advice</option>
                                    <option value="Legal Assistance">Legal Assistance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group-new">
                            <label>Your Message *</label>
                            <textarea name="message" rows="5" placeholder="Tell us how we can help you..." required class="form-control-new"></textarea>
                        </div>
                        <button type="submit" class="btn-gold-new">
                            <span class="btn-text"><i class="fas fa-paper-plane"></i> Send Message</span>
                            <span class="btn-loading" style="display:none"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
                        </button>
                        <div class="form-success-new" style="display:none">
                            <i class="fas fa-check-circle" style="font-size:40px;color:#800020;margin-bottom:10px;display:block"></i>
                            <h4>Message Sent!</h4>
                            <p>Thank you for reaching out. We'll get back to you within 24 hours.</p>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Map Embed -->
        <?php $mapEmbed = getSetting('google_map_embed'); ?>
        <?php if ($mapEmbed): ?>
        <div class="map-section-new fade-up" style="margin-top:60px">
            <h3 class="section-title-contact" style="margin-bottom:20px">Find <span>Our Office</span></h3>
            <div class="map-container">
                <?= $mapEmbed ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA Strip -->
<section class="cta-strip-new">
    <div class="container">
        <div class="cta-strip-content-new">
            <h2>Ready to Find Your Dream Property?</h2>
            <p>Browse our exclusive listings and connect with our experts today.</p>
        </div>
        <div class="cta-strip-actions-new">
            <a href="<?= SITE_URL ?>/properties.php" class="btn-gold-new">Browse Properties</a>
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', getSetting('contact_phone', '+91 98765 43210')) ?>" class="btn-white-outline-new">
                <i class="fas fa-phone"></i> Call Now
            </a>
        </div>
    </div>
</section>

<script>
document.getElementById('contactForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form   = this;
    const btn    = form.querySelector('button[type=submit]');
    const data   = new FormData(form);
    btn.querySelector('.btn-text').style.display   = 'none';
    btn.querySelector('.btn-loading').style.display = 'inline';
    btn.disabled = true;

    fetch('<?= SITE_URL ?>/ajax.php', { method: 'POST', body: data })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                form.querySelector('.form-success-new').style.display = 'block';
                btn.style.display = 'none';
                Array.from(form.querySelectorAll('.form-row-new, .form-group-new:not(.hidden)')).forEach(el => el.style.display = 'none');
            } else {
                alert(res.message);
                btn.querySelector('.btn-text').style.display   = 'inline';
                btn.querySelector('.btn-loading').style.display = 'none';
                btn.disabled = false;
            }
        })
        .catch(() => {
            alert('Something went wrong. Please try again.');
            btn.querySelector('.btn-text').style.display   = 'inline';
            btn.querySelector('.btn-loading').style.display = 'none';
            btn.disabled = false;
        });
});

// Intersection Observer for fade animations
const faders = document.querySelectorAll('.fade-left, .fade-right, .fade-up');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.2 });
faders.forEach(el => observer.observe(el));
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>