<?php
require_once 'Book.php';
require_once 'Ebook.php';
require_once 'Member.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Library System Test</h1>
    <?php
    $member = new Member("Alice Johnson", "alice@example.com", "2023-01-15");
    $book1 = new Book("Pride and Prejudice", "Jane Austen", 1813, "Romance", 14.99);
    $ebook1 = new Ebook("The Martian", "Andy Weir", 2011, "Science Fiction", 9.99, 1.8);

    $member->borrowBook($book1);
    $member->borrowBook($ebook1);

    $member->viewBorrowedBooks();

    $member->returnBook($book1);

    $member->viewBorrowedBooks();
    ?>
</body>
</html>