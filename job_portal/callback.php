<?php
session_start();
require_once 'env_loader.php'; // Load environment variables

// Google OAuth configuration from environment variables
$client_id = $_ENV['GOOGLE_CLIENT_ID'] ?? '';
$client_secret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? '';
$redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'] ?? '';

if (!isset($_GET['code'])) {
    die('Authorization code not found');
}

// Step 1: Exchange authorization code for access token
$token_url = "https://oauth2.googleapis.com/token";
$data = [
    "code" => $_GET['code'],
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "redirect_uri" => $redirect_uri,
    "grant_type" => "authorization_code"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);

if (!isset($response_data['access_token'])) {
    die("Error fetching access token.");
}

$access_token = $response_data['access_token'];

// Step 2: Fetch user info
$user_info_url = "https://www.googleapis.com/oauth2/v2/userinfo";
$headers = ["Authorization: Bearer $access_token"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $user_info_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$user_info_response = curl_exec($ch);
curl_close($ch);

$user = json_decode($user_info_response, true);

if (!isset($user['email'])) {
    die("Unable to fetch user email.");
}

// Save user details in session
$_SESSION['email'] = $user['email'];
$_SESSION['name'] = $user['name'] ?? '';
$_SESSION['oauth'] = true;

// 🔁 OPTIONAL: Redirect to dashboard or determine role
header('Location: dashboard.php');
exit;