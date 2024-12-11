<?php
session_start();
include 'db.php';  // Деректер базасына қосылу

// Кітаптарды іздеу функциясы
$search = '';
$search_query = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    if ($search != '') {
        $search_query = " AND (title LIKE ? OR author LIKE ?);";
    }
}

// Кітаптар тізімін алу
$query = "SELECT * FROM books WHERE 1" . $search_query . " ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
if ($search) {
    $search_term = "%" . $search . "%";
    $stmt->bind_param("ss", $search_term, $search_term);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кітаптар</title>
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

<div class="container">
    <h1>Кітаптар тізімі</h1>
    <div class="search-bar">
        <form action="books.php" method="GET">
            <input type="text" name="search" placeholder="Кітап атауы немесе авторы" value="<?= htmlspecialchars($search); ?>">
            <button type="submit">Іздеу</button>
        </form>
    </div>
    <table>
        <thead>
        <tr>
            <th>Сурет</th>
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
                <td><img src="<?= htmlspecialchars($row['image_path'] ?? 'default_image.jpg'); ?>" class="book-cover"></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['author']); ?></td>
                <td><?= htmlspecialchars($row['genre']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="read_book.php?id=<?= $row['id']; ?>">Оқу</a> |
                    <a href="download.php?id=<?= $row['id']; ?>">Жүктеу</a> |
                    <a href="save_book.php?id=<?= $row['id']; ?>">Сақтау</a>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php if ($result->num_rows === 0): ?>
            <tr><td colspan="6">Кітап табылмады!</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
</footer>
</body>
</html>
