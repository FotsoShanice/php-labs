<?php
session_start();
include 'config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = 'employer';

    // 1) Check if email exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->rowCount() > 0) {
        $message = "Email already registered.";
    } else {
        // 2) Insert new employer
        $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)"
        );
        if ($stmt->execute([$name, $email, $password, $role])) {
            // 3) Fetch back the user to get its ID & role
            $userStmt = $pdo->prepare("SELECT id, role FROM users WHERE email = ?");
            $userStmt->execute([$email]);
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);

            // 4) Set simple session keys
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];

            // 5) Redirect to post_job
            header("Location: post_job.php");
            exit;
        } else {
            $message = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employer Registration</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
    .container {max-width:500px;margin:50px auto;padding:20px;background:#fff;border-radius:8px;}
    label {display:block;margin-top:15px;}
    input {width:100%;padding:10px;margin-top:5px;}
    .btn {margin-top:20px;padding:10px;background:#28a745;color:#fff;border:none;width:100%;}
    .error {color:red;margin-top:10px;}
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
  <h2>Register as Employer</h2>
  <?php if ($message): ?><p class="error"><?=htmlspecialchars($message)?></p><?php endif; ?>
  <form method="POST">
    <label for="name">Full Name</label>
    <input id="name" name="name" type="text" required>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" required>
    <label for="password">Password</label>
    <input id="password" name="password" type="password" required>
    <button class="btn" type="submit">Register</button>
  </form>
</div>
</body>
</html>