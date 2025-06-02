<?php
require_once 'vendor/autoload.php';
require_once 'env_loader.php'; // Load environment variables

putenv('CURL_CA_BUNDLE='); // Disable SSL cert check globally (temporary)

session_start();

use GuzzleHttp\Client as GuzzleClient;

$guzzleClient = new GuzzleClient(['verify' => false]);

$googleClient = new \Google\Client();
$googleClient->setHttpClient($guzzleClient);

// Load Google OAuth configuration from environment variables
$googleClient->setClientId($_ENV['GOOGLE_CLIENT_ID'] ?? '');
$googleClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET'] ?? '');
$googleClient->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI'] ?? '');
$googleClient->addScope('email');
$googleClient->addScope('profile');

if (isset($_GET['code'])) {
    try {
        $token = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['error'])) {
            throw new Exception(join(', ', $token));
        }

        $googleClient->setAccessToken($token['access_token']);

        $oauth2 = new \Google\Service\Oauth2($googleClient);
        $userInfo = $oauth2->userinfo->get();

        $_SESSION['user_email'] = $userInfo->email;
        $_SESSION['user_name'] = $userInfo->name;
        $_SESSION['user_id'] = $userInfo->id;

        header('Location: dashboard.php');
        exit();

    } catch (Exception $e) {
        echo 'Error during Google OAuth: ' . htmlspecialchars($e->getMessage());
        exit();
    }
} else {
    $authUrl = $googleClient->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
}