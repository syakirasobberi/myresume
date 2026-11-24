<?php
require_once __DIR__ . '/lib/content.php';
require_once __DIR__ . '/lib/project-details.php';
$content = resume_get_content();
$portfolio = $content['portfolio'];

$featured = null;
$gridItems = [];
foreach ($portfolio['items'] as $item) {
    if (!$featured && !empty($item['featured'])) {
        $featured = $item;
    } else {
        $gridItems[] = $item;
    }
}
?>
<!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p><?= h($portfolio['intro']) ?></p>
      </div><!-- End Section Title -->

      <div class="container">

        <?php if ($featured): ?>
        <?php
          $fImage = $featured['image'] ?: 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg';
          $fDetails = resume_project_detail_for($featured);
          $fGithub = resume_url($featured['github'] ?? '');
          $fDemo = resume_url($featured['link'] ?? '');
        ?>
        <article class="featured-project" data-aos="fade-up">
          <div class="row g-0">
            <div class="col-lg-6">
              <a href="project-details.php?id=<?= h($featured['id']) ?>" class="featured-project-media">
                <img src="<?= h($fImage) ?>" alt="<?= h($featured['title']) ?> screenshot">
              </a>
            </div>
            <div class="col-lg-6">
              <div class="featured-project-body">
                <span class="featured-badge"><i class="bi bi-star-fill" aria-hidden="true"></i> Featured Project</span>
                <h3><?= h($featured['title']) ?></h3>
                <p class="featured-project-summary"><?= h($featured['description']) ?></p>
                <ul class="featured-project-points">
                  <?php foreach (array_slice($fDetails['features'], 0, 4) as $feature): ?>
                  <li><i class="bi bi-check2" aria-hidden="true"></i><?= h($feature) ?></li>
                  <?php endforeach; ?>
                </ul>
                <div class="portfolio-stack">
                  <?php foreach ($fDetails['technologies'] as $tool): ?><span><?= h($tool) ?></span><?php endforeach; ?>
                </div>
                <p class="featured-project-outcome"><i class="bi bi-trophy" aria-hidden="true"></i> <?= h($fDetails['outcome']) ?></p>
                <div class="featured-project-actions">
                  <a href="project-details.php?id=<?= h($featured['id']) ?>" class="btn-primary-outline">View Case Study</a>
                  <?php if ($fGithub): ?><a href="<?= h($fGithub) ?>" class="btn-ghost-dark" target="_blank" rel="noopener"><i class="bi bi-github" aria-hidden="true"></i> Source Code</a><?php endif; ?>
                  <?php if ($fDemo): ?><a href="<?= h($fDemo) ?>" class="btn-ghost-dark" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Live Demo</a><?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </article>
        <?php endif; ?>

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Projects</li>
            <li data-filter=".filter-product">Internship</li>
            <li data-filter=".filter-branding">Assignments</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <?php foreach ($gridItems as $item): ?>
            <?php $image = $item['image'] ?: 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg'; ?>
            <?php $details = resume_project_detail_for($item); ?>
            <?php $github = resume_url($item['github'] ?? ''); ?>
            <?php $demo = resume_url($item['link'] ?? ''); ?>
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?= h(resume_filter_class($item['category'])) ?>">
              <div class="portfolio-card">
              <img src="<?= h($image) ?>" class="img-fluid" alt="<?= h($item['title']) ?>" loading="lazy">
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
                <a href="<?= h($image) ?>" title="<?= h($item['title']) ?>" aria-label="Preview <?= h($item['title']) ?> image" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="project-details.php?id=<?= h($item['id']) ?>" title="Project Details" aria-label="<?= h($item['title']) ?> details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                <?php if ($github): ?><a href="<?= h($github) ?>" title="Source code on GitHub" aria-label="<?= h($item['title']) ?> source code on GitHub" class="details-link" target="_blank" rel="noopener"><i class="bi bi-github"></i></a><?php endif; ?>
                <?php if ($demo): ?><a href="<?= h($demo) ?>" title="Live demo" aria-label="<?= h($item['title']) ?> live demo" class="details-link" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i></a><?php endif; ?>
              </div>
              </div>
            </div><!-- End Portfolio Item -->
            <?php endforeach; ?>

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->
