<?php
require_once('../sanitize.php');

$post = sanitize($_POST);
$name = $post['name'];
$name = str_replace(" ", "", $name);
$name = str_replace("　", "", $name);
$pass = $post['pass'];
$pass = hash('sha512', $pass);

try {
  require_once '../new-db/execute-query.php';
  $DbQuery = new DbQuery();
  $rec = $DbQuery->dbQuery('
    SELECT name, code
    FROM members
    WHERE name = \'' . $name . '\' AND pass = \'' . $pass . '\'
  ');

  if ($rec == true) {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['name'] = $rec[0]['name'];
    $_SESSION['code'] = $rec[0]['code'];
    header('Location:../mypage/mypage.php');
    exit();
  } else {
    // headの記載
    require_once('../common.php');
    $cmn = new Common();
    $cmn->printNotIncludedHead('../css/mylist.css');
    ?>

    <body>
      <?php
      print '<form action="login.html" method="post">';
      print '<p style="text-align: center;margin-top: 25%;">登録されていないものです。</p>';
      print '<input type="submit" value="もどる">';
      print '</form>';
  }
} catch (Exception $e) {
  exit('障害発生中');
  var_dump($e);
}
?>
</body>

</html>