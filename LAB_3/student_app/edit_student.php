<?php
$conn = new mysqli('localhost', 'root', '', 'StudentDB');
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Students WHERE student_id = $id");
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; background-color: #fafafa; padding: 20px; }
        form { background: #fff; padding: 20px; width: 300px; margin: auto; border-radius: 8px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        input[type="submit"] { background: #ffc107; color: black; border: none; }
        input[type="submit"]:hover { background: #e0a800; cursor: pointer; }
    </style>
</head>
<body>
    <h2 align="center">Edit Student</h2>
    <form method="POST" action="update_student.php">
        <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
        Name: <input type="text" name="name" value="<?= $student['name'] ?>" required>
        Email: <input type="email" name="email" value="<?= $student['email'] ?>" required>
        Phone: <input type="text" name="phone_number" value="<?= $student['phone_number'] ?>" required>
        <input type="submit" value="Update Student">
    </form>
</body>
</html>