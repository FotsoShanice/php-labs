<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body { font-family: Arial; background: #eef; padding: 30px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; }
        input[type="text"], input[type="number"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        input[type="submit"] {
            background: #2196F3; color: white; padding: 10px; border: none; width: 100%;
        }
    </style>
</head>
<body>
    <h2 align="center">Add Product</h2>
    <form method="POST" action="process_product.php">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="product_price" placeholder="Product Price" required>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>