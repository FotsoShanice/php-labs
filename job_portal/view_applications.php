<?php
session_start();
require 'config.php';  // Make sure this file sets up $conn (mysqli)

// Optional: restrict access to authorized users (admin or employers)
// if (!isset($_SESSION['user_type']) || !in_array($_SESSION['user_type'], ['admin', 'employer'])) {
//     header('Location: login.php');
//     exit;
// }

$sql = "SELECT id, job_id, full_name, gender, dob, application_date, status FROM applications ORDER BY application_date DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>View Applications</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background: #f5f5f5;
    }
    h1 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid #ccc;
        text-align: left;
    }
    th {
        background: #007BFF;
        color: white;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
</style>
</head>
<body>

<h1>Job Applications</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Job ID</th>
            <th>Applicant Name</th>
            <th>Applicant Email</th>
            <th>Application Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($app = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($app['id']); ?></td>
            <td><?php echo htmlspecialchars($app['job_id']); ?></td>
            <td><?php echo htmlspecialchars($app['full_name']); ?></td>
            <td><?php echo htmlspecialchars($app['application_date']); ?></td>
            <td><?php echo htmlspecialchars($app['status']); ?></td>
               <td><?php echo htmlspecialchars($app['dob']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>