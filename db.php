<?php
$host = 'localhost';
$dbname = 'online_library';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Деректер базасына қосылу сәтсіз: " . $conn->connect_error);
}
?>

