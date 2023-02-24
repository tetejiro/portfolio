<?php
    // header の記載
    require_once('../common.php');
    $cmn = new Common();
    $cmn->printHead('../css/mannaka.css');

    // サニタイズ
    require_once '../sanitize.php';
    $post = sanitize($_POST);

    try {
        require_once '../new-db/execute-query.php';
        $DBQuery = new DBQuery();

        // 質問のレコードインサート
        if($_SESSION['url'] == $_SESSION['shitumon']) {
            $DBQuery->dbQuery('
                INSERT INTO horenso_infos
                    (member_code, target_member_code, title, purpose, detail, cause, other)
                VALUES
                    (\'' . $_SESSION['code'] . '\',\'' . $post['aite_code'] . '\',\'' . $post['title'] . '\',\'' . $post['purpose'] . '\',\'' . $post['detail'] . '\',\'' . $post['cause'] . '\',\'' . $post['other'] . '\')
            ');
        }

        // 報告のレコードインサート
        if($_SESSION['url'] == $_SESSION['horenso']) {
            $DBQuery->dbQuery('
                INSERT INTO horenso_infos
                    (member_code, target_member_code, title, detail, other, rsvp)
                VALUES
                    (\'' . $_SESSION['code'] . '\',\'' . $post['aite_code'] . '\',\'' . $post['title'] . '\',\'' . $post['detail'] . '\',\'' . $post['other'] . '\',\'' . $post['rsvp'] . '\')
            ');
        }

        // 送り先：名前・メールアドレス検索
        require_once '../new-db/execute-query.php';
        $DbQuery = new DbQuery();
        $target_member_info = $DbQuery->dbQuery('
            SELECT name, mail FROM members WHERE code =\''.$post['aite_code'].'\'
        ');

        // 送り元：名前
        $member_info = $DbQuery->dbQuery('
                SELECT name FROM members WHERE code = \'' . $_SESSION['code'] . '\'
        ');

    } catch (Exception $e) {
        var_dump($e);
        print '現在障害発生中です。';
        print '<a href="../registration/index.php">もどる</a>';
    }

    ?>
    <body>
    <div class="zentai">
    <?php

    // 直近の $URL になんの値が入っているかで場合分け。
    switch ($_SESSION['url']) {
        case $_SESSION['shitumon']:
            print '<a href="../mypage/shitsumon-list.php">質問リスト</a>に保存しました。<br>';
            require_once('shitsumon-mail.php');
            print 'mailでしつもんの通知をしました。<br>';
            print '<a href="../registration/index.php">もどる</a>';
            break;

        case $_SESSION['horenso']:
            print '<a href="../mypage/shitsumon-list.php">質問リスト</a>に保存されました。<br>';
            require_once('hokoku-mail.php');
            print 'mailでほうれんそうをしました。<br>';
            print '<a href="../registration/index.php">もどる</a>';
            break;
    } ?>
    </div>
</body>
</html>