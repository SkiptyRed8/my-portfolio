<?php
/*
 * /admin/ entry point: send to the dashboard or the login page.
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/auth.php';
header('Location: ' . (is_admin_logged_in() ? 'dashboard.php' : 'login.php'));
exit;
