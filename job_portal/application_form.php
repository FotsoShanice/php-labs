<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Invalid job.";
    exit();
}

$job_id = intval($_GET['id']);
// Use $job_id to prefill job info or insert into applications
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container" style="max-width:600px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;box-shadow:0 0 8px rgba(0,0,0,0.1);">
    <h2>Apply for Job</h2>
    <form method="post" action="submit_application.php">
        <input type="hidden" name="job_id" value="<?= htmlspecialchars($job_id) ?>">

        <label>Full Name</label>
        <input type="text" name="full_name" required style="width:100%;padding:10px;margin:10px 0;">

        <label>Skills</label>
        <textarea name="skills" required style="width:100%;padding:10px;margin:10px 0;"></textarea>

        <label>Motivation</label>
        <textarea name="motivation" required style="width:100%;padding:10px;margin:10px 0;"></textarea>

        <button type="submit" class="btn" style="padding:10px 20px;background:#007bff;color:#fff;border:none;border-radius:5px;">Submit Application</button>
    </form>
</div>
</body>
</html>