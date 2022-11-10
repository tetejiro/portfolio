<?php

/*
１．インデックス表示
２．ログインページ表示
３．ログインできない⇒２．にもどる
４．ログインできた⇒マイページ
５．マイページを
*/

//ここのそもそもの出力の条件のリストが分からない。

class PrintPage{

  function getIndex():void{
    try{
      require_once '../registration/index.php';
    }
    catch(Exception $e){
      $_SESSION['ellor'] = $e;
      header('Location:../registration/index.php');
    }
  }

    function getAnnounce():void{
      try{
        require_once '../registration/announce.php';
      }
      catch(Exception $e){
        $_SESSION['ellor'] = $e;
        header('Location:../registration/index.php');
      }
    }

    function getLogin():void{
      try{
        require_once '../registration/login.html';
      }
      catch(Exception $e){
        $_SESSION['ellor'] = $e;
        header('Location:../registration/index.php');
      }

      function getLogincheck(){
        try{
          require_once '../registration/login-check.php';
        }
        catch(Exception $e){
          $_SESSION['ellor'] = $e;
          header('Location:../registration/index.php');
        }
      }
    }

}


/*
//１．ログインしているかしていないか。
class Index{
  function Login($_POST){
    $name = $_POST['name'];
    $pass = $_POST['pass'];
  }
}
*/