<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$job_id = isset($_GET['job_id']) ? $_GET['job_id'] : null;

if (!$job_id) {
    echo "No job selected.";
    exit;
}

// Confirm the employer owns the job
$check = $pdo->prepare("SELECT * FROM jobs WHERE id = ? AND employer_id = ?");
$check->execute([$job_id, $_SESSION['user_id']]);
if ($check->rowCount() == 0) {
    echo "You do not have access to this job.";
    exit;
}

// Fetch applications
$stmt = $pdo->prepare("
    SELECT applications.id, users.name, users.email, applications.cover_letter
    FROM applications
    JOIN users ON applications.user_id = users.id
    WHERE applications.job_id = ?
");
$stmt->execute([$job_id]);
$applicants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Applicants for Your Job</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <h2>Applicants for Job ID: <?= htmlspecialchars($job_id) ?></h2>

        <?php if (count($applicants) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Cover Letter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applicants as $app): ?>
                        <tr>
                            <td><?= htmlspecialchars($app['name']) ?></td>
                            <td><?= htmlspecialchars($app['email']) ?></td>
                            <td><?= nl2br(htmlspecialchars($app['cover_letter'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No applicants yet for this job.</p>
        <?php endif; ?>

        <p><a href="employer_jobs.php">Back to My Jobs</a></p>
    </div>
</body>
</html>