<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Біз туралы</title>
    <style>
        /* Жалпы стильдер */
        body {
            font-family: 'Georgia', serif;
            background-color: #fafafa;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
        }

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

        nav a {
            text-decoration: none;
            color: #5a3b22;
            font-size: 1em;
            margin-left: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .about-section {
            padding: 50px;
            text-align: center;
            background: linear-gradient(to right, #fffefb, #f5ebe1);
        }

        .about-section h1 {
            font-size: 2.5em;
            color: #5a3b22;
            margin-bottom: 20px;
        }

        .about-section p {
            font-size: 1.2em;
            color: #6d6d6d;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .team {
            padding: 50px;
            text-align: center;
            background-color: #fff8f3;
        }

        .team h2 {
            font-size: 2em;
            color: #5a3b22;
            margin-bottom: 20px;
        }

        .team p {
            font-size: 1.2em;
            color: #6d6d6d;
            margin-bottom: 10px;
        }

        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 15px 0;
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

<!-- About Section -->
<div class="about-section">
    <h1>Біз туралы</h1>
    <p>
        Онлайн кітапхана — бұл кітап оқуды, іздеуді және сақтауды жеңілдететін заманауи веб-платформа.
        Біздің миссиямыз — барлық оқырмандарға қолжетімді және ыңғайлы қызмет көрсету.
    </p>
</div>

<!-- Team Section -->
<div class="team">
    <h2>Біздің команда</h2>
    <p>Тәжірибелі әзірлеушілер, дизайнерлер және кітапқұмарлар біріккен кәсіби команда.</p>
    <p>Біздің мақсатымыз — пайдаланушыларға ыңғайлы, заманауи және қызықты кітапханалық жүйе ұсыну.</p>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
</footer>

</body>
</html>
