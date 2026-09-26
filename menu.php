<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
  $anchorBase = $currentPage === 'index.php' ? '' : 'index.php';
?>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="<?= $anchorBase ?>#hero" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>"><i class="bi bi-house navicon"></i><span>Home</span></a></li>
        <li><a href="<?= $anchorBase ?>#about" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>"><i class="bi bi-person navicon"></i><span>About</span></a></li>
        <li><a href="<?= $anchorBase ?>#skills" class="<?= $currentPage == 'skills.php' ? 'active' : '' ?>"><i class="bi bi-tools navicon"></i><span>Skill</span></a></li>
        <li><a href="<?= $anchorBase ?>#resume" class="<?= $currentPage == 'resume.php' ? 'active' : '' ?>"><i class="bi bi-file-earmark-text navicon"></i><span>Resume</span></a></li>
        <li><a href="<?= $anchorBase ?>#portfolio" class="<?= in_array($currentPage, ['portfolio.php', 'project-details.php'], true) ? 'active' : '' ?>"><i class="bi bi-images navicon"></i><span>Portfolio</span></a></li>
        <li><a href="<?= $anchorBase ?>#contact" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>"><i class="bi bi-envelope navicon"></i><span>Contact</span></a></li>
      </ul>
    </nav>
