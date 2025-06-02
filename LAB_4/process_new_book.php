<?php
// process_new_book.php
class Book {
    public $title, $author, $genre, $year, $price;

    public function __construct($title, $author, $genre, $year, $price) {
        $this->title  = $title;
        $this->author = $author;
        $this->genre  = $genre;
        $this->year   = $year;
        $this->price  = $price;
    }

    public function displayBookInfo() {
        echo "<div style='border:1px solid #ccc;padding:15px;width:300px;'>";
        echo "<strong>Title:</strong> {$this->title}<br>";
        echo "<strong>Author:</strong> {$this->author}<br>";
        echo "<strong>Genre:</strong> {$this->genre}<br>";
        echo "<strong>Year:</strong> {$this->year}<br>";
        echo "<strong>Price:</strong> \${$this->price}<br>";
        echo "</div>";
    }
}

// Read from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book = new Book(
        $_POST['title'],
        $_POST['author'],
        $_POST['genre'],
        $_POST['year'],
        $_POST['price']
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Book Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        a {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>New Book Created:</h2>
<?php $book->displayBookInfo(); ?>

<a href="add_book.php">← Add Another Book</a>
<a href="library_dashboard.php">← Back to Dashboard</a>

</body>
</html>