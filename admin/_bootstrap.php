<?php
session_start();

require_once __DIR__ . '/../lib/content.php';

function admin_is_logged_in()
{
    return !empty($_SESSION['myresume_admin']);
}

function admin_require_login()
{
    if (!admin_is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function admin_redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function admin_post($key, $default = '')
{
    return trim((string)($_POST[$key] ?? $default));
}

function admin_upload_image($field, $current = '')
{
    if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $current;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return $current;
    }

    $extension = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($extension, $allowed, true)) {
        return $current;
    }

    $uploadDir = __DIR__ . '/uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $filename = date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $destination)) {
        return $current;
    }

    return 'admin/uploads/' . $filename;
}

function admin_list_from_text($value)
{
    $parts = preg_split('/\r\n|\r|\n|,/', (string)$value);
    return array_values(array_filter(array_map('trim', $parts)));
}

function admin_text_from_list($value)
{
    if (is_array($value)) {
        return implode("\n", array_filter(array_map('trim', array_map('strval', $value))));
    }

    return (string)$value;
}

function admin_header($title)
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= h($title) ?> - MyResume Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: #f5f7fb; }
            .admin-shell { max-width: 1180px; }
            .nav-pills .nav-link.active { background: #0563bb; }
            .card { border: 0; box-shadow: 0 10px 30px rgba(15, 23, 42, .08); }
            textarea { min-height: 120px; }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom mb-4">
        <div class="container admin-shell">
            <a class="navbar-brand fw-bold" href="index.php">MyResume Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav nav-pills gap-1 ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="skills.php">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="resume.php">Resume</a></li>
                    <li class="nav-item"><a class="nav-link" href="portfolio.php">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php" target="_blank">View Site</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container admin-shell mb-5">
    <?php
}

function admin_footer()
{
    ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
