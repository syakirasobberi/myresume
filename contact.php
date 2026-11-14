<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$profile = $content['profile'];
$about = $content['about'];
$phoneHref = preg_replace('/[^0-9+]/', '', $about['phone']);
?>
      <section id="contact" class="contact section">
        
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Interested in working together or discussing an opportunity? I am ready to connect.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4 align-items-stretch justify-content-center">

          <div class="col-lg-5">
            <div class="contact-card contact-intro h-100">
              <span class="contact-eyebrow">Let’s Connect</span>
              <h3>Open to web development, software engineering, and QA opportunities.</h3>
              <p>I am available for graduate trainee, junior developer, business analyst, and QA analyst roles. Reach out if my skills and background match your team’s needs.</p>

              <div class="contact-actions">
                <a href="mailto:<?= h($about['email']) ?>" class="btn-primary-outline">Email Me</a>
                <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>" class="btn-secondary-outline">LinkedIn</a><?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-card h-100">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p><a href="mailto:<?= h($about['email']) ?>"><?= h($about['email']) ?></a></p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Phone / WhatsApp</h3>
                <p><a href="tel:<?= h($phoneHref) ?>"><?= h($about['phone']) ?></a></p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Location</h3>
                <p><?= h($about['city']) ?></p>
              </div>
            </div><!-- End Info Item -->

              <?php if (!empty($profile['linkedin'])): ?>
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-linkedin flex-shrink-0"></i>
                <div>
                  <h3>LinkedIn</h3>
                  <p><a href="<?= h($profile['linkedin']) ?>">View my LinkedIn profile</a></p>
                </div>
              </div><!-- End Info Item -->
              <?php endif; ?>
            </div>
          </div>

        </div>

      </div>
      </section>
