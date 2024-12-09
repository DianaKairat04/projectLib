<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кіру</title>
    <style>
        /* Жалпы стильдер */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Georgia', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #4a4a4a;
        }

        /* Артқы фон суреті */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('lib.jpeg') no-repeat center center/cover;
            filter: blur(8px);
            z-index: -1;
        }

        /* Форманың стильдері */
        form {
            background: rgba(255, 248, 243, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            border: 2px solid #e3ddd5;
            position: relative;
            z-index: 1;
        }

        h2 {
            text-align: center;
            color: #5a3b22;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #5a3b22;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5a3b22;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #3e2a19;
        }

        .back-button {
            margin-top: 10px;
            background-color: #bfa17c;
        }

        .back-button:hover {
            background-color: #a1886a;
        }
    </style>
</head>
<body>
    <form action="login_handler.php" method="POST">
        <h2>Кіру</h2>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Құпиясөз:</label>
        <input type="password" name="password" required>
        <button type="submit">Кіру</button>
        <button type="button" class="back-button" onclick="window.history.back()">Артқа</button>
    </form>
</body>
</html>
