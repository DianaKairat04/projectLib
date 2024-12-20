<?php
session_start();

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне қайта бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php'; // Деректер базасына қосылу

// Егер форма жіберілген болса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Пайдаланушының енгізген мәліметтерін алу
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    // Файлдарды жүктеу папкасы
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Файлдарды алу
    $image_path = $_FILES['image_path']['name']; // Сурет файлы
    $file_path = $_FILES['file_path']['name'];   // PDF файл

    $image_tmp = $_FILES['image_path']['tmp_name'];
    $file_tmp = $_FILES['file_path']['tmp_name'];

    // Сурет және файл кеңейтімдері
    $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowed_file_extensions = ['pdf'];
    $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
    $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);

    // Файлдардың өлшемдерін тексеру
    $max_image_size = 5 * 1024 * 1024; // 5MB
    $max_file_size = 10 * 1024 * 1024; // 10MB

    // Сурет файлының өлшемін тексеру
    if ($_FILES['image_path']['size'] > $max_image_size) {
        $_SESSION['error_message'] = "Сурет файлының өлшемі 5MB-тан аспауы керек.";
        header("Location: add_book.php");
        exit;
    }

    // PDF файлының өлшемін тексеру
    if ($_FILES['file_path']['size'] > $max_file_size) {
        $_SESSION['error_message'] = "PDF файлының өлшемі 10MB-тан аспауы керек.";
        header("Location: add_book.php");
        exit;
    }

    // Файл кеңейтімдерін тексеру
    if (!in_array($image_ext, $allowed_image_extensions)) {
        $_SESSION['error_message'] = "Тек сурет (jpg, jpeg, png, gif) форматтарын жүктеуге болады.";
        header("Location: add_book.php");
        exit;
    }

    if (!in_array($file_ext, $allowed_file_extensions)) {
        $_SESSION['error_message'] = "Тек PDF файлдарын жүктеуге болады.";
        header("Location: add_book.php");
        exit;
    }

    // Файл аттарын қайта атау (қазақ тілінде кітап атауы мен авторды пайдалану)
    // Кітап атауын және авторды біріктіріп файл атын жасау
    $file_base_name = preg_replace("/[^a-zA-Z0-9А-Яа-я\s\.]/u", '', $title . '.' . $author); // Ағылшын және кириллица символдары
    $image_new_name = $file_base_name . '.' . $image_ext;
    $file_new_name = $file_base_name . '.' . $file_ext;

    // Файлдарды жүктеу
    if (move_uploaded_file($image_tmp, $upload_dir . $image_new_name) && move_uploaded_file($file_tmp, $upload_dir . $file_new_name)) {
        // Деректер базасына жазу
        // Мұнда файл жолын толық сақтаймыз: 'uploads/filename'
        $image_full_path = $upload_dir . $image_new_name;
        $file_full_path = $upload_dir . $file_new_name;

        $query = "INSERT INTO books (title, author, genre, description, image_path, file_path, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $title, $author, $genre, $description, $image_full_path, $file_full_path, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Кітап сәтті қосылды!";
            header("Location: profile.php"); // Пайдаланушының профиліне бағыттау
            exit;
        } else {
            $_SESSION['error_message'] = "Қате: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Файлдарды жүктеу кезінде қате орын алды.";
        header("Location: add_book.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кітап қосу</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
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

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #5a3b22;
            font-size: 1em;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
        }

        h2 {
            text-align: center;
            color: #a5673f;
            font-size: 2em;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #a5673f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
        }

        button:hover {
            background-color: #81492d;
        }

        .back-button {
            margin-top: 10px;
            text-align: center;
        }

        .back-button a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-button a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 1em;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Онлайн кітапхана</div>
        <nav>
            <a href="profile.php">Басты бет</a>
            <a href="kitaptar.php">Кітаптар</a>
            <a href="saved_books.php">Менің кітаптарым</a>
            <a href="user_profile.php">Профиль</a>
        </nav>
    </header>

    <div class="form-container">
        <h2>Кітап қосу</h2>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label>Кітап атауы:</label>
            <input type="text" name="title" required>

            <label>Автор:</label>
            <input type="text" name="author" required>

            <label>Жанр:</label>
            <select name="genre" required>
                <option value="">Жанрды таңдаңыз</option>
                <option value="Роман">Роман</option>
                <option value="Ғылыми фантастика">Ғылыми фантастика</option>
                <option value="Детектив">Детектив</option>
                <option value="Поэзия">Поэзия</option>
                <option value="Балалар әдебиеті">Балалар әдебиеті</option>
                <option value="Өмірбаян">Өмірбаян</option>
                <option value="Фантастика">Фантастика</option>
                <option value="Классика">Классика</option>
            </select>

            <label>Сипаттама:</label>
            <textarea name="description" rows="4" required></textarea>

            <label>Сурет:</label>
            <input type="file" name="image_path" required>

            <label>Кітап файлы (PDF):</label>
            <input type="file" name="file_path" required>

            <button type="submit">Қосу</button>
        </form>

        <div class="back-button">
            <a href="profile.php">Артқа</a>
        </div>
    </div>
</body>
</html>
