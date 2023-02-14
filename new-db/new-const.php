<?php
//ここには、定数とDB接続を書く。

//データベースの定数の定義
class ConstDb
{
    // public const dsn = 'mysql:host=mysql205.phy.lolipop.lan;dbname=LAA1452799-shitsumon;charset=utf8';
    // public const user = 'LAA1452799';
    // public const password = 'okikami07081103';

    public const dsn = 'mysql:host=localhost;dbname=portfolio;charset=utf8';
    public const user = 'yuki';
    public const password = 'hy1733505';

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

    /*ここに$dsn = self::dsn;
        $user = self::user;
        $password = self::password;って書いたらエラーになるのはなぜ？？？？
*/
    //あとで別のファイル作る。
    function ConnectDb($dsn, $user, $password)
    {
        $dsn = self::dsn;
        $user = self::user;
        $password = self::password;
        try {
            $dbh = new PDO($dsn, $user, $password, [
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
