<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$skills = $content['skills'];
?>
<section id="skills" class="skills section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
        <p>Here are some of the technical skills I have developed through coursework, projects, and internships.</p>
      </div><!-- End Section Title -->

      <div class="container skills-card" data-aos="fade-up" data-aos-delay="100">

        <div class="row skills-content skills-animation">

          <?php foreach (array_chunk($skills, (int)ceil(max(count($skills), 1) / 2)) as $column): ?>
          <div class="col-lg-6">
            <?php foreach ($column as $skill): ?>
            <?php $percentage = max(0, min(100, (int)$skill['percentage'])); ?>
            <div class="progress">
              <span class="skill"><span><?= h($skill['name']) ?></span> <i class="val"><?= $percentage ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div><!-- End Skills Item -->
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>

        </div>

      </div>

    </section>
