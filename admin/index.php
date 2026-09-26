<?php
require_once __DIR__ . '/_bootstrap.php';
admin_require_login();

$content = resume_get_content();
$saved = false;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $content['profile']['name'] = admin_post('name');
    $content['profile']['headline'] = admin_post('headline');
    $content['profile']['typed_items'] = admin_post('typed_items');
    $content['profile']['facebook'] = admin_post('facebook');
    $content['profile']['instagram'] = admin_post('instagram');
    $content['profile']['linkedin'] = admin_post('linkedin');
    $content['profile']['background_image'] = admin_upload_image('background_image', $content['profile']['background_image']);
    $content['profile']['profile_image'] = admin_upload_image('profile_image', $content['profile']['profile_image']);

    foreach (['intro', 'tagline', 'birthday', 'website', 'phone', 'city', 'age', 'degree', 'email', 'freelance', 'details'] as $field) {
        $content['about'][$field] = admin_post($field);
    }

    $highlights = [];
    foreach ($_POST['highlights'] ?? [] as $highlight) {
        $title = trim((string)($highlight['title'] ?? ''));
        $description = trim((string)($highlight['description'] ?? ''));

        if ($title === '' && $description === '') {
            continue;
        }

        $highlights[] = [
            'icon' => trim((string)($highlight['icon'] ?? 'bi-check2-circle')) ?: 'bi-check2-circle',
            'title' => $title,
            'description' => $description,
        ];
    }

    $content['highlights'] = $highlights;
    $content['tech_stack'] = admin_list_from_text(admin_post('tech_stack'));
    $content['cta'] = [
        'label' => admin_post('cta_label'),
        'title' => admin_post('cta_title'),
        'text' => admin_post('cta_text'),
    ];

    $saved = resume_save_content($content);
}

$profile = $content['profile'];
$about = $content['about'];
$highlights = $content['highlights'] ?? [];
$techStack = $content['tech_stack'] ?? [];
$cta = $content['cta'] ?? [];
admin_header('About');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">About & Profile</h1>
</div>
<?php if ($saved): ?><div class="alert alert-success">Saved successfully.</div><?php endif; ?>
<form class="card" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <h2 class="h5 mb-3">Hero / Profile</h2>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="<?= h($profile['name']) ?>" required></div>
            <div class="col-md-6"><label class="form-label">Headline</label><input class="form-control" name="headline" value="<?= h($profile['headline']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Typed Items</label><input class="form-control" name="typed_items" value="<?= h($profile['typed_items']) ?>"><div class="form-text">Separate items with commas.</div></div>
            <div class="col-md-6"><label class="form-label">Background Image</label><input class="form-control" type="file" name="background_image" accept="image/*"><div class="form-text">Current: <?= h($profile['background_image']) ?></div></div>
            <div class="col-md-6"><label class="form-label">Profile Image</label><input class="form-control" type="file" name="profile_image" accept="image/*"><div class="form-text">Current: <?= h($profile['profile_image']) ?></div></div>
            <div class="col-md-6"><label class="form-label">Facebook URL</label><input class="form-control" name="facebook" value="<?= h($profile['facebook']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Instagram URL</label><input class="form-control" name="instagram" value="<?= h($profile['instagram']) ?>"></div>
            <div class="col-md-6"><label class="form-label">LinkedIn URL</label><input class="form-control" name="linkedin" value="<?= h($profile['linkedin']) ?>"></div>
        </div>

        <hr class="my-4">
        <h2 class="h5 mb-3">About Details</h2>
        <div class="row g-3">
            <div class="col-12"><label class="form-label">About Intro</label><textarea class="form-control" name="intro"><?= h($about['intro']) ?></textarea></div>
            <div class="col-12"><label class="form-label">Tagline</label><textarea class="form-control" name="tagline"><?= h($about['tagline']) ?></textarea></div>
            <input type="hidden" name="birthday" value="<?= h($about['birthday']) ?>">
            <div class="col-md-6"><label class="form-label">Website</label><input class="form-control" name="website" value="<?= h($about['website']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="phone" value="<?= h($about['phone']) ?>"></div>
            <div class="col-md-6"><label class="form-label">City</label><input class="form-control" name="city" value="<?= h($about['city']) ?>"></div>
            <input type="hidden" name="age" value="<?= h($about['age']) ?>">
            <div class="col-md-6"><label class="form-label">Degree</label><input class="form-control" name="degree" value="<?= h($about['degree']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="<?= h($about['email']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Freelance</label><input class="form-control" name="freelance" value="<?= h($about['freelance']) ?>"></div>
            <div class="col-12"><label class="form-label">Details Paragraph</label><textarea class="form-control" name="details"><?= h($about['details']) ?></textarea></div>
        </div>

        <hr class="my-4">
        <h2 class="h5 mb-3">Professional Highlights</h2>
        <div class="row g-3">
            <?php for ($index = 0; $index < 4; $index++): ?>
            <?php $highlight = $highlights[$index] ?? ['icon' => 'bi-check2-circle', 'title' => '', 'description' => '']; ?>
            <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                    <div class="mb-2"><label class="form-label">Icon Class</label><input class="form-control" name="highlights[<?= $index ?>][icon]" value="<?= h($highlight['icon']) ?>"><div class="form-text">Example: bi-code-slash, bi-bug, bi-people</div></div>
                    <div class="mb-2"><label class="form-label">Title</label><input class="form-control" name="highlights[<?= $index ?>][title]" value="<?= h($highlight['title']) ?>"></div>
                    <div><label class="form-label">Description</label><textarea class="form-control" name="highlights[<?= $index ?>][description]"><?= h($highlight['description']) ?></textarea></div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

        <hr class="my-4">
        <h2 class="h5 mb-3">Tech Stack</h2>
        <div class="row g-3">
            <div class="col-12"><label class="form-label">Tools & Technologies</label><textarea class="form-control" name="tech_stack"><?= h(admin_text_from_list($techStack)) ?></textarea><div class="form-text">Enter one item per line or separate with commas.</div></div>
        </div>

        <hr class="my-4">
        <h2 class="h5 mb-3">Hiring CTA</h2>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Label</label><input class="form-control" name="cta_label" value="<?= h($cta['label'] ?? '') ?>"></div>
            <div class="col-md-6"><label class="form-label">Title</label><input class="form-control" name="cta_title" value="<?= h($cta['title'] ?? '') ?>"></div>
            <div class="col-12"><label class="form-label">Text</label><textarea class="form-control" name="cta_text"><?= h($cta['text'] ?? '') ?></textarea></div>
        </div>
    </div>
    <div class="card-footer bg-white text-end"><button class="btn btn-primary">Save Changes</button></div>
</form>
<?php admin_footer(); ?>
