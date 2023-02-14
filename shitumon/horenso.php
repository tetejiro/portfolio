<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
        print 'ログインしてください。';
        print '<a href="../registration/login.html">ログインページへ</a>';
} else {
        //このsession[url]の初期化が効かない理由が分からない。
        $_SESSION['url'] = array();
        $_SESSION['shitumon'] = 0;
        $_SESSION['horenso'] = 1;
        $_SESSION['url'] = $_SESSION['horenso'];
        $code = $_GET['code'];

        require_once '../new-db/new-select.php';
        $DbQuery = new DbQuery();
        $rec = $DbQuery->dbQuery('SELECT name FROM member WHERE code = \''.$code.'\'');
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
                                <p><?php print $name . 'さんへ報告'; ?></p>
                        </div><!--
                        <div class="ue2">
                                <ul>
                                        <li>答えが知りたいのか、それとも考え方が知りたいのか整理できましたか？</li>
                                        <li>聞くべき人はその人ですか？</li>
                                        <li>質問が抽象的すぎませんか？</li>
                                        <li>分からないことは自分で調べましたか？</li>
                                        <li>注意書きは読みましたか？</li>
                                        <li>相手のお話を素直に受け入れる準備はできていますか？</li>
                                </ul>
                        </div>-->
                </div>
                <form action="hozon.php" method="post">
                        <div class="shitumon">
                                <div class="goal">
                                        件名（必須）<br>
                                        <textarea name="situation" rows="10" cols="35" placeholder="※～に関しての報告です。" required></textarea>
                                </div>
                                <div class="situation">
                                        詳細（必須）<br>
                                        <textarea name="what" rows="10" cols="35" placeholder="※到達点とのギャップ・問題・報告事項・相談内容など" required></textarea>
                                </div>
                                <div class="sonota">
                                        その他 <br>
                                        <textarea name="try" rows="10" cols="35" placeholder="※～さんにも報告済みです。"></textarea>
                                </div>
                        </div>
                        <div class="henshin">
                                返答要・不要（必須）<br><br>
                                        <label><input type="radio" name="return1" value="必要" required>必要</label>
                                        <label><input type="radio" name="return1" value="不要">不要</label>
                        </div>

                        <?php $code = $_GET['code']; ?>
                        <input type="hidden" name="code" value="<?php print $code; ?>">

                        <div class="menu">
                                <input type="submit" value="保存してメールを送る">
                </form>
                <a href="../mypage/select.php?code=<?php print $code; ?>">もどる</a>
                </div>
        </body>
<?php
}
?>