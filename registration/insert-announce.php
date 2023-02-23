<?php

// 最小文字数
if (mb_strlen($_POST['content']) < 5) {
    print '5文字以上は記載してください。';
    print '<p><a href="announce.php">もどる</a></p>';
    print (mb_strlen($_POST['content']) > 61);

// 最大文字数
} else if (mb_strlen($_POST['content']) > 60) {
    print '60文字までにしてください。';
    print '<p><a href="announce.php">もどる</a></p>';

// 上記条件外（インサート可）
} else {

    try {
        require_once '../new-db/execute-query.php';
        $DbQuery = new DbQuery();
        $DbQuery->dbQuery('INSERT INTO notices (content) VALUES (\''.$_POST['content'].'\')');
        header('Location:announce.php');
    } catch(Exception $e) {
        print '障害により記録できませんでした。';
        print '<a href="index.php">もどる</a>';
        var_dump($e);
    }

} ?>