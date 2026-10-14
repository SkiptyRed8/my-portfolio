<?php
/*
 * Site configuration
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 *
 * Edit the DB_* values to match your hosting account.
 * (On InfinityFree the values look like: host "sql123.infinityfree.com",
 *  user "if0_12345678", database "if0_12345678_portfolio_db".)
 */

// ---- Database ----
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// ---- Admin account ----
// The password is NOT stored in plain text. This is the output of
// password_hash('123456', PASSWORD_DEFAULT). To change the password, run
//   php -r "echo password_hash('NEW_PASSWORD', PASSWORD_DEFAULT);"
// and paste the result here.
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', '$2y$10$Gpfq3ASuUWYtFl2NGPtr9u7QsWwUVRZXi.DvhDudc6wwLI4Z9oFRK');

// ---- Error display ----
// Never show raw PHP errors to visitors; log them instead.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// ---- Session ----
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}
