<?php
session_start();
session_regenerate_id(true);
if($_SESSION['login']==false)
{
  print 'ログインしてください。';
  print '<a href="../login.php">ログインページへ</a>';
}
else
{
  $code=$_GET['code'];
  require_once '../new-db/new-select.php';
  $SelectDb = new SelectDb();
  $rec = $SelectDb->selectDb9($code);
  $name=$rec['name'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>しつもん</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
<link rel="stylesheet" href="../css/select.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
<link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>
<body>
<main>
<div class="bun">
  <p><?php print $name.'さんに'; ?></p><br>
  <a href="../shitumon/horenso.php?code=<?php print $code ?>">報告する</a><br>
  <a href="../shitumon/shitumon.php?code=<?php print $code ?>">質問を予約する</a><br>
  <a href="../mypage/member-list.php">メンバーリストへもどる</a>
</div>
</main>
</body>
</html>
<?php
}
?>
