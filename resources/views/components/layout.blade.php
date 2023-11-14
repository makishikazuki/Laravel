<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <script src="https://kit.fontawesome.com/16d5915e4c.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <div>
        <h1 class="header">
            <a href="{{ route('posts.index') }}" class="header_text">My BBS</a>
        </h1>
    </div>
    <div class="container">
        {{ $slot }}
    </div>
</body>
</html>