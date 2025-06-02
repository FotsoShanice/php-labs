<?php
require 'db_conn.php';

$email = 'shaniceroyalef@icloud.com'; // Replace with your admin email
$new_password = 'Royale2006'; // Replace with your new password

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashed_password, $email);

if ($stmt->execute()) {
    echo "Password updated successfully.";
} else {
    echo "Error updating password.";
}
?>