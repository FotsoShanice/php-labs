<?php
class Product {
    public $product_name;
    public $product_price;

    public function __construct($name, $price) {
        $this->product_name = $name;
        $this->product_price = $price;
    }

    public function displayProduct() {
        echo "<div class='output'>
                <strong>Product Name:</strong> {$this->product_name}<br>
                <strong>Product Price:</strong> $ {$this->product_price}
              </div>";
    }
}

$product = new Product("USB Drive", 15.00);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; }
        h1 { color: #333; }
        .output { background: #fff; padding: 15px; border-left: 4px solid #4CAF50; }
    </style>
</head>
<body>
    <h1>Product Page</h1>
    <?php $product->displayProduct(); ?>
</body>
</html>