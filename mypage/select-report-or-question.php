<?php
{
  $code=$_GET['code'];
  require_once '../new-db/execute-Query.php';
  $DbQuery = new DbQuery();
  $rec = $DbQuery->dbQuery('SELECT name FROM members WHERE code = \''.$code.'\'');
  $name = $rec[0]['name'];

  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/select.css');
?>
<body>
<main>
<div class="bun">
  <p><?php print $name.'さんに'; ?></p><br>
  <a href="../shitumon/hokoku.php?code=<?php print $code ?>">報告する</a><br>
  <a href="../shitumon/shitumon.php?code=<?php print $code ?>">質問を予約する</a><br>
  <a href="../mypage/member-list.php">メンバーリストへもどる</a>
</div>
</main>
</body>
</html>
<?php
}
?>
