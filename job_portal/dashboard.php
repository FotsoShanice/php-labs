<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

switch ($_SESSION['role']) {
    case 'admin':
        header("Location: admin_panel.php");
        break;
    case 'employer':
        header("Location: employer_dashboard.php");
        break;
    case 'seeker':
        header("Location: jobseeker_dashboard.php");
        break;
    default:
        // Fallback in case role is unknown
        echo "Invalid user role.";
        break;
}
exit;