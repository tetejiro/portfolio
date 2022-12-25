<?php
require_once 'new-const.php';

//ここにconst書いてもだめだった。
//クラス内に記述しなきゃって書いてあったけど、メソッド内ということであってるのかな。
//ここはstaticの方がいいのかな？

class SelectDb
{
    /*ここにnewした後に、
    $dsn = ConstDb::dsn;
    $user = ConstDb::user;
    $password = ConstDb::password;
    って書いたらエラーになるのはなぜ？？？？
    */

// ここから
    // 使用箇所 index.php

    // 使用箇所 reg-check.php
    // function selectFromNow($honnin)
    // {
    //     $ConstDb = new ConstDb();
    //     $dsn = ConstDb::dsn;
    //     $user = ConstDb::user;
    //     $password = ConstDb::password;
    //     try {
    //         $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
    //         $sql = 'SELECT * FROM now WHERE whose = :honnin';
    //         $stmt = $dbh->prepare($sql);
    //         $stmt->bindValue(':honnin', $honnin, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         $dbh = null;
    //     } catch (Exception $e) {
    //         var_dump($e);
    //         exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
    //     }
    //     return $rec;
    // }

    function selectDb13($honnin)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT date, whom FROM latest WHERE code = :honnin';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':honnin', $honnin, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。');
        }
        return $rec;
    }

    //7.reg-check.phpのセレクト文(2)
    function selectFromQuestion($honnin) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT nitizi, whose, whom, situation, goal, what, why, try0
                    FROM question WHERE whose = :honnin';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':honnin', $honnin, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }


// ここまで

    //2.login-check.phpのセレクト文
    function selectDb2($name, $pass)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name,code FROM member WHERE name=:name AND pass=:pass';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    //3.reg-check.phpのセレクト文
    function selectDb3()
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = "SELECT max(code) FROM member";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $sql = 'UNLOCK TABLES';
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    //5-2.reg-check.phpとmypage.phpのセレクト文(2)
    //！！！注意！！！　この52という数字は合ってるから、変えなくて大丈夫！
    // function selectDb52($code) {
    //     $ConstDb = new ConstDb();
    //     $dsn = ConstDb::dsn;
    //     $user = ConstDb::user;
    //     $password = ConstDb::password;
    //     try {
    //         $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
    //         $sql = 'SELECT name FROM member WHERE code = :code';
    //         $stmt = $dbh->prepare($sql);
    //         $stmt->bindValue(':code', $code, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    //         $dbh = null;
    //     } catch (Exception $e) {
    //         var_dump($e);
    //         exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
    //     }
    //     return $rec;
    // }

    //6.reg-check.phpのセレクト文(2)
    //8.reg-check.phpのセレクト文(2)
    function selectDb8($name)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name FROM member
                    WHERE code = :whom';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':whom', $name, PDO::PARAM_INT);
            $stmt->execute();
            $aite = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        if (!empty($aite)) {
            return $aite['name'];
        } else {
            return $aite = '名無し';
        }
    }

    //9.select.phpのセレクト文(2)
    function selectDb9($code)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name FROM member WHERE code = :code';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    //10.select.phpとshitumon.phpとdelete.php
    function selectDb10($code)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name FROM member WHERE code = :code';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    //11.done.phpと、edit.php
    function selectDb11($code)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name,mail FROM member WHERE code = :code';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    function selectDb12($name, $year)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name FROM member WHERE name = :name AND year = :year';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':year', $year, PDO::PARAM_INT);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。');
        }
        return $rec;
    }

    function selectDb14($pass)
    {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT name FROM member WHERE pass = :pass';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。');
        }
        return $rec;
    }
    /*
    //11.done.phpと、edit.php
    public function selectDb12(string $sql, array $params): array
    {
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try
        {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $stmt = $dbh->prepare($sql);
            foreach($params as $key => $value){
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$rec){
                return [];
            }
            return $rec;
        }
        catch(Exception $e)
        {
            var_dump($e);
            exit ('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        finally{
            $dbh = null;
        }
    }
    */





    // FETCH_ASSOC
    function selectQuery($selectedObject, $selectField, $condition, $sortTx) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT '.$selectField.' FROM '.$selectedObject.' '.$condition.' '.$sortTx;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($sql);//'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
        }
        return $rec;
    }

    // fetch_group
    function selectFetchAll($selectObject, $selectField, $condition, $sortTx) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $sql = 'SELECT '.$selectField.' FROM '. $selectObject.' '.$condition.' '.$sortTx;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($sql);//'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
        }
        return $rec;
    }

}
