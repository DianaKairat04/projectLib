<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Онлайн кітапхана</title>
    <style>
        /* Жалпы стильдер */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 20px 10px;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        nav {
            background: #0056b3;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1em;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .hero {
            text-align: center;
            padding: 50px 10px;
            background: url('library-bg.jpg') no-repeat center center/cover;
            color: white;
        }
        .hero h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2em;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .container h3 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Header бөлімі -->
    <header>
        <h1>Онлайн кітапхана</h1>
        <p>Сандық кітап әлеміне қош келдіңіз!</p>
    </header>

    <!-- Навигация -->
    <nav>
        <a href="index.php">Басты бет</a>
        <a href="register.php">Тіркелу</a>
        <a href="login.php">Кіру</a>
        <a href="books.php">Кітаптар</a>
        <a href="about.php">Біз туралы</a>
    </nav>

    <!-- Hero бөлімі -->
    <div class="hero">
        <h2>Кітаптарды оңай басқарыңыз</h2>
        <p>Біздің кітапхана арқылы кітаптарды қосып, өшіріп, оларға пікірлер қалдырыңыз.</p>
    </div>

    <!-- Контент бөлімі -->
    <div class="container">
        <h3>Біздің артықшылықтарымыз</h3>
        <p>Онлайн кітапханамызда мыңдаған кітаптар бар, оларды оңай басқаруға болады.</p>
        <p>Пайдаланушылар пікір қалдырып, кітаптарға баға бере алады.</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
    </footer>
</body>
</html>
