<?php
require_once __DIR__ . '/_bootstrap.php';
admin_require_login();

$content = resume_get_content();
$skills = $content['skills'];
$editId = (int)($_GET['edit'] ?? 0);
$editing = null;

foreach ($skills as $skill) {
    if ((int)$skill['id'] === $editId) {
        $editing = $skill;
        break;
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = admin_post('action');
    $id = (int)admin_post('id');

    if ($action === 'delete') {
        $skills = array_values(array_filter($skills, fn($skill) => (int)$skill['id'] !== $id));
    } else {
        $item = [
            'id' => $id ?: resume_next_id($skills),
            'name' => admin_post('name'),
            'percentage' => max(0, min(100, (int)admin_post('percentage'))),
        ];

        if ($id) {
            foreach ($skills as $index => $skill) {
                if ((int)$skill['id'] === $id) {
                    $skills[$index] = $item;
                    break;
                }
            }
        } else {
            $skills[] = $item;
        }
    }

    $content['skills'] = $skills;
    resume_save_content($content);
    admin_redirect('skills.php?saved=1');
}

admin_header('Skills');
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Skills</h1>
</div>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Saved successfully.</div><?php endif; ?>
<div class="row g-4">
    <div class="col-lg-4">
        <form class="card" method="post">
            <div class="card-body">
                <h2 class="h5 mb-3"><?= $editing ? 'Edit Skill' : 'Add Skill' ?></h2>
                <input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>">
                <div class="mb-3"><label class="form-label">Skill Name</label><input class="form-control" name="name" value="<?= h($editing['name'] ?? '') ?>" required></div>
                <div class="mb-3"><label class="form-label">Percentage</label><input class="form-control" type="number" min="0" max="100" name="percentage" value="<?= h($editing['percentage'] ?? 50) ?>" required></div>
                <button class="btn btn-primary" type="submit"><?= $editing ? 'Update' : 'Add' ?></button>
                <?php if ($editing): ?><a class="btn btn-outline-secondary" href="skills.php">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <div class="card"><div class="card-body table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Percentage</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($skills as $skill): ?>
                    <tr>
                        <td><?= h($skill['name']) ?></td>
                        <td><?= h($skill['percentage']) ?>%</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="skills.php?edit=<?= h($skill['id']) ?>">Edit</a>
                            <form class="d-inline" method="post" onsubmit="return confirm('Delete this skill?')">
                                <input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= h($skill['id']) ?>">
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div></div>
    </div>
</div>
<?php admin_footer(); ?>
