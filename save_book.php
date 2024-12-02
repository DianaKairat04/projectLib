<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);
    $user_id = $_SESSION['user_id'];

    // Сақтау
    $query = "INSERT INTO saved_books (user_id, book_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $book_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Кітап сақталды!";
    } else {
        $_SESSION['error_message'] = "Кітапты сақтау кезінде қате пайда болды.";
    }

    $stmt->close();
}

header("Location: book_list.php");
exit;
?>
