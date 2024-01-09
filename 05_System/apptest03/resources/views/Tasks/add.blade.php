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
    <div class="text-center p-3 mb-2 bg-secondary text-white fw-bold">タスク追加</div>
    <div class="error">
        @foreach ($errors->all() as $error)
        <p class="error__message text-center text-danger">{{$error}}</p>
        @endforeach
    </div>
    <form action="{{ route('tasks.store') }}" method="post" class="form">
        @csrf
        <div class="form-group col-md-6 col-xs-12" style="margin-left:250px">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="padding-right:45px">タスク<span>(必須)</span></div>
                </div>
            <input type="text" class="form-control" name="name" maxlength="30" placeholder="タスクは30文字で書きましょう。" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12" style="margin-left:250px">
        <div class="form-group col-xs-12 mb-4">
            <div class="input-group-prepend">
            <div class="input-group-text">タスク内容<span>(必須)</span></div>
            <textarea rows="5" class="form-control" name="content" placeholder="タスク内容を具体的に書きましょう" >{{ old('content') }}</textarea>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-primary small">追加する</button>
    </div>
    </form>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
