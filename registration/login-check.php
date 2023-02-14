<?php
require_once('../sanitize.php');

$post = sanitize($_POST);
$name = $post['name'];
$name = str_replace(" ", "", $name);
$name = str_replace("　", "", $name);
$pass = $post['pass'];
//次からはhash()を使う。
$pass = md5($pass);

try {
  require_once '../new-db/new-select.php';
  $DbQuery = new DbQuery();
  $rec = $DbQuery->dbQuery('
    SELECT name, code
    FROM member
    WHERE name = \''.$name .'\' AND pass = \''.$pass. '\'
  ');
  if ($rec == true) {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['name'] = $rec[0]['name'];
    $_SESSION['code'] = $rec[0]['code'];
    header('Location:../mypage/mypage.php');
    exit();
  } else {
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
      <meta charset="utf-8">
      <meta title="しつもん">

      <!-- css -->
      <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
      <link rel="stylesheet" href="../css/mylist.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
      <link rel="icon" type="image/png" href="../p-favicon.png">
    </head>

    <body>
  <?php
    print '<form action="login.html" method="post">';
    print '<p style="text-align: center;margin-top: 25%;">登録されていないものです。</p><br>';
    print '<input type="submit" value="もどる">';
    print '</form>';
  }
} catch (Exception $e) {
  exit('障害発生中');
  var_dump($e);
}
  ?>
    </body>

    </html>