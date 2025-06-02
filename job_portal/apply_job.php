<?php
session_start();
require_once 'config.php'; // Ensure this file connects to your DB using mysqli

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }

    // Retrieve form data
    $fullName = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $applicationDate = date('Y-m-d');

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO applications (full_name, gender, dob, email, phone, address, application_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssss", $fullName, $gender, $dob, $email, $phone, $address, $applicationDate);
        $stmt->execute();
        echo '<div class="success">Application submitted successfully!</div>';
        echo '<script>setTimeout(() => { window.location.href = "browse_jobs.php"; }, 2000);</script>';
    } else {
        echo "Database error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 40px;
        }

        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background: #28a745;
            border: none;
            color: white;
            cursor: pointer;
        }

        .success {
            text-align: center;
            padding: 10px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            max-width: 600px;
            margin: 10px auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<form method="POST" action="apply_job.php">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

    <h2>Job Application Form</h2>

    <label for="full_name">Full Name</label>
    <input type="text" name="full_name" required>

    <label for="gender">Gender</label>
    <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="phone">Phone Number</label>
    <input type="text" name="phone" required>

    <label for="address">Address</label>
    <input type="text" name="address" required>

    <button type="submit">Submit Application</button>
</form>

</body>
</html>