<?php

// headの記載
require_once('../common.php');
$cmn = new Common();
$cmn->printHead('../css/main.css');
$code=$_GET['code'];//質問相手のコード

require_once '../new-db/execute-query.php';
$DbQuery = new DbQuery();
$rec = $DbQuery->dbQuery('
    SELECT name FROM members WHERE code = \''.$code.'\'
');
?>

<body>

    <div class="title-container">
        <img src="../favicon/p-favicon.png">
        <h2>check</h2>
        <p><?php print $rec[0]['name'].'さんへ質問' ?></p>
    </div>

    <div class="attention">
        <ul>
            <li>答えが知りたいのか、それとも考え方が知りたいのか整理できましたか？</li>
            <li>聞くべき人はその人ですか？</li>
            <li>質問が抽象的すぎませんか？</li>
            <li>分からないことは自分で調べましたか？</li>
            <li>注意書きは読みましたか？</li>
            <li>相手のお話を素直に受け入れる準備はできていますか？</li>
        </ul>
    </div>

    <form action="insert-branch.php" method="post">

        <div class="textarea-container">

            <div>
                <p>件名（必須）</p>
                <textarea name="title" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)" placeholder="※～について" required></textarea>
            </div>

            <div>
                <p>依頼したいこと（必須）</p>
                <textarea name="purpose" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)" placeholder="※～について解決策が知りたいです。" required></textarea>
            </div>

            <div>
                <p>詳細</p>
                <textarea name="detail" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)" placeholder="※～が表示できません。"></textarea>
            </div>

            <div>
                <p>考えられる原因</p>
                <textarea name="cause" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)" placeholder="※データベースにデータを挿入できていないこと。"></textarea>
            </div>

            <div>
                <p>試してみたこと・その他</p>
                <textarea name="other" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)" placeholder="※inputの属性をtimeからnumberに変更しました。"></textarea>
            </div>

        </div>

        <input type="hidden" name="aite_code" value="<?php print $code; ?>">
        <div class="menu">
            <input type="submit" name="question" value="メールを送信する" onclick="nullCheck()">
            <a href="../mypage/select-report-or-question.php?code=<?php print $code; ?>">もどる</a>
        </div>

    </form>

</body>

<script>
// 文字数制限
function maxLengthLimit($this, $num) {
        $this.value = $this.value.slice(0, $num);
}
</script>