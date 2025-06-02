<?php
require_once 'config.php';
 include 'navbar.php'; 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $job_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ? AND employer_id = ?");
    $stmt->execute([$job_id, $_SESSION['user_id']]);
    header("Location: employer_jobs.php");
    exit();
}

// Fetch jobs posted by this employer
$stmt = $conn->prepare("SELECT * FROM jobs WHERE employer_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Posted Jobs</title>
    <style>
        body { font-family: Arial; background: #eef2f3; }
        .container {
            max-width: 800px; margin: 40px auto;
            background: white; padding: 20px;
            border-radius: 8px; box-shadow: 0 0 10px #bbb;
        }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
        }
        th, td {
            padding: 10px; border: 1px solid #ccc; text-align: left;
        }
        th { background-color: #f7f7f7; }
        h2 { margin: 0; }
        .actions a {
            margin-right: 10px; padding: 6px 10px;
            background: #007bff; color: white;
            text-decoration: none; border-radius: 4px;
        }
        .actions a.delete {
            background: #dc3545;
        }
        .actions a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Posted Jobs</h2>
        <?php if (count($jobs) > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Description</th>
                <th>Posted</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= htmlspecialchars($job['title']) ?></td>
                <td><?= htmlspecialchars($job['category']) ?></td>
                <td><?= nl2br(htmlspecialchars($job['description'])) ?></td>
                <td><?= date('M d, Y', strtotime($job['created_at'])) ?></td>
                <td class="actions">
                    <a href="view_applicants.php?job_id=<?= $job['id'] ?>">View Applicants</a>
                    <a href="employer_jobs.php?delete=<?= $job['id'] ?>" class="delete" onclick="return confirm('Delete this job?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>No jobs posted yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>