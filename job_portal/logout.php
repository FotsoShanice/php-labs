<?php
session_start();

if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
}

session_unset();
session_destroy();

header("Location: login.php");
exit;