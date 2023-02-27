<?php
      // headの記載
      require_once('../common.php');
      $cmn = new Common();
      $cmn->printNotIncludedHead('../css/mannaka.css');
?>

<body>
      <div class="container">
            <?php

            try {
                  require_once '../sanitize.php';
                  $post=sanitize($_POST);
                  $code=$post['code'];
                  $name=$post['name'];
                  $mail=$post['mail'];
                  $pass=$post['pass'];
                  $year=$post['year'];

                  require_once '../new-db/execute-query.php';
                  $DbQuery = new DbQuery();
                  $DbQuery->dbQuery('
                        UPDATE members
                        SET name =\''.$name.'\', year =\''.$year.'\', pass=\''.$pass.'\', mail=\''.$mail.'\'
                        WHERE code = \''.$code.'\'
                  ');
            }
            catch (Exception $e) {
                  print_r($e);
                  exit('ただいま障害により大変ご迷惑をおかけしております。');
            }

            ?>

            <div>修正しました。</div>

            <a href="./user-list.php">戻る</a>
      </div>
</body>
</html>