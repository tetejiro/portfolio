<?php

$content=$_POST['content'];
if(mb_strlen($content)<5)
{
    print '5文字以上は記載してください。';
    print '<a href="announce.php">もどる</a><br>';
}
else
{
    try
    {
        require_once '../new-db/new-insert.php';
        $InsertDb = new InsertDb();
        $InsertDb->insertDb1($content);
        header('Location:announce.php');
    }
    catch(Exception $e)
    {
        print '障害により記録できませんでした。';
        print '<a href="index.php">もどる</a><br>';
        var_dump($e);
    }

}

?>
