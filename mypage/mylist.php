<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mylist.css');
  require_once '../new-db/new-select.php';
  $DbQuery = new DbQuery();
?>

  <body>
    <form>
      <h3><img src="../favicon/p-favicon.png"> 過去のほうれんそう・質問リスト</h3>
      <?php
        if(!empty($_GET['code'])) {
          $opponent = $DbQuery->dbQuery('
            SELECT name FROM member
            WHERE code = \'' . $_GET['code'] . '\'
          ')[0];

          print '<p class="center">'.$opponent['name'].' さんへの質問一覧</p>';
        }
      ?>
      <div class="zentai">
        <?php
          $selectField = 'nitizi, whose, whom, situation, goal, what, why, try0';
          $condition = 'WHERE whose =\'' . $_SESSION['code'] . '\'';
          // 他の人のマイリストの場合、自分から他の人への質問のみを表示する。
          $other = !empty($_GET['code']) ? 'AND whom = \''.$_GET['code'].'\'' : '';
          $selectedQuestion = $DbQuery->dbQuery('
            SELECT nitizi, whose, whom, situation, goal, what, why, try0
            FROM question
            WHERE whose =\'' . $_SESSION['code'] . '\'
          ');

          if (empty($selectedQuestion)) {
            print '<div class=center>';
            print 'まだしつもん・ほうれんそうをしていません。';
            print '<p><a href="../mypage/mypage.php?code=' . $_SESSION['code'] . '">もどる</a></p>';
            print '</div>';
        ?>
      </div>
        <?php
          } else {
            $count = count($selectedQuestion);

            for ($i = $count - 1; 0 <= $i; $i--) { ?>
          <div class="zentai2">
            <p><?php print $i + 1; ?></p>
            <div class="zentai3">
              <table>
                <tr>
                  <th>時間</th>
                  <td><?php print $selectedQuestion[$i]['nitizi']; ?></td>
                </tr>
                <?php
                $aite = $DbQuery->dbQuery('
                  SELECT name FROM member
                  WHERE code = \'' . $selectedQuestion[$i]['whom'] . '\'
                ');
                // 退会済みユーザ
                empty($aite) == true ? $aite = '退会済みユーザ' : ''; ?>
                <tr>
                  <th>質問相手</th>
                  <td><?php print $aite[0]['name']; ?>さん</td>
                </tr>
                <tr>
                  <th>件名</th>
                  <td><?php print $selectedQuestion[$i]['situation']; ?></td>
                </tr>
                <tr>
                  <th>依頼したいこと</th>
                  <td><?php print $selectedQuestion[$i]['goal']; ?></td>
                </tr>
                <tr>
                  <th>詳細</th>
                  <td><?php print $selectedQuestion[$i]['what']; ?></td>
                </tr>
                <tr>
                  <th>考えられる原因</th>
                  <td><?php print $selectedQuestion[$i]['why']; ?></td>
                </tr>
                <tr>
                  <th>試したこと・その他</th>
                  <td><?php print $selectedQuestion[$i]['try0']; ?></td>
                </tr>
              </table><br><br>
            </div>
            <!--zentai3-->
          </div>
          <!--zentai2-->
        <?php
            }
            print '<input type="button" onclick="history.back()" value="もどる">';
        ?>
      </form>
    </body>

    </html>
  <?php
          }
        }
