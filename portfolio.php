<?php
require_once __DIR__ . '/lib/content.php';
require_once __DIR__ . '/lib/project-details.php';
$content = resume_get_content();
$portfolio = $content['portfolio'];
?>
<!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p><?= h($portfolio['intro']) ?></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Projects</li>
            <li data-filter=".filter-product">Internship</li>
            <li data-filter=".filter-branding">Assignments</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <?php foreach ($portfolio['items'] as $item): ?>
            <?php $image = $item['image'] ?: 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg'; ?>
            <?php $details = resume_project_detail_for($item); ?>
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?= h(resume_filter_class($item['category'])) ?>">
              <div class="portfolio-card">
              <img src="<?= h($image) ?>" class="img-fluid" alt="<?= h($item['title']) ?>">
              <div class="portfolio-info">
                <span class="portfolio-category"><?= h($item['category']) ?></span>
                <h4><?= h($item['title']) ?></h4>
                <p><?= h($item['description']) ?></p>
                <div class="portfolio-details-mini">
                  <strong>Role:</strong> <?= h($details['role']) ?>
                </div>
                <div class="portfolio-stack">
                  <?php foreach (array_slice($details['technologies'], 0, 4) as $tool): ?><span><?= h($tool) ?></span><?php endforeach; ?>
                </div>
                <p class="portfolio-outcome"><?= h($details['outcome']) ?></p>
                <a href="<?= h($image) ?>" title="<?= h($item['title']) ?>" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="project-details.php?id=<?= h($item['id']) ?>" title="Project Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
              </div>
            </div><!-- End Portfolio Item -->
            <?php endforeach; ?>

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->
