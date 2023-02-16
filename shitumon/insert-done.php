<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print 'ログインしてください。';
  print '<a href="../registration/login.html">ログインページへ</a>';
} else {
  $member_codename = $_SESSION['name'];
  $member_code = $_SESSION['member_code'];
  $code = $_SESSION['target_member_code'];
  $title = $_SESSION['title'];
  $purpose = $_SESSION['purpose'];
  $return = $_SESSION['return'];
  $try = $_SESSION['try'];
  $detail = $_SESSION['detail'];
  $cause = $_SESSION['cause'];
  $url = $_SESSION['url'];

  require_once '../new-db/execute-Query.php';
  $DbQuery = new DbQuery();
  $rec = $DbQuery->dbQuery('
    SELECT name, mail FROM members WHERE code =\''.$code.'\'
  ');

  $name = $rec[0]['name'];
  $mail = $rec[0]['mail'];

?>
  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>しつもん</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../css/mannaka.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
    <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
  </head>

  <body>
    <div class="zentai">
      <?php
      switch ($_SESSION['url']) {
          // 直近の $URL になんの値が入っているかで場合分け。
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
      }
      ?>
    </div>
  <?php
}
  ?>