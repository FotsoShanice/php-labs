<?php
$conn = new mysqli('localhost', 'root', '', 'StudentDB');

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone_number'];

if ($name && $email && $phone) {
    $stmt = $conn->prepare("INSERT INTO Students (name, email, phone_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();
    echo "<p style='color:green;'>Student added successfully!</p><a href='add_student.php'>Add another</a>";
} else {
    echo "<p style='color:red;'>All fields are required.</p>";
}
?>