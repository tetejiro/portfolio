<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta title="しつもん">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>

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
    print '名前を入力してください。 <br>';
    $okflg = false;
  }
  if (mb_strlen($name) > 15) {
    print '名前の文字数は15文字までにしてください。';
    $okflg = false;
  }

  if (preg_match('/[ｦ-ﾟ]/u', $name) == true || preg_match('/[Ａ-Ｚ]/u', $name) == true || preg_match('/[０-９]/u', $name) == true) {
    print '※半角カタカナ・全角英字・全角数字は使用できません。<br>';
    $okflg = false;
  }

  //メール
  if ($mail == '' || preg_match('/\A([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+\z/', $mail) == 0) {
    print 'メールアドレスを正しく入力してください。 <br>';
    $okflg = false;
  }

  //パスワード
  if ($pass !== $pass2) {
    print 'パスワードを正しく入力してください。<br>';
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
    print '同期に同じ名前で登録している人がいます。<br>';
    print '他の人が分からなくなってしまうので、区別できる名前に変更してください。<br>';
    print 'ご協力よろしくお願いします。<br>';
    $okflg = false;
  }

  //パスワードかぶり
  $rec = $DbQuery->dbQuery('
    SELECT name FROM members
    WHERE pass =\''.hash('sha512', $pass).'\'
  ');
  if (empty($rec) == false) {
    print 'そのパスワードは使用されています。<br>';
    print '別のパスワードに変更してください。<br>';
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
      <div class="hidari">
        <img class="img" src="../favicon/p-favicon2.png" alt="?">
      </div>
      <!--hidari-->
      <div class="migi">
        <div class="naiyo">
          <p>入力内容確認</p><br><br>
          <ul>お名前<br>
            <li><?php print $name; ?></li>
          </ul><br><br>
          <ul>mail<br>
            <li><?php print $mail; ?></li>
          </ul><br><br>
          <ul>password<br>
            <li><?php print $pass; ?></li>
          </ul><br><br>
          <form>
            <input type="button" onclick="history.back();" value="修正する"><br><br>
          </form>
          <?php $pass = hash('sha512', $pass); ?>
          <form action="reg-done.php" method="post">
            <input type="hidden" name="name" value="<?php print $name; ?>">
            <input type="hidden" name="year" value="<?php print $year; ?>">
            <input type="hidden" name="pass" value="<?php print $pass; ?>">
            <input type="hidden" name="mail" value="<?php print $mail; ?>">
            <input type="submit" value="始める">
          </form>
        </div>
        <!--naiyo-->
      </div>
      <!--migi-->
    <?php } ?>
    </main>
</body>

</html>