s
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Uploaded File</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Last Uploaded File</h2>

<?php
if (isset($_SESSION['last_file'])) {
    $file = $_SESSION['last_file'];
    echo "<p><a href='$file' target='_blank'>View File</a></p>";
} else {
    echo "<p>No file uploaded in this session.</p>";
}
?>

</body>
</html>