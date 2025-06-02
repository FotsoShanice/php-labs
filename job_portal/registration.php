<?php
include 'config.php';
session_start();

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $role]);

    // Get inserted user ID
    $userId = $pdo->lastInsertId();

    // Set session
    $_SESSION['user_id'] = $userId;
    $_SESSION['name'] = $name;
    $_SESSION['role'] = $role;

    // Redirect based on role
    if ($role === 'employer') {
        header("Location: post_job.php");
        exit();
    } else {
        header("Location: browse_jobs.php");
        exit();
    }
}
?>