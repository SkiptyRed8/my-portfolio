<?php
/*
 * Admin login page
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/auth.php';

// Already logged in? Go straight to the dashboard.
if (is_admin_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

const MAX_ATTEMPTS  = 5;
const LOCK_SECONDS  = 60;

$errors   = [];
$username = '';
$notice   = isset($_GET['logged_out']) ? 'You have been logged out.' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $lockedUntil = $_SESSION['login_locked_until'] ?? 0;

    if (!csrf_valid($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired. Please try again.';
    } elseif ($lockedUntil > time()) {
        $errors[] = 'Too many failed attempts. Please wait ' . ($lockedUntil - time()) . ' seconds and try again.';
    } else {
        // Simple validation
        if ($username === '') {
            $errors[] = 'Please enter your username.';
        } elseif (mb_strlen($username) > 50) {
            $errors[] = 'Username is too long.';
        }
        if ($password === '') {
            $errors[] = 'Please enter your password.';
        }

        if (!$errors) {
            $validUser = hash_equals(ADMIN_USERNAME, $username);
            $validPass = password_verify($password, ADMIN_PASSWORD_HASH);

            if ($validUser && $validPass) {
                session_regenerate_id(true); // prevent session fixation
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username']  = ADMIN_USERNAME;
                unset($_SESSION['login_attempts'], $_SESSION['login_locked_until']);
                header('Location: dashboard.php');
                exit;
            }

            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            if ($_SESSION['login_attempts'] >= MAX_ATTEMPTS) {
                $_SESSION['login_locked_until'] = time() + LOCK_SECONDS;
                $_SESSION['login_attempts'] = 0;
            }
            $errors[] = 'Invalid username or password.';
        }
    }
}

$pageTitle  = 'Admin Login | Bonaobra Portfolio';
$activePage = 'admin';
$base       = '../';
require __DIR__ . '/../includes/header.php';
?>
        <section class="admin-section admin-login">
            <div class="admin-card fadeUp">
                <h1>ADMIN <span>LOGIN</span></h1>
                <p class="form-intro">Sign in to view contact messages.</p>

                <?php if ($notice): ?>
                    <div class="alert alert-success" role="status"><p><?= e($notice) ?></p></div>
                <?php endif; ?>

                <?php if ($errors): ?>
                    <div class="alert alert-error" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <p><?= e($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" maxlength="50"
                               value="<?= e($username) ?>" autocomplete="username" required autofocus>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                               autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn-gold">Login</button>
                </form>
            </div>
        </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
