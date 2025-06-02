<?php
class Product {
    public $product_name, $product_price;
    function __construct($name, $price) {
        $this->product_name = $name;
        $this->product_price = $price;
    }
    function displayProduct() {
        echo "<div style='background:#fff;padding:20px;border-radius:6px;max-width:400px;margin:auto;
        box-shadow:0 0 10px #ccc;font-family:Arial;'>
        <h2>Product Added</h2>
        <p><strong>Name:</strong> $this->product_name</p>
        <p><strong>Price:</strong> $this->product_price</p>
        </div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = new Product($_POST['product_name'], $_POST['product_price']);
    $product->displayProduct();
}
?>