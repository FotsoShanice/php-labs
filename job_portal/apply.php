<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jobseeker') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['job_id'])) {
    echo "No job selected to apply.";
    exit;
}

$job_id = $_GET['job_id'];
$user_id = $_SESSION['user_id'];
$message = '';
$status = '';

// Check if already applied
$check = $pdo->prepare("SELECT * FROM applications WHERE job_id = ? AND user_id = ?");
$check->execute([$job_id, $user_id]);

if ($check->rowCount() > 0) {
    $message = "You have already applied for this job.";
    $status = "error";
} else {
    // Insert application with current datetime
    $stmt = $pdo->prepare("INSERT INTO applications (job_id, user_id, date_applied) VALUES (?, ?, NOW())");
    if ($stmt->execute([$job_id, $user_id])) {
        // Notify employer by email
        $jobQuery = $pdo->prepare("SELECT j.title, e.email FROM jobs j JOIN employers e ON j.employer_id = e.id WHERE j.id = ?");
        $jobQuery->execute([$job_id]);
        $job = $jobQuery->fetch(PDO::FETCH_ASSOC);

        if ($job && !empty($job['email'])) {
            $to = $job['email'];
            $subject = "New Application for your Job Posting: " . $job['title'];
            $messageEmail = "Hello,\n\nA new applicant has applied for your job posting '" . $job['title'] . "'.\nPlease log in to your employer dashboard to review the application.\n\nRegards,\nJob Portal Team";
            $headers = "From: no-reply@yourjobportal.com\r\n";

            mail($to, $subject, $messageEmail, $headers);
        }

        $message = "Application submitted successfully!";
        $status = "success";
    } else {
        $message = "There was a problem submitting your application.";
        $status = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <?php if (!empty($message)): ?>
        <div class="<?= htmlspecialchars($status) ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        <a href="browse_jobs.php" class="btn">Back to Job Listings</a>
        <a href="my_applications.php" class="btn" style="margin-left: 10px;">My Applications</a>
    <?php endif; ?>
</div>
</body>
</html>