<?php
session_start();
try
{
      require_once '../sanitize.php';
      $post = sanitize($_POST);
      $name = $post['name'];
      $year = $post['year'];
      $pass = $post['pass'];
      $mail = $post['mail'];

      require_once '../new-db/new-select.php';
      $DbQuery = new DbQuery();
      $fieldName = 'name, year, pass, mail';
      $val = $name.'\',\''.$year.'\',\''.$pass.'\',\''.$mail;
      $DbQuery->DbQuery('
            INSERT INTO member
                  (name, year, pass, mail)
            VALUES
                  ('.$name.'\',\''.$year.'\',\''.$pass.'\',\''.$mail.'\'
      ');

      require_once '../new-db/new-select.php';
      $DbQuery = new DbQuery();
      $rec = $DbQuery->dbQuery('SELECT max(code) FROM member');

      $_SESSION['login'] = 1;
      $_SESSION['name'] = $name;
      $_SESSION['code'] = $rec['max(code)'];
      header('Location:../mypage/mypage.php');
      exit();
}
catch (Exception $e)
{
      var_dump($e);
      exit('ただいま障害によりご迷惑をおかけしております。');
      print '<form action="registration.html" method="post">';
      print '<input type="submit" value="戻る">';
      print '</form>';
}
