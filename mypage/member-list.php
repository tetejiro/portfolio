<?php
{
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/member-list.css');
?>

  <body>

    <main>

      <div class="header">

        <a href="./mypage.php"><img src="../favicon/p-favicon4.png" alt="?"></a>

        <div class="title">

          <h3>質問したい人を選択して、</h3>
          <h3>質問する際の注意事項などを確認しましょう。</h3>

        </div>

      </div>

      <?php
      require_once '../new-db/execute-query.php';
      $DbQuery = new DbQuery();
      // 先頭カラムをグループ化したレコード
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
              print '<div><a class="name" href="mypage.php?code=' . $code . '">';
              print $name . 'さん';
              print '</a>';
              print '</div>';
            }

            print '</fieldset>';
          }
        } else {
          print 'まだ登録がありません。';
        }
      } ?>

      </div>

    </main>

  </body>

</html>