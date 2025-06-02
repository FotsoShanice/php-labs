<?php
session_start();
include 'config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $error = "Email already registered.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'jobseeker')");
        if ($stmt->execute([$full_name, $email, $password])) {
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['role'] = 'jobseeker';

            // Redirect directly to application form if job_id is passed
            if (isset($_GET['job_id'])) {
                header("Location: apply_job.php?job_id=" . $_GET['job_id']);
                exit;
            } else {
                header("Location: browse_jobs.php");
                exit;
            }
        } else {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register as Job Seeker</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <h2>Job Seeker Registration</h2>

    <?php if ($message): ?>
        <div class="success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="form">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Register</button>
    </form>
</div>
</body>
</html>