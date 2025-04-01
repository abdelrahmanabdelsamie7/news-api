<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>📢 خبر جديد</title>
    <style>
        body {
            font-family: "Cairo", sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: #d6d4d4;
            border-radius: 15px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        h2 {
            color: #f75815;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            font-weight: 500;
            color: #212529;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #2d465e;
            color: #ffffff !important;
            text-decoration: none;
            padding: 15px 28px;
            font-size: 20px;
            font-weight: 550;
            text-decoration: none;
            border-radius: 10px;
            display: inline-block;
            transition: 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #1d3246;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>📢 خبر جديد!</h2>
        <p><strong>{{ $news->title }}</strong></p>
        <p>{{ $news->content }}</p>
        <a href="http://localhost:4200/post/{{ $news->id }}" class="btn">📖 قراءة المزيد</a>
    </div>
</body>

</html>
