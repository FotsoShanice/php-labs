<?php
// view_users.php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WebAppDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT id, name, email, age FROM Users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Users</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".htmlspecialchars($row["id"])."</td><td>".htmlspecialchars($row["name"])."</td><td>".htmlspecialchars($row["email"])."</td><td>".htmlspecialchars($row["age"])."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>