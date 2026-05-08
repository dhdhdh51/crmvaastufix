<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../functions/functions.php';

requireAdmin();

$db = db();
$errors  = [];
$success = '';

// ── Save settings ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $_POST['csrf_token'] ?? '';
    if (!validateCSRF($csrf)) {
        $errors[] = 'Invalid security token.';
    } else {
        $tab = $_POST['active_tab'] ?? 'general';

        $fields = [];

        if ($tab === 'general') {
            $fields = [
                'site_name'        => sanitize($_POST['site_name'] ?? ''),
                'site_tagline'     => sanitize($_POST['site_tagline'] ?? ''),
                'site_description' => sanitize($_POST['site_description'] ?? ''),
                'footer_text'      => sanitize($_POST['footer_text'] ?? ''),
                'established_year' => sanitize($_POST['established_year'] ?? ''),
                'properties_count' => sanitize($_POST['properties_count'] ?? ''),
                'clients_count'    => sanitize($_POST['clients_count'] ?? ''),
                'experience_years' => sanitize($_POST['experience_years'] ?? ''),
            ];
            // Logo upload
            if (!empty($_FILES['logo']['name'])) {
                $uploaded = uploadImage($_FILES['logo'], 'settings');
                if ($uploaded['success']) {
                    $fields['site_logo'] = $uploaded['path'];
                } else {
                    $errors[] = 'Logo: ' . $uploaded['message'];
                }
            }
            // Favicon upload
            if (!empty($_FILES['favicon']['name'])) {
                $uploaded = uploadImage($_FILES['favicon'], 'settings');
                if ($uploaded['success']) {
                    $fields['site_favicon'] = $uploaded['path'];
                } else {
                    $errors[] = 'Favicon: ' . $uploaded['message'];
                }
            }
        }

        if ($tab === 'contact') {
            $fields = [
                'contact_phone'   => sanitize($_POST['phone'] ?? ''),
                'contact_phone2'  => sanitize($_POST['phone_alt'] ?? ''),
                'contact_email'   => sanitize($_POST['email'] ?? ''),
                'contact_email2'  => sanitize($_POST['email_alt'] ?? ''),
                'contact_address' => sanitize($_POST['address'] ?? ''),
                'whatsapp_number' => sanitize($_POST['whatsapp'] ?? ''),
                'map_embed'       => sanitizeMapEmbed($_POST['map_embed'] ?? ''),
                'office_hours'    => sanitize($_POST['office_hours'] ?? ''),
            ];
        }

        if ($tab === 'social') {
            $fields = [
                'facebook_url'   => sanitize($_POST['facebook'] ?? ''),
                'instagram_url'  => sanitize($_POST['instagram'] ?? ''),
                'twitter_url'    => sanitize($_POST['twitter'] ?? ''),
                'youtube_url'    => sanitize($_POST['youtube'] ?? ''),
                'linkedin_url'   => sanitize($_POST['linkedin'] ?? ''),
                'pinterest_url'  => sanitize($_POST['pinterest'] ?? ''),
            ];
        }

        if ($tab === 'seo') {
            $fields = [
                'meta_title'       => sanitize($_POST['meta_title'] ?? ''),
                'meta_description' => sanitize($_POST['meta_description'] ?? ''),
                'meta_keywords'    => sanitize($_POST['meta_keywords'] ?? ''),
                'google_analytics' => sanitize($_POST['google_analytics'] ?? ''),
                'google_tag'       => sanitize($_POST['google_tag'] ?? ''),
                'schema_markup'    => sanitize($_POST['schema_markup'] ?? ''),
            ];
        }

        if ($tab === 'sections') {
            $section_keys = ['section_hero','section_featured','section_stats','section_services','section_testimonials','section_team','section_blog','section_cta','section_popup','section_sticky'];
            foreach ($section_keys as $k) {
                $fields[$k] = isset($_POST[$k]) ? '1' : '0';
            }
            // popup_enabled drives the actual popup visibility
            $fields['popup_enabled'] = isset($_POST['section_popup']) ? '1' : '0';
        }

        if ($tab === 'email') {
            $fields = [
                'smtp_host'      => sanitize($_POST['smtp_host'] ?? ''),
                'smtp_port'      => sanitize($_POST['smtp_port'] ?? ''),
                'smtp_user'      => sanitize($_POST['smtp_user'] ?? ''),
                'smtp_pass'      => sanitize($_POST['smtp_pass'] ?? ''),
                'smtp_from'      => sanitize($_POST['smtp_from'] ?? ''),
                'smtp_from_name' => sanitize($_POST['smtp_from_name'] ?? ''),
                'smtp_secure'    => sanitize($_POST['smtp_secure'] ?? 'tls'),
                'notify_email'   => sanitize($_POST['notify_email'] ?? ''),
            ];
        }

        if (empty($errors)) {
            foreach ($fields as $key => $value) {
                updateSetting($key, $value);
            }
            $success = 'Settings saved successfully!';
        }
    }
}

// Load all settings
$settings = getAllSettings();
$s = $settings;

$csrf_token = generateCSRF();
$active_tab = $_POST['active_tab'] ?? ($_GET['tab'] ?? 'general');
$pageTitle  = 'Settings';
$activePage = 'settings';
require_once __DIR__ . '/layout-header.php';
?>

<style>
/* Mobile Friendly Admin Styles */
:root {
    --maroon: #6B0F1E;
    --maroon-dark: #4a0a14;
    --gold: #C6A43F;
    --beige-light: #FCF8F0;
}

/* Mobile First Approach */
.admin-content {
    padding: 15px;
}

@media (min-width: 768px) {
    .admin-content {
        padding: 20px;
    }
}

/* Card Styles */
.card {
    border-radius: 16px;
    overflow: hidden;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.card-header {
    background: var(--maroon);
    color: white;
    padding: 15px 20px;
    border: none;
}

.card-header h5 {
    margin: 0;
    font-size: 16px;
}

@media (min-width: 768px) {
    .card-header h5 {
        font-size: 18px;
    }
}

.card-body {
    padding: 20px;
}

@media (max-width: 768px) {
    .card-body {
        padding: 15px;
    }
}

/* Form Controls */
.form-label {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 5px;
    color: #333;
}

@media (min-width: 768px) {
    .form-label {
        font-size: 14px;
    }
}

.form-control, .form-select {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 12px;
    font-size: 14px;
    width: 100%;
}

.form-control:focus, .form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(198,164,63,0.1);
    outline: none;
}

/* Sidebar Tabs - Mobile Friendly */
@media (max-width: 768px) {
    .sticky-top {
        position: relative !important;
        top: 0 !important;
    }
    
    #settingsTabs {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .settings-tab-link {
        padding: 8px 12px !important;
        font-size: 12px !important;
        border-radius: 30px !important;
        display: inline-flex !important;
        align-items: center;
        white-space: nowrap;
    }
    
    .settings-tab-link i {
        margin-right: 5px;
        font-size: 12px;
    }
}

@media (min-width: 768px) {
    #settingsTabs {
        flex-direction: column;
    }
    
    .settings-tab-link {
        padding: 10px 15px !important;
        margin-bottom: 5px;
    }
}

/* Active Tab Styles */
.settings-tab-link.active {
    background: var(--maroon) !important;
    color: white !important;
}

.settings-tab-link.text-dark {
    color: #333 !important;
}

/* Section Cards */
.section-card {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 15px;
    transition: all 0.2s;
}

.section-card.border-success {
    border-color: #10b981;
}

.section-card.border-secondary {
    border-color: #e2e8f0;
}

/* Button Styles */
.btn-gold {
    background: var(--gold);
    color: var(--maroon-dark);
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-gold:hover {
    background: #b08a2c;
    transform: translateY(-2px);
}

/* Alert Styles */
.alert {
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
}

.alert-success {
    background: #ecfdf5;
    border: 1px solid #10b981;
    color: #065f46;
}

.alert-danger {
    background: #fef2f2;
    border: 1px solid #ef4444;
    color: #991b1b;
}

.alert-info {
    background: #eff6ff;
    border: 1px solid #3b82f6;
    color: #1e40af;
}

/* Form Text */
.form-text {
    font-size: 11px;
    color: #6c757d;
    margin-top: 4px;
}

/* Preview Images */
.preview-img {
    max-height: 50px;
    margin-top: 10px;
    border-radius: 8px;
}

/* Row Gap */
.row.g-3 {
    --bs-gutter-y: 1rem;
}

/* Responsive Grid */
@media (max-width: 768px) {
    .col-md-3, .col-md-4, .col-md-6, .col-md-8, .col-md-9, .col-md-12 {
        margin-bottom: 15px;
    }
}

/* Switch Toggle */
.form-switch {
    padding-left: 0;
}

.form-check-input {
    width: 44px;
    height: 22px;
    margin-top: 0;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--gold);
    border-color: var(--gold);
}

/* Icon Circle */
.icon-circle {
    width: 40px;
    height: 40px;
    background: var(--beige-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-circle i {
    color: var(--maroon);
    font-size: 18px;
}

/* Page Header */
.page-header h4 {
    font-size: 22px;
    margin: 0;
}

@media (max-width: 768px) {
    .page-header h4 {
        font-size: 18px;
    }
    
    .page-header p {
        font-size: 13px;
    }
}

.text-gold {
    color: var(--gold);
}

.text-maroon {
    color: var(--maroon);
}

.bg-maroon {
    background: var(--maroon);
}

/* Save Button Container */
.d-flex.gap-2 {
    gap: 10px;
}

@media (max-width: 768px) {
    .btn-lg {
        padding: 10px 20px;
        font-size: 14px;
        width: 100%;
    }
    
    .d-flex.justify-content-end {
        flex-direction: column;
    }
}
</style>

<div class="admin-content">
  <div class="page-header mb-4">
    <h4 class="mb-1"><i class="fas fa-cog me-2 text-gold"></i>Site Settings</h4>
    <p class="text-muted mb-0">Configure all aspects of your website</p>
  </div>

  <?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <i class="fas fa-check-circle me-2"></i><?= $success ?>
      <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  
  <?php if ($errors): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <?= implode('<br>', array_map('htmlspecialchars', $errors)) ?>
      <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <!-- Sidebar Tabs -->
    <div class="col-md-3">
      <div class="card sticky-top" style="top:80px">
        <div class="card-body p-2 p-md-3">
          <nav class="nav flex-column flex-md-column flex-row flex-wrap" id="settingsTabs">
            <?php
            $tabs = [
                'general'  => ['icon'=>'fa-home',      'label'=>'General'],
                'contact'  => ['icon'=>'fa-phone',     'label'=>'Contact'],
                'social'   => ['icon'=>'fa-share-alt', 'label'=>'Social Media'],
                'seo'      => ['icon'=>'fa-search',    'label'=>'SEO & Analytics'],
                'sections' => ['icon'=>'fa-toggle-on', 'label'=>'Section Control'],
                'email'    => ['icon'=>'fa-envelope',  'label'=>'Email / SMTP'],
            ];
            foreach ($tabs as $key => $tab):
            ?>
              <a href="#" class="nav-link settings-tab-link px-3 py-2 rounded mb-1 <?= $active_tab === $key ? 'active bg-maroon text-white' : 'text-dark' ?>" data-tab="<?= $key ?>">
                <i class="fas <?= $tab['icon'] ?> me-2"></i><?= $tab['label'] ?>
              </a>
            <?php endforeach; ?>
          </nav>
        </div>
      </div>
    </div>

    <!-- Settings Panels -->
    <div class="col-md-9">
      <form method="POST" enctype="multipart/form-data" id="settingsForm">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input type="hidden" name="active_tab" id="activeTabInput" value="<?= htmlspecialchars($active_tab) ?>">

        <!-- GENERAL -->
        <div class="settings-panel card" id="panel-general" style="<?= $active_tab !== 'general' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-home me-2"></i>General Settings</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label">Site Name</label>
                <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($s['site_name'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Tagline</label>
                <input type="text" name="site_tagline" class="form-control" value="<?= htmlspecialchars($s['site_tagline'] ?? '') ?>">
              </div>
              <div class="col-12">
                <label class="form-label">Site Description</label>
                <textarea name="site_description" class="form-control" rows="3"><?= htmlspecialchars($s['site_description'] ?? '') ?></textarea>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Logo</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <?php if (!empty($s['site_logo'])): ?>
                  <div class="mt-2"><img src="<?= SITE_URL . '/' . htmlspecialchars($s['site_logo']) ?>" class="preview-img" alt="Logo"></div>
                <?php endif; ?>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Favicon</label>
                <input type="file" name="favicon" class="form-control" accept="image/*">
                <?php if (!empty($s['site_favicon'])): ?>
                  <div class="mt-2"><img src="<?= SITE_URL . '/' . htmlspecialchars($s['site_favicon']) ?>" class="preview-img" style="max-height:32px" alt="Favicon"></div>
                <?php endif; ?>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Established Year</label>
                <input type="text" name="established_year" class="form-control" value="<?= htmlspecialchars($s['established_year'] ?? '') ?>" placeholder="e.g. 2010">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Footer Text</label>
                <input type="text" name="footer_text" class="form-control" value="<?= htmlspecialchars($s['footer_text'] ?? '') ?>">
              </div>
              <div class="col-12"><hr><h6 class="text-muted">Homepage Stats</h6></div>
              <div class="col-12 col-md-4">
                <label class="form-label">Properties Sold</label>
                <input type="text" name="properties_count" class="form-control" value="<?= htmlspecialchars($s['properties_count'] ?? '500+') ?>">
              </div>
              <div class="col-12 col-md-4">
                <label class="form-label">Happy Clients</label>
                <input type="text" name="clients_count" class="form-control" value="<?= htmlspecialchars($s['clients_count'] ?? '1200+') ?>">
              </div>
              <div class="col-12 col-md-4">
                <label class="form-label">Years Experience</label>
                <input type="text" name="experience_years" class="form-control" value="<?= htmlspecialchars($s['experience_years'] ?? '15+') ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- CONTACT -->
        <div class="settings-panel card" id="panel-contact" style="<?= $active_tab !== 'contact' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-phone me-2"></i>Contact Information</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label">Primary Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($s['contact_phone'] ?? '') ?>" placeholder="+91 98765 43210">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Alternate Phone</label>
                <input type="text" name="phone_alt" class="form-control" value="<?= htmlspecialchars($s['contact_phone2'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Primary Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($s['contact_email'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Alternate Email</label>
                <input type="email" name="email_alt" class="form-control" value="<?= htmlspecialchars($s['contact_email2'] ?? '') ?>">
              </div>
              <div class="col-12">
                <label class="form-label">Office Address</label>
                <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($s['contact_address'] ?? '') ?></textarea>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">WhatsApp Number</label>
                <input type="text" name="whatsapp" class="form-control" value="<?= htmlspecialchars($s['whatsapp_number'] ?? '') ?>" placeholder="919876543210 (with country code, no +)">
                <div class="form-text">Include country code without + sign</div>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Office Hours</label>
                <input type="text" name="office_hours" class="form-control" value="<?= htmlspecialchars($s['office_hours'] ?? '') ?>" placeholder="Mon-Sat: 9AM - 7PM">
              </div>
              <div class="col-12">
                <label class="form-label">Google Maps Embed URL/Code</label>
                <textarea name="map_embed" class="form-control" rows="4" placeholder="Paste your Google Maps embed iframe code here..."><?= htmlspecialchars($s['map_embed'] ?? '') ?></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- SOCIAL -->
        <div class="settings-panel card" id="panel-social" style="<?= $active_tab !== 'social' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-share-alt me-2"></i>Social Media Links</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <?php
              $socials = [
                'facebook'  => ['icon'=>'fa-facebook-f',  'color'=>'#1877F2', 'label'=>'Facebook',    'db_key'=>'facebook_url'],
                'instagram' => ['icon'=>'fa-instagram',   'color'=>'#E4405F', 'label'=>'Instagram',   'db_key'=>'instagram_url'],
                'twitter'   => ['icon'=>'fa-twitter',     'color'=>'#1DA1F2', 'label'=>'Twitter / X', 'db_key'=>'twitter_url'],
                'youtube'   => ['icon'=>'fa-youtube',     'color'=>'#FF0000', 'label'=>'YouTube',     'db_key'=>'youtube_url'],
                'linkedin'  => ['icon'=>'fa-linkedin-in', 'color'=>'#0A66C2', 'label'=>'LinkedIn',    'db_key'=>'linkedin_url'],
                'pinterest' => ['icon'=>'fa-pinterest-p', 'color'=>'#E60023', 'label'=>'Pinterest',   'db_key'=>'pinterest_url'],
              ];
              foreach ($socials as $key => $social): ?>
              <div class="col-12 col-md-6">
                <label class="form-label">
                  <i class="fab <?= $social['icon'] ?> me-1" style="color:<?= $social['color'] ?>"></i>
                  <?= $social['label'] ?>
                </label>
                <input type="url" name="<?= $key ?>" class="form-control" value="<?= htmlspecialchars($s[$social['db_key']] ?? '') ?>" placeholder="https://...">
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- SEO -->
        <div class="settings-panel card" id="panel-seo" style="<?= $active_tab !== 'seo' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-search me-2"></i>SEO &amp; Analytics</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Default Meta Title</label>
                <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($s['meta_title'] ?? '') ?>" maxlength="70">
                <div class="form-text">Recommended: 50–60 characters</div>
              </div>
              <div class="col-12">
                <label class="form-label">Default Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3" maxlength="160"><?= htmlspecialchars($s['meta_description'] ?? '') ?></textarea>
                <div class="form-text">Recommended: 150–160 characters</div>
              </div>
              <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" class="form-control" value="<?= htmlspecialchars($s['meta_keywords'] ?? '') ?>" placeholder="real estate, property, apartments, ...">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Google Analytics ID</label>
                <input type="text" name="google_analytics" class="form-control" value="<?= htmlspecialchars($s['google_analytics'] ?? '') ?>" placeholder="G-XXXXXXXXXX">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Google Tag Manager ID</label>
                <input type="text" name="google_tag" class="form-control" value="<?= htmlspecialchars($s['google_tag'] ?? '') ?>" placeholder="GTM-XXXXXXX">
              </div>
            </div>
          </div>
        </div>

        <!-- SECTIONS -->
        <div class="settings-panel card" id="panel-sections" style="<?= $active_tab !== 'sections' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-toggle-on me-2"></i>Homepage Section Control</h5></div>
          <div class="card-body">
            <p class="text-muted mb-3">Toggle which sections appear on your homepage.</p>
            <div class="row g-3">
              <?php
              $section_opts = [
                'section_hero'        => ['icon'=>'fa-image',          'label'=>'Hero / Banner Section',          'desc'=>'Full-width hero with search'],
                'section_featured'    => ['icon'=>'fa-home',           'label'=>'Featured Properties',            'desc'=>'Grid of featured listings'],
                'section_stats'       => ['icon'=>'fa-chart-bar',      'label'=>'Statistics Counter',             'desc'=>'Properties sold, clients, years'],
                'section_services'    => ['icon'=>'fa-concierge-bell', 'label'=>'Services Section',               'desc'=>'What we offer cards'],
                'section_testimonials'=> ['icon'=>'fa-quote-right',    'label'=>'Testimonials / Reviews',         'desc'=>'Client testimonial slider'],
                'section_team'        => ['icon'=>'fa-users',          'label'=>'Team Section',                   'desc'=>'Meet our team cards'],
                'section_blog'        => ['icon'=>'fa-blog',           'label'=>'Latest Blog Posts',              'desc'=>'Recent articles on homepage'],
                'section_cta'         => ['icon'=>'fa-bullhorn',       'label'=>'Call-to-Action Section',         'desc'=>'Bottom CTA / contact banner'],
                'section_popup'       => ['icon'=>'fa-bell',           'label'=>'Lead Popup Form',                'desc'=>'Triggered on scroll'],
                'section_sticky'      => ['icon'=>'fa-thumbtack',      'label'=>'Sticky Call / WhatsApp Buttons', 'desc'=>'Floating action buttons'],
              ];
              foreach ($section_opts as $key => $opt):
                $checked = ($s[$key] ?? '1') === '1';
              ?>
              <div class="col-12 col-md-6">
                <div class="section-card d-flex justify-content-between align-items-center p-3 border rounded-3 <?= $checked ? 'border-success' : 'border-secondary' ?>">
                  <div class="d-flex gap-3 align-items-center">
                    <div class="icon-circle">
                      <i class="fas <?= $opt['icon'] ?>"></i>
                    </div>
                    <div>
                      <div class="fw-semibold"><?= $opt['label'] ?></div>
                      <small class="text-muted"><?= $opt['desc'] ?></small>
                    </div>
                  </div>
                  <div class="form-check form-switch ms-3">
                    <input class="form-check-input section-toggle" type="checkbox" name="<?= $key ?>" id="<?= $key ?>" <?= $checked ? 'checked' : '' ?>>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- EMAIL / SMTP -->
        <div class="settings-panel card" id="panel-email" style="<?= $active_tab !== 'email' ? 'display:none' : '' ?>">
          <div class="card-header"><h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Email / SMTP Configuration</h5></div>
          <div class="card-body">
            <div class="alert alert-info mb-3"><i class="fas fa-info-circle me-2"></i>Configure SMTP to send lead notification emails.</div>
            <div class="row g-3">
              <div class="col-12 col-md-8">
                <label class="form-label">SMTP Host</label>
                <input type="text" name="smtp_host" class="form-control" value="<?= htmlspecialchars($s['smtp_host'] ?? '') ?>" placeholder="smtp.gmail.com">
              </div>
              <div class="col-12 col-md-4">
                <label class="form-label">SMTP Port</label>
                <input type="number" name="smtp_port" class="form-control" value="<?= htmlspecialchars($s['smtp_port'] ?? '587') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">SMTP Username</label>
                <input type="text" name="smtp_user" class="form-control" value="<?= htmlspecialchars($s['smtp_user'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">SMTP Password</label>
                <input type="password" name="smtp_pass" class="form-control" value="<?= htmlspecialchars($s['smtp_pass'] ?? '') ?>" placeholder="Leave blank to keep current">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">From Email</label>
                <input type="email" name="smtp_from" class="form-control" value="<?= htmlspecialchars($s['smtp_from'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">From Name</label>
                <input type="text" name="smtp_from_name" class="form-control" value="<?= htmlspecialchars($s['smtp_from_name'] ?? '') ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Encryption</label>
                <select name="smtp_secure" class="form-select">
                  <option value="tls" <?= ($s['smtp_secure'] ?? 'tls') === 'tls' ? 'selected' : '' ?>>TLS (Recommended)</option>
                  <option value="ssl" <?= ($s['smtp_secure'] ?? '') === 'ssl' ? 'selected' : '' ?>>SSL</option>
                  <option value=""    <?= ($s['smtp_secure'] ?? '') === '' ? 'selected' : '' ?>>None</option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label">Notification Email</label>
                <input type="email" name="notify_email" class="form-control" value="<?= htmlspecialchars($s['notify_email'] ?? '') ?>" placeholder="Admin email to receive lead alerts">
              </div>
            </div>
          </div>
        </div>

        <!-- Save Button -->
        <div class="d-flex justify-content-end gap-2 mt-3">
          <button type="submit" class="btn btn-gold btn-lg px-5">
            <i class="fas fa-save me-2"></i>Save Settings
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.settings-tab-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const tab = this.dataset.tab;
        document.getElementById('activeTabInput').value = tab;
        document.querySelectorAll('.settings-panel').forEach(p => p.style.display = 'none');
        document.getElementById('panel-' + tab).style.display = '';
        document.querySelectorAll('.settings-tab-link').forEach(l => {
            l.classList.remove('active', 'bg-maroon', 'text-white');
            l.classList.add('text-dark');
        });
        this.classList.add('active', 'bg-maroon', 'text-white');
        this.classList.remove('text-dark');
    });
});

function updateSectionCard(checkbox) {
    const card = checkbox.closest('.section-card');
    if (checkbox.checked) {
        card.classList.remove('border-secondary');
        card.classList.add('border-success');
    } else {
        card.classList.remove('border-success');
        card.classList.add('border-secondary');
    }
}

// Add event listeners to all section toggles
document.querySelectorAll('.section-toggle').forEach(toggle => {
    toggle.addEventListener('change', function() {
        updateSectionCard(this);
    });
});
</script>

<?php require_once __DIR__ . '/layout-footer.php'; ?>