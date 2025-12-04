<?php
session_start();
require 'admin_credentials.php';

// Check if user is admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$success = "";

if (isset($_POST['upload_csv']) && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];

    // Read CSV emails
    $emails = array_map('str_getcsv', file($file));
    $approved_emails = [];
    foreach ($emails as $row) {
        $approved_emails[] = trim($row[0]);
    }

    // Save approved emails to a file
    file_put_contents('approved_emails.txt', implode(PHP_EOL, $approved_emails));
    $success = "CSV uploaded successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User Authentication System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div>
            <div class="title">User Authentication System</div>
            <div class="subtitle">Admin Panel</div>
        </div>
        <div class="badge-week">Phase 2 · Admin</div>
    </div>
</header>

<main>
    <section class="card">
        <div class="card-header">
            <div class="card-title">Upload Approved Emails</div>
        </div>

        <?php if ($success): ?>
            <div class="success-box">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="admin.php" method="post" enctype="multipart/form-data" class="form">
            <div class="form-row">
                <label for="csv_file">CSV File *</label>
                <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
            </div>

            <div class="form-actions">
                <button type="submit" name="upload_csv">Upload</button>
                <a href="logout.php" class="link-button secondary">Logout</a>
            </div>
        </form>
    </section>
</main>

<footer>
    COSC 213 · Admin Panel
</footer>

</body>
</html>
