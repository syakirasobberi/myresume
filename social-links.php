<?php
// Shared social icon links. Expects $profile from lib/content.php.
$socialLinks = [
    'github' => ['bi-github', 'GitHub'],
    'linkedin' => ['bi-linkedin', 'LinkedIn'],
    'facebook' => ['bi-facebook', 'Facebook'],
    'instagram' => ['bi-instagram', 'Instagram'],
];

foreach ($socialLinks as $key => [$icon, $label]):
    if (empty($profile[$key])) {
        continue;
    }
?>
<a href="<?= h($profile[$key]) ?>" aria-label="<?= h($label) ?>" title="<?= h($label) ?>" target="_blank" rel="noopener"><i class="bi <?= h($icon) ?>"></i></a>
<?php endforeach; ?>
