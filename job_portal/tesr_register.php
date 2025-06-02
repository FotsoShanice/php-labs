<?php
session_start();

// “Registration” — we’ll simulate creating user ID 42
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user_id'] = 42;
    $_SESSION['role'] = 'employer';
    header("Location: test_post_job.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Test Register</title></head>
<body>
    <h2>TEST: Register as Employer</h2>
    <form method="POST">
        <button type="submit">“Register” (simulate)</button>
    </form>
</body>
</html>