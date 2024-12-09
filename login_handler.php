<?php
session_start();
include 'db.php'; // Деректер базасына қосылу файлын қосыңыз

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Деректер базасынан пайдаланушыны іздеу
    $query = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Құпиясөзді тексеру
        if (password_verify($password, $user['password'])) {
            // Пайдаланушыны жүйеге кіргізу
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Негізгі бетке бағыттау
            header("Location: profile.php");
            exit;
        } else {
            // Қате құпиясөз
            $_SESSION['error_message'] = "Қате құпиясөз!";
            header("Location: login.php");
            exit;
        }
    } else {
        // Электрондық пошта табылмады
        $_SESSION['error_message'] = "Бұл email тіркелмеген!";
        header("Location: login.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
