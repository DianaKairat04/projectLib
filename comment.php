<?php
session_start();
include 'db.php'; // Деректер базасымен байланыс орнату

// Егер пайдаланушы жүйеге кірмеген болса, логин бетіне қайта бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Пайдаланушының аты сессиядан алынады

// Пікірді сақтау
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && !empty($_POST['comment'])) {
    $comment = htmlspecialchars($_POST['comment']);
    $date = date("Y-m-d H:i:s");

    // Пікірді деректер базасына қосу
    $query = "INSERT INTO comments (user_id, username, comment, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $username, $comment, $date);
    if ($stmt->execute()) {
        $message = "Пікіріңіз сәтті жіберілді!";
    } else {
        $message = "Пікірді жіберуде қате болды!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пікірлер - Онлайн кітапхана</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #fafafa;
            margin: 0;
            color: #4a4a4a;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #fff8f3;
            color: #5a3b22;
            border-bottom: 2px solid #e3ddd5;
        }

        header .logo {
            font-size: 1.8em;
            font-weight: bold;
        }

        nav a {
            text-decoration: none;
            color: #5a3b22;
            font-size: 1em;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .content-section {
            padding: 50px;
            text-align: center;
        }

        .content-section h1 {
            font-size: 2.5em;
            color: #a5673f;
        }

        .content-section .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

        .content-section .error-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .comments-list {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .comment {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #a5673f;
            border-radius: 8px;
        }

        .comment p {
            margin: 5px 0;
        }

        .comment p strong {
            color: #5a3b22;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            font-size: 1.1em;
            color: #333;
        }

        button {
            padding: 10px 20px;
            background-color: #a5673f;
            color: white;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #81492d;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">Онлайн кітапхана</div>
    <nav>
        <a href="index.php">Басты бет</a>
        <a href="book_list.php">Кітаптар</a>
        <a href="saved_books.php">Менің кітаптарым</a>
        <a href="user_profile.php">Профиль</a>
    </nav>
</header>

<!-- Content Section -->
<section class="content-section" id="reviews">
    <div class="hero-content">
        <h1>Пайдаланушылар пікірі</h1>
        <p>Біздің оқырмандарымыз кітапхана жайлы тек жылы сөздер қалдырады. Барлық пікірлерді қарап шығыңыз және өз пікіріңізді қалдырыңыз!</p>
    </div>

    <!-- Пікір қалдыру формасы -->
    <form method="POST" action="">
        <textarea name="comment" placeholder="Сіздің пікіріңіз..." required></textarea>
        <button type="submit" class="btn">Пікір қалдыру</button>
    </form>

    <?php if (isset($message)) { ?>
        <div class="message"><?= $message; ?></div>
    <?php } ?>

    <!-- Пікірлер тізімі -->
    <div class="comments-list">
        <h2>Барлық пікірлер:</h2>
        <?php
        // Пікірлерді деректер базасынан алу
        $query = "SELECT * FROM comments ORDER BY created_at DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p><strong>" . htmlspecialchars($row['username']) . "</strong> - " . $row['created_at'] . "</p>";
                echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Пікір жоқ.</p>";
        }
        ?>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
</footer>

</body>
</html>
