<?php
require_once __DIR__ . '/lib/content.php';
$content = resume_get_content();
$profile = $content['profile'];
?>
 <footer id="footer" class="footer position-relative light-background">
    <div class="container">
      <h3 class="sitename"><?= h($profile['name']) ?></h3>
      <p>Professional portfolio showcasing software engineering, QA, and web development experience.</p>
      <div class="social-links d-flex justify-content-center">
        <?php if (!empty($profile['facebook'])): ?><a href="<?= h($profile['facebook']) ?>"><i class="bi bi-facebook"></i></a><?php endif; ?>
        <?php if (!empty($profile['instagram'])): ?><a href="<?= h($profile['instagram']) ?>"><i class="bi bi-instagram"></i></a><?php endif; ?>
        <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>"><i class="bi bi-linkedin"></i></a><?php endif; ?>
      </div>
      <div class="container">
        <div class="copyright">
          <span>Copyright</span> <strong class="px-1 sitename"><?= h($profile['name']) ?></strong> <span>All Rights Reserved</span>
        </div>
    
      </div>
    </div>
  </footer>
