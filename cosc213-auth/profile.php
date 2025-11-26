<?php
declare(strict_types=1);
session_start();

require __DIR__ . '/config.php';

// If user is not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = (int)$_SESSION['user_id'];

// Fetch user data
$stmt = $pdo->prepare("
    SELECT id, first_name, family_name, email, address, phone
    FROM users
    WHERE id = ?
");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>

<h1>Your Profile</h1>

<p><strong>First Name:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
<p><strong>Family Name:</strong> <?= htmlspecialchars($user['family_name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
<p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
<p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>

<a href="logout.php">Logout</a>

</body>
</html>
