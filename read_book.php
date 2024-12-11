<?php
session_start();
include 'db.php'; // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Кітаптың ID-ін алу
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Кітаптың жолын деректер базасынан алу
    $query = "SELECT file_path, title FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($file_path, $title);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Файлдың бар-жоғын тексеру
        if (!file_exists($file_path)) {
            echo "Кітап файлы серверде жоқ.";
            exit;
        }
    } else {
        echo "Кітап табылмады.";
        exit;
    }
    $stmt->close();
} else {
    echo "Кітап идентификаторы жоқ.";
    exit;
}

// PDF файлын көрсету
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
readfile($file_path);

$conn->close();
?>
