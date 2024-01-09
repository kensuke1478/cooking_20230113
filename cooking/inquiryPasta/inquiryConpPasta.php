<?php
session_start();
require_once('util.inc.php');
require_once('const.php');

if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] != $_POST['token']) {
    header('Location: inquiryPasta.php');
    exit;
}

unset($_SESSION['token']);

mb_language('ja');
mb_internal_encoding('UTF-8');

$to = h($_POST['mail']);
$title = 'お問い合わせ内容の件';
$headers = 'From: info@xxx.com';

$body =
    h($_POST['name']) . '様' . PHP_EOL .
    'この度はお問い合わせ頂きまして、有り難う御座います。' . PHP_EOL .
    '以下の内容をメールにてお問い合わせがございました。' . PHP_EOL . PHP_EOL .
    '【お名前】' . h($_POST['name']) . PHP_EOL .
    '【フリガナ】' . h($_POST['kana']) . PHP_EOL .
    '【電話番号】' . h($_POST['tel']) . PHP_EOL .
    '【住所】' . h($prefectures[$_POST['prefectures']]) . PHP_EOL .
    '【メールアドレス】' . h($_POST['mail']) . PHP_EOL .

    'お問い合わせ内容に関しまして、3営業日以内にご回答させていただきます。' . PHP_EOL .
    '本メールに心当たりのない場合はinfo@xxx.comまでご連絡ください。' . PHP_EOL .
    '※こちらのご案内は送信専用です。' . PHP_EOL .
    '*********************************************';

if (mb_send_mail($to, $title, $body, $headers)) {
    $msg = 'お問い合わせありがとうございました。';
} else {
    $msg = 'システムエラーが発生致しました。' . "\n" . '電話番号は下記になります。' . "\n" . '電話番号：0000000';
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

<body>
    <!-- ヘッター部分/ -->
    <header>
        <div class='inquiry_nav-list01'>
            <h1 class='main'><img src="img/icon02.png" alt="パスタWEBサイト"></h1>
        </div>
        <div class='inquiry_nav-list02'>
            <div class='title'>お問い合わせ完了</div>
        </div>
    </header>
    <nav class="Breadcrumb">
        <ol class="Breadcrumb-ListGroup">
            <li class="Breadcrumb-ListGroup-Item">
                <a class="Breadcrumb-ListGroup-Item-Link" href="inquiryPasta.php"><span>お問い合わせ入力</span></a>
            </li>
            <li class="Breadcrumb-ListGroup-Item">
                <a class="Breadcrumb-ListGroup-Item-Link" href="inquiryConfPasta.php"><span>お問い合わせ確認</span></a>
            </li>
            <li class="Breadcrumb-ListGroup-Item">
                <a class="Breadcrumb-ListGroup-Item-Link"><span>お問い合わせ完了</span></a>
            </li>
        </ol>
    </nav>

    <div class='conp-pasta'>
        <p class='msg'><?= h($msg) ?></p>
        <p><a href="inquiryPasta.php" class="contact-btn">戻る</a></p>
    </div>
</body>

</html>
