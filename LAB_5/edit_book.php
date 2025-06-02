<?php
// edit_book.php

session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: dashboard.php");
    exit