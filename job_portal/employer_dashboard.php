<?php
session_start();
require_once "config.php";
 include 'navbar.php';

// Allow only employers
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$employer_id = $_SESSION['user_id'];

// Fetch jobs posted by this employer
$stmt = $conn->prepare("SELECT * FROM jobs WHERE employer_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employer Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            padding: 50px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 25px;
        }

        .job-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
        }

        .job-box h3 {
            margin-top: 0;
            color: #007bff;
        }

        .job-box p {
            margin: 5px 0;
            color: #555;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            display: inline-block;
            padding: 8px 14px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .actions a.delete {
            background-color: #dc3545;
        }

        .actions a:hover {
            opacity: 0.85;
        }

        .logout {
            float: right;
            background-color: #dc3545;
            padding: 10px 16px;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .logout:hover {
            background-color: #c82333;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .username {
            font-weight: bold;
            color: #444;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <div class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <h1>Your Posted Jobs</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($job = $result->fetch_assoc()): ?>
            <div class="job-box">
                <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                <p><strong>Created on:</strong> <?php echo htmlspecialchars($job['created_at']); ?></p>

                <div class="actions">
                    <a href="view_applicants.php?job_id=<?php echo $job['id']; ?>">View Applicants</a>
                    <a href="edit_job.php?id=<?php echo $job['id']; ?>">Edit</a>
                    <a class="delete" href="delete_job.php?id=<?php echo $job['id']; ?>" onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You haven't posted any jobs yet. <a href="post_job.php">Post a Job</a></p>
    <?php endif; ?>

</div>
</body>
</html>