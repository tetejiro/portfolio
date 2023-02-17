<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>しつもん</title>
  <meta name="description" content="しつもんするための便利なツール。しつもん上手になって安心して業務に取り組もう。">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>

<body>
  <main>
    <div class="left-side">
      <div class="left-square">
        <p>最初はみんな
        <p>何もわからない。</p>
        <p>先輩に質問をしよう。</p>
        <p><span>正しい質問</span>の仕方を身に着け、</p>
        <p>質問力を高めよう。</p>
      </div>
    </div>
    <div class="right-side" id="right-side">
      <nav>
        <ul>
          <li><a href="login.html">ログイン</a></li>
          <li><a href="registration.html">登録</a></li>
          <li><a href="../reg-Info-Management/user-list.php">登録情報管理</a></li>
        </ul>
      </nav>
      <h1>しつもんしよう</h1>
      <?php
      try {
        require_once '../new-db/execute-query.php';
        $DbQuery = new DbQuery();
        $rec = $DbQuery->dbQuery('
          SELECT date, content
          FROM notices ORDER BY date DESC LIMIT 3
        ');
      } catch (Exception $e) {
        print '周知事項が読み取れません。';
        var_dump($e);
      }
      ?>
      <div class="bottom">
        <p>周知事項</p>
        <div class="announce">
          <div class="content">
            <?php foreach ($rec as $key => $value) : ?>
              <ul>
                <li><?php print $value['date'] ?></li>
                <li><?php print $value['content'] ?></li>
              </ul>
            <?php endforeach; ?>
          </div>
          <a href="announce.php"><img src="../favicon/haguruma.png" alt="追加"></a>
        </div>
      </div>
    </div>
  </main>
</body>

</html>