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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
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
    </style>
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
