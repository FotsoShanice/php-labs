<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: login.php");
    exit;
}

$job_id = $_GET['id'] ?? null;
$employer_id = $_SESSION['user_id'];
$error = '';
$message = '';

if (!$job_id) {
    die("Job ID is missing.");
}

// Fetch job details
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ? AND employer_id = ?");
$stmt->execute([$job_id, $employer_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Job not found or unauthorized access.");
}

// Update job
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $category = $_POST['category'];

    if ($title && $description && $location && $salary && $category) {
        $updateStmt = $pdo->prepare("UPDATE jobs SET title=?, description=?, location=?, salary=?, category=? WHERE id=? AND employer_id=?");
        if ($updateStmt->execute([$title, $description, $location, $salary, $category, $job_id, $employer_id])) {
            $message = "Job updated successfully!";
        } else {
            $error = "Failed to update job.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Job</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <h2>Edit Job</h2>
    <?php if ($message): ?><p style="color:green;"><?= $message ?></p><?php endif; ?>
    <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($job['title']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($job['description']) ?></textarea>
        <input type="text" name="location" value="<?= htmlspecialchars($job['location']) ?>" required>
        <input type="text" name="salary" value="<?= htmlspecialchars($job['salary']) ?>" required>
        <select name="category" required>
            <option value="">-- Select Category --</option>
            <?php
            $categories = $pdo->query("SELECT * FROM categories");
            while ($cat = $categories->fetch()) {
                $selected = ($cat['name'] === $job['category']) ? 'selected' : '';
                echo "<option value='{$cat['name']}' $selected>{$cat['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Update Job</button>
    </form>
</div>
</body>
</html>