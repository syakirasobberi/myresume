<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$profile = $content['profile'];
$cta = $content['cta'] ?? [];
?>
<section id="hire" class="hire-cta section">
  <div class="container" data-aos="zoom-in">
    <div class="hire-cta-card">
      <span><?= h($cta['label'] ?? 'Open To Opportunities') ?></span>
      <h2><?= h($cta['title'] ?? 'Available for graduate trainee, junior developer, business analyst, and QA analyst roles.') ?></h2>
      <p><?= h($cta['text'] ?? 'I am ready to contribute to professional software teams through web development, testing, documentation, and continuous improvement.') ?></p>
      <div class="hire-cta-actions">
        <a href="#contact" class="btn-primary-outline">Contact Me</a>
        <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>" class="btn-secondary-outline">View LinkedIn</a><?php endif; ?>
      </div>
    </div>
  </div>
</section>
