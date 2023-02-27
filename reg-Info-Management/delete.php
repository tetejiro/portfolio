<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/control.css');
?>

<body>
  <div class="delete">
    <?php
    try {
      $code = $_GET['code'];
      require_once '../new-db/execute-query.php';
      $DbQuery = new DbQuery();
      $rec = $DbQuery->dbQuery('SELECT name FROM members WHERE code = \''.$code.'\'');
      $name = $rec[0]['name'];
    } catch (Exception $e) {
      exit('ただいま障害により大変ご迷惑をおかけしております。');
    }
    ?>

    <p>このスタッフを削除してよろしいですか？</p>
    <div>スタッフコード</div>
    <div><?php print $code; ?></div>
    <div>スタッフ名</div>
    <div><?php print $name; ?></div>

    <form method="post" action="delete-done.php">
      <input type="hidden" name="code" value="<?php print $code; ?>">
      <input type="submit" value="OK">
      <input type="button" onclick="history.back()" value="戻る">
    </form>
  </div>
</body>

</html>