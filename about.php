<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$profile = $content['profile'];
$about = $content['about'];
?>
<!-- About Section -->
    <section id="about" class="about section">
<!-- About Section -->
    <div class="container section-title" data-aos="fade-up">
      <h2>About</h2>
      <p><?= h($about['intro']) ?></p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4 justify-content-center">
        <div class="col-lg-4">
          <img src="<?= h($profile['profile_image']) ?>" style="width: 300px; height: auto;" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 content">
          <h2><?= h($profile['headline']) ?></h2>
          <p class="fst-italic py-3"><?= h($about['tagline']) ?></p>

          <div class="row">
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?= h($about['birthday']) ?></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span><a href="<?= h($about['website']) ?>"><?= h($about['website']) ?></a></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?= h($about['phone']) ?></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span><?= h($about['city']) ?></span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?= h($about['age']) ?></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?= h($about['degree']) ?></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?= h($about['email']) ?></span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span><?= h($about['freelance']) ?></span></li>
              </ul>
            </div>
          </div>
          <p class="py-3"><?= h($about['details']) ?></p>
    
        </div>
      </div>
    </div>
    </section><!-- End About Section -->
