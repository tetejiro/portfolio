<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/mannaka.css');
?>

  <body>

  <?php

  try
  {
    $code = $_POST['code'];

    require_once '../new-db/execute-query.php';
    $DbQuery = new DbQuery();
    $DbQuery->dbQuery('DELETE FROM members WHERE code = \''.$code.'\'');
  }
  catch (Exception $e)
  {
    var_dump($e);
    exit('ただいま障害により大変ご迷惑をおかけしております。');
  }

  ?>

  <div class="container">
    <p>削除しました。</p>
    <a href="./user-list.php">戻る</a>
  </div>
  </body>
</html>
