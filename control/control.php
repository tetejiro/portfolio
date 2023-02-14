<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta title="しつもん">
    <title>しつもん</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../css/control-honmono.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
    <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>

<body>
    <main>
        <div class="header">
            <a href="../registration/index.php"><img src="../favicon/p-favicon4.png" alt="?"></a>
            <div class="kotoba">
                <div class="kotoba1">
                    <h3>編集する人を選択してください。</h3>
                </div>
            </div>
        </div>
        <?php
        require_once '../new-db/new-select.php';
        $DbQuery = new DbQuery();
        $rec = $DbQuery->selectFetchAll('SELECT year, code, name FROM member');

        ksort($rec);
        // ↑ https://kinocolog.com/pdo_fetch_pattern/ の下の方参照

        //                登録がない場合はrecがないからIF。
        ?>
        <div class="waku">
            <?php
            if (isset($rec) == true) {
                foreach ($rec as $key => $hito) {
                    print '<fieldset>';
                    print '<legend>';
                    if ($key === 6) {
                        print 'シニア';
                    } else {
                        print $key . '期';
                    }
                    print '</legend>';

                    foreach ($hito as $year_member) {
                        $code = $year_member['code'];
                        $name = $year_member['name'];
                        print '<div class="namae">';
                        print '<form method="post" action="./control-branch.php">';
                        print '<label>';
                        print '<input type="radio" class="name" name="code" value="' . $code . '" required>';
                        print $name;
                        print 'さん';
                        print '</label>';
                        print '</div>';
                        print '<br>';
                    }

                    print '</fieldset>';
                }
            ?></div>
        <div class="menu">
            <input type="submit" name="edit" value="編集する">
            <input type="submit" name="delete" value="削除する">
            </form>
            <a href="../registration/index.php">もどる</a>
        </div>
    <?php
            }
            if (isset($rec) == false) {
                print 'まだ登録がありません。';
            }
    ?>
    </main>
</body>

</html>