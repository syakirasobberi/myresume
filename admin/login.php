<?php
require_once __DIR__ . '/_bootstrap.php';

// Credentials come from admin/config.php (not committed; see config.example.php).
// There is deliberately no fallback password: without a config file, login is disabled.
$config = is_file(__DIR__ . '/config.php') ? require __DIR__ . '/config.php' : [];
$validUsername = (string)($config['username'] ?? '');
$passwordHash = (string)($config['password_hash'] ?? '');
$configured = $validUsername !== '' && $passwordHash !== '';
$error = $configured ? '' : 'Admin login is disabled until admin/config.php is set up. See admin/config.example.php.';

if ($configured && ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $usernameOk = hash_equals($validUsername, admin_post('username'));
    $passwordOk = password_verify(admin_post('password'), $passwordHash);

    if ($usernameOk && $passwordOk) {
        session_regenerate_id(true);
        $_SESSION['myresume_admin'] = true;
        admin_redirect('index.php');
    }

    sleep(1); // slow down password guessing
    $error = 'Invalid username or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card border-0 shadow-sm" style="max-width: 420px; width: 100%;">
            <div class="card-body p-4">
                <h1 class="h4 mb-3">MyResume Admin</h1>
                <?php if ($error): ?><div class="alert alert-danger"><?= h($error) ?></div><?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input class="form-control" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
