<?php
session_start();
include 'config.php';
 include 'navbar.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jobseeker') {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT a.*, j.title AS job_title FROM applications a JOIN jobs j ON a.job_id = j.id WHERE a.user_id = ? ORDER BY a.date_applied DESC");
$stmt->execute([$_SESSION['user_id']]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Applications</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .app-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
            background-color: #fafafa;
        }
        .app-card h3 {
            margin-top: 0;
            color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 10px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .no-apps {
            text-align: center;
            color: #777;
            font-size: 18px;
            padding: 50px 0;
        }
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h2>My Applications</h2>

    <?php if (count($applications) === 0): ?>
        <div class="no-apps">You have not applied for any jobs yet.</div>
    <?php else: ?>
        <?php foreach ($applications as $app): ?>
            <div class="app-card">
                <h3><?= htmlspecialchars($app['job_title']) ?></h3>
                <p><strong>Date Applied:</strong> <?= htmlspecialchars($app['date_applied']) ?></p>
                <p><strong>Full Name:</strong> <?= htmlspecialchars($app['full_name']) ?></p>
                <p><strong>Skills:</strong><br><?= nl2br(htmlspecialchars($app['skills'])) ?></p>
                <p><strong>Motivation:</strong><br><?= nl2br(htmlspecialchars($app['motivation'])) ?></p>
                
                <a class="btn" href="download_application.php?id=<?= $app['id'] ?>">Download PDF</a>
                <a class="btn" href="delete_application.php?id=<?= $app['id'] ?>" onclick="return confirm('Are you sure you want to delete this application?')">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>