<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>"><i class="bi bi-house navicon"></i><span>Home</span></a></li>
        <li><a href="#about" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>"><i class="bi bi-person navicon"></i><span>About</span></a></li>
        <li><a href="#skills" class="<?= $currentPage == 'skills.php' ? 'active' : '' ?>"><i class="bi bi-tools navicon"></i><span>Skill</span></a></li>
        <li><a href="#resume" class="<?= $currentPage == 'resume.php' ? 'active' : '' ?>"><i class="bi bi-file-earmark-text navicon"></i><span>Resume</span></a></li>
        <li><a href="#portfolio" class="<?= $currentPage == 'portfolio.php' ? 'active' : '' ?>"><i class="bi bi-images navicon"></i><span>Portfolio</span></a></li>
        <li><a href="#contact" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>"><i class="bi bi-envelope navicon"></i><span>Contact</span></a></li>
      </ul>
    </nav>
