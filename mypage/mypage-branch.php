<?php
//require_once('libs/consts/AppConstants.php');
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  exit('ログインしていません。');
  print '<a href="../registration/login.html">ログインへ</a>';
} else {
  require_once '../sanitize.php';
  $post = sanitize($_POST);
  $task = $post['task'];
  $bytime1_1 = $post['bytime1_1'];
  $bytime1_2 = $post['bytime1_2'];
  $bytime2_1 = $post['bytime2_1'];
  $bytime2_2 = $post['bytime2_2'];
  $emotion = $post['emotion'];
  $time1_1 = $post['time1_1'];
  $time1_2 = $post['time1_2'];
  $time2_1 = $post['time2_1'];
  $time2_2 = $post['time2_2'];
  $attention = $post['attention'];
  $strong1 = $post['strong1'];
  if($post['strong2']){
    $strong2 = $post['strong2'];
  } else {
    $strong2 = null;
  }
  if($post['strong3']){
    $strong3 = $post['strong3'];
  } else {
    $strong3 = null;
  }

  /*
  ?>
  <!DOCTYPE html>
  <html lang="ja">
  <head>
  <meta charset="utf-8">
  <title>しつもん</title>
    <!-- css -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="../css/mannaka.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
  </head>
  <body>
  <div class="zentai">
  <?php
*/
  if($bytime1_1 == $bytime2_1 && $bytime1_2 == $bytime2_2 || $time1_1 == $time2_1 && $time2_1 == $time2_2){
    print '「仕事の開始時間と終了時間」もしくは「都合がいい時間」が同時になっています。<br><br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
  }
  if (
    is_numeric($bytime1_1) == false || is_numeric($bytime1_2) == false || is_numeric($bytime2_1) == false || is_numeric($bytime2_2) == false
    || is_numeric($time1_1) == false || is_numeric($time1_2) == false || is_numeric($time2_1) == false || is_numeric($time2_2) == false
  ) {
    print '時間は数字で入力してください。<br><br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
  }
  if ($bytime2_1 < $bytime1_1 || $bytime1_1 == $bytime2_2 && $bytime1_2 > $bytime2_2) {
    print '時間の大小が逆になっています。<br><br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
  } else if ($time2_1 < $time1_1 || $time1_1 == $time2_1 && $time1_2 > $time2_2) {
    print '時間の大小が逆になっています。<br><br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
  }
  if ($strong1 == '') {
    print 'ここは任せて！の3つの1つ目は必ず入力をしてください。';
  }
  if(mb_strlen($task, 'UTF-8')>250 || mb_strlen($attention, 'UTF-8')>250 || mb_strlen($strong1, 'UTF-8')>250 || mb_strlen($strong2, 'UTF-8')>250 || mb_strlen($strong3, 'UTF-8')>250){
    print '250文字以内で記入してください。<br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
  }

  if (
    is_null($task) == true || is_null($bytime1_1) == true || is_null($bytime1_2) == true || is_null($bytime2_1) == true ||
    is_null($bytime2_2) == true || is_null($emotion) == true || is_null($time1_1) == true || is_null($time1_2) == true || is_null($time2_1) == true
    || is_null($time2_2) == true || is_null($attention) == true || is_null($strong1) == true
  ) {
    print '入力されていない箇所があります。最後2枠以外は全て入力してください。';
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
    print '</div>';
  }

  require_once '../new-db/new-const.php';
  $ConstDb = new ConstDb();
  $_SESSION[ConstDb::task] = $task;
  $_SESSION[ConstDb::bytime1] = $bytime1_1;
  $_SESSION[ConstDb::bytime2] = $bytime1_2;
  //緊急で付け足すので、constはしてない。
  $_SESSION['bytime2_1'] = $bytime2_1;
  $_SESSION['bytime2_2'] = $bytime2_2;
  $_SESSION['time1_1'] = $time1_1;
  $_SESSION['time1_2'] = $time1_2;
  $_SESSION[ConstDb::emotion] = $emotion;
  $_SESSION[ConstDb::time1] = $time2_1;
  $_SESSION[ConstDb::time2] = $time2_2;
  $_SESSION[ConstDb::attention] = $attention;
  $_SESSION[ConstDb::strong1] = $strong1;
  $_SESSION[ConstDb::strong2] = $strong2;
  $_SESSION[ConstDb::strong3] = $strong3;
  header('Location:./mypage-update.php');
  exit();
}
