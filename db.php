<?php
// Деректер базасы параметрлері
$host = 'localhost';  // Сервердің мекенжайы
$dbname = 'online_library';  // Деректер базасының аты
$username = 'root';   // Деректер базасына қосылу үшін пайдаланушы аты
$password = '';       // Пайдаланушының паролі (әдетте, жергілікті серверде бос болады)

// Деректер базасына қосылу
$conn = new mysqli($host, $username, $password, $dbname);

// Қосылу қатесін тексеру
if ($conn->connect_error) {
    die("Қосылу қатесі: " . $conn->connect_error); // Қате болса, тоқтатып, хабарлама шығару
}
?>
