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

        nav a {
            text-decoration: none;
            color: #5a3b22;
            font-size: 1em;
            margin-left: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 40px 60px;
            max-width: 1200px;
            margin: auto;
        }

        .search-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .search-bar input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #5a3b22;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #3e2a19;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff8f3;
            border: 2px solid #e3ddd5;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e3ddd5;
        }

        table th {
            background-color: #5a3b22;
            color: white;
            font-size: 1em;
        }

        table td a {
            color: #5a3b22;
            font-weight: bold;
        }

        table td a:hover {
            text-decoration: underline;
        }

        .book-cover {
            width: 80px;
            height: auto;
            display: block;
            border-radius: 5px;
        }

        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 15px 0;
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
        <a href="books.php">Кітаптар</a>
        <a href="about.php">Біз туралы</a>
        <a href="register.php">Тіркелу</a>
        <a href="login.php">Кіру</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h1>Кітаптар тізімі</h1>
    <p>Қазақ және әлем әдебиетінің үздік туындыларын тегін жүктеп, оқыңыздар.</p>

    <div class="search-bar">
        <form action="books.php" method="GET">
            <input type="text" name="search" placeholder="Кітап атауы" value="<?= htmlspecialchars($search); ?>">
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

<!-- Footer -->
<footer>
    <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
</footer>

</body>
</html>
