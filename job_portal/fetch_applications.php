<?php
session_start();
include 'db_connection.php'; // Your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['jobseeker_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$jobseeker_id = $_SESSION['jobseeker_id'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT job_title, company_name, application_date, status, viewed_at FROM applications WHERE jobseeker_id = ?");
$stmt->bind_param("i", $jobseeker_id);
$stmt->execute();
$result = $stmt->get_result();

$applications = [];
while ($row = $result->fetch_assoc()) {
    $applications[] = $row;
}

$stmt->close();
$conn->close();

// Return the data as JSON
echo json_encode($applications);
?>