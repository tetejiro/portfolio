<?php
//データベースの定数の定義
class ConstDb
{
    private $dsnName;
    private $userName;
    private $pass;

    // DBのユーザ名・パスワードのセット（ローカル・サーバ）
    function __construct() {
        if(($_SERVER['SERVER_NAME'] == 'localhost') == 1) {
            $this->dsnName = 'mysql:host=localhost;dbname=portfolio;charset=utf8';
            $this->userName = 'yuki';
            $this->pass = 'hy1733505';
        } else {
            $this->dsnName = 'mysql:host=mysql205.phy.lolipop.lan;dbname=LAA1452799-shitsumon;charset=utf8';
            $this->userName = 'LAA1452799';
            $this->pass = 'okikami07081103';
        }
    }

    function ConnectDb()
    {
        try {
            $dbh = new PDO($this->dsnName, $this->userName, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES, false
            ]);
        } catch (Exception $e) {
            var_dump($e);
            exit('接続エラーです。<a href="../registration/index.php">もどる</a>');
        }
        return $dbh;
    }
}
