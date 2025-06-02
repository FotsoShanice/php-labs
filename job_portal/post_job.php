<?php
session_start();
require_once "config.php";

// Only allow employers or admins
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'employer' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit;
}

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $employer_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO jobs (title, location, salary, company, description, category, employer_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssssi", $title, $location, $salary, $company, $description, $category, $employer_id);

    if ($stmt->execute()) {
        $success_message = "Job posted successfully!";
        // Optional redirect:
        // header("refresh:2;url=employer_dashboard.php");
    } else {
        $success_message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            padding: 50px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Post a New Job</h2>

    <?php if (!empty($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Job Title</label>
        <input type="text" name="title" required>

        <label>Location</label>
        <input type="text" name="location" required>

        <label>Salary</label>
        <input type="text" name="salary" required>

        <label>Company</label>
        <input type="text" name="company" required>

        <label>Category</label>
        <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="IT">IT</option>
            <option value="Engineering">Engineering</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Finance">Finance</option>
            <option value="Education">Education</option>
            <option value="Other">Other</option>
        </select>

        <label>Description</label>
        <textarea name="description" rows="5" required></textarea>

        <button type="submit">Post Job</button>
    </form>

    <a class="back-link" href="employer_dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>