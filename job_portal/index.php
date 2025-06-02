<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ROYALE'S OPPORTUNITIES</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            width: 100%;
        }

        .full-logo {
            background: url('logo.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            width: 100vw;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* dark overlay */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .overlay h1 {
            font-size: 48px;
            margin-bottom: 30px;
        }

        .search-bar {
            margin: 20px 0;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: none;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .buttons a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .overlay h1 {
                font-size: 28px;
            }

            .search-bar input[type="text"] {
                width: 200px;
            }
        }
    </style>
</head>
<body>

<div class="full-logo">
    <div class="overlay">
        <h1>Welcome to ROYALE’S OPPORTUNITIES</h1>

        <div class="search-bar">
            <form action="browse_jobs.php" method="get">
                <input type="text" name="search" placeholder="Search jobs...">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="browse_jobs.php">Browse Jobs</a>
        </div>
    </div>
</div>

</body>
</html>