<?php
{
  $code=$_GET['code'];
  require_once '../new-db/new-select.php';
  $DbQuery = new DbQuery();
  $condition = 'where code = \''.$code.'\'';
  $rec = $DbQuery->dbQuery('select', 'member', 'name', $condition, '');
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
