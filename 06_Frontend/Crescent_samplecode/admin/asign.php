<?php
session_start();

require_once '../util.inc.php';
require_once '../DB.php';
require_once '../env.php';

$id     = '';
$pass   = '';
$retype = '';

try {
    $pdo = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();
    if (!empty($_POST)) {
        $id     = $_POST['id'];
        $pass   = $_POST['pass'];
        $retype = $_POST['retype'];
        $isValidated = true;

        if ($id === '' || mb_ereg_match('^(\s|　)+$', $id)) {
            $idError = '※ログイン名を入力してください';
            $isValidated = false;
        }

        if ($pass === '' || mb_ereg_match('^(\s|　)+$', $pass)) {
            $passError = '※パスワードを入力してください';
            $isValidated = false;
        } elseif (!preg_match('/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}$/i', $pass)) {
            $passError = '※パスワードは半角英数字各1字以上を含む8〜100字以内で入力してください';
            $isValidated = false;
        }

        if ($retype === '' || mb_ereg_match('^(\s|　)+$', $retype)) {
            $retypeError = '※パスワードを再入力してください';
            $isValidated = false;
        } elseif ($pass !== $retype) {
            $retypeError = '※再入力のパスワードが一致しません';
            $isValidated = false;
        }

        if ($isValidated == true) {

            $sql = 'INSERT INTO admins (login_id, login_pass) VALUES (?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                [$id, password_hash($pass, PASSWORD_DEFAULT)]
            );
            session_regenerate_id(true);
            $_SESSION['admin_id']    = $id;
            $_SESSION['admin_login'] = true;

            header('Location: index.php');
            exit;
        }
    }


    $sql = 'SELECT * FROM admins';
    $admins = $pdo->query($sql)->fetchAll();

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header>
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
        </div>
    </header>
    <div id="container">
        <main>
            <h1>ログイン</h1>
            <?php if (isset($retypeError)) : ?><p class="error"><?= h($retypeError) ?></p><?php endif; ?>
            <?php if (isset($passError)) : ?><p class="error"><?= h($passError) ?></p><?php endif; ?>
            <?php if (isset($idError)) : ?><p class="error"><?= h($idError) ?></p><?php endif; ?>
            <form action="" method="post" novalidate>
                <table id="loginbox">
                    <tr>
                        <th>ログインID</th>
                        <td>
                            <input type="text" name="id" value="<?= h($id) ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td>
                            <input type="password" name="pass" value="<?= h($pass) ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>再入力</th>
                        <td><input type="password" name="retype" value="<?= h($retype) ?>"></td>
                    </tr>
                </table>
                <p><input type="submit" value="登録"></p>
            </form>>
            <table>
                <tr>
                    <th>番号</th>
                    <th>ログインID</th>
                    <th>パスワード</th>
                </tr>
                <?php foreach ($admins as $admin):?>
                <tr>
                    <td><?=h($admin['id'])?></td>
                    <td><?=h($admin['login_id'])?></td>
                    <td><?=h($admin['login_pass'])?></td>
                </tr>
                <?php endforeach;?>
            </table>

        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
