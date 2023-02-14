<?php
require_once 'new-const.php';

//ここにconst書いてもだめだった。
//クラス内に記述しなきゃって書いてあったけど、メソッド内ということであってるのかな。
//ここはstaticの方がいいのかな？

class DbQuery {

    // FETCH_ASSOC
    function dbQuery($query) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;

        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($query); //'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
        }
        return $rec;
    }

    // fetch_group
    function selectFetchAll($query) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($query); //'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
        }
        return $rec;
    }
}
