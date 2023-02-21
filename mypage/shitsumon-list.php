<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mylist.css');
  require_once '../new-db/execute-query.php';
  $DbQuery = new DbQuery();
?>

  <body>
    <form>
      <h3><img src="../favicon/p-favicon.png"> 過去のほうれんそう・質問リスト</h3>
      <?php
        if(!empty($_GET['code'])) {
          $opponent = $DbQuery->dbQuery('
            SELECT name FROM members WHERE code = \'' . $_GET['code'] . '\'
          ')[0];

          print '<p class="center">'.$opponent['name'].' さんへの質問一覧</p>';
        }
      ?>
      <div class="zentai">
        <?php

          // 他の人のマイリストの場合、自分から他の人への質問のみを表示する。
          $terms = !empty($_GET['code']) ? 'AND target_member_code = \''.$_GET['code'].'\'' : '';
          $selectedQuestion = $DbQuery->dbQuery('
            SELECT
              created_at, member_code, target_member_code, title, purpose, detail, cause, other
            FROM
              horenso_infos
            WHERE
              member_code =\'' . $_SESSION['code'] . '\'
            '.$terms
          );

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
                  <td><?php print mb_substr($selectedQuestion[$i]['created_at'], 0, 16); ?></td>
                </tr>
                <?php
                $target_member_codes = $selectedQuestion[$i]['target_member_code'];
                $aite = $DbQuery->dbQuery('
                  SELECT name FROM members
                  WHERE code = '.$target_member_codes
                );
                // 退会済みユーザ
                empty($aite) ? $aite[0]['name'] = '退会済みユーザ' : ''; ?>
                <tr>
                  <th>質問相手</th>
                  <td><?php print $aite[0]['name']; ?> さん</td>
                </tr>
                <tr>
                  <th>件名</th>
                  <td><?php print $selectedQuestion[$i]['title']; ?></td>
                </tr>
                <tr>
                  <th>依頼したいこと</th>
                  <td><?php print $selectedQuestion[$i]['purpose']; ?></td>
                </tr>
                <tr>
                  <th>詳細</th>
                  <td><?php print $selectedQuestion[$i]['detail']; ?></td>
                </tr>
                <tr>
                  <th>考えられる原因</th>
                  <td><?php print $selectedQuestion[$i]['cause']; ?></td>
                </tr>
                <tr>
                  <th>試したこと・その他</th>
                  <td><?php print $selectedQuestion[$i]['other']; ?></td>
                </tr>
              </table>
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
