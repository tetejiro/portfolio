<?php

if(isset($_POST['edit']) == true)
{
  if(isset($_POST['code']) == false)
  {
    header('Location:ng.php');
    exit('編集する人を選択してください。');
  }
  $code = $_POST['code'];
  header('Location:edit.php?code='.$code);
  exit();
}

if(isset($_POST['delete']) == true)
{
  if(isset($_POST['code']) == false)
  {
    header('Location:ng.php');
    exit('削除する人を選択してください。');
  }
  $code = $_POST['code'];
  header('Location:delete.php?code='.$code);
  exit();
}

?>
