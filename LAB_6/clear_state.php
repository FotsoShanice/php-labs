
<?php
session_start();
session_destroy();

// Expire the cookie
setcookie("fav_color", "", time() - 3600);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clear Session and Cookie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Reset Complete</h2>
<p>Your session and cookies have been cleared.</p>
<a href="upload.php">Go back to Upload Page</a>

</body>
</html>