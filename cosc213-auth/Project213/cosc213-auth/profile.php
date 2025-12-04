<?php
declare(strict_types=1);

session_start();
require __DIR__ . '/config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT id, first_name, family_name, email, address, phone
    FROM users
    WHERE id = :id
");
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile – User Authentication System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div>
            <div class="title">User Authentication System</div>
            <div class="subtitle">User Profile</div>
        </div>
        <div class="badge-week">Phase 1 · Profile</div>
    </div>
</header>

<main>

    <section class="card">
        <div class="card-header">
            <div class="card-title">
                Welcome, <?= htmlspecialchars($user['first_name']) ?>!
            </div>
        </div>

        <div class="card-body">
            <p>Here is the information stored for your account:</p>

            <table class="profile-table">
                <tr>
                    <th>First Name</th>
                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                </tr>
                <tr>
                    <th>Family Name</th>
                    <td><?= htmlspecialchars($user['family_name']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?= htmlspecialchars((string)$user['address']) ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars((string)$user['phone']) ?></td>
                </tr>
            </table>

            <div class="form-actions" style="margin-top: 16px;">
                <a href="logout.php" class="link-button">Logout</a>
                <a href="index.php" class="link-button secondary">Back to Home</a>
            </div>
        </div>
    </section>

</main>

<footer>
    COSC 213 · Profile
</footer>

</body>
</html>
