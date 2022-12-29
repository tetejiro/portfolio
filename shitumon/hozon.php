<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION) == false) {
    print 'ログインしてください。';
    print '<a href="../registration/login.php">ログインへ</a>';
} else {
    //内容チェック（空がないか）
    $okflg = true;
    if (empty($_POST['situation']) == true) {
        $okflg = false;
    }
/*
if (empty($_POST['goal']) == true) {
    $okflg = false;
}
if(empty($_POST['return'])==true)
{
    $okflg=false;
}
if(empty($_POST['what'])==true)
{
    $okflg=false;
}
if(empty($_POST['why'])==true)
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
        $situation = $post['situation'];
        if (empty($post['goal']) == false) {
            $goal = $post['goal'];
        } else {
            $goal = null;
        }
        if (empty($post['try']) == false){
            $try = $post['try'];
        } else {
            $try = null;
        }
        if (empty($post['return1']) == false) {
            $return1 = $post['return1'];
        } else {
            $return1 = null;
        }
        if(empty($post['what']) == false){
            $what = $post['what'];
        } else {
            $what = null;
        }
        if(empty($post['why']) == false){
            $why = $post['why'];
        } else {
            $why = null;
        }
        if(mb_strlen($situation, 'UTF-8')>500 || mb_strlen($goal, 'UTF-8')>500 || mb_strlen($what, 'UTF-8')>500 ||
                mb_strlen($why, 'UTF-8')>500 || mb_strlen($try, 'UTF-8')>500){
            print '全て500文字以内で記入してください。<br>';
            print '<form><input type="button" onclick="history.back()" value="戻る"></form>';
        }
        try {
            require_once '../new-db/new-select.php';
            $DBQuery = new DBQuery();
            $fieldName = 'whose, whom, situation, goal, what, why, try0, return1';
            $val = $honnin.'\',\''.$code.'\',\''.$situation.'\',\''.$goal.'\',\''.$what.'\',\''.$why.'\',\''.$try.'\',\''.$return1;
            $DBQuery->dbQuery('insert', 'question', $fieldName, $val, '');
            //セッションはconstでしなきゃいけないのかも。
            $_SESSION['whose'] = $honnin;
            $_SESSION['whom'] = $code;
            $_SESSION['situation'] = $situation;
            if (isset($goal) == true){
                $_SESSION['goal'] = $goal;
            } else {
                $_SESSION['goal'] = null;
            }
            if (isset($try) == true){
                $_SESSION['try'] = $try;
            } else {
                $_SESSION['try'] = null;
            }
            if (isset($return1) == true) {
                $_SESSION['return'] = $return1;
            } else {
                $_SESSION['return'] = null;
            }
            if(isset($what)==true){
                $_SESSION['what'] = $what;
            } else {
                $_SESSION['what'] = null;
            }
            //質問のみの項目
            if(isset($why)==true){
                $_SESSION['why'] = $why;
            } else {
                $_SESSION['why'] = null;
            }
            header('Location:done.php');
        } catch (Exception $e) {
            var_dump($e);
            print '現在障害発生中です。';
            print '<a href="../registration/index.php">もどる</a>';
        }
    }
}
