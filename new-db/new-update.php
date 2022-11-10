<?php
require_once 'new-const.php';
class UpdateDb
{
    function updateDb1($name, $year, $pass, $mail, $code)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'UPDATE member
                    SET name = :name, year = :year, pass = :pass, mail = :mail
                    WHERE code = :code';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue('name', $name, PDO::PARAM_STR);
            $stmt->bindValue('year', $year, PDO::PARAM_INT);
            $stmt->bindValue('pass', $pass, PDO::PARAM_STR);
            $stmt->bindValue('mail', $mail, PDO::PARAM_STR);
            $stmt->bindValue('code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit('アップデートエラーです。');
        }
    }
}