<?php
/*
$dsn='mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1049460-portfolio;charset=utf8';
$user='LAA1049460';
$password='kuriharasan';
*/
require_once('libs/bases/BaseDB.php');
final class DB extends BaseDB
{
    protected function getConnectionString(): string
    {
        return 'mysql:host=localhost;dbname=portfolio;charset=utf8';
        //return 'mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1321995-portfolio;charset=utf8';
    }
    protected function getId(): string
    {
        return 'yuki';
        //return 'LAA1321995';
    }
    protected function getPassword(): string
    {
        return 'hy1733505';
        //return 'okikami07081103';
    }
/*
データベース名	LAA1321995-portfolio	操作する
データベースホスト	mysql153.phy.lolipop.lan
データベースバージョン	5.6
ユーザー名	LAA1321995
*/
}

?>
