<?php
//ここには、定数とDB接続を書く。

//データベースの定数の定義
class ConstDb
{
    protected $dsnName;
    protected $userName;
    protected $pass;

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

    const task = 'task';
    const bytime1 = 'bytime1';
    const bytime2 = 'bytime2';
    const emotion = 'emotion';
    const time1 = 'time1';
    const time2 = 'time2';
    const attention = 'attention';
    const strong1 = 'strong1';
    const strong2 = 'strong2';
    const strong3 = 'strong3';

    //あとで別のファイル作る。
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
