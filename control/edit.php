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

try
{
  $code=$_GET['code'];

  require_once '../new-db/new-select.php';
  $SelectDb = new SelectDb();
  $rec = $SelectDb->selectDb11($code);
  $name=$rec['name'];
  $mail=$rec['mail'];
}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。';
  exit('<a href="../registration/login.html">ログイン</a>し直してください。');
}


?>

スタッフ修正<br>
<br>
スタッフコード<br>
<?php print $code; ?>
<br>
<br>
<form method="post" action="edit-check.php">
<input type="hidden" name="code" value="<?php print $code; ?>">
スタッフ名<br>
<input type="text" name="name" class="waku" value="<?php print $name; ?>" required><br><br>
第
<select name="year">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">シニア</option>
</select>
期 <br><br>
メールアドレス<br>
<input type="text" name="email" class="waku" value="<?php print $mail; ?>" required><br><br>
パスワードを入力してください。<br>
<input type="password" name="pass" class="waku" required><br><br>
パスワードをもう1度入力してください。<br>
<input type="password" name="pass2" class="waku" required><br>
<br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</div>
</body>
</html>
