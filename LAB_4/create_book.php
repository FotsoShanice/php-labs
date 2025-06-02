<?php
require_once 'Book.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create a New Book</h1>
    <?php
    $book = new Book("1984", "George Orwell", 1949, "Dystopian", 15.99);
    $book->displayProduct();
    ?>
</body>
</html> 