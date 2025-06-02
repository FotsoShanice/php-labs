<?php
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');
$result = $conn->query("
    SELECT e.emp_id, e.emp_name, e.emp_salary, d.dept_name, d.dept_location
    FROM Employee e
    INNER JOIN Department d ON e.emp_dept_id = d.dept_id
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
    <style>
        body { font-family: Arial; background-color: #eef; padding: 20px; }
        table { border-collapse: collapse; width: 80%; margin: auto; background: white; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Salary</th><th>Department</th><th>Location</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['emp_id'] ?></td>
            <td><?= $row['emp_name'] ?></td>
            <td><?= $row['emp_salary'] ?></td>
            <td><?= $row['dept_name'] ?></td>
            <td><?= $row['dept_location'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>