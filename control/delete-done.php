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

<?php

try
{
    $code=$_POST['code'];

    require_once '../new-db/new-delete.php';
    $UpdateDb = new UpdateDb();
    $UpdateDb->updateDb1($code);
}
catch (Exception $e)
{
  var_dump($e);
  exit('ただいま障害により大変ご迷惑をおかけしております。');
}

?>

<div class="mi">
削除しました。<br>
<br>
<a href="./control.php">戻る</a>
</div>
</body>
</html>
