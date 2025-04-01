<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خبر جديد!</title>
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; text-align: right; }
        .container { padding: 20px; background-color: #f4f4f4; border-radius: 10px; }
        h2 { color: #2c3e50; }
        .btn { background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📢 خبر جديد!</h2>
        <p>{{ $news->title }}</p>
        <p>{{ $news->content }}</p>
        <a href="{{ url('/news/' . $news->id) }}" class="btn">قراءة المزيد</a>
    </div>
</body>
</html>
