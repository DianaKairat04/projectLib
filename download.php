<?php
session_start();
include 'db.php';  // Деректер базасына қосылу

// Егер пайдаланушы жүйеге кірмеген болса, кіру бетіне бағыттау
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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
        
        // Файлдың толық жолын құру
        $filepath = __DIR__ . '/' . $file_path; // Дұрыс жолды құру үшін 'uploads/' қосуды қосыңыз

        // Файлдың бар-жоғын тексеру
        echo "File Path: " . $filepath . "<br>"; // Файл жолын тексеру үшін

        if (file_exists($filepath)) {
            // Жүктеу тақырыптарын орнату
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf'); 
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            
            // Файлды шығару
            readfile($filepath);
            exit;
        } else {
            echo "Файл табылмады: " . $filepath; // Файл жоқ екенін көрсету
        }
    } else {
        echo "Кітап табылмады.";
    }
    $stmt->close();
} else {
    echo "Кітап идентификаторы жоқ.";
}
?>
