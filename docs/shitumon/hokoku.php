<?php

// headの記載
require_once('../common.php');
$cmn = new Common();
$cmn->printHead('../css/main.css');

require_once '../new-db/execute-query.php';
$DbQuery = new DbQuery();
$rec = $DbQuery->dbQuery('
        SELECT name FROM members WHERE code = \'' . $_GET['code'] . '\'
');
?>

<body style="height: 100vh;">

        <div class="title-container">
                <img src="../favicon/p-favicon.png">
                <h2>check</h2>
                <p>
                        <?php print $rec[0]['name'] . 'さんへ報告'; ?>
                </p>
        </div>

        <form action="insert-branch.php" method="post">

                <div class="textarea-container">

                        <div>
                                <p>件名（必須）</p>
                                <textarea name="title" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)"
                                        placeholder="※～に関しての報告です。" required></textarea>
                        </div>

                        <div>
                                <p>詳細（必須）</p>
                                <textarea name="detail" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)"
                                        placeholder="※到達点とのギャップ・問題・報告事項・相談内容など" required></textarea>
                        </div>

                        <div>
                                <p>その他 </p>
                                <textarea name="other" rows="10" cols="35" oninput="maxLengthLimit(this, 1000)"
                                        placeholder="※～さんにも報告済みです。"></textarea>
                        </div>

                </div>

                <div class="rsvp">
                        <p>返答要・不要（必須）</p>
                        <label><input type="radio" name="rsvp" value="必要" required>必要</label>
                        <label><input type="radio" name="rsvp" value="不要">不要</label>
                </div>

                <input type="hidden" name="aite_code" value="<?php print $_GET['code']; ?>">
                <div class="menu">
                        <input type="submit" name="report" value="保存してメールを送る">
                        <a href="../mypage/select-report-or-question.php?code=<?php print $_GET['code']; ?>">もどる</a>
                </div>
        </form>
</body>

<script>
        // 文字数制限
        function maxLengthLimit($this, $num) {
                $this.value = $this.value.slice(0, $num);
        }
</script>