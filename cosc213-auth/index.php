<?php

declare(strict_types=1);

require __DIR__ . '/config.php';

$dbStatus = 'Database connection OK.';
try {
    $stmt = $pdo->query('SELECT 1');
} catch (Throwable $e) {
    $dbStatus = 'Database connection error: ' . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Authentication System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 80px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 24px;
        }
        h1 {
            margin-top: 0;
            font-size: 1.6rem;
        }
        .status {
            padding: 10px 14px;
            border-radius: 4px;
            background: #eef;
            border: 1px solid #99a;
            margin-top: 10px;
            font-size: 0.95rem;
        }
        .note {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #555;
        }
        code {
            background: #f0f0f0;
            padding: 2px 4px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User Authentication System</h1>

    <p>Week 1 - Docker/PHP/MySQL setup for COSC 213.</p>

    <div class="status">
        <strong>Database status:</strong><br>
        <?php echo $dbStatus; ?>
    </div>

    <div class="note">
        <p>This milestone includes:</p>
        <ul>
            <li>Docker containers for PHP/Apache and MySQL</li>
            <li><code>config.php</code> with PDO connection</li>
            <li><code>users</code> table created in <code>cosc213_auth</code></li>
        </ul>
        <p>Registration, login, and profile pages will come in later weeks.</p>
    </div>
</div>
</body>
</html>
