
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) mkdir($upload_dir);

    $target_file = $upload_dir . basename($_FILES["myfile"]["name"]);
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'txt'];

    if (!in_array($ext, $allowed)) {
        $message = "Invalid file type!";
    } elseif (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
        $message = "File uploaded: " . basename($_FILES["myfile"]["name"]);
        $_SESSION['last_file'] = $target_file;
    } else {
        $message = "Upload failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Upload a File</h2>

<?php if (isset($message)): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" required><br>
    <button type="submit">Upload</button>
</form>

</body>
</html>