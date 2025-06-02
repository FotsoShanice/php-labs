<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

// Fetch books
$stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <style>
        body { font-family: Arial; background: #f0f8ff; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: left; }
        a.button { padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        a.button:hover { background: #0056b3; }
        .top-bar { margin-bottom: 20px; }
        .welcome-message {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!</h2>
        <a href="add_book.php" class="button">Add New Book</a>
        <a href="logout.php" class="button" style="background:#dc3545;">Logout</a>
    </div>

    <?php if (isset($_SESSION['just_registered'])): ?>
        <div class="welcome-message">
            🎉 Registration successful! You're now logged in.
        </div>
        <?php unset($_SESSION['just_registered']); ?>
    <?php endif; ?>

    <table>
        <tr>
            <th>Title</th><th>Author</th><th>Published Date</th><th>Actions</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['published_date']) ?></td>
                <td>
                    <a class="button" href="edit_book.php?id=<?= $book['id'] ?>">Edit</a>
                    <a class="button" href="delete_book.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>