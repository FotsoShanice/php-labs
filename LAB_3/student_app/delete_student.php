<?php
$conn = new mysqli('localhost', 'root', '', 'StudentDB');
$id = $_GET['id'];
$conn->query("DELETE FROM Students WHERE student_id = $id");
echo "<p style='color:red;'>Student deleted.</p><a href='view_students.php'>Back to list</a>";
?>