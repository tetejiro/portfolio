<?php
require_once 'definition.php';

class DbQuery {

    // FETCH_ASSOCモード
    function dbQuery($query) {

        try {
            $ConstDb = new ConstDb();
            $dbh = $ConstDb->ConnectDb();
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }

    // fetch_groupモード
    function selectFetchAll($query) {
        try {
            $ConstDb = new ConstDb();
            $dbh = $ConstDb->ConnectDb();
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $rec = $stmt->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
            $dbh = null;
        } catch (Exception $e) {
            var_dump($e);
            exit('セレクトできませんでした。<a href="../registration/index.php">もどる</a>');
        }
        return $rec;
    }
}
