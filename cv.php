<?php
// One-page, print-ready A4 resume built from data/content.json.
// The downloadable PDF (assets/resume/Nurul-Syakirah-Resume.pdf) is printed from this page;
// re-run tools/build-resume-pdf.ps1 after editing content in the admin panel.
require_once __DIR__ . '/lib/content.php';
require_once __DIR__ . '/lib/project-details.php';

$content = resume_get_content();
$profile = $content['profile'];
$about = $content['about'];
$resume = $content['resume'];
$skills = $content['skills'] ?? [];

// Projects section: real projects (not assignments), featured first.
$projects = array_values(array_filter($content['portfolio']['items'], fn($p) => strtolower($p['category'] ?? '') === 'projects'));
usort($projects, fn($a, $b) => (int)!empty($b['featured']) <=> (int)!empty($a['featured']));

$strip = fn($url) => preg_replace('#^https?://(www\.)?#', '', rtrim((string)$url, '/'));
$lines = fn($text) => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string)$text))));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title><?= h($resume['summary_name'] ?? $profile['name']) ?> — Resume</title>
<style>
  @page { size: A4; margin: 12mm 14mm; }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    color: #1e293b;
    background: #ffffff;
    font: 9.6pt/1.4 "Segoe UI", "Inter", Arial, sans-serif;
  }
  .page { max-width: 180mm; margin: 0 auto; }
  @media screen { body { background: #e2e8f0; } .page { margin: 24px auto; padding: 14mm 15mm; background: #fff; box-shadow: 0 10px 40px rgba(15,23,42,.15); max-width: 210mm; } }
  a { color: inherit; text-decoration: none; }

  header { border-bottom: 2px solid #0f766e; padding-bottom: 8pt; margin-bottom: 10pt; }
  h1 { margin: 0; font-size: 22pt; line-height: 1.1; color: #0f172a; letter-spacing: -0.01em; }
  .role { margin: 3pt 0 6pt; font-size: 11.5pt; font-weight: 600; color: #0f766e; }
  .contact { display: flex; flex-wrap: wrap; gap: 2pt 14pt; font-size: 9pt; color: #475569; }

  h2 {
    margin: 11pt 0 5pt;
    font-size: 10.5pt;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #0f766e;
    border-bottom: 1px solid #cbd5e1;
    padding-bottom: 2pt;
  }
  p { margin: 0 0 4pt; }
  .item { margin-bottom: 7pt; break-inside: avoid; }
  .item-head { display: flex; justify-content: space-between; gap: 10pt; }
  .item-title { font-weight: 700; color: #0f172a; }
  .item-date { flex-shrink: 0; color: #64748b; font-size: 9pt; }
  .item-sub { color: #475569; font-style: italic; font-size: 9.3pt; }
  ul { margin: 2pt 0 0; padding-left: 13pt; }
  li { margin-bottom: 1.5pt; }
  .tech { color: #475569; font-size: 9pt; }
  .tech strong { color: #334155; }
  .skills { display: grid; grid-template-columns: 1fr 1fr; gap: 3pt 18pt; }
  .skills div strong { color: #0f172a; }
</style>
</head>
<body>
<div class="page">
  <header>
    <h1><?= h($resume['summary_name'] ?? $profile['name']) ?></h1>
    <div class="role">Software Engineering Student · Web Developer &amp; QA Analyst</div>
    <div class="contact">
      <span><?= h($about['email']) ?></span>
      <span><?= h($resume['summary_phone'] ?? $about['phone']) ?></span>
      <span><?= h($about['city']) ?></span>
      <?php if (!empty($profile['linkedin'])): ?><a href="<?= h($profile['linkedin']) ?>"><?= h($strip($profile['linkedin'])) ?></a><?php endif; ?>
      <?php if (!empty($profile['github'])): ?><a href="<?= h($profile['github']) ?>"><?= h($strip($profile['github'])) ?></a><?php endif; ?>
      <?php if (!empty($about['website'])): ?><a href="<?= h($about['website']) ?>"><?= h($strip($about['website'])) ?></a><?php endif; ?>
    </div>
  </header>

  <h2>Summary</h2>
  <p><?= h($resume['summary_text']) ?> <?= h($about['freelance'] ? '(' . $about['freelance'] . ')' : '') ?></p>

  <h2>Skills</h2>
  <div class="skills">
    <?php foreach ($skills as $group): if (empty($group['items'])) continue; ?>
    <div><strong><?= h($group['title']) ?>:</strong> <?= h(implode(', ', $group['items'])) ?></div>
    <?php endforeach; ?>
  </div>

  <h2>Experience</h2>
  <?php foreach ($resume['experience'] as $exp): ?>
  <div class="item">
    <div class="item-head"><span class="item-title"><?= h($exp['title']) ?></span><span class="item-date"><?= h($exp['period']) ?></span></div>
    <div class="item-sub"><?= h($exp['institution']) ?></div>
    <ul><?php foreach ($lines($exp['description']) as $line): ?><li><?= h($line) ?></li><?php endforeach; ?></ul>
  </div>
  <?php endforeach; ?>

  <h2>Projects</h2>
  <?php foreach ($projects as $project): $d = resume_project_detail_for($project); ?>
  <div class="item">
    <div class="item-head">
      <span class="item-title"><?= h($project['title']) ?> — <?= h(strtok($project['description'], ':')) ?></span>
      <?php if ($gh = resume_url($project['github'] ?? '')): ?><a class="item-date" href="<?= h($gh) ?>"><?= h($strip($gh)) ?></a><?php endif; ?>
    </div>
    <ul>
      <?php foreach (array_slice($d['features'], 0, !empty($project['featured']) ? 3 : 2) as $feature): ?><li><?= h($feature) ?></li><?php endforeach; ?>
      <li><?= h($d['outcome']) ?></li>
    </ul>
    <div class="tech"><strong>Tech:</strong> <?= h(implode(', ', $d['technologies'])) ?></div>
  </div>
  <?php endforeach; ?>

  <h2>Education</h2>
  <?php foreach ($resume['education'] as $edu): ?>
  <div class="item">
    <div class="item-head"><span class="item-title"><?= h($edu['title']) ?></span><span class="item-date"><?= h($edu['period']) ?></span></div>
    <div class="item-sub"><?= h($edu['institution']) ?></div>
  </div>
  <?php endforeach; ?>
</div>
</body>
</html>
