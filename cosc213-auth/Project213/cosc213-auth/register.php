<?php
declare(strict_types=1);

require __DIR__ . '/config.php';

$firstName  = '';
$familyName = '';
$email      = '';
$address    = '';
$phone      = '';
$errors     = [];
$success    = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName  = trim($_POST['first_name'] ?? '');
    $familyName = trim($_POST['family_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirm_password'] ?? '';
    $address    = trim($_POST['address'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');

    // Validation
    if ($firstName === '') {
        $errors[] = 'First name is required.';
    }
    if ($familyName === '') {
        $errors[] = 'Family name is required.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Password and confirmation do not match.';
    }

    if (!$errors) {
        // 1. Check if email is already registered
        $checkStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $checkStmt->execute([':email' => $email]);
        if ($checkStmt->fetch()) {
            $errors[] = 'This email is already registered.';
        }

        // 2. Check if email is in the approved emails list
        $approvedEmails = file_exists('approved_emails.txt') 
            ? file('approved_emails.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) 
            : [];

        $emailClean = strtolower(trim($email));
        $approvedEmails = array_map('strtolower', $approvedEmails);

        if (!in_array($emailClean, $approvedEmails)) {
            $errors[] = 'Your email is not authorized to register. Contact admin.';
        }
    }

    if (!$errors) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $insertStmt = $pdo->prepare("
            INSERT INTO users (first_name, family_name, email, password_hash, address, phone)
            VALUES (:first_name, :family_name, :email, :password_hash, :address, :phone)
        ");

        try {
            $insertStmt->execute([
                ':first_name'    => $firstName,
                ':family_name'   => $familyName,
                ':email'         => $email,
                ':password_hash' => $passwordHash,
                ':address'       => $address,
                ':phone'         => $phone,
            ]);
            $success = true;
            $firstName = $familyName = $email = $address = $phone = '';
        } catch (Throwable $e) {
            $errors[] = 'Error saving user: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - User Authentication System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div>
            <div class="title">User Authentication System</div>
            <div class="subtitle">Register New Account</div>
        </div>
        <div class="badge-week">Phase 1 · Registration</div>
    </div>
</header>

<main>
    <section class="card">
        <div class="card-header">
            <div class="card-title">Create a new account</div>
        </div>

        <?php if ($success): ?>
            <div class="success-box">
                Registration successful. You can now <a href="login.php">log in</a>.
            </div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="error-box">
                <strong>Please fix the following:</strong>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="form">
            <div class="form-row">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name"
                       value="<?= htmlspecialchars($firstName) ?>" required>
            </div>

            <div class="form-row">
                <label for="family_name">Family Name *</label>
                <input type="text" id="family_name" name="family_name"
                       value="<?= htmlspecialchars($familyName) ?>" required>
            </div>

            <div class="form-row">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="form-row">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-row">
                <label for="confirm_password">Confirm Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-row">
                <label for="address">Address</label>
                <input type="text" id="address" name="address"
                       value="<?= htmlspecialchars($address) ?>">
            </div>

            <div class="form-row">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone"
                       value="<?= htmlspecialchars($phone) ?>">
            </div>

            <div class="form-actions">
                <button type="submit">Register</button>
                <a href="login.php" class="link-button">Go to Login</a>
                <a href="index.php" class="link-button secondary">Back to Home</a>
            </div>
        </form>
    </section>
</main>

<footer>
    COSC 213 · Registration
</footer>

</body>
</html>
