<?php
/*
 * Contact page
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 *
 * Step 1: ask the visitor for their name.
 * Step 2: show "Welcome [Name] to my Portfolio!" and a contact form
 *         (email + message) that saves to the contact_messages table.
 */
require_once __DIR__ . '/includes/db.php';

$errors = [];
$old    = ['name' => '', 'email' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if (!csrf_valid($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired. Please try again.';
    } elseif ($action === 'set_name') {
        // ---- Step 1: save the visitor's name ----
        $name = trim($_POST['name'] ?? '');
        $old['name'] = $name;

        if ($name === '') {
            $errors[] = 'Please enter your name.';
        } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $errors[] = 'Your name must be between 2 and 100 characters.';
        } elseif (!preg_match("/^[\p{L}\p{M}][\p{L}\p{M} .'\-]*$/u", $name)) {
            $errors[] = 'Your name can only contain letters, spaces, periods, apostrophes and hyphens.';
        }

        if (!$errors) {
            $_SESSION['visitor_name'] = $name;
            header('Location: contact.php');
            exit;
        }
    } elseif ($action === 'change_name') {
        unset($_SESSION['visitor_name']);
        header('Location: contact.php');
        exit;
    } elseif ($action === 'send_message') {
        // ---- Step 2: save the message ----
        $name    = $_SESSION['visitor_name'] ?? '';
        $email   = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $old['email']   = $email;
        $old['message'] = $message;

        if ($name === '') {
            $errors[] = 'Please tell me your name first.';
        }
        if ($email === '') {
            $errors[] = 'Please enter your email address.';
        } elseif (mb_strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }
        if ($message === '') {
            $errors[] = 'Please enter a message.';
        } elseif (mb_strlen($message) < 5) {
            $errors[] = 'Your message is too short.';
        } elseif (mb_strlen($message) > 2000) {
            $errors[] = 'Your message must be 2000 characters or fewer.';
        }

        if (!$errors) {
            $pdo = db();
            if ($pdo === null) {
                $errors[] = 'Sorry, messages can\'t be sent right now. Please try again later.';
            } else {
                try {
                    $stmt = $pdo->prepare(
                        'INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)'
                    );
                    $stmt->execute([
                        ':name'    => $name,
                        ':email'   => $email,
                        ':message' => $message,
                    ]);
                    // Post/Redirect/Get so refreshing doesn't send twice.
                    $_SESSION['flash_success'] = 'Thank you, ' . $name . '! Your message has been sent successfully. I\'ll get back to you soon.';
                    header('Location: contact.php');
                    exit;
                } catch (PDOException $e) {
                    error_log('Saving contact message failed: ' . $e->getMessage());
                    $errors[] = 'Sorry, something went wrong while sending your message. Please try again.';
                }
            }
        }
    }
}

$visitorName = $_SESSION['visitor_name'] ?? '';
$success     = $_SESSION['flash_success'] ?? '';
unset($_SESSION['flash_success']);

$pageTitle  = 'Contact | Bonaobra Portfolio';
$activePage = 'contact';
$base       = '';
require __DIR__ . '/includes/header.php';
?>
        <section id="contact" class="contact-page">
            <div class="content-contact fadeUp">
                <h1>CONTAC<span>T</span></h1>
                <div class="message-contact-socials">
                    <div class="send-message">

                        <?php if ($visitorName === ''): ?>
                            <!-- Step 1: ask for the visitor's name -->
                            <form action="contact.php" method="POST" class="name-step" novalidate>
                                <h2>Before we start&hellip;</h2>
                                <p class="form-intro">What should I call you?</p>

                                <?php if ($errors): ?>
                                    <div class="alert alert-error" role="alert">
                                        <?php foreach ($errors as $error): ?>
                                            <p><?= e($error) ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="action" value="set_name">
                                <div class="field">
                                    <label for="name">Your Name</label>
                                    <input type="text" id="name" name="name" placeholder="Juan Dela Cruz"
                                           maxlength="100" value="<?= e($old['name']) ?>" required autofocus>
                                </div>
                                <button type="submit" class="btn-gold">Continue</button>
                            </form>

                        <?php else: ?>
                            <!-- Step 2: welcome message + contact form -->
                            <div class="welcome-box">
                                <h2>Welcome <?= e($visitorName) ?> to my Portfolio!</h2>
                                <form action="contact.php" method="POST" class="inline-form">
                                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                    <input type="hidden" name="action" value="change_name">
                                    <button type="submit" class="link-button">Not <?= e($visitorName) ?>? Change name</button>
                                </form>
                            </div>

                            <?php if ($success): ?>
                                <div class="alert alert-success" role="status">
                                    <p><?= e($success) ?></p>
                                </div>
                            <?php endif; ?>

                            <form action="contact.php" method="POST" novalidate>
                                <h2>Send your message</h2>

                                <?php if ($errors): ?>
                                    <div class="alert alert-error" role="alert">
                                        <?php foreach ($errors as $error): ?>
                                            <p><?= e($error) ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="action" value="send_message">
                                <div class="field">
                                    <label for="email">Your Email</label>
                                    <input type="email" id="email" name="email" placeholder="juandelacruz@gmail.com"
                                           maxlength="100" value="<?= e($old['email']) ?>" required>
                                </div>
                                <div class="field">
                                    <label for="message">Your Message</label>
                                    <textarea name="message" id="message" rows="6" maxlength="2000"
                                              placeholder="Type your message here" required><?= e($old['message']) ?></textarea>
                                </div>
                                <button type="submit" class="btn-gold">Send</button>
                            </form>
                        <?php endif; ?>

                    </div>
                    <div class="contact-socials">
                        <div class="contact-info">
                            <h2>Contact Information</h2>
                            <div class="email">
                                <a href="mailto:atbonaobra6647qc@student.fatima.edu.ph"><img src="imageIcon/email-9-svgrepo-com (2).svg" alt="Email icon"></a>
                                <span>
                                    <p>
                                        Email
                                        <br>
                                        amalynbonaobra@gmail.com
                                    </p>
                                </span>
                            </div>
                            <div class="phone">
                                <img src="imageIcon/phone-flip-svgrepo-com (2).svg" alt="Phone icon">
                                <span>
                                    <p>
                                        Phone
                                        <br>
                                        +63-956-645-8942
                                    </p>
                                </span>
                            </div>
                        </div>
                        <div class="socials">
                            <h2>Follow me here:</h2>
                            <div class="socials-icon">
                                <a href="https://www.facebook.com/share/1CEg3AhzrJ/?mibextid=wwXIfr" target="_blank" rel="noopener"><img src="imageIcon/fb-icon.svg" alt="Facebook"></a>
                                <a href="https://github.com/SkiptyRed8" target="_blank" rel="noopener"><img src="imageIcon/github-circle-svgrepo-com (1).svg" alt="GitHub"></a>
                                <a href="https://www.linkedin.com/in/amalyn-bonaobra-89b421203/" target="_blank" rel="noopener"><img src="imageIcon/linkedin-white.svg" alt="LinkedIn"></a>
                                <a href="https://www.instagram.com/krngg_kringg" target="_blank" rel="noopener"><img src="imageIcon/instagram-white.svg" alt="Instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php require __DIR__ . '/includes/footer.php'; ?>
