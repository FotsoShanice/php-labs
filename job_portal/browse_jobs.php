<?php
session_start();
require_once 'env_loader.php'; // Load environment variables

$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';
$dbname = $_ENV['DB_NAME'] ?? 'job_portal';

$mysqli = new mysqli($host, $user, $pass, $dbname);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Category filter
$category_filter = isset($_GET['category']) ? $mysqli->real_escape_string($_GET['category']) : '';
$category_query = "SELECT DISTINCT category FROM jobs";
$categories = $mysqli->query($category_query);

// Total jobs for pagination
$where_clause = $category_filter ? "WHERE category = '$category_filter'" : '';
$total_query = $mysqli->query("SELECT COUNT(*) AS total FROM jobs $where_clause");
$total_jobs = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_jobs / $limit);

// Get jobs
$jobs_query = "SELECT * FROM jobs $where_clause ORDER BY posted_date DESC LIMIT $limit OFFSET $offset";
$result = $mysqli->query($jobs_query);

$logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse Jobs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #fff;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 6px;
        }

        .job-card {
            position: relative;
            border-bottom: 1px solid #ddd;
            padding: 20px;
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .job-meta {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .apply-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 4px;
        }

        .apply-button:hover {
            background-color: #218838;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a.active {
            background-color: #0056b3;
        }

        .filter-bar {
            margin-bottom: 20px;
        }

        .filter-bar form {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div><strong>Browse Jobs</strong></div>
    <div>
        <a href="index.php">Home</a>
        <?php if ($logged_in): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="filter-bar">
        <form method="get">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($cat['category']) ?>" <?= $category_filter === $cat['category'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category']) ?>
                    </option>
                    <?php endwhile; ?>
            </select>
        </form>
    </div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="job-card">
            <div class="job-title"><?= htmlspecialchars($row['title']) ?></div>
            <div class="job-meta">Category: <?= htmlspecialchars($row['category']) ?></div>
            <div class="job-meta">Location: <?= htmlspecialchars($row['location']) ?></div>
            <div class="job-meta">Posted: <?= htmlspecialchars($row['posted_date']) ?></div>

            <?php if ($logged_in): ?>
                <a class="apply-button" href="apply_job.php?id=<?= $row['id'] ?>">Apply</a>
            <?php else: ?>
                <a class="apply-button" href="login.php?message=Please+login+to+apply">Register to Apply</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&category=<?= urlencode($category_filter) ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

</body>
</html>