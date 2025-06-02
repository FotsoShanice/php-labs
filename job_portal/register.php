<?php
session_start();
require_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']); // admin, employer, jobseeker

    if ($username && $email && $password && $role) {
        // Check if username or email already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "Username or email already taken.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
            if ($stmt->execute()) {
                // Auto login
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role === 'admin') {
                    header("Location: admin_panel.php");
                } elseif ($role === 'employer') {
                    header("Location: post_job.php");
                } else {
                    header("Location: browse_jobs.php");
                }
                exit;
            } else {
                $error = "Registration failed. Try again.";
            }

            $stmt->close();
        }

        $checkStmt->close();
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .register-container {
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

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>User Registration</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label>Username:
                <input type="text" name="username" required>
            </label>

            <label>Email:
                <input type="email" name="email" required>
            </label>

            <label>Password:
                <input type="password" name="password" required>
            </label>

            <label>Role:
                <select name="role" required>
                    <option value="">Select role</option>
                    <option value="admin">Admin</option>
                    <option value="employer">Employer</option>
                    <option value="jobseeker">Job Seeker</option>
                </select>
            </label>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>