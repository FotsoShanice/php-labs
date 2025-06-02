<?php
require_once 'Product.php';
require_once 'Book.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Inheritance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Testing Inheritance</h1>
    <?php
    $product = new Product("Generic Product", 9.99);
    $product->displayProduct();

    $book = new Book("To Kill a Mockingbird", "Harper Lee", 1960, "Fiction", 12.99);
    $book->displayProduct();
    ?>
</body>
</html>