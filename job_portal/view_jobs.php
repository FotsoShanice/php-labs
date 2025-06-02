<?php
session_start();
require_once 'config.php';  // Make sure this file defines your mysqli $conn

// Check admin login
//if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    //header('Location: login.php');
    //exit();
//}

// Fetch all jobs
$sql = "SELECT id, title, company, location, salary, posted_date FROM jobs ORDER BY posted_date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - View Jobs</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    margin: 40px auto;
    max-width: 900px;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 14px 20px;
    text-align: left;
}

th {
    background-color: #2980b9;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f2f6fb;
}

tr:hover {
    background-color: #dbeeff;
    transition: background-color 0.3s ease;
}

a {
    display: inline-block;
    margin: 20px 10px 0 0;
    padding: 10px 20px;
    background-color: #2980b9;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

a:hover {
    background-color: #1c5980;
}
</style>
</head>
<body>

<h1>All Job Listings</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Job Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Salary</th>
            <th>Posted Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                echo "<td>" . htmlspecialchars($row['salary']) . "</td>";
                echo "<td>" . htmlspecialchars($row['posted_date']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="6">No jobs found.</td></tr>';
        }
        ?>
    </tbody>
</table>

<p>
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <a href="logout.php">Logout</a>
</p>

</body>
</html>