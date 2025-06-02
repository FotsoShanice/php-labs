<?php
session_start();
require_once 'env_loader.php'; // Load environment variables

// Database credentials from environment variables
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbuser = $_ENV['DB_USER'] ?? 'root';
$dbpass = $_ENV['DB_PASS'] ?? '';
$dbname = $_ENV['DB_NAME'] ?? 'job_portal';

// Connect to MySQL with mysqli
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get POST data, sanitize
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($username) || empty($email) || empty($password)) {
    $_SESSION['login_error'] = 'Please fill in all fields.';
    header('Location: login.php');
    exit;
}

// Prepare and execute SQL statement (use prepared statements to avoid SQL injection)
$stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? AND email = ?");
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password hash
    if (password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Redirect by role
        if ($user['role'] === 'admin') {
            header("Location: admin_panel.php");
        } elseif ($user['role'] === 'employer') {
            header("Location: post_job.php");
        } else {
            header("Location: browse_jobs.php");
        }
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid password.';
    }
} else {
    $_SESSION['login_error'] = 'Invalid username or email.';
}

$stmt->close();
$conn->close();

header('Location: login.php');
exit;