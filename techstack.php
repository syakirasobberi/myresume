<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$techStack = $content['tech_stack'] ?? [];
?>
<section id="techstack" class="techstack section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Tech Stack</h2>
    <p>Tools and technologies used across coursework, internships, testing, and project development.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="techstack-card">
      <?php foreach ($techStack as $tool): ?>
        <span><?= h($tool) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>
