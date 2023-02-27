<?php

// 編集ボタン押下
if(isset($_POST['edit']) == true)
{
  $code = $_POST['code'];
  header('Location:edit.php?code='.$code);
  exit();
}

// 削除ボタン押下
if(isset($_POST['delete']) == true)
{
  $code = $_POST['code'];
  header('Location:delete.php?code='.$code);
  exit();
}

?>
