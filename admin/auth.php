<?php
/*
 * Admin authentication helpers
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/../includes/db.php';

function is_admin_logged_in(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

/** Send visitors who aren't logged in back to the login page. */
function require_admin(): void
{
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
