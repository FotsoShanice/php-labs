
<?php
if (isset($_POST['color'])) {
    setcookie('fav_color', $_POST['color'], time() + 3600); // 1 hour
    header("Location: cookie_test.php");
    exit;
}

$color = $_COOKIE['fav_color'] ?? 'Not set';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Favorite Color</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Choose Your Favorite Color</h2>

<form method="POST">
    <select name="color">
        <option value="red">Red</option>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
    </select>
    <button type="submit">Save</button>
</form>

<p>Your favorite color is: <strong><?= htmlspecialchars($color) ?></strong></p>

</body>
</html>