<?php
declare(strict_types=1);

require __DIR__ . '/config.php';
session_start();

$email    = '';
$errors   = [];
$message  = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id, first_name, family_name, email, password_hash, address, phone FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors[] = 'Invalid email or password.';
        } else {
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['family_name']= $user['family_name'];
            $_SESSION['email']      = $user['email'];

            header('Location: profile.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - User Authentication System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div>
            <div class="title">User Authentication System</div>
            <div class="subtitle">User Login</div>
        </div>
        <div class="badge-week">Phase 1 · Login</div>
    </div>
</header>

<main>

    <section class="card">
        <div class="card-header">
            <div class="card-title">Log in to your account</div>
        </div>

        <?php if ($message): ?>
            <div class="info-box">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="error-box">
                <strong>Login failed:</strong>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="form">
            <div class="form-row">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-actions">
                <button type="submit">Login</button>
                <a href="register.php" class="link-button">Create an account</a>
                <a href="index.php" class="link-button secondary">Back to Home</a>
            </div>
        </form>
    </section>

</main>

<footer>
    COSC 213 · Login
</footer>

</body>
</html>