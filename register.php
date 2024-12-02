<?php
// Сессияны бастау
session_start();
include 'db.php'; // Деректер базасына қосылу

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Құпиясөзді хэштеу
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Деректер базасына жазу
    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Тіркелу сәтті аяқталды!";
        header("Location: login.php"); // Кіру бетіне бағыттау
        exit;
    } else {
        $error_message = "Қате: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тіркелу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            margin-top: 10px;
            background-color: #6c757d;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h2>Тіркелу</h2>
        <?php if (isset($error_message)): ?>
            <div class="error"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <label>Логин:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Құпиясөз:</label>
        <input type="password" name="password" required>
        <button type="submit">Тіркелу</button>
        <!-- Артқа батырмасы -->
        <button type="button" class="back-button" onclick="window.history.back()">Артқа</button>
    </form>
</body>
</html>
