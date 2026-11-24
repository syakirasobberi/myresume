<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$skillGroups = array_filter($content['skills'] ?? [], fn($group) => !empty($group['items']));
?>
<section id="skills" class="skills section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
        <p>Technologies and practices I have used across coursework, final year projects, and internships.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
          <?php foreach ($skillGroups as $group): ?>
          <div class="col-lg-3 col-md-6">
            <div class="skill-group">
              <div class="skill-group-head">
                <i class="bi <?= h($group['icon'] ?? 'bi-check2-circle') ?>" aria-hidden="true"></i>
                <h3><?= h($group['title'] ?? '') ?></h3>
              </div>
              <ul class="skill-tags">
                <?php foreach ($group['items'] as $skill): ?>
                <li><?= h($skill) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </section>
