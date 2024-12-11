<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Пайдаланушының сақталған кітаптарын алу
$user_id = $_SESSION['user_id'];  // Қолданушының ID-сі
$query = "SELECT b.id, b.title, b.author, b.genre, b.description, b.file_path 
          FROM books b 
          INNER JOIN saved_books sb ON b.id = sb.book_id 
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
        body {
            font-family: 'Georgia', serif;
            background-color: #fafafa;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
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
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #a5673f;
            margin-bottom: 20px;
        }
        .search-bar {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-bar button {
            padding: 10px 20px;
            background-color: #a5673f;
            color: white;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #81492d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #a5673f;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .book-cover {
            width: 80px;
            height: auto;
        }
        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
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

    <!-- Content Section -->
    <div class="content-container">
        <h1>Сақталған кітаптар</h1>

        <table>
            <thead>
                <tr>
                    <th>Атауы</th>
                    <th>Автор</th>
                    <th>Жанр</th>
                    <th>Аннотация</th>
                    <th>Әрекет</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']); ?></td>
                        <td><?= htmlspecialchars($row['author']); ?></td>
                        <td><?= htmlspecialchars($row['genre']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                        <td>
                            <a href="read_book.php?id=<?= $row['id']; ?>">Оқу</a> | 
                            <a href="download.php?id=<?= $row['id']; ?>">Жүктеу</a> | 
                            <a href="delete_book.php?id=<?= $row['id']; ?>" onclick="return confirm('Шынымен осы кітапты жойғыңыз келе ме?')">Жою</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
    </footer>

</body>
</html>
