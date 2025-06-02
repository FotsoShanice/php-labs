<?php
require 'db_conn.php';

$name = 'Admin User';
$email = 'admin@example.com';
$password = password_hash('Admin123!', PASSWORD_DEFAULT);
$role = 'admin';

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $role);

if ($stmt->execute()) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $stmt->error;
}