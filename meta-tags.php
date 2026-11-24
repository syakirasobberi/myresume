<?php
// Shared <head> tags for search results and link previews (LinkedIn, WhatsApp, etc.).
// Expects: $metaTitle, $metaDescription, $metaImage (site-relative path), $metaPath (site-relative page URL).
$baseUrl = resume_base_url();
$metaUrl = $baseUrl . ltrim($metaPath ?? '', '/');
$metaImageUrl = $baseUrl . ltrim($metaImage ?? 'assets/img/og-image.jpg', '/');
?>
  <title><?= h($metaTitle) ?></title>
  <meta name="description" content="<?= h($metaDescription) ?>">
  <link rel="canonical" href="<?= h($metaUrl) ?>">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= h($profile['name']) ?> Portfolio">
  <meta property="og:title" content="<?= h($metaTitle) ?>">
  <meta property="og:description" content="<?= h($metaDescription) ?>">
  <meta property="og:url" content="<?= h($metaUrl) ?>">
  <meta property="og:image" content="<?= h($metaImageUrl) ?>">
  <meta property="og:image:alt" content="<?= h($metaTitle) ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= h($metaTitle) ?>">
  <meta name="twitter:description" content="<?= h($metaDescription) ?>">
  <meta name="twitter:image" content="<?= h($metaImageUrl) ?>">
