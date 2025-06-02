<?php
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');
$departments = $conn->query("SELECT * FROM Department");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 300px; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 8px 0; }
        input[type="submit"] { background: #28a745; color: white; border: none; }
        input[type="submit"]:hover { background: #218838; cursor: pointer; }
    </style>
</head>
<body>
    <h2 align="center">Add Employee</h2>
    <form method="POST" action="process_employee.php">
        Name: <input type="text" name="emp_name" required>
        Salary: <input type="number" name="emp_salary" required>
        Department:
        <select name="emp_dept_id" required>
            <?php while($row = $departments->fetch_assoc()): ?>
                <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>