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
        <?php include __DIR__ . '/social-links.php'; ?>
      </div>
      <div class="container">
        <div class="copyright">
          <span>&copy; <?= date('Y') ?></span> <strong class="sitename"><?= h($profile['name']) ?></strong><span>. All rights reserved.</span>
        </div>
    
      </div>
    </div>
  </footer>
