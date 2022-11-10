<?php
//require_once('libs/consts/AppConstants.php');
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print 'ログインしていません。';
  print '<a href="../registration/login.html">ログインへ</a>';
  exit();
} else {
  ?>
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
  <h3><img src="../favicon/p-favicon.png">過去の仕事の記録</h3><br>
  <?php
      //マイページからマイリスト
      $honnin = $_SESSION['code'];
      require_once '../new-db/new-select.php';
      $SelectDb = new SelectDb();
      $rec = $SelectDb->selectDb4($honnin);
      $count = count($rec);
      for ($i = $count-1; 0<=$i; $i--) {
        ?>
  <div class="zentai">
    <div class="zentai2">
      <p><?php print $i+1; ?></p>
      <div class="zentai3">
          <table>
            <tr>
              <th>記録時間</th>
              <td><?php print $rec[$i]['nitizi']; ?></td>
            </tr>
            <tr>
              <th>内容</th>
              <td><?php print $rec[$i]['task']; ?></td>
            </tr>
            <tr>
              <th>開始時間</th>
              <td><?php print $rec[$i]['bytime1_1'].'時'.$rec[$i]['bytime1_2'].'分'; ?></td>
            </tr>
            <tr>
              <th>終了時間</th>
              <td><?php print $rec[$i]['bytime2_1'].'時'.$rec[$i]['bytime2_2'].'分'; ?></td>
            </tr>
            <?php
              $start = new DateTimeImmutable($rec[$i]['bytime1_1'].':'.$rec[$i]['bytime1_2']);
              $stop = new DateTimeImmutable($rec[$i]['bytime2_1'].':'.$rec[$i]['bytime2_2']);
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
          </table><br><br>
        </form>
      </div><!--zentai3-->
    </div><!--zentai2-->
    <?php
      }
      print '<div class="modoru">';
      print '<a href="../mypage/mypage.php?code=' . $honnin . '">もどる</a>';
      print '</div>';
    ?>
  </div><!--zentai-->
  </body>

  </html>
  <?php
}