<?php
require_once 'new-const.php';
class UpdateDb
{
    function updateDb1($code)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'DELETE FROM member WHERE code = :code';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit('デリートに失敗しました。');
        }
    }
}