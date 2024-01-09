<?php
session_start();
require_once '../util.inc.php';
require_once '../DB.php';
require_once '../env.php';
require_once 'auth.inc.php';
authConfirm();

const IMAGE_PATH = '../images/press/';
const NUM_PER_PAGE = 5;

try {
    $pdo  = (new DB(DBHOST, DBNAME, DBUSER, DBPASS))->dbConnect();

    $sql  = 'SELECT COUNT(*) AS hits FROM news';
    $res  = $pdo->query($sql)->fetch();
    $numPages = ceil($res['hits'] / NUM_PER_PAGE);

    if (isset($_GET['p'])) {
        $page = $_GET['p'];
    } else {
        $page = 1;
    }

    $prevNum = $page - 1;
    $nextNum = $page + 1;
    $offset  = ($page - 1) * NUM_PER_PAGE;
    $sql = 'SELECT * FROM news ORDER BY posted_at DESC LIMIT ' . $offset . ' , ' . NUM_PER_PAGE;
    $news = $pdo->query($sql)->fetchAll();
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お知らせ一覧 | Crescent Shoes 管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body id="admin_index">
    <header class="pt-3 pb-4 mb-3">
        <div class="inner">
            <span><a href="index.php">Crescent Shoes 管理</a></span>
            <?php include 'account.parts.php' ?>
        </div>
    </header>
    <div id="container">
        <main>
            <h1>お知らせ一覧</h1>
            <p><a href="news_add.php">お知らせの追加</a></p>
            <ul class="pl-0">
                <?php if ($numPages > 1) : ?>
                    <ul class="pagination">
                        <?php if ($page == 1) : ?>
                            <li class="page-item disabled">
                                <a href="" class="page-link">前のページへ</a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a href="?p=<?= h($prevNum) ?>" class="page-link">前のページへ</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $numPages; $i++) : ?>
                            <?php if ($page == $i) : ?>
                                <li class="page-item active">
                                    <a class="page-link" href=""><?= h($i) ?></a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?p=<?= h($i) ?>"><?= h($i) ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($page == $numPages) : ?>
                            <li class="page-item disabled">
                                <a href="" class="page-link">次のページへ</a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a href="?p=<?= h($nextNum) ?>" class="page-link">次のページへ</a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>

                    </ul>
                    <table>
                        <tr>
                            <th>日付</th>
                            <th>タイトル／お知らせ内容</th>
                            <th>画像(64x64)</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                        <?php foreach ($news as $item) : ?>
                            <tr>
                                <td class="center"><?= $item['posted_at'] ?></td>
                                <td>
                                    <span class="title"><?= h($item['title']) ?></span>
                                    <?= h(nl2br($item['message'])) ?>
                                </td>
                                <td class="center">
                                    <?php if ($item['image']) : ?>
                                        <img src="<?= h(IMAGE_PATH . $item['image']) ?>" width="64" height="64" alt="">
                                    <?php else : ?>
                                        <img src="../images/press.png" width="64" height="64" alt="">
                                    <?php endif; ?>
                                </td>
                                <td class="center"><a href="news_edit.php?id=<?= h($item['id']) ?>">編集</a></td>
                                <td class="center"><a href="news_delete.php?id=<?= h($item['id']) ?>">削除</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
        </main>
        <footer>
            <p>&copy; Crescent Shoes All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
