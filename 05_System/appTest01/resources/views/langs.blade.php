<!Doctype html>
<head>
    <meta charset="UTF-8">
    <title>タイトル</title>
</head>
<body>
    <ul>
        @foreach ($langs as $lang)
            <li>{{ $lang->lang_name }}</li>
        @endforeach
    </ul>
</body>
