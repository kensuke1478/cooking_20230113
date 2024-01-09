<?php
if (!isset($_SESSION['token'])) {
    session_start();
}
require_once('util.inc.php');
require_once('const.php');

$_SESSION['token'] = getToken();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>お問い合わせフォーム</title>
</head>
<form action="inquiryConfPasta.php" method="post" novalidate>

    <body>
        <!-- ヘッター部分/ -->
        <header>
            <div class='inquiry_nav-list01'>
                <h1 class='main'><img src="img/icon02.png" alt="パスタWEBサイト"></h1>
            </div>
            <div class='inquiry_nav-list02'>
                <div class='title'>お問い合わせ入力</div>
            </div>
        </header>
        <nav class="Breadcrumb">
            <ol class="Breadcrumb-ListGroup">
                <li class="Breadcrumb-ListGroup-Item">
                    <a class="Breadcrumb-ListGroup-Item-Link"><span>お問い合わせ入力</span></a>
                </li>
                <li class="Breadcrumb-ListGroup-Item">
                    <a class="Breadcrumb-ListGroup-Item-Link"><span>お問い合わせ確認</span></a>
                </li>
                <li class="Breadcrumb-ListGroup-Item">
                    <a class="Breadcrumb-ListGroup-Item-Link"><span>お問い合わせ完了</span></a>
                </li>
            </ol>
        </nav>
        <!-- メイン部分/ -->
        <table class='CF7_table'>
            <tr>
                <th>名前<a class="mandatory">必須</a></th>
                <p class="error"><?= isset($error['name']) ? $error['name'] : '' ?></p>
                <td><input class="contact-text01" type="text" name="name" id="'inputName" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>名前(フリガナ)<a class="mandatory">必須</a></th>
                <p class="error"><?= isset($error['kana']) ? $error['kana'] : '' ?></p>
                <td><input class="contact-text02" type="text" name="kana" id="inputKana" value="<?= isset($_POST['kana']) ? h($_POST['kana']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>電話番号<a class="mandatory">必須</a></th>
                <p class="error"><?= isset($error['tel']) ? $error['tel'] : '' ?></p>
                <td><input class="contact-text03" type="text" name="tel" id="inputTel" value="<?= isset($_POST['tel']) ? h($_POST['tel']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>住所</th>
            </tr>
            <tr>
                <th>都道府県</th>
                <td class="contact-body">
                    <select name="prefectures" class="form-select">
                        <?php foreach ($prefectures as $key => $value) : ?>
                            <option value="<?= $key ?>" <?= isset($_POST['prefectures']) && $_POST['prefectures'] == $key ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>メールアドレス<a class="mandatory">必須</a></th>
                <p class="error"><?= isset($error['mail']) ? $error['mail'] : '' ?></p>
                <td><input class="contact-text04" type="text" name="mail" id="inputmail" value="<?= isset($_POST['mail']) ? h($_POST['mail']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>確認メールアドレス<a class="mandatory">必須</a></th>
                <p class="error"><?= isset($error['confmail']) ? $error['confmail'] : '' ?></p>
                <td><input class="contact-text05" type="text" name="confmail" id="inputconfmail" value="<?= isset($_POST['confmail']) ? h($_POST['confmail']) : '' ?>">
                </td>
            </tr>
        </table>
        <!-- フッター部分 -->
        <footer>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
            <input class="contact-top" name="confirm" type="submit" value="戻る" formaction="../top.php">
            <input class="contact-con" name="confirm" type="submit" value="進む">
        </footer>
</form>
</body>

</html>
