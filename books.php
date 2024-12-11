<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне қайта бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Кітаптар тізімін деректер базасынан алу
$query = "SELECT id, title, author, genre, file_path FROM books ORDER BY title";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Кітаптар тізімі</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            padding: 20px 50px;
            background-color: #fff8f3;
            color: #5a3b22;
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
        .section-container {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
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
    </style>
</head>
<body>

<header>
    <div class="logo">Онлайн кітапхана</div>
    <nav>
            <a href="profile.php">Басты бет</a>
            <a href="book_list.php">Кітаптар</a>
            <a href="add_book.php">Кітаптар қосу</a>
            <a href="saved_books.php">Менің кітаптарым</a>
            <a href="user_profile.php">Профиль</a>
    </nav>
</header>

<section class="section-container">
    <h1>Кітаптар тізімі</h1>

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
            <?php if ($result->num_rows > 0): ?>
                <?php while ($book = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['title']); ?></td>
                        <td><?= htmlspecialchars($book['author']); ?></td>
                        <td><?= htmlspecialchars($book['genre']); ?></td>
                        <td>
                            <a href="<?= htmlspecialchars($book['file_path']); ?>" target="_blank">Оқу</a> |
                            <a href="download.php?file=<?= urlencode($book['file_path']); ?>" download>Жүктеу</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Кітаптар табылмады.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

</body>
</html>

<?php
$conn->close();
?>
