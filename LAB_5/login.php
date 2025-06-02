<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Look up the user by email
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        form { background: white; padding: 20px; max-width: 400px; margin: auto; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, button { display: block; width: 100%; margin-top: 10px; padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
        button { background-color: #007bff; color: white; border: none; }
        button:hover { background-color: #0056b3; }
        .google-btn {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background-color: #db4437;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }
        .google-btn:hover {
            background-color: #c1351d;
        }
        .message { margin-top: 15px; color: red; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Login to Your Account</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email Address" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <a class="google-btn" href="google_login.php">Login with Google</a>
    </form>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
</body>
</html>