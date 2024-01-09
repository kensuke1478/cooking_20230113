<?php
// マジック定数でプロジェクトまでの絶対パスでdotenv機能の読み込み
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

// ...今までの記述

// .envファイルがある階層(プロジェクト直下)を指定
$dotenv = Dotenv::createImmutable(__DIR__);
// 環境変数を読み込む
$dotenv->load();

// ページ内で下記の方法で参照可能
$user = $_SERVER['DB_USER'];
$pass = $_ENV['DB_PASS']; // $_ENVは非推奨

echo $user . ' / ' . $pass;

echo '<pre>';
print_r($_SERVER);
echo '</pre>';
