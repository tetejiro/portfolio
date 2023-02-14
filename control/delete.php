<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>しつもん</title>
  <meta name="description" content="しつもんするための便利なツール。しつもん上手になって安心して業務に取り組もう。">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
  <link rel="stylesheet" href="../css/control.css">
  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>

<body>
  <div class="delete">
    <?php

    try {
      $code = $_GET['code'];
      require_once '../new-db/execute-Query.php';
      $DbQuery = new DbQuery();
      $condition = 'where code = \''.$code.'\'';
      $rec = $DbQuery->dbQuery('select', 'member', 'name', $condition, '');
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