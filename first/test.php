<?php
  require_once './first.php';

  $PrintPage = new PrintPage();

  if(isset($_POST['start']) == true){
    $PrintPage->getLogincheck();
  }