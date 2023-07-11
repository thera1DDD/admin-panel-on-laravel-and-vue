<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin: 0 0 10px;
        }

        .code {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Сброс пароля</h2>

    <p>Ассаламу алейкум!</p>

    <p>Для сброса пароля введите полученный код подтверждения:</p>

    <div class="code">{{ $verification_code}}</div>

    <p>Спасибо за внимание!</p>
</div>

<div class="footer">
    &copy; {{ date('Y') }} DJigit-IT. Все права защищены.
</div>
</body>
</html>
