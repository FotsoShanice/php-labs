<?php
$mysqli = new mysqli("localhost", "root", "", "test_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "MySQLi is working!";
}
?>