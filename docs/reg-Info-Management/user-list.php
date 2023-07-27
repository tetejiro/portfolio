<?php
    // headの記載
    require_once('../common.php');
    $cmn = new Common();
    $cmn->printNotIncludedHead('../css/member-list.css');
?>

<body>

    <main>

        <form method="post" action="./control-branch.php">

            <div class="header">

                <a href="../registration/index.php"><img src="../favicon/p-favicon4.png" alt="?"></a>

                <div class="title">
                    <h3 style="margin-top: revert;">編集する人を選択してください。</h3>
                </div>

            </div>

            <?php
            require_once '../new-db/execute-query.php';
            $DbQuery = new DbQuery();
            // 先頭カラムでグループ化されたレコード
            $rec = $DbQuery->selectFetchAll('SELECT year, code, name FROM members');
            ksort($rec);
            ?>

            <div class="classes">

                <?php
                if (isset($rec) == true) {
                    foreach ($rec as $class => $members) {

                        print '<fieldset>';

                            $class === 6 ? print 'シニア' : print $class . '期';

                            foreach ($members as $member) {
                                $code = $member['code'];
                                $name = $member['name'];
                                print '<div class="name">';
                                print '<label>';
                                print '<input type="radio" class="name" name="code" value="' . $code . '" required>';
                                print $name. 'さん';
                                print '</label>';
                                print '</div>';
                            }

                        print '</fieldset>';

                    }
                } ?>
            </div>

            <div class="menu">

                <input type="submit" name="edit" value="編集する">

                <input type="submit" name="delete" value="削除する">

                <a href="../registration/index.php">もどる</a>

            </div>

            <?php
            if (!isset($rec)) {
                print 'まだ登録がありません。';
            }
            ?>

        </form>

    </main>

</body>

</html>