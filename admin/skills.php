<?php
require_once __DIR__ . '/_bootstrap.php';
admin_require_login();

$content = resume_get_content();
$groups = $content['skills'] ?? [];
$editId = (int)($_GET['edit'] ?? 0);
$editing = null;

foreach ($groups as $group) {
    if ((int)($group['id'] ?? 0) === $editId) {
        $editing = $group;
        break;
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = admin_post('action');
    $id = (int)admin_post('id');

    if ($action === 'delete') {
        $groups = array_values(array_filter($groups, fn($group) => (int)($group['id'] ?? 0) !== $id));
    } else {
        $item = [
            'id' => $id ?: resume_next_id($groups),
            'title' => admin_post('title'),
            'icon' => admin_post('icon') ?: 'bi-check2-circle',
            'items' => admin_list_from_text(admin_post('items')),
        ];

        if ($id) {
            foreach ($groups as $index => $group) {
                if ((int)($group['id'] ?? 0) === $id) {
                    $groups[$index] = $item;
                    break;
                }
            }
        } else {
            $groups[] = $item;
        }
    }

    $content['skills'] = $groups;
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
                <h2 class="h5 mb-3"><?= $editing ? 'Edit Skill Group' : 'Add Skill Group' ?></h2>
                <input type="hidden" name="id" value="<?= h($editing['id'] ?? '') ?>">
                <div class="mb-3"><label class="form-label">Group Title</label><input class="form-control" name="title" value="<?= h($editing['title'] ?? '') ?>" placeholder="e.g. Frontend" required></div>
                <div class="mb-3"><label class="form-label">Icon</label><input class="form-control" name="icon" value="<?= h($editing['icon'] ?? 'bi-check2-circle') ?>"><div class="form-text">A Bootstrap Icons class, e.g. bi-window, bi-server, bi-bug, bi-tools.</div></div>
                <div class="mb-3"><label class="form-label">Skills</label><textarea class="form-control" name="items" required><?= h(admin_text_from_list($editing['items'] ?? [])) ?></textarea><div class="form-text">One skill per line or separate with commas.</div></div>
                <button class="btn btn-primary" type="submit"><?= $editing ? 'Update' : 'Add' ?></button>
                <?php if ($editing): ?><a class="btn btn-outline-secondary" href="skills.php">Cancel</a><?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <div class="card"><div class="card-body table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Group</th><th>Skills</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($groups as $group): ?>
                    <tr>
                        <td><i class="bi <?= h($group['icon'] ?? '') ?>"></i> <?= h($group['title'] ?? '') ?></td>
                        <td><?= h(implode(', ', $group['items'] ?? [])) ?></td>
                        <td class="text-end text-nowrap">
                            <a class="btn btn-sm btn-outline-primary" href="skills.php?edit=<?= h($group['id'] ?? '') ?>">Edit</a>
                            <form class="d-inline" method="post" onsubmit="return confirm('Delete this skill group?')">
                                <input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= h($group['id'] ?? '') ?>">
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
