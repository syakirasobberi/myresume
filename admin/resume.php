<?php
require_once __DIR__ . '/_bootstrap.php';
admin_require_login();

$content = resume_get_content();
$resume = $content['resume'];
$type = $_GET['type'] ?? 'education';
$type = $type === 'experience' ? 'experience' : 'education';
$editId = (int)($_GET['edit'] ?? 0);
$editing = null;

foreach ($resume[$type] as $item) {
    if ((int)$item['id'] === $editId) {
        $editing = $item;
        break;
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = admin_post('action');
    $postType = admin_post('type') === 'experience' ? 'experience' : 'education';
    $id = (int)admin_post('id');

    if ($action === 'summary') {
        foreach (['intro', 'summary_name', 'summary_text', 'summary_location', 'summary_phone', 'summary_website'] as $field) {
            $resume[$field] = admin_post($field);
        }
    } elseif ($action === 'delete') {
        $resume[$postType] = array_values(array_filter($resume[$postType], fn($item) => (int)$item['id'] !== $id));
    } else {
        $item = [
            'id' => $id ?: resume_next_id($resume[$postType]),
            'title' => admin_post('title'),
            'period' => admin_post('period'),
            'institution' => admin_post('institution'),
            'description' => admin_post('description'),
        ];

        if ($id) {
            foreach ($resume[$postType] as $index => $row) {
                if ((int)$row['id'] === $id) {
                    $resume[$postType][$index] = $item;
                    break;
                }
            }
        } else {
            $resume[$postType][] = $item;
        }
    }

    $content['resume'] = $resume;
    resume_save_content($content);
    admin_redirect('resume.php?type=' . $postType . '&saved=1');
}

admin_header('Resume');
?>
<h1 class="h3 mb-3">Resume</h1>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Saved successfully.</div><?php endif; ?>
<form class="card mb-4" method="post">
    <div class="card-body">
        <input type="hidden" name="action" value="summary">
        <h2 class="h5 mb-3">Summary</h2>
        <div class="row g-3">
            <div class="col-12"><label class="form-label">Section Intro</label><textarea class="form-control" name="intro"><?= h($resume['intro']) ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Summary Name</label><input class="form-control" name="summary_name" value="<?= h($resume['summary_name']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Location</label><input class="form-control" name="summary_location" value="<?= h($resume['summary_location']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="summary_phone" value="<?= h($resume['summary_phone']) ?>"></div>
            <div class="col-md-6"><label class="form-label">Website</label><input class="form-control" name="summary_website" value="<?= h($resume['summary_website']) ?>"></div>
            <div class="col-12"><label class="form-label">Summary Text</label><textarea class="form-control" name="summary_text"><?= h($resume['summary_text']) ?></textarea></div>
        </div>
    </div>
    <div class="card-footer bg-white text-end"><button class="btn btn-primary">Save Summary</button></div>
</form>
<div class="row g-4">
    <div class="col-lg-4">
        <form class="card" method="post">
            <div class="card-body">
                <h2 class="h5 mb-3"><?= $editing ? 'Edit' : 'Add' ?> <?= h(ucfirst($type)) ?></h2>
                <input type="hidden" name="type" value="<?= h($type) ?>"><input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>">
                <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="title" value="<?= h($editing['title'] ?? '') ?>" required></div>
                <div class="mb-3"><label class="form-label">Period</label><input class="form-control" name="period" value="<?= h($editing['period'] ?? '') ?>"></div>
                <div class="mb-3"><label class="form-label">Institution</label><input class="form-control" name="institution" value="<?= h($editing['institution'] ?? '') ?>"></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description"><?= h($editing['description'] ?? '') ?></textarea></div>
                <button class="btn btn-primary"><?= $editing ? 'Update' : 'Add' ?></button>
                <?php if ($editing): ?><a class="btn btn-outline-secondary" href="resume.php?type=<?= h($type) ?>">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <div class="mb-3"><a class="btn btn-sm <?= $type === 'education' ? 'btn-primary' : 'btn-outline-primary' ?>" href="resume.php?type=education">Education</a> <a class="btn btn-sm <?= $type === 'experience' ? 'btn-primary' : 'btn-outline-primary' ?>" href="resume.php?type=experience">Experience</a></div>
        <div class="card"><div class="card-body table-responsive">
            <table class="table align-middle"><thead><tr><th>Title</th><th>Period</th><th class="text-end">Actions</th></tr></thead><tbody>
                <?php foreach ($resume[$type] as $item): ?>
                <tr><td><?= h($item['title']) ?><br><small class="text-muted"><?= h($item['institution']) ?></small></td><td><?= h($item['period']) ?></td><td class="text-end"><a class="btn btn-sm btn-outline-primary" href="resume.php?type=<?= h($type) ?>&edit=<?= h($item['id']) ?>">Edit</a> <form class="d-inline" method="post" onsubmit="return confirm('Delete this resume item?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="type" value="<?= h($type) ?>"><input type="hidden" name="id" value="<?= h($item['id']) ?>"><button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
                <?php endforeach; ?>
            </tbody></table>
        </div></div>
    </div>
</div>
<?php admin_footer(); ?>
