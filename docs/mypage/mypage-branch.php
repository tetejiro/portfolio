<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mannaka.css');
  require_once '../new-db/execute-query.php';
  $DbQuery = new DbQuery();

  // サニタイズ
  require_once '../sanitize.php';
  $post = sanitize($_POST);

  try {
    // インサート処理
    $DbQuery->dbQuery('
      INSERT INTO mypage_infos
        (member_code,task,bytime1_1,bytime1_2,bytime2_1,bytime2_2,emotion,time1_1,time1_2,time2_1,time2_2,attention,strong1,strong2,strong3)
      VALUES
      (\''.$_SESSION['code'].'\',\''. $post['task'].'\',\''. $post['bytime1_1'].'\',\''. $post['bytime1_2'].'\',\''. $post['bytime2_1'].'\',\''. $post['bytime2_2'].'\',\''. $post['emotion'].'\',\''. $post['time1_1'].'\',\''. $post['time1_2'].'\',\''. $post['time2_1'].'\',\''. $post['time2_2'].'\',\''. $post['attention'].'\',\''. $post['strong1'].'\',\''. $post['strong2'].'\',\''. $post['strong3'].'\')
    ');
    header('Location:mypage.php');
    exit();
  } catch (Exception $e) {
    var_dump($e);
    print '現在障害発生中です。<br>';
    print '<a href="../registration/login.html">もどる</a>';
  }
}
