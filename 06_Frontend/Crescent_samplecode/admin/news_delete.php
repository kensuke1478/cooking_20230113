<?php
session_start();
require_once '../util.inc.php';
require_once '../DB.php';
require_once '../env.php';
require_once 'auth.inc.php';
authConfirm();

const IMAGE_PATH = '../images/press/';

try {
    $pdo = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();

    if (isset($_GET['id'])) {

        $sql  = 'SELECT * FROM news WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetch();

        if ($news != false) {

            $posted_at = $news['posted_at'];
            $title     = $news['title'];
            $message   = $news['message'];
            $image     = $news['image'];

            if (isset($_POST['delete'])) {

                $sql = 'DELETE FROM news WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();

                header('Location: news_delete_done.php');
                exit;
            }
        } else {
            $idError = '指定されたお知らせが存在しません';
        }
    } else {
        $idError = 'お知らせが指定されていません';
    }
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お知らせの削除 | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <header>
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
            <?php include 'account.parts.php' ?>
        </div>
    </header>
    <div id="container">
        <main>
            <h1>お知らせの削除</h1>
            <?php if (isset($idError)) : ?>
                <p><?= h($idError) ?></p>
                <p><a href="index.php">戻る</a></p>
            <?php else : ?>
                <p>以下のお知らせを削除します。</p>
                <p>よろしければ「削除」ボタンを押してください。</p>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th class="fixed">日付</th>
                            <td>
                                <?= h($posted_at) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">タイトル</th>
                            <td>
                                <?= h($title) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">お知らせ内容</th>
                            <td>
                                <?= h(nl2br($message)) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">画像</th>
                            <td>
                                <?php if ($image) : ?>
                                    <img src="<?= h(IMAGE_PATH . $image) ?>" width="64" height="64" alt="">
                                <?php else : ?>
                                    <img src="../images/press.png" width="64" height="64" alt="">
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <input type="submit" name="delete" value="削除">
                        <input type="submit" value="キャンセル" formaction="index.php">
                    </p>
                </form>
            <?php endif; ?>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
