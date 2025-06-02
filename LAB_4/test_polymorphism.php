<?php
require_once 'Book.php';
require_once 'Ebook.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Polymorphism</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Testing Polymorphism</h1>
    <?php
    $book = new Book("The Great Gatsby", "F. Scott Fitzgerald", 1925, "Classic", 10.00);
    $ebook = new Ebook("Digital Fortress", "Dan Brown", 1998, "Thriller", 8.00, 2.5);

    $items = [$book, $ebook];

    foreach ($items as $item) {
        $item->displayProduct();
        echo "<p><strong>Discount:</strong> {$item->getDiscount()}</p>";
    }
    ?>
</body>
</html>