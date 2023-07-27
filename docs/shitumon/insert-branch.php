<?php
    // header の記載
    require_once('../common.php');
    $cmn = new Common();
    $cmn->printHead('../css/mannaka.css');

    // サニタイズ
    require_once '../sanitize.php';
    $post = sanitize($_POST);
    // 質問か報告かの判定・応じた処理
    if(isset($_POST['question'])) {
        $question_or_report = "質問";
        $post['rsvp'] = null;
    } else {
        $question_or_report = "報告";
    }

    try {
        require_once '../new-db/execute-query.php';
        $DBQuery = new DBQuery();
        $DBQuery->dbQuery('
            INSERT INTO horenso_infos
                (member_code, target_member_code, question_or_report, title, purpose, detail, cause, other, rsvp)
            VALUES
                (\'' . $_SESSION['code'] . '\',\'' . $post['aite_code'] . '\',\'' . $question_or_report . '\',\'' . $post['title'] . '\',\'' . $post['purpose'] . '\',\'' . $post['detail'] . '\',\'' . $post['cause'] . '\',\'' . $post['other'] . '\',\'' . $post['rsvp'] . '\')
        ');

        // 送り先：名前・メールアドレス検索
        $target_member_info = $DBQuery->dbQuery('
            SELECT name, mail FROM members WHERE code =\''.$post['aite_code'].'\'
        ');

        // 送り元：名前検索
        $member_info = $DBQuery->dbQuery('
                SELECT name FROM members WHERE code = \'' . $_SESSION['code'] . '\'
        ');
    } catch (Exception $e) {
        var_dump($e);
        print '現在障害発生中です。';
        print '<a href="../registration/index.php">もどる</a>';
    }

    ?>

    <!-- DB処理後の表示内容 -->

    <body>
        <div class="container">
        <?php

        if(isset($_POST['question'])) {
            // 質問後の表示内容
            print '<p><a href="../mypage/shitsumon-list.php">質問リスト</a>に保存しました。</p>';
            require_once('shitsumon-mail.php'); // メール送信処理
            print '<p>mailでしつもんの通知をしました。</p>';
            print '<a href="../registration/index.php">もどる</a>';
        } else {
            // 報告後の表示内容
            print '<p><a href="../mypage/shitsumon-list.php">質問リスト</a>に保存されました。</p>';
            require_once('hokoku-mail.php'); // メール送信処理
            print '<p>mailでほうれんそうをしました。</p>';
            print '<a href="../registration/index.php">もどる</a>';
        } ?>
        </div>
    </body>
</html>