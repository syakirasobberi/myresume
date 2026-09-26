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
      <div class="row gy-4 justify-content-center align-items-center about-card">
        <div class="col-lg-4 text-center">
          <img src="<?= h($profile['profile_image']) ?>" class="img-fluid about-photo" alt="<?= h($profile['name']) ?>">
        </div>
        <div class="col-lg-8 content">
          <h2><?= h($profile['headline']) ?></h2>
          <p class="about-tagline py-3"><?= h($about['tagline']) ?></p>

          <div class="row professional-details">
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-globe2"></i> <strong>Portfolio:</strong> <span><a href="<?= h($about['website']) ?>"><?= h($about['website']) ?></a></span></li>
                <li><i class="bi bi-telephone"></i> <strong>Phone:</strong> <span><?= h($about['phone']) ?></span></li>
                <li><i class="bi bi-geo-alt"></i> <strong>Location:</strong> <span><?= h($about['city']) ?></span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-mortarboard"></i> <strong>Education:</strong> <span><?= h($about['degree']) ?></span></li>
                <li><i class="bi bi-envelope"></i> <strong>Email:</strong> <span><?= h($about['email']) ?></span></li>
                <li><i class="bi bi-briefcase"></i> <strong>Availability:</strong> <span><?= h(ucfirst($about['freelance'])) ?></span></li>
              </ul>
            </div>
          </div>
          <p class="py-3"><?= h($about['details']) ?></p>
    
        </div>
      </div>
    </div>
    </section><!-- End About Section -->
