<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print 'ログインしてください。';
    print '<a href="../registration/login.html">ログインページへ</a>';
}
else
{
    //このsessionの初期化ができないのはなんで？
    $_SESSION['url']=array();
    $_SESSION['horenso']=0;
    $_SESSION['shitumon']=1;
    $_SESSION['url']=$_SESSION['shitumon'];
    //質問相手のコード
    $code=$_GET['code'];

    require_once '../new-db/execute-Query.php';
    $DbQuery = new DbQuery();
    $rec = $DbQuery->dbQuery('
        SELECT name FROM members WHERE code = \''.$code.'\'
    ');
    $name = $rec[0]['name'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>しつもん</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- css -->
<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
<link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>
<body>
    <div class="ue">
        <div class="ue1">
            <img src="../favicon/p-favicon.png">
            <h2>check</h2>
            <p><?php print $name.'さんへ質問' ?></p>
        </div>
        <div class="ue2">
            <ul>
                <li>答えが知りたいのか、それとも考え方が知りたいのか整理できましたか？</li>
                <li>聞くべき人はその人ですか？</li>
                <li>質問が抽象的すぎませんか？</li>
                <li>分からないことは自分で調べましたか？</li>
                <li>注意書きは読みましたか？</li>
                <li>相手のお話を素直に受け入れる準備はできていますか？</li>
            </ul>
        </div><!--ue2-->
    </div><!--ue-->
    <form action="insert-branch.php" method="post">
        <div class="shitumon">
            <div class="goal">
                件名（必須）<br>
                <textarea name="situation" rows="10" cols="35" placeholder="※～について" required></textarea>
            </div>
            <div class="situation">
                依頼したいこと（必須）<br>
                <textarea name="goal" rows="10" cols="35" placeholder="※～について解決策が知りたいです。" required></textarea>
            </div>
            <div class="what">
                詳細<br>
                <textarea name="what" rows="10" cols="35" placeholder="※～が表示できません。"></textarea>
            </div>
            <div class="why">
                考えられる原因<br>
                <textarea name="why" rows="10" cols="35" placeholder="※データベースにデータを挿入できていないこと。"></textarea>
            </div>
            <div class="sonota">
                試してみたこと・その他<br>
                <textarea name="try" rows="10" cols="35" placeholder="※inputの属性をtimeからnumberに変更しました。"></textarea>
            </div>
        </div>
        <input type="hidden" name="code" value="<?php print $code; ?>">
        <div class="menu">
                <input type="submit" value="メールを送信する">
            </form>
                <a href="../mypage/select-report-or-question.php?code=<?php print $code; ?>">もどる</a>
        </div>
</body>
<?php }
?>
