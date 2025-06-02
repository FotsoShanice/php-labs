<?php
$conn = new mysqli('localhost', 'root', '', 'StudentDB');
$result = $conn->query("SELECT * FROM Students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body { font-family: Arial; background-color: #eef; padding: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h2 align="center">Student List</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td>
                <a href="edit_student.php?id=<?= $row['student_id'] ?>">Edit</a> |
                <a href="delete_student.php?id=<?= $row['student_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>