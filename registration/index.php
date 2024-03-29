<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/index.css');
?>

<body>

  <main>

    <div class="left-side">

      <div class="left-square">
        <p class="mrg-left">最初はみんな
        <p class="mrg-left">何もわからない。</p>
        <p class="mrg-left">先輩に質問をしよう。</p>
        <p class="mrg-left"><span>正しい質問</span>の仕方を身に着け、</p>
        <p class="mrg-left">質問力を高めよう。</p>
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