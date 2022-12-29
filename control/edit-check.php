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
    require_once '../sanitize.php';
    $post = sanitize($_POST);
    $code = $post['code'];
    $name = $post['name'];
    $name = str_replace(" ", "", $name);
    $name = str_replace("　", "", $name);
    $mail = $post['email'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];
    $year = $post['year'];

    $okflag = true;

    if ($name == '') {
      print 'スタッフ名が入力されていません<br>';
      $okflag = false;
    }
    if (preg_match('/[ｦ-ﾟ]/u', $name) == true || preg_match('/[Ａ-Ｚ]/u', $name) == true || preg_match('/[０-９]/u', $name) == true) {
      print '※半角カタカナ・全角英字・全角数字は使用できません。<br>';
      $okflg = false;
    }

    if ($pass == '') {
      print 'パスワードが入力されていません<br>';
      $okflag = false;
    }

    if ($pass != $pass2) {
      print 'パスワードが一致しません。<br>';
      $okflag = false;
    }
    if ($mail == '' || preg_match('/\A([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+\z/', $mail) == 0) {
      print 'メールアドレスが正しく入力されていません。';
      $okflag = false;
    }

    //名前・学年かぶりがないか。
    require_once '../new-db/new-select.php';
    $DbQuery = new DbQuery();
    $condition = 'where name =\'' .$name .'\' AND year = \''.$year.'\'';
    $sameName = $DbQuery->dbQuery('select', 'member', 'name, year', $condition, '');
    print_r($sameName);
    if (count($sameName) > 1) {
      $okflag = false;
      print '同期に同じ名前で登録している人がいます。<br>';
      print '他の人が分からなくなってしまうので、区別できる名前に変更してください。<br>';
      print 'ご協力よろしくお願いします。<br>';
    }

    //パスワードかぶり
    $condition = 'where pass = \''.md5($pass).'\'';
    $samePass = $DbQuery->dbQuery('select', 'member', 'name', $condition , '');
    if (count($samePass) > 1) {
      $okflg = false;
      print 'パスワード「'.$pass.'」は使用されています。<br>';
      print '別のパスワードに変更してください。<br>';
    }

    if ($okflag == true) {
      print '<br>変更してもよろしいですか？<br><br>';
      print 'スタッフ名: ';
      print $name;
      print '<br>pass: ';
      print $pass;
      print '<br>';

      $pass = md5($pass);
      print '<form method="post" action="edit-done.php">';
      print '<input type="hidden" name="code" value="' . $code . '">';
      print '<input type="hidden" name="name" value="' . $name . '">';
      print '<input type="hidden" name="pass" value="' . $pass . '">';
      print '<input type="hidden" name="mail" value="' . $mail . '">';
      print '<input type="hidden" name="year" value="' . $year . '">';
      print '<br>';
      print '<input type="button" onclick="history.back()" value="戻る"><br><br>';
      print '<input type="submit" value="OK">';
      print '</form>';
    } else {
      print '<input type="button" onclick="history.back()" value="戻る">';
    }

    ?>
  </div>
</body>

</html>