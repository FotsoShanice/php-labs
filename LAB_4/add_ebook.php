<!DOCTYPE html>
<html>
<head>
    <title>Add Ebook</title>
    <style>
        body { font-family: Arial; background: #eef; padding: 30px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; }
        input[type="text"], input[type="number"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        input[type="submit"] {
            background: #9C27B0; color: white; padding: 10px; border: none; width: 100%;
        }
    </style>
</head>
<body>
    <h2 align="center">Add Ebook</h2>
    <form method="POST" action="process_ebook.php">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="submit" value="Add Ebook">
    </form>
</body>
</html>