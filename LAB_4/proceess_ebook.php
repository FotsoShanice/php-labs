<?php
interface Discountable {
    public function getDiscount();
}

class Book {
    public $title, $author, $price, $genre;
    function __construct($title, $author, $price, $genre) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->genre = $genre;
    }
}

class Ebook extends Book implements Discountable {
    function getDiscount() {
        return $this->price * 0.10;
    }

    function display() {
        $discount = $this->getDiscount();
        echo "<div style='background:#fff;padding:20px;border-radius:6px;max-width:400px;margin:auto;
        box-shadow:0 0 10px #ccc;font-family:Arial;'>
        <h2>Ebook Added</h2>
        <p><strong>Title:</strong> $this->title</p>
        <p><strong>Author:</strong> $this->author</p>
        <p><strong>Genre:</strong> $this->genre</p>
        <p><strong>Price:</strong> $this->price</p>
        <p><strong>Discount:</strong> $discount</p>
        </div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ebook = new Ebook($_POST['title'], $_POST['author'], $_POST['price'], $_POST['genre']);
    $ebook->display();
}
?>