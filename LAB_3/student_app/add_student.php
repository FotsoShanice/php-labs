<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body { font-family: Arial; background-color: #f0f8ff; padding: 20px; }
        form { background: #fff; padding: 20px; width: 300px; margin: auto; border-radius: 8px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        input[type="submit"] { background: #007bff; color: white; border: none; }
        input[type="submit"]:hover { background: #0056b3; cursor: pointer; }
    </style>
</head>
<body>
    <h2 align="center">Add Student</h2>
    <form method="POST" action="insert_student.php">
        Name: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        Phone: <input type="text" name="phone_number" required>
        <input type="submit" value="Add Student">
    </form>
</body>
</html>