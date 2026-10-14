<?php
/*
 * Admin logout
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/auth.php';

// Only log out through the dashboard's Logout button (POST + CSRF token).
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valid($_POST['csrf_token'] ?? null)) {
    header('Location: ' . (is_admin_logged_in() ? 'dashboard.php' : 'login.php'));
    exit;
}

// Clear all session data and the session cookie.
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();

header('Location: login.php?logged_out=1');
exit;
