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
            background: linear-gradient(to right, #fff, #f6ebe0);
        }

        .hero-content {
            max-width: 50%;
        }

        .hero-content h1 {
            font-size: 2.5em;
            color: #a5673f;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2em;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .hero-content .btn {
            padding: 10px 20px;
            background-color: #a5673f;
            color: white;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
        }

        .hero-content .btn:hover {
            background-color: #81492d;
        }

        .hero-image {
            max-width: 40%;
            text-align: right;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }

        /* Жалпы контейнер стильдері */
        .content-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px;
            border-bottom: 1px solid #ddd;
        }

        .content-section:nth-child(odd) {
            background: #f6f6f6;
        }

        .content-section:nth-child(even) {
            background: #fff;
        }

        /* Footer стильдері */
        footer {
            background-color: #5a3b22;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">Онлайн кітапхана</div>
        <nav>
            <a href="index.php">Басты бет</a>
            <a href="add_book.php">Кітаптар қосу</a>
            <a href="saved_books.php">Менің кітаптарым</a>
            <a href="user_profile.php">Профиль</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero-content">
            <h1>Кітап әлеміне қош келдіңіз!</h1>
            <p>Мыңдаған кітаптарды оңай басқарып, оларға пікір қалдырыңыз.</p>
            <a href="#advantages" class="btn">Толығырақ</a>
        </div>
        <div class="hero-image">
            <img src="library-image.png" alt="Books and tablet">
        </div>
    </section>

    <!-- Content Section 1 -->
    <section class="content-section" id="advantages">
        <div class="hero-content">
            <h1>Біздің артықшылықтарымыз</h1>
            <p>Онлайн кітапханамыз сізге кітаптарды қосуға, өшіруге және оларға баға беруге мүмкіндік береді. Сондай-ақ, пікірлер қалдыруға болады!</p>
            <a href="#reviews" class="btn">Пікірлерді оқу</a>
        </div>
        <div class="hero-image">
            <img src="advantages-image.png" alt="Advantages of Library">
        </div>
    </section>

    <!-- Content Section 2 -->
    <section class="content-section" id="reviews">
        <div class="hero-content">
            <h1>Пайдаланушылар пікірі</h1>
            <p>Біздің оқырмандарымыз кітапхана жайлы тек жылы сөздер қалдырады. Барлық пікірлерді қарап шығыңыз және өз пікіріңізді қалдырыңыз!</p>
            <a href="#contacts" class="btn">Бізбен байланысу</a>
        </div>
        <div class="hero-image">
            <img src="reviews-image.png" alt="Reviews and Feedback">
        </div>
    </section>

    <!-- Content Section 3 -->
    <section class="content-section" id="contacts">
        <div class="hero-content">
            <h1>Байланыс</h1>
            <p>Сұрақтарыңыз немесе ұсыныстарыңыз болса, бізге хабарласыңыз. Біз сіздермен байланысқа шыққанға қуаныштымыз!</p>
            <a href="mailto:contact@onlinelibrary.kz" class="btn">Бізге хат жазу</a>
        </div>
        <div class="hero-image">
            <img src="contact-image.png" alt="Contact Us">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Онлайн кітапхана. Барлық құқықтар қорғалған.</p>
    </footer>
</body>
</html>
