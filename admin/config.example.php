<?php
/*
 * Admin login settings.
 *
 * 1. Copy this file to admin/config.php (config.php is ignored by git, so it never gets committed).
 * 2. Generate a password hash by running this in a terminal, replacing YOUR-PASSWORD:
 *
 *      php -r "echo password_hash('YOUR-PASSWORD', PASSWORD_DEFAULT), PHP_EOL;"
 *
 * 3. Paste the hash below and choose a username.
 */
return [
    'username' => 'choose-a-username',
    'password_hash' => 'paste-the-hash-here',
];
