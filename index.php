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
            font-family: 'Georgia', serif;
            background-color: #fafafa;
            color: #4a4a4a;
        }

        /* Header стильдері */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #fff8f3;
            color: #5a3b22;
            border-bottom: 2px solid #e3ddd5;
        }

        header .logo {
            font-size: 1.8em;
            font-weight: bold;
            color: #5a3b22;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #5a3b22;
            font-size: 1em;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Hero секция стильдері */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px;
            background: linear-gradient(to right, #fffefb, #f5ebe1);
        }

        .hero-content {
            max-width: 50%;
        }

        .hero-content h1 {
            font-size: 3em;
            color: #5a3b22;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2em;
            color: #6d6d6d;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .hero-content .btn {
            padding: 10px 20px;
            background-color: #5a3b22;
            color: white;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
        }

        .hero-content .btn:hover {
            background-color: #3e2a19;
        }

        .hero-image {
            max-width: 40%;
            text-align: right;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }

        /* Контент бөлімі */
        .container {
            padding: 20px;
            text-align: center;
            background-color: #fff8f3;
            border-top: 2px solid #e3ddd5;
        }

        .container h3 {
            font-size: 1.8em;
            color: #5a3b22;
            margin-bottom: 10px;
        }

        .container p {
            font-size: 1.2em;
            color: #6d6d6d;
        }

        /* Footer стильдері */
        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 20px;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">Онлайн кітапхана</div>
        <nav>
            <a href="index.php">Басты бет</a>
            <a href="books.php">Кітаптар</a>
            <a href="about.php">Біз туралы</a>
            <a href="register.php">Тіркелу</a>
            <a href="login.php">Кіру</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Кітап әлеміне қош келдіңіз!</h1>
            <p>Онлайн кітапхана арқылы мыңдаған кітаптарды оңай басқарыңыз.</p>
            <a href="books.php" class="btn">Кітаптарды қарау</a>
        </div>
        <div class="hero-image">
            <img src="lib.jpeg" alt="Books and tablet">
        </div>
    </section>

    <!-- Контент бөлімі -->
    <div class="container">
        <h3>Біздің артықшылықтарымыз</h3>
        <p>Кітаптарды қосу, өшіру, және олар туралы пікір қалдыру мүмкіндігі бар.</p>
        <p>Пайдаланушыларға ыңғайлы платформа ұсынамыз!</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
    </footer>
</body>
</html>
