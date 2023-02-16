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
<div class="mi">
<?php

try {
      require_once '../sanitize.php';
      $post=sanitize($_POST);
      $code=$post['code'];
      $name=$post['name'];
      $mail=$post['mail'];
      $pass=$post['pass'];
      $year=$post['year'];

      require_once '../new-db/execute-Query.php';
      $DbQuery = new DbQuery();
      $DbQuery->dbQuery('
            UPDATE members
            SET name =\''.$name.'\', year =\''.$year.'\', pass=\''.$pass.'\', mail=\''.$mail.'\'
            WHERE code = \''.$code.'\'
      ');
}
catch (Exception $e) {
      print $e;
      exit('ただいま障害により大変ご迷惑をおかけしております。');
}

?>
<br>
修正しました。<br>
<br>
<a href="./user-list.php">戻る</a>
</div>
</body>
</html>