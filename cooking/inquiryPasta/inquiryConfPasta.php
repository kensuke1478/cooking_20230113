<?php
session_start();
require_once('util.inc.php');
require_once('const.php');

if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] != $_POST['token']) {
    header('Location: inquiryPasta.php');
    exit;
}

$_SESSION['token'] = getToken();

if (empty($_POST['name'])) {
    $error['name'] = '名前を入力してください。';
}

if (empty($_POST['kana'])) {
    $error['kana'] = 'フリガナを入力してください';
} elseif (!preg_match('/^[ァ-ヶ]+$/u', $_POST['kana'])) {
    $error['kana'] = '全角カタカナで入力してください。';
}

if (empty($_POST['tel'])) {
    $error['tel'] = '電話番号を入力してください';
} elseif (!preg_match('/^0[0-9]{9,10}\z/', $_POST['tel'])) {
    $error['tel'] = '電話番号の入力は10桁以上または半角数字で入力してください。';
}

if (empty($_POST['mail'])) {
    $error['mail'] = 'メールアドレスを入力してください。';
}
if (empty($_POST['confmail'])) {
    $error['confmail'] = 'メールアドレス確認を入力してください。';
} elseif ($_POST['mail'] !== $_POST['confmail']) {
    $error['confmail'] = 'メールアドレスと確認用メールアドレスが一致していません。';
}
if (isset($error)) {
    require_once('inquiryPasta.php');
    exit;
}

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
<form action="inquiryConpPasta.php" method="post" novalidate>

    <body>
        <!-- ヘッター部分/ -->
        <header>
            <div class='inquiry_nav-list01'>
                <h1 class='main'><img src="img/icon02.png" alt="パスタWEBサイト"></h1>
            </div>
            <div class='inquiry_nav-list02'>
                <div class='title'>お問い合わせ確認</div>
            </div>
        </header>
        <nav class="Breadcrumb">
            <ol class="Breadcrumb-ListGroup">
                <li class="Breadcrumb-ListGroup-Item">
                    <a class="Breadcrumb-ListGroup-Item-Link" href="inquiryPasta.php"><span>お問い合わせ入力</span></a>
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
                <td class='confirm-text01'><?= isset($_POST['name']) ? h($_POST['name']) : '' ?>
                    <input type="hidden" name="name" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>名前(フリガナ)<a class="mandatory">必須</a></th>
                <td class='confirm-text02'><?= isset($_POST['kana']) ? h($_POST['kana']) : '' ?>
                    <input type="hidden" name="kana" value="<?= isset($_POST['kana']) ? h($_POST['kana']) : '' ?>">
            </tr>
            <tr>
                <th>電話番号<a class="mandatory">必須</a></th>
                <td class='confirm-text03'><?= isset($_POST['tel']) ? h($_POST['tel']) : '' ?>
                    <input type="hidden" name="tel" value="<?= isset($_POST['tel']) ? h($_POST['tel']) : '' ?>">
            </tr>
            <tr>
                <th>住所</th>
            </tr>
            <tr>
                <th>都道府県</th>
                <td class="confirm-text04">
                    <?= $prefectures[$_POST['prefectures']] ?>
                    <input type="hidden" name="prefectures" value="<?= isset($_POST['prefectures']) ? h($_POST['prefectures']) : '' ?>">
                </td>
            </tr>
            <tr>
                <th>メールアドレス<a class="mandatory">必須</a></th>
                <td class='confirm-text05'><?= isset($_POST['mail']) ? h($_POST['mail']) : '' ?>
                    <input type="hidden" name="mail" value="<?= isset($_POST['mail']) ? h($_POST['mail']) : '' ?>">
            </tr>
            <tr>
                <th>確認メールアドレス<a class="mandatory">必須</a></th>
                <td class='confirm-text06'><?= isset($_POST['confmail']) ? h($_POST['confmail']) : '' ?>
                    <input type="hidden" name="confmail" value="<?= isset($_POST['confmail']) ? h($_POST['confmail']) : '' ?>">
            </tr>
        </table>
        <footer>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
            <input class="contact-top" name="confirm" type="submit" value="戻る" formaction="inquiryPasta.php">
            <input class="contact-con" name="confirm" type="submit" value="進む" formaction="inquiryConpPasta.php">
        </footer>
</form>
</body>

</html>
