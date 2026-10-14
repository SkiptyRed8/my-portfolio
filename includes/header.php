<?php
/*
 * Shared page header + navigation (used on every page)
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 *
 * Before including, a page may set:
 *   $pageTitle  - text for the <title> tag
 *   $activePage - 'home' | 'contact' | 'admin' (highlights the nav link)
 *   $base       - path back to the site root ('' for root pages, '../' for /admin)
 */
$pageTitle  = $pageTitle  ?? 'Bonaobra Portfolio';
$activePage = $activePage ?? 'home';
$base       = $base       ?? '';

function nav_class(string $page, string $activePage): string
{
    return $page === $activePage ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>style.css">
</head>
<body class="page-<?= e($activePage) ?>">
    <!--Name: Bonaobra Amalyn T.
        Section: BSIT 2 Y2 -2
        Date: 03/28/2026
    -->
    <main>
        <header>
            <h3><a href="<?= $base ?>index.php"><span class="fn">Amalyn</span><span class="ln">Bonaobra</span></a></h3>
            <nav>
                <ul>
                    <li><a href="<?= $base ?>index.php"<?= nav_class('home', $activePage) ?>>Home</a></li>
                    <li><a href="<?= $base ?>index.php#about-me">About me</a></li>
                    <li><a href="<?= $base ?>index.php#skills">Skills</a></li>
                    <li><a href="<?= $base ?>index.php#projects">Projects</a></li>
                    <li><a href="<?= $base ?>contact.php"<?= nav_class('contact', $activePage) ?>>Contact</a></li>
                    <li><a href="<?= $base ?>admin/login.php"<?= nav_class('admin', $activePage) ?>>Admin</a></li>
                </ul>
            </nav>
        </header>
