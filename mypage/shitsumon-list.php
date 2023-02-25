<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mylist.css');
  require_once '../new-db/execute-query.php';
  $DbQuery = new DbQuery();
?>

  <body>

    <h3><img src="../favicon/p-favicon.png"> 過去のほうれんそう・質問リスト</h3>

    <!-- 他の人のマイページの場合、誰のマイページか調べる -->
    <?php
    if (!empty($_GET['code'])) {
      $opponent = $DbQuery->dbQuery('
          SELECT name FROM members WHERE code = \'' . $_GET['code'] . '\'
        ')[0];

      print '<p class="subtitle">' . $opponent['name'] . ' さんへの質問一覧</p>';
    }
    ?>

    <div class="records">

      <?php
      /*
      *  他の人のマイページ：自分がその人へした質問を表示する。
      *  自分のマイページ：過去の質問全てを表示する。
      */
      $terms = !empty($_GET['code']) ? 'AND target_member_code = \'' . $_GET['code'] . '\'' : '';
      $selectedQuestion = $DbQuery->dbQuery(
        '
          SELECT
            created_at, member_code, target_member_code, title, purpose, detail, cause, other
          FROM
            horenso_infos
          WHERE
            member_code =\'' . $_SESSION['code'] . '\'
          ' . $terms
      );

      // 過去の質問がない場合
      if (empty($selectedQuestion)) {
        print '<div class=subtitle>';
        print 'まだしつもん・ほうれんそうをしていません。';
        print '<p><a href="../mypage/mypage.php?code=' . $_SESSION['code'] . '">もどる</a></p>';
        print '</div>';
      ?>

    </div>

    <!-- 過去の質問がある場合 -->
    <?php
    } else {
      $count = count($selectedQuestion);
      for ($i = $count - 1; 0 <= $i; $i--) { ?>

        <div class="record">

          <p><?php print $i + 1; ?></p>

          <table>

            <tr>
              <th>時間</th>
              <td><?php print mb_substr($selectedQuestion[$i]['created_at'], 0, 16); ?></td>
            </tr>

            <!-- 誰への質問なのか検索 -->
            <?php
            $target_member_codes = $selectedQuestion[$i]['target_member_code'];
            $aite = $DbQuery->dbQuery(
              '
                SELECT name FROM members
                WHERE code = ' . $target_member_codes
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

      <?php
      }

      /*
      * 遷移前のURL：mypage.phpを含む場合はhistory.back
      * 遷移前のURL：mypage.phpを含まない場合はmypage.phpリンク
      */
      if(preg_match("/mypage.php/", $_SERVER['HTTP_REFERER'])) {
        print '<input type="button" onclick="history.back()" value="もどる">';
      } else {
        print '<a href="../mypage/mypage.php"><input value="もどる"></input></a>';
      }
    } ?>

  </body>
  <?php } ?>

  </html>