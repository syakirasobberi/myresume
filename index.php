<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$profile = $content['profile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Syakirah's Resume</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/Slogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&family=Roboto:wght@400;500;700&family=Raleway:wght@600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css?v=<?= filemtime(__DIR__ . '/assets/css/main.css') ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: MyResume
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex flex-column justify-content-center">

    <i class="header-toggle d-xl-none bi bi-list"></i>

    <?php include 'menu.php'; ?>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="<?= h($profile['background_image']) ?>" alt="">

      <div class="container" data-aos="zoom-out">
        <div class="row justify-content-center">
          <div class="col-lg-9 hero-panel">
            <span class="hero-kicker">Software Engineering Portfolio</span>
            <h2><?= h($profile['name']) ?></h2>
            <p class="hero-subtitle">Aspiring <span class="typed" data-typed-items="<?= h($profile['typed_items']) ?>"><?= h(strtok($profile['typed_items'], ',')) ?></span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span> focused on reliable web systems, clean user experiences, and continuous learning.</p>
            <div class="hero-actions">
              <a href="#resume" class="btn-primary-outline">View Resume</a>
              <button type="button" class="btn-secondary-outline hero-print-button" onclick="window.print()">Save Resume PDF</button>
              <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>" class="btn-secondary-outline">LinkedIn</a><?php endif; ?>
              <a href="#contact" class="btn-secondary-outline">Contact Me</a>
            </div>
            <div class="social-links">
              <?php if (!empty($profile['facebook'])): ?><a href="<?= h($profile['facebook']) ?>"><i class="bi bi-facebook"></i></a><?php endif; ?>
              <?php if (!empty($profile['instagram'])): ?><a href="<?= h($profile['instagram']) ?>"><i class="bi bi-instagram"></i></a><?php endif; ?>
              <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>"><i class="bi bi-linkedin"></i></a><?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <?php include 'about.php'; ?>
    <!-- About Section -->

    <!-- Highlights Section -->
    <?php include 'highlights.php'; ?>
    <!-- /Highlights Section -->

    <!-- Tech Stack Section -->
    <?php include 'techstack.php'; ?>
    <!-- /Tech Stack Section -->

    <!-- Skills Section -->
    <?php include 'skills.php'; ?>
    <!-- /Skills Section -->

    <!-- Resume Section -->
    <?php include 'resume.php'; ?>

    <!-- Portfolio Section -->
    <?php include 'portfolio.php'; ?>
    <!-- /Portfolio Section -->

    <!-- Hiring CTA Section -->
    <?php include 'hire-cta.php'; ?>
    <!-- /Hiring CTA Section -->

    <!-- Contact Section -->
    <?php include 'contact.php'; ?>
    <!-- /Contact Section -->

  </main>

  <?php include 'footer.php'; ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
