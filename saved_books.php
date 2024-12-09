<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Пайдаланушының сақтаған кітаптарын алу
$query = "SELECT b.id, b.title, b.author, b.genre, b.file_path 
          FROM saved_books sb
          JOIN books b ON sb.book_id = b.id
          WHERE sb.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сақталған кітаптар</title>
    <style>
        /* Жалпы стильдер */
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
            color: #4a4a4a;
        }

        /* Header стильдері */
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

        /* Бөлімдер стилі */
        .section-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
        }

        h1 {
            text-align: center;
            color: #a5673f;
            font-size: 2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-books {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        /* Кнопкалар мен сілтемелер */
        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-button a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Онлайн кітапхана</div>
        <nav>
            <a href="index.php">Басты бет</a>
            <a href="profile.php">Профиль</a>
            <a href="logout.php">Шығу</a>
        </nav>
    </header>

    <section class="section-container">
        <h1>Сақталған кітаптар</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Атауы</th>
                        <th>Автор</th>
                        <th>Жанр</th>
                        <th>Оқу/Жүктеу</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($book = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']); ?></td>
                            <td><?= htmlspecialchars($book['author']); ?></td>
                            <td><?= htmlspecialchars($book['genre']); ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($book['file_path']); ?>" target="_blank">Оқу</a> |
                                <a href="<?= htmlspecialchars($book['file_path']); ?>" download>Жүктеу</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-books">Сізде сақталған кітаптар жоқ.</p>
        <?php endif; ?>
    </section>

    <div class="back-button">
        <a href="profile.php">Артқа</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
