<?php
const SMTP_HOST     = 'smtp.gmail.com';
const SMTP_PORT     = 587;
const SMTP_PROTOCOL = 'tls';
const GMAIL_SITE    = 'arihito.m@gmail.com';
const GMAIL_APPPASS = 'qgqdnrvurwfrtici';
const MAIL_FROM     = ['arihito.m@gmail.com' => 'Crescent Shoes 公式サイト'];
const MAIL_TITLE = 'Crescent Shoes 問い合わせの通知';

/**
 * 問い合わせたユーザのメールと名前を受け取り送り先の配列を返す
 *
 * @param string | null $email
 * @param string | null $name
 * @return array
 */
function sendUserMail(?string $email, ?string $name): array
{
    if (empty($email) || empty($name)) {
        return null;
    }

    return [
        'arihito.m@gmail.com'  => 'Web担当者様'
        ];
}


/**
 * Swiftメッセージインスタンスを受けてメール本文を返す
 *
 * @param object | null $message
 * @param array | null $messageArr
 * @return string
 */
function setMailBody (?object $message, ?array $messageArr): string 
{
    if (empty($message) || empty($messageArr)) {
        return null;
    }

    return <<<EOT
    <img src="{$message->embed(Swift_Image::fromPath('images/logo01.png'))}">
    <h2>Crescent Shoes 問い合わせの通知</h2>
    <p>以下の内容を承りました。</p>
    <table style="border-collapse:collapse;width:auto">
      <tr>
        <th style="padding:10px;border:1px solid #ccc">お名前</th>
        <td style="padding:10px;border:1px solid #ccc">{$messageArr['name']}</td>
      </tr>
      <tr>
        <th style="padding:10px;border:1px solid #ccc">フリガナ</th>
        <td style="padding:10px;border:1px solid #ccc">{$messageArr['kana']}</td>
      </tr>
      <tr>
        <th style="padding:10px;border:1px solid #ccc">メールアドレス</th>
        <td style="padding:10px;border:1px solid #ccc">{$messageArr['email']}</td>
      </tr>
      <tr>
        <th style="padding:10px;border:1px solid #ccc">電話番号</th>
        <td style="padding:10px;border:1px solid #ccc">{$messageArr['phone']}</td>
      </tr>
      <tr>
        <th style="padding:10px;border:1px solid #ccc">お問い合わせ内容</th>
        <td style="padding:10px;border:1px solid #ccc">{$messageArr['inquiry']}</td>
      </tr>
    </table>
    EOT;
}
