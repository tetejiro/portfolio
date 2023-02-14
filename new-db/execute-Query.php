<?php
require_once 'definition.php';

//ここにconst書いてもだめだった。
//クラス内に記述しなきゃって書いてあったけど、メソッド内ということであってるのかな。
//ここはstaticの方がいいのかな？

class DbQuery {

    // FETCH_ASSOCモード
    function dbQuery($queryKind, $targetObject, $targetField, $condition, $othere) {

        switch ($queryKind) {
            case 'select':
                $sql = 'select '.$targetField.' FROM ' .$targetObject.' '.$condition. ' '.$othere;
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
            $ConstDb = new ConstDb();
            $dbh = $ConstDb->ConnectDb();
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

    // fetch_groupモード
    function selectFetchAll($selectObject, $selectField, $condition, $sortTx) {
        try {
            $ConstDb = new ConstDb();
            $dbh = $ConstDb->ConnectDb();
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
