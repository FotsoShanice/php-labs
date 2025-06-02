<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_name = $_POST['emp_name'];
    $emp_salary = $_POST['emp_salary'];
    $emp_dept_id = $_POST['emp_dept_id'];

    // Basic validation (no empty(), just manual checks)
    if ($emp_name != "" && $emp_salary != "" && $emp_dept_id != "") {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Employee (emp_name, emp_salary, emp_dept_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $emp_name, $emp_salary, $emp_dept_id);

        if ($stmt->execute()) {
            $success = "Employee added successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Please fill out all fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Process Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            padding: 50px;
        }
        .container {
            background-color: #fff;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .message {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 16px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($success): ?>
        <div class="message success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <a href="add_employee.php">← Back to Add Employee</a><br>
    <a href="view_employees.php">👀 View All Employees</a>
</div>
</body>
</html>