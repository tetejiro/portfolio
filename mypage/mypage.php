<?php {
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mypage.css');
?>

  <body class="all">
    <?php
    $rec = null;
    // member_code
    isset($_GET['code']) == 1 ? $code = $_GET['code'] : $code = $_SESSION['code'];

    /*
    *  自分のマイページ：自分フラグTRUE：$_GET['code']があり、$_SESSION['code']と同じ値 / $_GET['code']がない
    *  他の人のマイページ：自分フラグFALSE：$_GET['code']がある場合
    */

    isset($_GET['code']) == 1 ?
    // メンバーリストからマイページ
    $_GET['code'] == $_SESSION['code'] ? $zibunflg = true : $zibunflg = false :
    // ログイン・登録からマイページ
    $zibunflg = true;

    try {
      require_once '../new-db/execute-query.php';
      $DbQuery = new DbQuery();

      // マイページの記入欄のレコード取得
      $latestNowRec = $DbQuery->dbQuery('
        SELECT * FROM mypage_infos
        WHERE member_code =\'' . $code . '\'
        order by created_at DESC limit 1
      ');
      !empty($latestNowRec) ? $rec = $latestNowRec[0] : '';

      // マイページの所有者名の取得
      $name = $DbQuery->dbQuery('SELECT name FROM members WHERE code = \'' . $code . '\'');

      require_once './hozyo.php';
    } catch (Exception $e) {
      print 'ただいま障害中です。前回のデータを読み取れませんでした。';
      exit('<a href="../registration/index.php">もどる</a>');
    }
    ?>
    <div class="header">

      <div class="header-title">
        <a href="../registration/index.php">
          <img src="../favicon/p-favicon3.png" alt="?">
          <h1>しつもん</h1>
        </a>
      </div>

      <div class="annotation">

        <div class="annotation-button">ボタン説明</div>

        <!-- 自分のマイページ -->
        <?php
        if ($zibunflg) {
          print '<div class="annotation-description">';
          print '<font>' . $_SESSION['name'] . 'さん</font> のマイページ<p>今日も頑張ろう。</p>';
          print '</div>';
        ?>
          <script>
            document.querySelector('font').style.borderBottom = "thick solid #B0DEEC";
          </script>
        <?php

        // 他の人のマイページ
        } else {
          print '<div class="annotation-description">';
          print '<font>' . $name[0]['name'] . 'さん</font> のページ<p class="txt">注意書きによく目を通してしつもんしましょう。</p>';
          print '</div>';
        ?>
          <script>
            let names = '<?php print $name[0]['name'] ?>';
            let message = names + 'さんのページ。\nよく読んで質問しましょう。';
            window.alert(message);
            document.querySelector('font').style.borderBottom = "thick solid #5fa5ba";
            document.querySelector('.txt').style.lineHeight = "155%";
          </script>
        <?php
        }
        ?>
      </div>

    </div>

    <!-- ナビボタン（上部） -->
    <nav>
      <!-- 自分のページ -->
      <?php
      if ($zibunflg) {
        print '<p><label for="update">更新</label></p>';
        print '<a href="../mypage/record.php">記録</a>';
      }
      ?>

      <a href="../mypage/shitsumon-list.php<?php $code != $_SESSION['code'] ? print '?code='.$code : ''; ?>">質問リスト</a>

      <a href="member-list.php">メンバーリスト</a>

      <?php
      // 他の人のページ
      !$zibunflg ? print '<a href="select-report-or-question.php?code=' . $code . '">しつもんする</a>' : '';
      ?>
    </nav>

    <!-- モーダル -->
    <div style="display: none;" class="modal">

      <p class="modal-title">ボタン説明内容</p>
      <div class="modal-content">
        <p>更新</p>
        <div>下の記入欄を更新するためのボタンです。</div>
        <div>※ <span></span> は必須項目</div>
        <p>記録</p>
        <div>記入した内容を記録した一覧を見られます。</div>
        <p>質問リスト</p>
        <div>他の人に質問した内容の一覧を見られます。</div>
        <p>メンバーリスト</p>
        <div>他の人の記録を見に行くことができます。</div>
      </div>
      <p class="close">とじる</p>

    </div>

    <!--  本文  -->
    <form action="mypage-branch.php" method="post">

      <div class="section1">

        <div class="question1-2">

          <div class="question-now">
            <p class="question-title">今は何をしていますか？<span></span></p>
            <textarea name="task" oninput="maxLengthLimit(this, 500)" placeholder="※自分が今していることを周りの人にも共有しましょう。" required><?php
              empty($task) == false ? print $task : ''; ?></textarea>
          </div>

          <div class="question-time">
            <p class="question-title">どれくらいかかりそうですか？</p>
            <input type="number" name="bytime1_1" max="24" min="0" required value="<?php
              empty($bytime1_1) == false ? print $bytime1_1 : print '00'; ?>" oninput="maxLengthLimit(this, 2)"><span></span>:
            <input type="number" name="bytime1_2" max="59" min="0" value="<?php
              empty($bytime1_2) == false ? print $bytime1_2 : print '00'; ?>" oninput="maxLengthLimit(this, 2)">～
            <input type="number" name="bytime2_1" max="24" min="0" value="<?php
              empty($bytime2_1) == false ? print $bytime2_1 : print '00'; ?>" oninput="maxLengthLimit(this, 2)">:
            <input type="number" name="bytime2_2" max="59" min="0" value="<?php
              empty($bytime2_2) == false ? print $bytime2_2 : print '00'; ?>" oninput="maxLengthLimit(this, 2)">
          </div>

        </div>

        <div class="question-emotion">

          <p class="question-title">今日の気分は？<span></span></p>

          <div class="emotion-img-list">
            <label>
              <div><img src="../favicon/kao1.png"></div>
              <input type="radio" name="emotion" value="余裕" <?php $emotion == '余裕' ? print 'checked' : print '';?> required>余裕
            </label>

            <label>
              <div><img src="../favicon/kao2.png"></div>
              <input type="radio" name="emotion" value="普通" <?php $emotion == '普通' ? print 'checked' : print ''; ?>>普通
            </label>

            <label>
              <div><img src="../favicon/kao3.png"></div>
              <input type="radio" name="emotion" value="余裕がない" <?php $emotion == '余裕がない' ? print 'checked' : print ''; ?>>余裕がない
            </label>

            <label>
              <div><img src="../favicon/kao4.png"></div>
              <input type="radio" name="emotion" value="忙しい" <?php $emotion == '忙しい' ? print 'checked' : print ''; ?>>忙しい
            </label>

            <label>
              <div><img src="../favicon/kao5.png"></div>
              <input type="radio" name="emotion" value="手伝ってほしい" <?php $emotion == '手伝ってほしい' ? print 'checked' : print ''; ?>>手伝ってほしい
            </label>
          </div>

        </div>

      </div>

      <div class="section2">

        <div class="question-convenient-time">

          <p class="question-title">都合がいい時間</p>

          <input type="number" name="time1_1" max="24" min="0" value="<?php
            empty($time1_1) == false ? print $time1_1 : print '00'; ?>"oninput="maxLengthLimit(this, 2)" required><span></span>:

          <input type="number" name="time1_2" max="59" min="0" value="<?php
            empty($time1_2) == false ? print $time1_2 : print '00'; ?>" oninput="maxLengthLimit(this, 2)">～

          <input type="number" name="time2_1" max="24" min="0" value="<?php
            empty($time2_1) == false ? print $time2_1 : print '00'; ?>" oninput="maxLengthLimit(this, 2)" required><span></span>:

          <input type="number" name="time2_2" max="59" min="0" value="<?php
            empty($time2_2) == false ? print $time2_2 : print '00'; ?>" oninput="maxLengthLimit(this, 2)">

        </div>

        <div class="question-attention">

          <p class="question-title">質問時の注意事項<span></span></p>

          <textarea name="attention"
            placeholder="※質問する前に留意してほしいことを書いてください。"
            required oninput="maxLengthLimit(this, 500)"><?php
            isset($attention) == true ? print $attention : ''; ?></textarea>

        </div>

      </div>

      <div class="section3">

        <p class="question-title">ここは私に任せて！</p>

        <div class="question-strong-point">

          <p>1<span></span></p>
          <textarea type="text" name="strong1"
            placeholder="※あなたの得意分野を教えてください。&#13;&#10;誰に質問するべきか、分かるようになります。"
            required oninput="maxLengthLimit(this, 50)"><?php
            empty($strong1) == false ? print $strong1 : ''; ?></textarea>

          <p>2</p>
          <textarea type="text" name="strong2" oninput="maxLengthLimit(this, 50)"><?php
            empty($strong2) == false ? print $strong2 : print ''; ?></textarea>

          <p>3</p>
          <textarea type="text" name="strong3" oninput="maxLengthLimit(this, 50)"><?php
            empty($strong3) == false ? print $strong3 : print ''; ?></textarea>
          <input type="hidden" name="code" value="<?php print $code; ?>">

        </div>

      </div>

      <!--  下ナビ  -->
      <div class="bottom-nav"><?php

        if ($zibunflg) {
          print '<p><input type="submit" value="更新" id="update"></p>';
          print '<p><a href="../mypage/record.php">記録</a></p>';
        } ?>

        <p><a href="../mypage/shitsumon-list.php<?php $code != $_SESSION['code'] ? print '?code='.$code : ''; ?>">質問リスト</a></p>

        <?php print '<p><a href="member-list.php">メンバーリスト</a></p>';

        !$zibunflg ? print '<p><a href="select-report-or-question.php?code='.$code.'">しつもんする</a></p>' : '';

      ?></div>

    </form>

  </body>

  <script>
    // モーダル開閉処理
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('modal') || event.target.closest('.modal')) {
        document.querySelector('.close').addEventListener('click', function() {
          // モーダル内・とじるボタン
          document.querySelector('.modal').classList.remove('block');
        })
      } else if (event.target.classList.contains('annotation-button')) {
        // 説明ボタン押下
        document.querySelector('.modal').classList.toggle('block');
      } else {
        // モーダル外
        document.querySelector('.modal').classList.remove('block');
      }
      // 背景色
      if (document.querySelector('.modal').classList.contains('block')) {
        document.querySelector('.all').style.background = 'rgba(0,0,0,0.7)';
      } else {
        document.querySelector('.all').style.background = 'white';
      }
    })

    // 更新時記入欄チェック
    document.querySelector('form').addEventListener('submit', function(event) {

      /*
      * nullチェック:各項目の値がNULLであれば、0を代入→足して1があるかチェック
      */

      let text1 = document.getElementsByName('task')[0].value == '' ? '0' : '1';
      let text2 = document.getElementsByName('bytime1_1')[0].value == 00 ? '0' : '1';
      let text3;
      document.querySelector('input[name=emotion]:checked') == null ? text3 = '0' : text3 = '1';
      let text4 = document.getElementsByName('time1_1')[0].value == 00 ? 0 : '1';
      let text5 = document.getElementsByName('time2_1')[0].value == 00 ? 0 : '1';
      let text6 = document.getElementsByName('attention')[0].value == '' ? '' : '1';
      let text7 = document.getElementsByName('strong1')[0].value == '' ? '' : '1';
      let total = text1 + text2 + text3 + text4 + text5 + text6 + text7;

      // 0が含まれてるときに、window.alertを出す
      if(total.includes(0)) {
        window.alert('必須項目が未記入です。\n記入してください。');
        event.preventDefault();
      }

      /*
      * 時間の逆転チェック
      */

      // タスク実施時間
      let bytime1_1 = document.getElementsByName('bytime1_1')[0].value;
      let bytime1_2 = document.getElementsByName('bytime1_2')[0].value;
      let bytime2_1 = document.getElementsByName('bytime2_1')[0].value;
      let bytime2_2 = document.getElementsByName('bytime2_2')[0].value;

      if(bytime1_1 == bytime2_1 && bytime1_2 >= bytime2_2) {
        window.alert('タスク実施予定時間の記載が正しくありません。');
        event.preventDefault();
      }

      // 都合がいい時間
      let time1_1 = document.getElementsByName('time1_1')[0].value;
      let time1_2 = document.getElementsByName('time1_2')[0].value;
      let time2_1 = document.getElementsByName('time2_1')[0].value;
      let time2_2 = document.getElementsByName('time2_2')[0].value;

      if(time1_1 == time2_1 && time1_2 >= time2_2) {
        window.alert('都合がいい時間の記載が正しくありません。');
        event.preventDefault();
      }
    })

    //文字数制限
    function maxLengthLimit($this, $num) {
      $this.value = $this.value.slice(0, $num);
    }

    // モーダル内にカーソルがある時、スクロールバーを表示。
    document.querySelector('.modal').addEventListener('mouseover', function() {
      this.style.overflow = 'auto'
    });

    // モーダル内にカーソルがない時、スクロールバーを非表示。
    document.querySelector('.modal').addEventListener('mouseout', function() {
      this.style.overflow = 'hidden'
    });
  </script>

  </html>
<?php
}