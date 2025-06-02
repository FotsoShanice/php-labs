<?php
session_start();
require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']); // username or email
    $password = trim($_POST['password']);

    if ($identifier && $password) {
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: admin_panel.php");
                } elseif ($user['role'] === 'employer') {
                    header("Location: post_job.php");
                } else {
                    header("Location: browse_jobs.php");
                }
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that username or email.";
        }

        $stmt->close();
    } else {
        $error = "Please fill in both fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .note {
            text-align: center;
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>User Login</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label>Email or Username:
                <input type="text" name="identifier" required>
            </label>

            <label>Password:
                <input type="password" name="password" required>
            </label>

            <input type="submit" value="Login">
        </form>

        <p class="note">Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>