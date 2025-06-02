<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jobseeker') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['application_id'])) {
    echo "No application selected.";
    exit;
}

$application_id = $_GET['application_id'];
$user_id = $_SESSION['user_id'];

// Fetch application with job and employer details for this user
$sql = "SELECT a.*, j.title, j.description, e.company_name, e.email AS employer_email
        FROM applications a
        JOIN jobs j ON a.job_id = j.id
        JOIN employers e ON j.employer_id = e.id
        WHERE a.id = ? AND a.user_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$application_id, $user_id]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$app) {
    echo "Application not found or you don't have permission to view it.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Details</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        h2 { margin-bottom: 10px; }
        p { line-height: 1.5; }
        a.btn-back { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none; }
        a.btn-back:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <h2><?= htmlspecialchars($app['title']) ?></h2>
    <p><strong>Company:</strong> <?= htmlspecialchars($app['company_name']) ?></p>
    <p><strong>Applied on:</strong> <?= htmlspecialchars(date('F j, Y, g:i a', strtotime($app['date_applied']))) ?></p>
    <p><strong>Job Description:</strong><br><?= nl2br(htmlspecialchars($app['description'])) ?></p>
    <p><strong>Employer Contact:</strong> <?= htmlspecialchars($app['employer_email']) ?></p>

    <a href="my_applications.php" class="btn-back">Back to My Applications</a>
</div>
</body>
</html>