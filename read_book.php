<?php
session_start();
include 'db.php'; // Деректер базасымен байланыс

// URL арқылы жіберілген кітаптың ID-ін алу
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Кітапты деректер базасынан іздеу
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

// Егер кітап табылмаса, қате хабарламасын көрсету
if (!$book) {
    echo "<h1>Кітап табылмады!</h1>";
    exit;
}

// Кітап файл жолы
$file_path = $book['file_path'];
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['title']); ?> - Оқу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        iframe {
            width: 100%;
            height: 90vh;
            border: none;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            max-width: 200px;
            margin: 15px auto;
        }
        .back-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Кітап оқу: <?= htmlspecialchars($book['title']); ?></h1>
    </header>
    <div class="container">
        <!-- Артқа қайту батырмасы -->
        <a href="books.php" class="back-btn">Артқа қайту</a>

        <!-- Кітапты көрсету -->
        <?php if ($file_path && pathinfo($file_path, PATHINFO_EXTENSION) === 'pdf'): ?>
            <iframe src="<?= htmlspecialchars($file_path); ?>"></iframe>
        <?php else: ?>
            <p>Бұл кітапты сайт ішінде оқу мүмкін емес. Жүктеп алып оқыңыз.</p>
            <a href="<?= htmlspecialchars($file_path); ?>" download>Кітапты жүктеу</a>
        <?php endif; ?>
    </div>
</body>
</html>
