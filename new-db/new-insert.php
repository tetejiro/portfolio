<?php
//ここには、インサート文を全部書く。
require_once 'new-const.php';

class InsertDb
{
    /*ここにnewした後に、
    $dsn = ConstDb::dsn;
    $user = ConstDb::user;
    $password = ConstDb::password;
    って書いたらエラーになるのはなぜ？？？？
*/
    function insertDb1($content)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);

            //1.registration/announce.phpのインサート文
            $sql="INSERT INTO announce(content) VALUES(:content)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit ('インサートできませんでした。<a href="../registration.php/index.php">もどる</a>');
        }
    }

    function InsertDb2($name, $year, $pass, $mail)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);

            //2.registration/reg-done.phpのインサート文
            $sql = 'LOCK TABLES member READ';
            $sql = 'INSERT INTO member (name, year, pass, mail)
                    VALUES (:name, :year, :pass, :mail)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':year', $year, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit ('インサートできませんでした。<a href="../registration.php/index.php">もどる</a>');
        }
    }

    function insertDb3($whose, $task, $bytime1_1, $bytime1_2, $bytime2_1, $bytime2_2, $emotion, $time1_1, $time1_2, $time2_1, $time2_2, $attention, $strong1, $strong2, $strong3)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);

            //3.mypage-update.phpのインサート文
            $sql='INSERT INTO now (whose,task,bytime1_1,bytime1_2,bytime2_1,bytime2_2,emotion,time1_1,time1_2,time2_1,time2_2,attention,strong1,strong2,strong3)
                    VALUES (:whose, trim(:task), :bytime1_1, :bytime1_2, :bytime2_1, :bytime2_2, :emotion, :time1_1, :time1_2, :time2_1, :time2_2, trim(:attention), trim(:strong1), trim(:strong2), trim(:strong3))';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':whose', $whose, PDO::PARAM_INT);
            $stmt->bindValue(':task', $task, PDO::PARAM_STR);
            $stmt->bindValue(':bytime1_1', $bytime1_1, PDO::PARAM_INT);
            $stmt->bindValue(':bytime1_2', $bytime1_2, PDO::PARAM_INT);
            $stmt->bindValue(':bytime2_1', $bytime2_1, PDO::PARAM_INT);
            $stmt->bindValue(':bytime2_2', $bytime2_2, PDO::PARAM_INT);
            $stmt->bindValue(':emotion', $emotion, PDO::PARAM_STR);
            $stmt->bindValue(':time1_1', $time1_1, PDO::PARAM_INT);
            $stmt->bindValue(':time1_2', $time1_2, PDO::PARAM_INT);
            $stmt->bindValue(':time2_1', $time2_1, PDO::PARAM_INT);
            $stmt->bindValue(':time2_2', $time2_2, PDO::PARAM_INT);
            $stmt->bindValue(':attention', $attention, PDO::PARAM_STR);
            $stmt->bindValue(':strong1', $strong1, PDO::PARAM_STR);
            $stmt->bindValue(':strong2', $strong2, PDO::PARAM_STR);
            $stmt->bindValue(':strong3', $strong3, PDO::PARAM_STR);
            //ここから緊急の付け足し

            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit ('インサートできませんでした。<a href="../registration.php/index.php">もどる</a>');
        }
    }

    //hozon.phpのインサート
    function insertDb4($honnin, $code, $situation, $goal, $what, $why, $try, $return1)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);

            //2.registration/reg-done.phpのインサート文
            $sql='INSERT INTO question (whose, whom, situation, goal, what, why, try0, return1)
                    VALUES (:honnin, :code, :situation, :goal, :what, :why, :try, :return1)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':honnin', $honnin, PDO::PARAM_INT);
            $stmt->bindValue(':code', $code, PDO::PARAM_INT);
            $stmt->bindValue(':situation', $situation, PDO::PARAM_STR);
            $stmt->bindValue(':goal', $goal, PDO::PARAM_STR);
            $stmt->bindValue(':what', $what, PDO::PARAM_STR);
            $stmt->bindValue(':why', $why, PDO::PARAM_STR);
            $stmt->bindValue(':try', $try, PDO::PARAM_STR);
            $stmt->bindValue(':return1', $return1, PDO::PARAM_STR);
            $stmt->execute();
            $dbh = null;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit ('インサートできませんでした。<a href="../registration.php/index.php">もどる</a>');
        }
    }

}