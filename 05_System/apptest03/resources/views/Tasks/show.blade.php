<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>タスク詳細</title>
</head>
<body>
    <div class="text-center p-3 mb-2 bg-secondary text-white fw-bold">
        BLOG Todoリスト
        </div>
    <div class="container" style="width:860px">
        <table class="table table-bordered">
            <tr class="table-primary">
                <th>ID</th>
                <td>{{ $task->id }}</td>
            </tr>
            <tr class="table-danger">
                <th>タスク</th>
                <td>{{ $task->name }}</td>
            </tr>
            <tr class="table-warning">
                <th>タスク内容</th>
                <td>{{ $task->content }}</td>
            </tr>
            <tr class="table-success">
                <th>作成日時</th>
                <td>{{ $task->created_at->format('Y年m月d日 H:i') }}</td>
            </tr>
            <tr class="table-info">
                <th>更新日時</th>
                <td>{{ $task->updated_at->format('Y年m月d日 H:i') }}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-center">
                <a href="/" class="btn btn-success">戻る</a>
                <a href="{{ url('tasks/' . $task->id . '/edit') }}" class="btn btn-primary">編集する</a>
                <form action="{{ route('tasks.derete', ['id' => $task->id]) }}" method="post" name="deleteForm">
                    @csrf
                        <button type="submit" class="btn btn-danger">削 除</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
