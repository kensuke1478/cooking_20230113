<?php
session_start();
require_once '../util.inc.php';
require_once '../DB.php';
require_once '../env.php';
require_once 'auth.inc.php';
authConfirm();

$posted_at = (new DateTime())->format('Y-m-d');
$title   = '';
$message = '';
$image   = '';

const IMAGE_PATH = '../images/press/';

if (!empty($_POST)) {
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

    if (isset($_FILES)) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = basename(mb_convert_encoding($_FILES['image']['name'], 'cp932', 'utf8'));
            echo $image;
            if (!move_uploaded_file(
                $_FILES['image']['tmp_name'],
                IMAGE_PATH . $image
            )) {
                $imageError = '※アップロードに失敗しました';
                $isValidated = false;
            }
        } elseif ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        } else {
            $imageError = '※アップロードに失敗しました';
            $isValidated = false;
        }
    }

    if ($isValidated == true) {
        try {
            $pdo = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();
            $sql = 'INSERT INTO news (posted_at, title, message, image)
                    VALUES (?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $posted_at, PDO::PARAM_STR);
            $stmt->bindValue(2, $title,     PDO::PARAM_STR);
            $stmt->bindValue(3, $message,   PDO::PARAM_STR);
            $stmt->bindValue(4, $image,     PDO::PARAM_STR);
            $stmt->execute();

            header('Location: news_add_done.php');
            exit;
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e -> getMessage());
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お知らせの追加 | Crescent Shoes 管理</title>
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
            <h1>お知らせの追加</h1>
            <p>情報を入力し、「追加」ボタンを押してください。</p>
            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th class="fixed">日付(任意)</th>
                        <td>
                            <input type="date" name="posted" value="<?=h($posted_at)?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">タイトル</th>
                        <td>
                            <?php if (isset($titleError)):?>
                                <div class="error"><?=h($titleError)?></div>
                            <?php endif;?>
                            <input type="text" name="title" size="80" value="<?=h($title)?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">お知らせの内容</th>
                        <td>
                            <?php if (isset($messageError)):?>
                                <div class="error"><?=h($messageError)?></div>
                            <?php endif;?>
                            <textarea name="message" cols="80" rows="5"><?=h($message)?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th class="fixed">画像(任意)</th>
                        <td>
                            <?php if (isset($imageError)):?>
                                <div class="error"><?=h($imageError)?></div>
                            <?php endif;?>
                            <input type="file" name="image" accept="images/*">
                            <div>画像は64x64ピクセルで表示されます</div>
                            <?php if ($image):?>
                                <img src="<?=h(IMAGE_PATH . $image)?>" width="64" height="64" alt="">
                            <?php else:?>
                                <img src="../images/press.png" width="64" height="64" alt="">
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type="submit" name="add" value="追加">
                    <input type="submit" value="キャンセル" formaction="index.php">
                </p>
            </form>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
