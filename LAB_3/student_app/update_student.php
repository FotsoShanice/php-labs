<?php
$conn = new mysqli('localhost', 'root', '', 'StudentDB');

$id = $_POST['student_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone_number'];

$stmt = $conn->prepare("UPDATE Students SET name=?, email=?, phone_number=? WHERE student_id=?");
$stmt->bind_param("sssi", $name, $email, $phone, $id);
$stmt->execute();

echo "<p style='color:green;'>Student updated!</p><a href='view_students.php'>View Students</a>";
?>