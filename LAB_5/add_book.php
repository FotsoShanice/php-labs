<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $date = $_POST['published_date'];

    $stmt = $pdo->prepare("INSERT INTO books (title, author, published_date) VALUES (?, ?, ?)");
    $stmt->execute([$title, $author, $date]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <style>
        body { font-family: Arial; background: #e6ffee; padding: 20px; }
        form { background: white; padding: 20px; max-width: 500px; margin: auto; border-radius: 5px; }
        input, button { width: 100%; margin-top: 10px; padding: 10px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Add New Book</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author Name" required>
        <input type="date" name="published_date" required>
        <button type="submit">Add Book</button>
    </form>
</body>
</html>