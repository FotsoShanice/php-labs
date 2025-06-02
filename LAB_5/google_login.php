<?php
require_once 'vendor/autoload.php';
require_once 'env_loader.php'; // Load environment variables
session_start();
require_once 'db.php';

// === CONFIG ===
$clientID = $_ENV['GOOGLE_CLIENT_ID'] ?? '';
$clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? '';
$redirectUri = $_ENV['GOOGLE_REDIRECT_URI'] ?? '';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        $oauth2 = new Google_Service_Oauth2($client);
        $googleUser = $oauth2->userinfo->get();

        $googleId = $googleUser->id;
        $name = $googleUser->name;
        $email = $googleUser->email;

        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, name FROM users WHERE google_id = ? OR email = ?");
        $stmt->execute([$googleId, $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
        } else {
            // Register new Google user
            $stmt = $pdo->prepare("INSERT INTO users (name, email, google_id) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $googleId]);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
        }

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Google login failed.";
        exit;
    }
} else {
    // Redirect to Google
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
    exit;
}