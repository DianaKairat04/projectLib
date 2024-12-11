<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Кітаптың ID-ін алу
if (isset($_GET['book_id'])) {
    $book_id = (int)$_GET['book_id'];

    // Кітаптың жолын деректер базасынан алу
    $query = "SELECT file_path, title FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($file_path, $title);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
    } else {
        // Егер кітап табылмаса, қате көрсету
        echo "Кітап табылмады.";
        exit;
    }
    $stmt->close();
} else {
    echo "Кітап идентификаторы жоқ.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кітапты оқу - <?= htmlspecialchars($title); ?></title>
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
        <h1>Кітапты оқу: <?= htmlspecialchars($title); ?></h1>

        <embed src="<?= htmlspecialchars($file_path); ?>" width="100%" height="600px" type="application/pdf">

        <div class="back-button">
            <a href="book_list.php">Артқа</a>
        </div>
    </section>

</body>
</html>

<?php
$conn->close();
?>
