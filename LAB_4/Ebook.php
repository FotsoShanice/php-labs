<?php
include_once 'Book.php';

class Ebook extends Book {
    public function getDiscount() {
        return 15;
    }

    public function download() {
        return "You can download '{$this->product_name}' now.";
    }

    public function displayProduct() {
        echo "<div class='output'>
                <strong>Title:</strong> {$this->product_name}<br>
                <strong>Author:</strong> {$this->author}<br>
                <strong>Year:</strong> {$this->year}<br>
                <strong>Genre:</strong> {$this->genre}<br>
                <strong>Price:</strong> $ {$this->product_price}<br>
                <strong>Discount:</strong> {$this->getDiscount()}%<br>
                <strong>Download:</strong> {$this->download()}
              </div>";
    }
}

$ebook = new Ebook("Learn PHP", 19.99, "Jane Roe", 2021, "Technology"); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ebook</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 20px; }
        h1 { color: #444; }
        .output { background: #fff3e0; padding: 15px; border-left: 4px solid #FFA726; }
    </style>
</head>
<body>
    <h1>Ebook Page</h1>
    <?php $ebook->displayProduct(); ?>
</body>
</html>