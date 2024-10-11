<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content->title }}</title>
</head>
<body>
    <div style="text-align: center; padding: 50px; color: red">
        <h1>{{ $content->title }}</h1>
        <div style="padding: 50px; font-size: 50px">
            <p>{!! nl2br(e($content->body)) !!}</p>
        </div>
    </div>
</body>
</html>
