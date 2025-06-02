<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT n.*, j.title FROM notifications n JOIN jobs j ON n.job_id = j.id WHERE n.employer_id = ? ORDER BY n.created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$notifications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employer Notifications</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <h2>New Applications</h2>
    <?php foreach ($notifications as $note): ?>
        <div class="app-card">
            <p><strong><?= $note['message'] ?></strong></p>
            <p>Job: <?= $note['title'] ?></p>
            <p>Date: <?= $note['created_at'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>