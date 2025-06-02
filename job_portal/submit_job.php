<?php
session_start();
require_once 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_title = trim($_POST['job_title']);
    $company = trim($_POST['company']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO jobs (job_title, company, description, user_id, created_at) VALUES (?, ?, ?, ?, NOW())");

    if ($stmt) {
        $stmt->bind_param("sssi", $job_title, $company, $description, $user_id);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Failed to post job. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "Error preparing the query.";
    }
} else {
    $error = "Invalid request method.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Posted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 50px;
        }
        .message-box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .message-box h2 {
            color: #28a745;
        }
        .message-box p {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            margin-top: 25px;
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 5px;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php if (isset($success)): ?>
            <h2>Job Posted Successfully!</h2>
            <p>Your job has been added to the portal.</p>
            <a class="button" href="browse_jobs.php">Go to Home Page</a>
        <?php else: ?>
            <h2 style="color:red;">Error</h2>
            <p><?= htmlspecialchars($error) ?></p>
            <a class="button" href="post_job.php">Back to Post Job</a>
        <?php endif; ?>
    </div>
</body>
</html>