<?php
{
  $code=$_GET['code'];
  require_once '../new-db/execute-query.php';
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
  <div class="select-list">
    <p><?php print $name.'さんに'; ?></p>
    <div><a href="../shitumon/hokoku.php?code=<?php print $code ?>">報告する</a></div>
    <div><a href="../shitumon/shitumon.php?code=<?php print $code ?>">質問を予約する</a></div>
    <div><a href="../mypage/member-list.php">メンバーリストへもどる</a></div>
  </div>
</main>
</body>
</html>
<?php
}
?>
