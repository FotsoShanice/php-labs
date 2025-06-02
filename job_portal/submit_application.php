<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jobseeker') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $job_id = $_POST['job_id'];
    $full_name = $_POST['full_name'];
    $skills = $_POST['skills'];
    $motivation = $_POST['motivation'];

    $check = $pdo->prepare("SELECT * FROM applications WHERE job_id = ? AND user_id = ?");
    $check->execute([$job_id, $user_id]);

    if ($check->rowCount() > 0) {
        $message = "You have already applied for this job.";
        $status = "error";
    } else {
        $stmt = $pdo->prepare("INSERT INTO applications (job_id, user_id, full_name, skills, motivation, date_applied) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$job_id, $user_id, $full_name, $skills, $motivation]);
        $message = "Application submitted successfully!";
        $status = "success";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Status</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container" style="max-width:600px;margin:40px auto;text-align:center;padding:30px;background:#fff;border-radius:8px;">
    <div style="padding:20px;background:<?= $status === 'success' ? '#d4edda' : '#f8d7da' ?>;color:<?= $status === 'success' ? '#155724' : '#721c24' ?>;border-radius:5px;">
        <?= htmlspecialchars($message) ?>
    </div>
    <br>
    <a href="browse_jobs.php" style="text-decoration:none;padding:10px 20px;background:#007bff;color:white;border-radius:5px;">Back to Jobs</a>
</div>
</body>
</html>