<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Todoリスト</title>
</head>
<body>
    <div class="text-center p-3 mb-2 bg-secondary text-white fw-bold" style="height:95px">
        <h1 class="navbar-brand">BLOG Todoリスト</h1>
        <a class="nav-link text-right text-white small" href="{{ route('tasks.add') }}">＋タスクを追加する</a>
    </div>
    <div class="container" style="width:860px">
        <table class="table table-bordered">
            <tr class="table-primary">
                <th class="text-center text-secondary">タスク</th>
                <th class="text-center text-secondary">アクション</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td class="td1">{{ $task->name }}</td>
                    <td class="td2 ">
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('tasks/' . $task->id . '/show') }}" class="btn btn-success">詳 細</a>
                            <a href="{{ url('tasks/' . $task->id . '/edit') }}" class="btn btn-primary">編 集</a>
                            <form action="{{ route('tasks.derete', ['id' => $task->id]) }}" method="post" name="deleteForm">
                                @csrf
                            <button type="submit" class="btn btn-danger">削 除</button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
