<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION) == false) {
    print 'ログインしてください。';
    print '<a href="../registration/login.php">ログインへ</a>';
} else {
    //内容チェック（空がないか）
    $okflg = true;
    if (empty($_POST['title']) == true) {
        $okflg = false;
    }
/*
if (empty($_POST['purpose']) == true) {
    $okflg = false;
}
if(empty($_POST['return'])==true)
{
    $okflg=false;
}
if(empty($_POST['detail'])==true)
{
    $okflg=false;
}
if(empty($_POST['cause'])==true)
{
    $okflg=false;
}
*/
    if ($okflg == false) {
        print '空欄があります。必須項目は全て記入してください。<br>';
        print '<form><input type="button" onclick="history.back()" value="戻る"></form>';
    } else {
        //質問相手のコード
        $code = $_POST['code'];
        //自分のコード
        $honnin = $_SESSION['code'];

        require_once '../sanitize.php';
        $post = sanitize($_POST);
        $title = $post['title'];
        if (empty($post['purpose']) == false) {
            $purpose = $post['purpose'];
        } else {
            $purpose = null;
        }
        if (empty($post['try']) == false){
            $try = $post['try'];
        } else {
            $try = null;
        }
        if (empty($post['rsvp']) == false) {
            $rsvp = $post['rsvp'];
        } else {
            $rsvp = null;
        }
        if(empty($post['detail']) == false){
            $detail = $post['detail'];
        } else {
            $detail = null;
        }
        if(empty($post['cause']) == false){
            $cause = $post['cause'];
        } else {
            $cause = null;
        }
        if(mb_strlen($title, 'UTF-8')>500 || mb_strlen($purpose, 'UTF-8')>500 || mb_strlen($detail, 'UTF-8')>500 ||
                mb_strlen($cause, 'UTF-8')>500 || mb_strlen($try, 'UTF-8')>500){
            print '全て500文字以内で記入してください。<br>';
            print '<form><input type="button" onclick="history.back()" value="戻る"></form>';
        }
        try {
            require_once '../new-db/execute-query.php';
            $DBQuery = new DBQuery();
            $DBQuery->dbQuery('
                INSERT INTO horenso_infos
                    (member_code, target_member_code, title, purpose, detail, cause, other, rsvp)
                VALUES
                    (\''.$honnin.'\',\''.$code.'\',\''.$title.'\',\''.$purpose.'\',\''.$detail.'\',\''.$cause.'\',\''.$try.'\',\''.$rsvp.'\')
            ');
            $_SESSION['member_code'] = $honnin;
            $_SESSION['target_member_code'] = $code;
            $_SESSION['title'] = $title;
            if (isset($purpose) == true){
                $_SESSION['purpose'] = $purpose;
            } else {
                $_SESSION['purpose'] = null;
            }
            if (isset($try) == true){
                $_SESSION['try'] = $try;
            } else {
                $_SESSION['try'] = null;
            }
            if (isset($rsvp) == true) {
                $_SESSION['return'] = $rsvp;
            } else {
                $_SESSION['return'] = null;
            }
            if(isset($detail)==true){
                $_SESSION['detail'] = $detail;
            } else {
                $_SESSION['detail'] = null;
            }
            //質問のみの項目
            if(isset($cause)==true){
                $_SESSION['cause'] = $cause;
            } else {
                $_SESSION['cause'] = null;
            }
            header('Location:insert-done.php');
        } catch (Exception $e) {
            var_dump($e);
            print '現在障害発生中です。';
            print '<a href="../registration/index.php">もどる</a>';
        }
    }
}
