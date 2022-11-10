<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print 'ログインできていません。<br><br>';
  print '<a href="../registration/login.html">ログインへ</a>';
} else { ?>
  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>しつもん</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="../css/mylist.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
    <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
  </head>

  <body>
    <h3><img src="../favicon/p-favicon.png"> 過去のほうれんそう・質問リスト</h3><br>
    <div class="zentai">
      <?php
      //メール送信からマイリスト
      if (isset($_GET['aite']) == true) {
        $honnin = $_GET['aite'];
      } else {
        //マイページからマイリスト
        $honnin = $_SESSION['code'];
      }

      require_once '../new-db/new-select.php';
      $SelectDb = new SelectDb();
      $rec = $SelectDb->selectDb7($honnin);

      if (isset($rec) == false) {
        print '<link rel="stylesheet" href="../css/mannaka.css">';
        print '<div class=mi>';
        print '<br>まだしつもん・ほうれんそうをしていません。<br>';
        print '<a href="../mypage/mypage.php?code=' . $honnin . '">もどる</a>';
        print '</div>';
      ?>
    </div>
    <?php
      } else {
        $count = count($rec);

        for ($i = $count-1; 0<=$i; $i--) { ?>
      <div class="zentai2">
        <p><?php print $i + 1; ?></p>
        <div class="zentai3">
          <table>
            <tr>
              <th>時間</th>
              <td><?php print $rec[$i]['nitizi']; ?></td>
            </tr>
            <?php
            $name = $rec[$i]['whom'];
            $SelectDb = new SelectDb();
            $aite = $SelectDb->selectDb8($name); ?>
            <tr>
              <th>質問相手</th>
              <td><?php print $aite; ?>さん</td>
            </tr>
            <tr>
              <th>件名</th>
              <td><?php print $rec[$i]['situation']; ?></td>
            </tr>
            <tr>
              <th>依頼したいこと</th>
              <td><?php print $rec[$i]['goal']; ?></td>
            </tr>
            <tr>
              <th>詳細</th>
              <td><?php print $rec[$i]['what']; ?></td>
            </tr>
            <tr>
              <th>考えられる原因</th>
              <td><?php print $rec[$i]['why']; ?></td>
            </tr>
            <tr>
              <th>試したこと・その他</th>
              <td><?php print $rec[$i]['try0']; ?></td>
            </tr>
          </table><br><br>
        </div>
        <!--zentai3-->
      </div>
      <!--zentai2-->
    <?php
        }
        print '<div class="modoru">';
        print '<a href="../mypage/mypage.php?code=' . $honnin . '">もどる</a>';
        print '</div>';
    ?>
  </body>

  </html>
<?php
      }
    }
