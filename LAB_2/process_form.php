<?php
// process_form.php

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

// Retrieve and sanitize form inputs
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$age = trim($_POST['age']);

// Validate inputs
$errors = [];

if (empty($name)) {
    $errors[] = "Name is required.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email is required.";
}

if (empty($age) || !filter_var($age, FILTER_VALIDATE_INT)) {
    $errors[] = "A valid age is required.";
}

if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo "<p><a href='user_form.php'>Go back</a></p>";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO Users (name, email, age) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $email, $age);

// Execute the statement
if ($stmt->execute()) {
    echo "<p style='color:green;'>New record created successfully.</p>";
    echo "<p><a href='view_users.php'>View Users</a></p>";
} else {
    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
}

// Close connections
$stmt->close();
$conn->close();
?>