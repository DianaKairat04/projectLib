<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Кітап ID-сін алу
if (isset($_GET['id'])) {
    $book_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Жою сұранысын орындау
    $query = "DELETE FROM saved_books WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        // Егер сұраныс дайындалмаса, қате туралы хабарлама шығару
        die('Қате SQL сұранысы: ' . $conn->error);
    }

    $stmt->bind_param("ii", $book_id, $user_id);
    
    // Сұранысты орындау
    if ($stmt->execute()) {
        // Егер жою сәтті болса, пайдаланушыны сақталған кітаптар бетіне қайта бағыттау
        header("Location: saved_books.php");
        exit;
    } else {
        // Жою қатесі болса, қате туралы хабарлама шығару
        die('Кітапты жоя алмадық: ' . $stmt->error);
    }

    $stmt->close();
} else {
    echo "Кітап идентификаторы жоқ.";
}

$conn->close();
?>
