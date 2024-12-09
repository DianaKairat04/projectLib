<?php
include 'db.php'; // Деректер базасымен байланыс

// Іздеу сұранысын алу
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Кітаптарды деректер базасынан таңдау
$query = "SELECT * FROM books WHERE title LIKE ?";
$stmt = $conn->prepare($query);
$search_term = "%$search%";
$stmt->bind_param("s", $search_term);
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
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-bar input {
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-bar button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        .book-cover {
            width: 80px;
            height: auto;
            display: block;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Кітаптар тізімі</h1>
        <p>Қазақ және әлем әдебиетінің үздік туындыларын электронды форматта тегін жүктеп, оқыңыздар.</p>
    </header>
    <div class="container">
        <div class="search-bar">
            <form action="books.php" method="GET">
                <input type="text" name="search" placeholder="Кітаптың атауы:" value="<?= htmlspecialchars($search); ?>">
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
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['title']); ?>" class="book-cover">
                        </td>
                        <td>
                            <a href="read_book.php?id=<?= $row['id']; ?>"><?= htmlspecialchars($row['title']); ?></a>
                        </td>
                        <td><?= htmlspecialchars($row['author']); ?></td>
                        <td><?= htmlspecialchars($row['genre']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($result->num_rows === 0): ?>
                    <tr>
                        <td colspan="5">Кітап табылмады!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
