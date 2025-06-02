<?php
include_once 'Product.php';
include_once 'Discountable.php';
include_once 'Loanable.php';

class Book extends Product implements Discountable, Loanable {
    public $author;
    public $year;
    public $genre;

    public function __construct($name, $price, $author, $year, $genre) {
        parent::__construct($name, $price);
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
    }

    public function displayProduct() {
        echo "<div class='output'>
                <strong>Title:</strong> {$this->product_name}<br>
                <strong>Author:</strong> {$this->author}<br>
                <strong>Year:</strong> {$this->year}<br>
                <strong>Genre:</strong> {$this->genre}<br>
                <strong>Price:</strong> $ {$this->product_price}<br>
                <strong>Discount:</strong> {$this->getDiscount()}%
              </div>";
    }

    public function getDiscount() {
        return 10;
    }

    public function borrowBook() {
        return "{$this->product_name} has been borrowed.";
    }

    public function returnBook() {
        return "{$this->product_name} has been returned.";
    }
}

$book = new Book("Introduction to OOP", 29.99, "John Doe", 2020, "Education");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book</title>
    <style>
        body { font-family: Arial; background: #f8f8f8; padding: 20px; }
        h1 { color: #333; }
        .output { background: #e0f7fa; padding: 15px; border-left: 4px solid #00796B; }
    </style>
</head>
<body>
    <h1>Book Page</h1>
    <?php $book->displayProduct(); ?>
</body>
</html>