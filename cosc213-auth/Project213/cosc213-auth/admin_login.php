<?php
session_start();
require 'admin_credentials.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $errors[] = "Username and password are required.";
    } else {
        // Check admin credentials
        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            $_SESSION['admin'] = true; // Admin logged in
            header("Location: admin.php");
            exit;
        } else {
            $errors[] = "Invalid admin username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - User Authentication System</title>
</head>
<body>
    <h2>Admin Login</h2>

    <?php if ($errors): ?>
        <div style="color:red;">
            <ul>
                <?php foreach($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login as Admin</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
