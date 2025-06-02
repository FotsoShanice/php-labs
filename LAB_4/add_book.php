<?php
// add_book.php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            width: 300px;
            border-radius: 5px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }
        a {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Add New Book</h2>
<form action="process_new_book.php" method="post">
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="text" name="author" placeholder="Author" required><br>
    <input type="text" name="genre" placeholder="Genre" required><br>
    <input type="number" name="year" placeholder="Year" required><br>
    <input type="number" name="price" placeholder="Price" step="0.01" required><br>
    <input type="submit" value="Create Book">
</form>

<a href="library_dashboard.php">← Back to Dashboard</a>

</body>
</html>