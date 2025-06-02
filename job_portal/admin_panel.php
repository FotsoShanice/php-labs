<?php
session_start();
 include 'navbar.php';

// Restrict access to admins only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #343a40;
            margin-bottom: 25px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 12px 0;
        }

        a.button {
            display: inline-block;
            padding: 12px 18px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #bd2130;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-msg {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <div class="welcome-msg">Welcome, Admin: <?php echo htmlspecialchars($_SESSION['username']); ?></div>
            <a class="button logout-btn" href="logout.php">Logout</a>
        </div>

        <h1>Admin Dashboard</h1>
        <ul>
            <li><a class="button" href="view_users.php">View & Manage Users</a></li>
            <li><a class="button" href="view_jobs.php">View All Jobs</a></li>
            <li><a class="button" href="view_applications.php">View All Applications</a></li>
            <li><a class="button" href="site_settings.php">Site Settings</a></li>
        </ul>
    </div>
</body>
</html>