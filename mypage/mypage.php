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
    *   自分のマイページ：自分フラグTRUE：$_GET['code']があり、$_SESSION['code']と同じ値 / $_GET['code']がない
    *   他の人のマイページ：自分フラグFALSE：$_GET['code']がある場合
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
      <div class="hidari">
        <a href="../registration/index.php">
          <img src="../favicon/p-favicon3.png" alt="?">
          <h1>しつもん</h1>
        </a>
      </div>
      <!--hidari-->
      <div class="header-right">
        <div class="button-info-button">ボタン説明</div>
        <!--登録orログインから。-->
        <?php
        if ($zibunflg) {
          print '<div class="migi">';
          print '<span>' . $_SESSION['name'] . 'さん</span> のマイページ<p>今日も頑張ろう。</p>';
          print '</div>';
        ?>
          <script>
            document.querySelector('span').style.borderBottom = "thick solid #B0DEEC";
          </script>
        <?php
        } else {
          print '<div class="migi">';
          print '<span>' . $name[0]['name'] . 'さん</span> のページ<p>注意書きによく目を通してしつもんしましょう。</p>';
          print '</div>';
        ?>
          <script>
            let names = '<?php print $name[0]['name'] ?>';
            let message = names + 'さんのページ。\nよく読んで質問しましょう。';
            window.alert(message);
            document.querySelector('span').style.borderBottom = "thick solid #5fa5ba";
          </script>
        <?php
        }
        ?>
      </div>
    </div>
    <!--.header-->

    <!-- 上ナビ（ボタン） -->
    <nav>
      <?php
      // 自分のページ
      if ($zibunflg) {
        print '<p><label for="kousin">更新</label></p>';
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
    <div style="display: none;" class="button-info">
      <p>ボタン説明内容</p>
      <div class="content">
        <p>更新</p>
        <div>下の記入欄を更新するためのボタンです。</div>
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
      <div class="zenhan">
        <div class="zenhan1">
          <div class="now">
            <p class="title">今は何をしていますか？</p>
            <textarea class="area" name="task" placeholder="※自分が今していることを周りの人にも共有しましょう。" required><?php
              empty($task) == false ? print $task : ''; ?></textarea>
          </div>
          <div class="time">
            <p class="title">どれくらいかかりそうですか？</p>
            <input type="number" name="bytime1_1" max="24" min="0" value="<?php
              empty($bytime1_1) == false ? print $bytime1_1 : print '00'; ?>" oninput="maxLengthLimit(this)" required>:
            <input type="number" name="bytime1_2" max="59" min="0" value="<?php
              empty($bytime1_2) == false ? print $bytime1_2 : print '00'; ?>" oninput="maxLengthLimit(this)">～
            <input type="number" name="bytime2_1" max="24" min="0" value="<?php
              empty($bytime2_1) == false ? print $bytime2_1 : print '00'; ?>" oninput="maxLengthLimit(this)" required>:
            <input type="number" name="bytime2_2" max="59" min="0" value="<?php
              empty($bytime2_2) == false ? print $bytime2_2 : print '00'; ?>" oninput="maxLengthLimit(this)">
          </div>
        </div>
        <!--zenhan1-->
        <div class="emotion">
          <p class="title">今日の気分は？</p>
          <div class="kibun">
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
      <div class="kouhan">
        <div class="kohan1">
          <div class="zikan">
            <p class="title">都合がいい時間</p>
            <input type="number" name="time1_1" v max="24" min="0" value="<?php
              empty($time1_1) == false ? print $time1_1 : print '00'; ?>" oninput="maxLengthLimit(this)" required>:
            <input type="number" name="time1_2" v max="59" min="0" value="<?php
              empty($time1_2) == false ? print $time1_2 : print '00'; ?>" oninput="maxLengthLimit(this)">～
            <input type="number" name="time2_1" v max="24" min="0" value="<?php
              empty($time2_1) == false ? print $time2_1 : print '00'; ?>" oninput="maxLengthLimit(this)" required>:
            <input type="number" name="time2_2" v max="59" min="0" value="<?php
              empty($time2_2) == false ? print $time2_2 : print '00'; ?>" oninput="maxLengthLimit(this)">
          </div>
          <div class="tyui">
            <p class="title">質問時の注意事項</p>
            <textarea class="area" name="attention" placeholder="※質問する前に留意してほしいことを書いてください。" required><?php
              isset($attention) == true ? print $attention : ''; ?></textarea>
          </div>
        </div>
        <div class="makasete">
          <p class="title">ここは私に任せて！</p>
          <div class="makasete1">
            <p>1</p>
            <textarea class="a" type="text" name="strong1" placeholder="※あなたの得意分野を教えてください。&#13;&#10;誰に質問するべきか、分かるようになります。" required><?php
              empty($strong1) == false ? print $strong1 : ''; ?></textarea>
            <p>2</p>
            <textarea class="b" type="text" name="strong2"><?php
              empty($strong2) == false ? print $strong2 : print ''; ?></textarea>
            <p>3</p>
            <textarea class="c" type="text" name="strong3"><?php
              empty($strong3) == false ? print $strong3 : print ''; ?></textarea>
            <input type="hidden" name="code" value="<?php print $code; ?>">
          </div>
        </div>
      </div>
      <div class="navzentai">

        <!--  下ナビ  -->
        <div class="nav2">
          <?php
          if ($zibunflg) {
            print '<p><input id="kousin" type="submit" value="更新"></p>';
            print '<p><a href="../mypage/record.php">記録</a></p>';
          } ?>
          <a href="../mypage/shitsumon-list.php<?php $code != $_SESSION['code'] ? print '?code='.$code : ''; ?>">質問リスト</a>
          <?php
          print '<p><a href="member-list.php">メンバーリスト</a></p>';
          !$zibunflg ? print '<p><a id="shitu" href="select-report-or-question.php?code='.$code.'">しつもんする</a></p>' : '';
          ?>
        </div>
      </div>
    </form>
  </body>
  <script>
    // モーダル開閉処理
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('button-info') || event.target.closest('.button-info')) {
        document.querySelector('.close').addEventListener('click', function() {
          // モーダル内・とじるボタン
          document.querySelector('.button-info').classList.remove('block');
        })
      } else if (event.target.classList.contains('button-info-button')) {
        // 説明ボタン押下
        document.querySelector('.button-info').classList.toggle('block');
      } else {
        // モーダル外
        document.querySelector('.button-info').classList.remove('block');
      }
      // 背景色
      if (document.querySelector('.button-info').classList.contains('block')) {
        document.querySelector('.all').style.background = 'rgba(0,0,0,0.7)';
      } else {
        document.querySelector('.all').style.background = 'white';
      }
    })

    // 更新時記入欄NULLチェック
    document.querySelector('form').addEventListener('submit', function(event) {
      // 値取得
      let text1 = document.getElementsByName('task')[0].value == '' ? '0' : '1';
      let text2 = document.getElementsByName('bytime1_1')[0].value == '' ? '0' : '1';
      let text3 = document.getElementsByName('bytime2_1')[0].value == '' ? '0' : '1';
      let text4;
      document.querySelector('input[name=emotion]:checked') == null ? text4 = '0' : text4 = '1';
      let text5 = document.getElementsByName('time1_1')[0].value == '' ? '0' : '1';
      let text6 = document.getElementsByName('time2_1')[0].value == '' ? '0' : '1';
      let text7 = document.getElementsByName('attention')[0].value == '' ? '0' : '1';
      let text8 = document.getElementsByName('strong1')[0].value == '' ? '0' : '1';
      let total = text1 + text2 + text3 + text4 + text5 + text6 + text7 + text8;

      // 記入欄のvalueを全て足して、0が含まれてる⇒NULLを含む。
      if(total.includes(0)) {
        window.alert('必須項目が未記入です。\n記入してください。');
        event.preventDefault();
      }
    })

    //文字数制限
    function maxLengthLimit($this) {
      $this.value = $this.value.slice(0, 2);
    }
  </script>
  </html>
<?php
}
