<?php
require_once __DIR__ . '/_bootstrap.php';
admin_require_login();

$content = resume_get_content();
$portfolio = $content['portfolio'];
$items = $portfolio['items'];
$editId = (int)($_GET['edit'] ?? 0);
$editing = null;

foreach ($items as $item) {
    if ((int)$item['id'] === $editId) {
        $editing = $item;
        break;
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = admin_post('action');
    $id = (int)admin_post('id');

    if ($action === 'intro') {
        $portfolio['intro'] = admin_post('intro');
    } elseif ($action === 'delete') {
        $items = array_values(array_filter($items, fn($item) => (int)$item['id'] !== $id));
        $portfolio['items'] = $items;
    } else {
        $currentImage = admin_post('current_image');
        $item = [
            'id' => $id ?: resume_next_id($items),
            'title' => admin_post('title'),
            'category' => admin_post('category'),
            'description' => admin_post('description'),
            'image' => admin_upload_image('image', $currentImage),
            'link' => admin_post('link') ?: '#',
            'problem' => admin_post('problem'),
            'role' => admin_post('role'),
            'technologies' => admin_list_from_text(admin_post('technologies')),
            'features' => admin_list_from_text(admin_post('features')),
            'outcome' => admin_post('outcome'),
            'screenshots' => admin_list_from_text(admin_post('screenshots')),
        ];

        if ($id) {
            foreach ($items as $index => $row) {
                if ((int)$row['id'] === $id) {
                    $items[$index] = $item;
                    break;
                }
            }
        } else {
            $items[] = $item;
        }

        $portfolio['items'] = $items;
    }

    $content['portfolio'] = $portfolio;
    resume_save_content($content);
    admin_redirect('portfolio.php?saved=1');
}

admin_header('Portfolio');
?>
<h1 class="h3 mb-3">Portfolio</h1>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Saved successfully.</div><?php endif; ?>
<form class="card mb-4" method="post">
    <div class="card-body"><input type="hidden" name="action" value="intro"><label class="form-label">Section Intro</label><textarea class="form-control" name="intro"><?= h($portfolio['intro']) ?></textarea></div>
    <div class="card-footer bg-white text-end"><button class="btn btn-primary">Save Intro</button></div>
</form>
<div class="row g-4">
    <div class="col-lg-4">
        <form class="card" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <h2 class="h5 mb-3"><?= $editing ? 'Edit Project' : 'Add Project' ?></h2>
                <input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>"><input type="hidden" name="current_image" value="<?= h($editing['image'] ?? '') ?>">
                <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="title" value="<?= h($editing['title'] ?? '') ?>" required></div>
                <div class="mb-3"><label class="form-label">Category</label><select class="form-select" name="category"><option <?= (($editing['category'] ?? '') === 'Projects') ? 'selected' : '' ?>>Projects</option><option <?= (($editing['category'] ?? '') === 'Internship') ? 'selected' : '' ?>>Internship</option><option <?= (($editing['category'] ?? '') === 'Assignments') ? 'selected' : '' ?>>Assignments</option></select></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description"><?= h($editing['description'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Image</label><input class="form-control" type="file" name="image" accept="image/*"><div class="form-text">Current: <?= h($editing['image'] ?? 'none') ?></div></div>
                <div class="mb-3"><label class="form-label">Link</label><input class="form-control" name="link" value="<?= h($editing['link'] ?? '#') ?>"></div>
                <hr>
                <h3 class="h6 mb-3">Project Details Page</h3>
                <div class="mb-3"><label class="form-label">Problem Statement</label><textarea class="form-control" name="problem"><?= h($editing['problem'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Your Role</label><textarea class="form-control" name="role"><?= h($editing['role'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Technologies Used</label><textarea class="form-control" name="technologies"><?= h(admin_text_from_list($editing['technologies'] ?? [])) ?></textarea><div class="form-text">One item per line or comma separated.</div></div>
                <div class="mb-3"><label class="form-label">Key Features</label><textarea class="form-control" name="features"><?= h(admin_text_from_list($editing['features'] ?? [])) ?></textarea><div class="form-text">One feature per line.</div></div>
                <div class="mb-3"><label class="form-label">Outcome / Result</label><textarea class="form-control" name="outcome"><?= h($editing['outcome'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Extra Screenshot Paths</label><textarea class="form-control" name="screenshots"><?= h(admin_text_from_list($editing['screenshots'] ?? [])) ?></textarea><div class="form-text">Optional. One image path per line. Main image is included automatically.</div></div>
                <button class="btn btn-primary"><?= $editing ? 'Update' : 'Add' ?></button>
                <?php if ($editing): ?><a class="btn btn-outline-secondary" href="portfolio.php">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <div class="card"><div class="card-body table-responsive">
            <table class="table align-middle"><thead><tr><th>Project</th><th>Category</th><th class="text-end">Actions</th></tr></thead><tbody>
                <?php foreach ($items as $item): ?>
                <tr><td><?= h($item['title']) ?><br><small class="text-muted"><?= h($item['description']) ?></small></td><td><?= h($item['category']) ?></td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" target="_blank" href="../project-details.php?id=<?= h($item['id']) ?>">View</a> <a class="btn btn-sm btn-outline-primary" href="portfolio.php?edit=<?= h($item['id']) ?>">Edit</a> <form class="d-inline" method="post" onsubmit="return confirm('Delete this portfolio item?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= h($item['id']) ?>"><button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
                <?php endforeach; ?>
            </tbody></table>
        </div></div>
    </div>
</div>
<?php admin_footer(); ?>
