<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/login.css');
?>

<body>
  <?php
  $name = $_POST['name'];
  require_once '../sanitize.php';
  $post = sanitize($_POST);
  $name = $post['name'];
  $name = str_replace(" ", "", $name);
  $name = str_replace("　", "", $name);
  $year = $post['year'];
  $mail = $post['mail'];
  $pass = $post['pass'];
  $pass2 = $post['pass2'];

  //名前
  $okflg = true;
  if ($name == '') {
    print '名前を入力してください。 ';
    $okflg = false;
  }
  if (mb_strlen($name) > 15) {
    print '名前の文字数は15文字までにしてください。';
    $okflg = false;
  }

  if (preg_match('/[ｦ-ﾟ]/u', $name) == true || preg_match('/[Ａ-Ｚ]/u', $name) == true || preg_match('/[０-９]/u', $name) == true) {
    print '※半角カタカナ・全角英字・全角数字は使用できません。';
    $okflg = false;
  }

  //メール
  if ($mail == '' || preg_match('/\A([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+\z/', $mail) == 0) {
    print 'メールアドレスを正しく入力してください。 ';
    $okflg = false;
  }

  //パスワード
  if (mb_strlen($pass) > 20) {
    print 'パスワードは20文字以内にしてください。';
    $okflg = false;
  }

  if ($pass !== $pass2) {
    print 'パスワードを正しく入力してください。';
    $okflg = false;
  }

  //名前・学年かぶりがないか。
  require_once '../new-db/execute-query.php';
  $DbQuery = new DbQuery();
  $rec = $DbQuery->dbQuery('
    SELECT name, year
    FROM members
    WHERE name = \''.$name.'\'AND year =\''.$year.'\'
  ');

  if (empty($rec) == false) {
    print '同期に同じ名前で登録している人がいます。';
    print '他の人が分からなくなってしまうので、区別できる名前に変更してください。';
    print 'ご協力よろしくお願いします。';
    $okflg = false;
  }

  //パスワードかぶり
  $rec = $DbQuery->dbQuery('
    SELECT name FROM members
    WHERE pass =\''.hash('sha512', $pass).'\'
  ');
  if (empty($rec) == false) {
    print 'そのパスワードは使用されています。';
    print '別のパスワードに変更してください。';
    $okflg = false;
  }

  //メールアドレスかぶり
  $mailQuery = $DbQuery->dbQuery('
    SELECT mail FROM members WHERE mail = \''.$mail.'\'
  ');
  if(count($mailQuery) >= 1) {
    print 'メールアドレスは既に使用されています。';
    print '他のメールアドレスに変更してください。';
    $okflg = false;
  }

  //1つでも当てはまったらもどるへ
  if ($okflg == false) {
    print '<form>';
    print '<input type="button" onclick="history.back();" value="戻る">';
    print '</form>';
  } ?>

  <!--全部クリアしていれば表示-->
  <?php if ($okflg == true) { ?>
    <main>
      <div class="left-side">
        <img class="img" src="../favicon/p-favicon2.png" alt="?">
      </div>
      <div class="right-side">
        <div class="container">
          <p class="mrg-bottom">入力内容確認</p>
          <ul class="mrg-top">お名前
            <li class="mrg-left"><?php print $name; ?></li>
          </ul>
          <ul class="mrg-top">mail
            <li class="mrg-left"><?php print $mail; ?></li>
          </ul>
          <ul class="mrg-top">password
            <li class="mrg-left"><?php print $pass; ?></li>
          </ul>
          <div class="btn-flex">
            <input type="submit" onclick="history.back();" value="修正する">
            <form action="reg-done.php" method="post">
              <input type="hidden" name="name" value="<?php print $name; ?>">
              <input type="hidden" name="year" value="<?php print $year; ?>">
              <input type="hidden" name="pass" value="<?php print hash('sha512', $pass); ?>">
              <input type="hidden" name="mail" value="<?php print $mail; ?>">
              <input class="scd-btn" type="submit" value="始める">
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
    </main>
</body>

</html>