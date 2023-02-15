<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print 'ログインしていません。';
  print '<a href="../registration/login.php">ログインへ</a>';
} else {
  //自分のコード
  $whose = $_SESSION['code'];
  $task = $_SESSION['task'];
  $bytime1_1 = $_SESSION['bytime1'];
  $bytime1_2 = $_SESSION['bytime2'];
  //ここは緊急のつけたし
  $bytime2_1 = $_SESSION['bytime2_1'];
  $bytime2_2 = $_SESSION['bytime2_2'];
  $emotion = $_SESSION['emotion'];
  $time2_1 = $_SESSION['time1'];
  $time2_2 = $_SESSION['time2'];
  //ここも緊急付け足し
  $time1_1 = $_SESSION['time1_1'];
  $time1_2 = $_SESSION['time1_2'];
  $attention = $_SESSION['attention'];
  $strong1 = $_SESSION['strong1'];
  $strong2 = $_SESSION['strong2'];
  $strong3 = $_SESSION['strong3'];

  try {
    require_once '../new-db/execute-Query.php';
    $DbQuery = new DbQuery();
    $insertField = 'whose,task,bytime1_1,bytime1_2,bytime2_1,bytime2_2,emotion,time1_1,time1_2,time2_1,time2_2,attention,strong1,strong2,strong3';
    $val = $whose.'\',\''. trim($task).'\',\''. $bytime1_1.'\',\''. $bytime1_2.'\',\''. $bytime2_1.'\',\''. $bytime2_2.'\',\''. $emotion.'\',\''. $time1_1.'\',\''. $time1_2.'\',\''. $time2_1.'\',\''. $time2_2.'\',\''. trim($attention).'\',\''. trim($strong1).'\',\''. trim($strong2).'\',\''. trim($strong3);
    $DbQuery->dbQuery('insert', 'now', $insertField, $val, '');
    header('Location:mypage.php');
    exit();
  } catch (Exception $e) {
    var_dump($e);
    print '現在障害発生中です。<br>';
    print '<a href="../registration/login.html">もどる</a>';
  }
}
