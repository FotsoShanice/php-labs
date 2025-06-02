<?php
session_start();
require 'config.php';  // Make sure this file sets up $conn (mysqli)

// Check if user is logged in as admin or authorized (optional, add your auth check here)
// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
//     header('Location: login.php');
//     exit;
// }

$sql = "SELECT id, username, email, role, registered_at FROM users ORDER BY registered_at DESC";
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
<title>View Users</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background: #f9f9f9;
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
        border: 1px solid #ddd;
        text-align: left;
    }
    th {
        background: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background: #f2f2f2;
    }
</style>
</head>
<body>

<h1>Registered Users</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['role']); ?></td>
            <td><?php echo htmlspecialchars($user['registered_at']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>