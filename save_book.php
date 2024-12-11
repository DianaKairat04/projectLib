<?php
session_start();
include 'db.php';  // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Кітаптың ID-ін алу
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];  // Қолданушының ID-сі

    // Кітапты сақтау (saved_books) кестесіне қосу
    $query = "INSERT INTO saved_books (user_id, book_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Кітап сәтті сақталды!";
    } else {
        $_SESSION['error_message'] = "Қате: Кітапты сақтау мүмкін болмады.";
    }
    $stmt->close();
} else {
    $_SESSION['error_message'] = "Кітап идентификаторы жоқ.";
}

header("Location: book_list.php");  // Кітаптар тізіміне қайта бағыттау
exit;
?>
