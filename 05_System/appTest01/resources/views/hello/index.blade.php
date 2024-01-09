<!Doctype html>
<head>
    <meta charset="UTF-8">
    <title> タイトル</title>
</head>
<body>
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
</body>
