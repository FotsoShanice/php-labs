<?php
session_start();
header('Content-Type: text/plain');

// Dump session so we can see what’s in it
echo "SESSION DUMP:\n";
print_r($_SESSION);

// Access check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    echo "\nNOT LOGGED IN as employer.\n";
    exit;
}

echo "\n✅ You are logged in as employer (user_id={$_SESSION['user_id']}).\n";