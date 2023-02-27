<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/control.css');
?>

<style>
  .container {text-align: center; margin-top: 5%;}
  input[type=submit] {margin-right: 0;}
</style>

<body>
  <div class="container">

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
    require_once '../new-db/execute-query.php';
    $DbQuery = new DbQuery();
    $sameName = $DbQuery->dbQuery('
      SELECT name, year
      FROM members
      WHERE name =\'' .$name .'\' AND year = \''.$year.'\'
    ');
    if (count($sameName) > 1) {
      $okflag = false;
      print '同期に同じ名前で登録している人がいます。<br>';
      print '他の人が分からなくなってしまうので、区別できる名前に変更してください。<br>';
      print 'ご協力よろしくお願いします。<br>';
    }

    //パスワードかぶり
    $samePass = $DbQuery->dbQuery('
      SELECT name FROM members where pass = \''.hash('sha512', $pass).'\'
    ');
    if (count($samePass) > 1) {
      $okflg = false;
      print 'パスワード「'.$pass.'」は使用されています。<br>';
      print '別のパスワードに変更してください。<br>';
    }

    if ($okflag == true) {
      print '<p>変更してもよろしいですか？</p>';
      print '<div>スタッフ名: ';
      print $name.'</div>';
      print '<div>pass: ';
      print $pass.'</div>';

      $pass = hash('sha512', $pass);
      print '<form method="post" action="edit-done.php">';
      print '<input type="hidden" name="code" value="' . $code . '">';
      print '<input type="hidden" name="name" value="' . $name . '">';
      print '<input type="hidden" name="pass" value="' . $pass . '">';
      print '<input type="hidden" name="mail" value="' . $mail . '">';
      print '<input type="hidden" name="year" value="' . $year . '">';
      print '<div><input type="submit" value="OK"></div>';
      print '<div><input type="button" onclick="history.back()" value="戻る"></div>';
      print '</form>';
    } else {
      print '<div><input type="button" onclick="history.back()" value="戻る"></div>';
    }

    ?>
  </div>
</body>

</html>