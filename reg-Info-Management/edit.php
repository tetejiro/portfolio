<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/control.css');
?>
<style>
  div:not(:last-child) {margin: 2% 0 !important;}
  div:first-child {margin-top: 0 !important;}
  input[type="submit"] {margin-top: 2.5%;}
</style>

<body>
  <?php

  try {
    $code = $_GET['code'];

    require_once '../new-db/execute-query.php';
    $DbQuery = new DbQuery();
    $rec = $DbQuery->dbQuery('SELECT name, mail, year FROM members WHERE code = \'' .$code.'\'');
    $name = $rec[0]['name'];
    $mail = $rec[0]['mail'];
    $year = $rec[0]['year'];
  } catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit('<a href="../registration/login.html">ログイン</a>し直してください。');
  }


  ?>
  <div class="edit">
    <h3>スタッフ情報 修正</h3>
    <div>スタッフコード</div>
    <?php print $code; ?>
    <form method="post" action="edit-check.php">
      <input type="hidden" name="code" value="<?php print $code; ?>">
      <div>スタッフ名</div>
      <input type="text" name="name" class="container" value="<?php print $name; ?>" required>
      <div>
        第
        <select name="year">
          <option value="1" <?php $year == 1 ? print 'selected' : '';?>>1</option>
          <option value="2" <?php $year == 2 ? print 'selected' : '';?>>2</option>
          <option value="3" <?php $year == 3 ? print 'selected' : '';?>>3</option>
          <option value="4" <?php $year == 4 ? print 'selected' : '';?>>4</option>
          <option value="5" <?php $year == 5 ? print 'selected' : '';?>>5</option>
          <option value="6" <?php $year == 6 ? print 'selected' : '';?>>シニア</option>
        </select>
        期
      </div>
      <div>メールアドレス</div>
      <input type="text" name="email" class="container" value="<?php print $mail; ?>" required>
      <div>パスワードを入力してください。</div>
      <input type="password" name="pass" class="container" required>
      <div>パスワードをもう1度入力してください。</div>
      <div class="mgn"><input type="password" name="pass2" class="container" required></div>
      <input type="submit" value="OK">
      <input type="button" onclick="history.back()" value="戻る">
    </form>
  </div>
</body>

</html>