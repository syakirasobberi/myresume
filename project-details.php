<?php
require_once __DIR__ . '/lib/content.php';
require_once __DIR__ . '/lib/project-details.php';

$content = resume_get_content();
$profile = $content['profile'];
$portfolio = $content['portfolio'];
$projectId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$project = null;

foreach ($portfolio['items'] as $item) {
    if ((int)$item['id'] === $projectId) {
        $project = $item;
        break;
    }
}

if (!$project) {
    http_response_code(404);
}

$details = $project ? resume_project_detail_for($project) : null;
$image = $project['image'] ?? 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg';
$screenshots = $project ? array_values(array_unique(array_filter(array_merge([$image], $details['screenshots'])))) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $project ? h($project['title']) . ' | Project Details' : 'Project Not Found' ?></title>
  <meta content="<?= $project ? h($details['outcome']) : 'Project details page' ?>" name="description">

  <link href="assets/img/Slogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&family=Roboto:wght@400;500;700&family=Raleway:wght@600;700&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css?v=<?= filemtime(__DIR__ . '/assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="project-details-page">
  <header id="header" class="header d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>
    <?php include 'menu.php'; ?>
  </header>

  <main class="main">
    <section class="project-hero section">
      <div class="container" data-aos="fade-up">
        <a href="index.php#portfolio" class="back-link"><i class="bi bi-arrow-left"></i> Back to Portfolio</a>

        <?php if (!$project): ?>
          <div class="project-not-found">
            <h1>Project Not Found</h1>
            <p>The project you are looking for is unavailable or has been removed.</p>
            <a href="index.php#portfolio" class="btn-primary-outline">View Portfolio</a>
          </div>
        <?php else: ?>
          <div class="row gy-4 align-items-center">
            <div class="col-lg-7">
              <span class="project-category"><?= h($project['category']) ?></span>
              <h1><?= h($project['title']) ?></h1>
              <p><?= h($project['description']) ?></p>
              <div class="project-actions">
                <a href="#project-content" class="btn-primary-outline">View Case Study</a>
                <a href="<?= h($image) ?>" class="btn-secondary-outline glightbox" data-gallery="project-screenshots">Open Screenshot</a>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="project-hero-image">
                <img src="<?= h($image) ?>" alt="<?= h($project['title']) ?> screenshot">
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <?php if ($project): ?>
    <section id="project-content" class="project-content section">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-8" data-aos="fade-up">
            <div class="project-detail-card">
              <h2>Problem Statement</h2>
              <p><?= h($details['problem']) ?></p>
            </div>

            <div class="project-detail-card">
              <h2>Key Features</h2>
              <div class="feature-grid">
                <?php foreach ($details['features'] as $feature): ?>
                  <div class="feature-item"><i class="bi bi-check2"></i><span><?= h($feature) ?></span></div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="project-detail-card">
              <h2>Screenshots</h2>
              <div class="screenshot-grid">
                <?php foreach ($screenshots as $screenshot): ?>
                  <a href="<?= h($screenshot) ?>" class="glightbox" data-gallery="project-screenshots">
                    <img src="<?= h($screenshot) ?>" alt="<?= h($project['title']) ?> screenshot">
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <aside class="project-sidebar">
              <div class="project-sidebar-box">
                <h3>My Role</h3>
                <p><?= h($details['role']) ?></p>
              </div>

              <div class="project-sidebar-box">
                <h3>Technologies Used</h3>
                <div class="project-tech-list">
                  <?php foreach ($details['technologies'] as $technology): ?><span><?= h($technology) ?></span><?php endforeach; ?>
                </div>
              </div>

              <div class="project-sidebar-box outcome-box">
                <h3>Outcome / Result</h3>
                <p><?= h($details['outcome']) ?></p>
              </div>

              <a href="index.php#contact" class="project-contact-link">Discuss this project <i class="bi bi-arrow-right"></i></a>
            </aside>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
  </main>

  <?php include 'footer.php'; ?>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>
