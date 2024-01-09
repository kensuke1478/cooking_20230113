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
    $pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED');

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

            if (isset($_POST['save'])) {

                $posted_at = $_POST['posted'];
                $title     = $_POST['title'];
                $message   = $_POST['message'];
                $isValidated = true;

                if ($title === '' || mb_ereg_match('/^(\s|　)+$', $title)) {
                    $titleError = '※タイトルを入力して下さい';
                    $isValidated = false;
                } elseif (mb_strlen($title, 'utf8') > 20) {
                    $titleError = '※タイトルを20文字以内で入力して下さい';
                    $isValidated = false;
                }
                if ($message === '' || mb_ereg_match('/^(\s|　)+$', $message)) {
                    $messageError = '※メッセージを入力して下さい';
                    $isValidated = false;
                }

                $pdo->beginTransaction();

                if (isset($_FILES)) {
                    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $image = basename(mb_convert_encoding($_FILES['image']['name'], 'cp932', 'utf8'));
                        echo $image;
                        if (!move_uploaded_file(
                            $_FILES['image']['tmp_name'],
                            IMAGE_PATH . $image
                        )) {
                            throw new Exception('アップロードに失敗しました。');
                        }
                    } elseif ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
                    } else {
                         throw new Exception('アップロードに失敗しました。');
                    }
                }

                if ($isValidated == true) {
                    try {
                        $pdo = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();
                        $sql = 'UPDATE news SET posted_at = ?, title = ?, message = ?, image = ?
                                WHERE id = ?';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(1, $posted_at,  PDO::PARAM_STR);
                        $stmt->bindValue(2, $title,      PDO::PARAM_STR);
                        $stmt->bindValue(3, $message,    PDO::PARAM_STR);
                        $stmt->bindValue(4, $image,      PDO::PARAM_STR);
                        $stmt->bindValue(5, $_GET['id'], PDO::PARAM_INT);
                        $stmt->execute();

                        $pdo->commit();

                        header('Location: news_edit_done.php');
                        exit;
                    } catch (PDOException $e) {
                        header('Content-Type: text/plain; charset=UTF-8', true, 500);
                        exit($e->getMessage());
                    }
                }
            }
        } else {
            $idError = '指定されたお知らせが存在しません';
        }
    } else {
        $idError = 'お知らせが指定されていません';
    }
} catch (PDOException $e) {
    $message = 'システムエラーのため更新出来ませんでした。';
    $pdo->rollback();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お知らせの編集 | Crescent Shoes 管理</title>
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
            <h1>お知らせの編集</h1>
            <?php if (isset($idError)) : ?>
                <p><?= h($idError) ?></p>
                <p><a href="index.php">戻る</a></p>
            <?php else : ?>
                <p>情報を入力し、「保存」ボタンを押してください。</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <th class="fixed">日付(任意)</th>
                            <td>
                                <input type="date" name="posted" value="<?= h($posted_at) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">タイトル</th>
                            <td>
                                <?php if (isset($titleError)) : ?>
                                    <div class="error"><?= h($titleError) ?></div>
                                <?php endif; ?>
                                <input type="text" name="title" size="80" value="<?= h($title) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">お知らせの内容</th>
                            <td>
                                <?php if (isset($messageError)) : ?>
                                    <div class="error"><?= h($messageError) ?></div>
                                <?php endif; ?>
                                <textarea name="message" cols="80" rows="5"><?= h($message) ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th class="fixed">画像(任意)</th>
                            <td>
                                <?php if (isset($imageError)) : ?>
                                    <div class="error"><?= h($imageError) ?></div>
                                <?php endif; ?>
                                <input type="file" name="image" accept="images/*">
                                <div>画像は64x64ピクセルで表示されます</div>
                                <?php if ($image) : ?>
                                    <img src="<?= h(IMAGE_PATH . $image) ?>" width="64" height="64" alt="">
                                <?php else : ?>
                                    <img src="../images/press.png" width="64" height="64" alt="">
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <input type="submit" name="save" value="保存">
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
