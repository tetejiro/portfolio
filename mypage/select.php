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

  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/select.css');
?>
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
