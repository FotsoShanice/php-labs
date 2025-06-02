<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            padding: 30px;
            max-width: 800px;
            margin: auto;
            background: white;
            box-shadow: 0 0 10px #ccc;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 15px 0;
        }
        a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            display: inline-block;
            border-radius: 5px;
        }
        a:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Library Management Dashboard</h1>
    </div>

    <div class="container">
        <h2>Select an Action</h2>
        <ul>
            <li><a href="add_book.php">Add Book</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="add_ebook.php">Add Ebook</a></li>
        </ul>
    </div>
</body>
</html>