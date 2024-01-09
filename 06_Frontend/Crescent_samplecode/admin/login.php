<?php
session_start();

require_once '../util.inc.php';
require_once '../DB.php';
require_once '../env.php';

if (isset($_SESSION['admin_login'])) {
    if ($_SESSION['admin_login'] == true) {
        header('Location: index.php');
        exit;
    }
}

$id   = '';
$pass = '';

if (!empty($_POST)) {
    $id   = $_POST['id'];
    $pass = $_POST['pass'];
    $isValidated = true;

    if ($id === '' || mb_ereg_match('/^(\s|　)+$', $id)) {
        $idError = 'ログインIDを入力してください。';
        $isValidated = false;
    }
    if ($pass === '' || mb_ereg_match('/^(\s|　)+$', $pass)) {
        $passError = 'パスワードを入力してください。';
        $isValidated = false;
    }

    if ($isValidated == true) {
        try {
            $pdo = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();

            $sql = 'SELECT * FROM admins WHERE login_id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $admins = $stmt->fetch();

            if ($admins && $id === $admins['login_id'] && password_verify($pass, $admins['login_pass'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id']    = $id;
                $_SESSION['admin_login'] = true;

                header('Location: index.php');
                exit;
            } else {
                $loginError = 'ログインIDまたはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header class="pt-3 pb-4 mb-3">
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
        </div>
    </header>
    <div id="container">
        <main>

            <form action="" method="post" class="form-signin d-b mt-5" style="width:400px;margin:auto" novalidate>
                <div class="card-deck text-center">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">
                                <img src="../images/logo01.png" width="100">
                            </h4>
                        </div>
                        <div class="card-body">
                            <?php if (isset($loginError)) : ?>
                                <p class="error alert alert-danger"><?= h($loginError) ?></p>
                            <?php endif; ?>
                            <?php if (isset($idError)) : ?>
                                <p class="error alert alert-danger"><?= h($idError) ?></p>
                            <?php endif; ?>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">
                                        ログインID
                                    </label>
                                </div>
                                <input type="text" name="id" value="<?= h($id) ?>" class="form-control" autofocus>
                            </div>

                            <?php if (isset($passError)) : ?>
                                <p class="error alert alert-danger"><?= h($passError) ?></p>
                            <?php endif; ?>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">
                                        パスワード
                                    </label>
                                </div>
                                <input type="password" name="pass" value="<?= h($pass) ?>" class="form-control" autofocus>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
                            <div class="mt-3">※ログインID・パスワードの登録は<a href="asign.php">こちら</a></div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer class="text-center">
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
