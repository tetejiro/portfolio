<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mylist.css');
?>

  <body>

    <form>

      <h3><img src="../favicon/p-favicon.png">過去の仕事の記録</h3><br>

      <?php
      $honnin = $_SESSION['code'];
      require_once '../new-db/execute-query.php';
      $DbQuery = new DbQuery();
      $rec = $DbQuery->dbQuery('SELECT * FROM mypage_infos WHERE member_code = \'' . $honnin . '\'');
      $count = count($rec);

      // 記録をしていない場合
      if (empty($rec)) {
        print '<div class=subtitle>';
        print 'まだ記録していません。';
        print '<p><a href="../mypage/mypage.php?code=' . $_SESSION['code'] . '">もどる</a></p>';
        print '</div>';

      // 記録がある場合
      } else {
        for ($i = $count - 1; 0 <= $i; $i--) { ?>

          <div class="records">

            <div class="record">

              <p><?php print $i + 1; ?></p>

              <table>

                <tr>
                  <th>記録時間</th>
                  <td><?php print mb_substr($rec[$i]['created_at'], 0, 16); ?></td>
                </tr>

                <tr>
                  <th>内容</th>
                  <td><?php print $rec[$i]['task']; ?></td>
                </tr>

                <tr>
                  <th>開始時間</th>
                  <td><?php print $rec[$i]['bytime1_1'] . '時' . $rec[$i]['bytime1_2'] . '分'; ?></td>
                </tr>

                <tr>
                  <th>終了時間</th>
                  <td><?php print $rec[$i]['bytime2_1'] . '時' . $rec[$i]['bytime2_2'] . '分'; ?></td>
                </tr>

                <?php
                $start = new DateTimeImmutable($rec[$i]['bytime1_1'] . ':' . $rec[$i]['bytime1_2']);
                $stop = new DateTimeImmutable($rec[$i]['bytime2_1'] . ':' . $rec[$i]['bytime2_2']);
                $interval = $stop->diff($start);
                ?>

                <tr>
                  <th>所要時間</th>
                  <td><?php print $interval->format("%h時間%i分"); ?></td>
                </tr>

                <tr>
                  <th>当時の気分</th>
                  <td><?php print $rec[$i]['emotion']; ?></td>
                </tr>

              </table>

            </div>

          </div>

        <?php
        }
        print '<input type="button" onclick="history.back()" value="もどる">';
      } ?>

    </form>

  </body>

  </html>
<?php
}
