<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $message = "Email already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            // Auto login the user and show welcome message
            $user_id = $pdo->lastInsertId();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_name"] = $name;
            $_SESSION["just_registered"] = true; // Flag for welcome message
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Error during registration.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        form { background: white; padding: 20px; max-width: 400px; margin: auto; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, button { display: block; width: 100%; margin-top: 10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
        button { background-color: #28a745; color: white; border: none; }
        button:hover { background-color: #218838; }
        .message { margin-top: 15px; color: red; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Create an Account</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email Address" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Register</button>
    </form>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
</body>
</html>