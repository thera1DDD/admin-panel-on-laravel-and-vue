<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 0 0 10px;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Feedback Notification</h2>

<p>Ассаламу алейкум!</p>

<p>У вас новое сообщение от пользователя:</p>

<p><strong>Пользователь: </strong> {{ $data['name'] }}</p>
<p><strong>Мобильный номер пользователя:</strong> {{ $data['phone'] }}</p>
<p><strong>Вопрос:</strong> {{ $data['question'] }}</p>
<p>Спасибо за внимание!</p>
</body>
</html>
