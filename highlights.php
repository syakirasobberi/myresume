<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$highlights = $content['highlights'] ?? [];
?>
<section id="highlights" class="highlights section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Professional Highlights</h2>
    <p>Key strengths and outcomes that are relevant for internship, graduate trainee, junior developer, and QA-focused opportunities.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-4">
      <?php foreach ($highlights as $highlight): ?>
      <div class="col-lg-3 col-md-6">
        <div class="highlight-card">
          <i class="bi <?= h($highlight['icon'] ?? 'bi-check2-circle') ?>"></i>
          <h3><?= h($highlight['title'] ?? '') ?></h3>
          <p><?= h($highlight['description'] ?? '') ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
