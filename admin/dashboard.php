<?php
/*
 * Admin dashboard: lists every contact message
 * Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
 */
require_once __DIR__ . '/auth.php';
require_admin(); // only reachable after a successful login

$messages = [];
$dbError  = '';

$pdo = db();
if ($pdo === null) {
    $dbError = 'Could not connect to the database. Check the settings in includes/config.php.';
} else {
    try {
        $stmt = $pdo->query(
            'SELECT id, name, email, message, date_sent FROM contact_messages ORDER BY date_sent DESC, id DESC'
        );
        $messages = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('Loading messages failed: ' . $e->getMessage());
        $dbError = 'Could not load messages. Make sure the contact_messages table exists.';
    }
}

$pageTitle  = 'Admin Dashboard | Bonaobra Portfolio';
$activePage = 'admin';
$base       = '../';
require __DIR__ . '/../includes/header.php';
?>
        <section class="admin-section admin-dashboard">
            <div class="dashboard-head">
                <div>
                    <h1>ADMIN <span>DASHBOARD</span></h1>
                    <p class="form-intro">Logged in as <strong><?= e($_SESSION['admin_username'] ?? 'admin') ?></strong></p>
                </div>
                <form action="logout.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <button type="submit" class="btn-outline">Logout</button>
                </form>
            </div>

            <?php if ($dbError): ?>
                <div class="alert alert-error" role="alert"><p><?= e($dbError) ?></p></div>
            <?php else: ?>
                <p class="message-count">
                    <?= count($messages) ?> message<?= count($messages) === 1 ? '' : 's' ?> received
                </p>

                <?php if (!$messages): ?>
                    <div class="empty-state">
                        <p>No messages yet. They'll appear here when someone uses the contact form.</p>
                    </div>
                <?php else: ?>
                    <div class="table-wrap">
                        <table class="messages-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $row): ?>
                                    <tr>
                                        <td data-label="#"><?= (int) $row['id'] ?></td>
                                        <td data-label="Name"><?= e($row['name']) ?></td>
                                        <td data-label="Email"><a href="mailto:<?= e($row['email']) ?>"><?= e($row['email']) ?></a></td>
                                        <td data-label="Message" class="msg-cell"><?= nl2br(e($row['message'])) ?></td>
                                        <td data-label="Date Sent" class="date-cell"><?= e(date('M j, Y g:i A', strtotime($row['date_sent']))) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
