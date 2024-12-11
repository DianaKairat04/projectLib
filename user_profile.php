<?php
session_start();
include 'db.php'; // Деректер базасымен байланыс орнату

// Пайдаланушының ID-сі сессиядан алу
if (!isset($_SESSION['user_id'])) {
    // Егер сессияда пайдаланушы ID-і жоқ болса, логин бетіне қайта бағыттау
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Пайдаланушы туралы мәліметтерді алу
$query = "SELECT username, email, created_at, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Егер пайдаланушы табылмаса, қате көрсетеміз
    echo "Пайдаланушы табылмады!";
    exit;
}

// Құпия сөзді жаңарту процесі
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password']) && !empty($_POST['new_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $update_query = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_password, $user_id);
    if ($stmt->execute()) {
        $message = "Құпия сөз сәтті жаңартылды!";
    } else {
        $message = "Құпия сөзді жаңартуда қате пайда болды!";
    }
}

// Профиль суретін жаңарту процесі
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $profile_picture = $_FILES['profile_picture'];
    
    // Сурет дұрыс жүктелгенін тексеру
    if ($profile_picture['error'] == 0) {
        // Суретті сақтау үшін жолды анықтау
        $upload_dir = 'uploads/profile_pictures/';
        $file_name = uniqid() . '_' . basename($profile_picture['name']);
        $upload_file = $upload_dir . $file_name;

        // Суретті сақтау
        if (move_uploaded_file($profile_picture['tmp_name'], $upload_file)) {
            // Суретті деректер базасына қосу
            $update_picture_query = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($update_picture_query);
            $stmt->bind_param("si", $upload_file, $user_id);

            if ($stmt->execute()) {
                $message = "Профиль суреті сәтті жаңартылды!";
            } else {
                $message = "Суретті сақтау кезінде қате пайда болды!";
            }
        } else {
            $message = "Суретті жүктеу кезінде қате болды.";
        }
    } else {
        $message = "Сурет дұрыс жүктелген жоқ.";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль - Онлайн кітапхана</title>
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

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 50px;
        }

        .profile-container h1 {
            font-size: 2.5em;
            color: #a5673f;
        }

        .profile-container img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-container .profile-info {
            margin-top: 20px;
        }

        .profile-container .profile-info p {
            font-size: 1.2em;
            color: #555;
        }

        .profile-container .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #a5673f;
            color: white;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
        }

        .profile-container .btn:hover {
            background-color: #81492d;
        }

        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

        .error-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
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
            <a href="add_book.php">Кітаптар қосу</a>
            <a href="saved_books.php">Менің кітаптарым</a>
            <a href="user_profile.php">Профиль</a>
        </nav>
    </header>

    <!-- Profile Section -->
    <div class="profile-container">
        <h1>Сіздің Профиліңіз</h1>

        <?php if (isset($message)) { ?>
            <div class="message"><?= $message; ?></div>
        <?php } ?>

        <?php if (isset($error_message)) { ?>
            <div class="error-message"><?= $error_message; ?></div>
        <?php } ?>

        <!-- Display user profile picture -->
        <img src="<?= htmlspecialchars($user['profile_picture'] ?: 'default-profile.png'); ?>" alt="Профиль суреті">
        
        <div class="profile-info">
            <p><strong>Аты-жөні:</strong> <?= htmlspecialchars($user['username']); ?></p>
            <p><strong>Электрондық пошта:</strong> <?= htmlspecialchars($user['email']); ?></p>
            <p><strong>Тіркелген күні:</strong> <?= htmlspecialchars($user['created_at']); ?></p>
        </div>

        <!-- Change password form -->
        <h2>Құпия сөзді өзгерту</h2>
        <form method="POST" action="">
            <label for="new_password">Жаңа құпиясөз:</label>
            <input type="password" name="new_password" id="new_password" required>
            <button type="submit" class="btn">Құпия сөзді өзгерту</button>
        </form>

        <!-- Profile picture upload form -->
        <h2>Профиль суретін өзгерту</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="profile_picture">Жаңа профиль суреті:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            <button type="submit" class="btn">Суретті жаңарту</button>
        </form>

    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
    </footer>

</body>
</html>
