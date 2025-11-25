<?php //starts php code
declare(strict_types=1); //strict variables. Good php practice.

require __DIR__ . '/config.php'; //include the config file for database connection.

$users = []; //initialize an empty array to hold user data
$error = null; //initialize error variable to null

try {
    $stmt = $pdo->query("
        SELECT id, first_name, family_name, email, address, phone
        FROM users
        ORDER BY id ASC
    ");
    $users = $stmt->fetchAll(); //fetch all user records from the database. Part of the PDO usage.
} catch (Throwable $e) {
    $error = $e->getMessage(); //store the error message if an exception occurs.
} //Try to fetch all users from the database. If an error occurs, store the error message.
?>
<!DOCTYPE html> <!-- Start of HTML document -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COSC 213 - User Authentication System</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div>
            <div class="title">User Authentication System</div>
            <div class="subtitle">COSC 213 - PHP Web Development Project</div>
        </div>
        <div class="badge-week">Week 1 · Database Setup</div>
    </div>
</header>

<main>
    <section class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Project Overview</div>
                <div class="card-sub">
                    Base layout and database connectivity only. Registration, login and admin features
                    will be implemented in later weeks.
                </div>
            </div>
            <div class="pill">Phase: Setup</div>
        </div>

        <div class="card-body">
            <p>This application will eventually support:</p>
            <ul style="margin: 6px 0 0 16px; padding: 0; color: var(--text-soft); font-size: 0.88rem;">
                <li>User registration with password hashing</li>
                <li>Login and profile page</li>
                <li>Admin CSV upload for email whitelisting</li>
            </ul>

            <div class="info-row">
                <span class="info-chip">PHP 8 · Docker</span>
                <span class="info-chip">MySQL · PDO</span>
                <span class="info-chip"><code>cosc213_auth.users</code></span>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Users Table</div>
                <div class="card-sub">
                    Live data from the <code>users</code> table. For Week 1, rows can be added manually via SQL Client.
                </div>
            </div>

            <?php if ($error === null): ?> <!-- Check if there was no error of database connection -->
                <div class="pill pill-ok">DB: Connected</div>
            <?php else: ?>
                <div class="pill pill-error">DB: Error</div>
            <?php endif; ?>
        </div>

        <?php if ($error !== null): ?> <!-- If there was an error, display it -->
            <div class="error-box">
                <strong>Database error:</strong><br>
                <?= htmlspecialchars($error) ?> <!-- htmlspecialchars to prevent XSS attacks (Cross-Site Scripting), good practice -->
            </div>
        <?php elseif (empty($users)): ?> <!-- If no users found, display empty state message -->
            <div class="empty-state">
                No users found. Insert some rows into <code>users</code> using SQL Client to see them listed here.
            </div>
        <?php else: ?> <!-- If users are found, display them in a table -->
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First</th>
                    <th>Family</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $u): ?> <!-- Loop through each user and display their data in a table row -->
                    <tr>
                        <td class="cell-muted"><?= (int)$u['id'] ?></td>
                        <td><?= htmlspecialchars($u['first_name']) ?></td>
                        <td><?= htmlspecialchars($u['family_name']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td class="cell-muted"><?= htmlspecialchars((string)$u['address']) ?></td>
                        <td class="cell-muted"><?= htmlspecialchars((string)$u['phone']) ?></td>
                        <!-- Use htmlspecialchars to prevent XSS attacks (Cross-Site Scripting), good practice -->
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

</main>

<footer> <!-- Footer of the page -->
    COSC 213 · Week 1 · Docker · PHP · MySQL · PDO
</footer>

</body>
</html>
