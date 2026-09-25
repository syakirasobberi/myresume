<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$resume = $content['resume'];
?>
<section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p><?= h($resume['intro']) ?></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Sumary</h3>

            <div class="resume-item pb-0">
              <h4><?= h($resume['summary_name']) ?></h4>
              <p><em><?= h($resume['summary_text']) ?></em></p>
              <ul>
                <li><?= h($resume['summary_location']) ?></li>
                <li><?= h($resume['summary_phone']) ?></li>
                <li><a href="<?= h($resume['summary_website']) ?>"><?= h($resume['summary_website']) ?></a></li>
              </ul>
            </div><!-- End Resume Item -->

            <h3 class="resume-title">Education</h3>
            <?php foreach ($resume['education'] as $item): ?>
            <div class="resume-item">
              <h4><?= h($item['title']) ?></h4>
              <h5><?= h($item['period']) ?></h5>
              <p><em><?= h($item['institution']) ?></em></p>
              <p><?= nl2br(h($item['description'])) ?></p>
            </div><!-- End Resume Item -->
            <?php endforeach; ?>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="resume-title">Professional Experience</h3>
            <?php foreach ($resume['experience'] as $item): ?>
            <div class="resume-item">
              <h4><?= h($item['title']) ?></h4>
              <h5><?= h($item['period']) ?></h5>
              <p><em><?= h($item['institution']) ?></em></p>
              <p><?= nl2br(h($item['description'])) ?></p>
            </div><!-- End Resume Item -->
            <?php endforeach; ?>

          </div>

        </div>

      </div>

    </section><!-- /Resume Section -->
