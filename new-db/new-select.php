<?php
require_once 'new-const.php';

//ここにconst書いてもだめだった。
//クラス内に記述しなきゃって書いてあったけど、メソッド内ということであってるのかな。
//ここはstaticの方がいいのかな？

class DbQuery {

    // FETCH_ASSOC
    function dbQuery($queryKind, $targetObject, $targetField, $condition, $sortTx) {
        $ConstDb = new ConstDb();
        $dsn = ConstDb::dsn;
        $user = ConstDb::user;
        $password = ConstDb::password;

        switch ($queryKind) {
            case 'select':
                $sql = 'select '.$targetField.' FROM ' .$targetObject.' '.$condition. ' '.$sortTx;
                break;
            case 'insert':
                $sql = 'insert into '.$targetObject.' ('.$targetField.') values (\''.$condition.'\')';
                break;
            case 'update':
                $sql = 'update '.$targetObject.' set '.$targetField.' '.$condition;
                break;
            case 'delete':
                $sql = 'delete from '.$targetObject.' '.$condition;
                break;
        }
        try {
            $dbh = $ConstDb->ConnectDb($dsn, $user, $password);
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($sql); //'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
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
            $sql = 'SELECT ' . $selectField . ' FROM ' . $selectObject . ' ' . $condition . ' ' . $sortTx;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit($sql); //'セレクトできませんでした。<a href="../registration/index.php">もどる</a>'
        }
        return $rec;
    }
}
