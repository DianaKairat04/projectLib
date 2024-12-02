<?php
session_start();

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .profile-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-info h2 {
            margin: 0;
        }
        .nav-links {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .nav-links a {
            display: block;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
            text-align: center;
        }
        .nav-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Пайдаланушы профилі</h1>
    </div>
    <div class="container">
        <div class="profile-info">
            <h2>Сәлем, <?= htmlspecialchars($username); ?>!</h2>
            <p>Онлайн кітапханаңызға қош келдіңіз!</p>
        </div>
        <div class="nav-links">
            <a href="book_list.php">Кітаптар тізімі</a>
            <a href="saved_books.php">Сақталған кітаптар</a>
            <a href="add_book.php">Жаңа кітап қосу</a>
            <a href="logout.php" style="background-color: #dc3545;">Шығу</a>
        </div>
    </div>
</body>
</html>

