<?php
{
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printHead('../css/mypage.css');
?>

  <body class="all">
    <?php
    $rec = null;
    //自分のコード
    $honnin = $_SESSION['code'];
    //相手のコード
    isset($_GET['code']) == true ? $code = $_GET['code'] : $code = 0;
    // 自分フラグTRUE：自分のマイページ、自分フラグFALSE：他の人のマイページ
    empty($_GET['code']) == false ?
      // メンバーリストからマイページ
      $_GET['code'] == $honnin ? $zibunflg = true : $zibunflg = false :
      // ログイン・登録からマイページ
      $zibunflg = true;

    try {
      require_once '../new-db/new-select.php';
      $DbQuery = new DbQuery();
      $zibunflg ? $condition = 'where whose =\''.$code.'\'' : $condition = 'where whose =\''.$honnin.'\'';
      $rec = $DbQuery->dbQuery('select', 'now', '*', $condition, '');
      if(count($rec) > 0) {
        $rec = $rec[count($rec) - 1];
      }
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
            'use strict';
            document.querySelector('span').style.borderBottom = "thick solid #B0DEEC";
          </script>
          <?php
        } else {
          $condition = 'WHERE code = \''.$code.'\'';
          $rec = $DbQuery->dbQuery('select', 'member', 'name', $condition, '');
          print '<div class="migi">';
          print '<span>' . $rec[0]['name'] . 'さん</span> のページ<p>注意書きによく目を通してしつもんしましょう。</p>';
          print '</div>';
          ?>
          <script>
            'use strict';
            let names = '<?php print $rec[0]['name']?>';
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
    <nav>
      <?php
      // マイページ
      if (empty($code) == true) {
        print '<p><label for="kousin">更新</label></p>';
        print '<a href="../mypage/record.php">記録</a>';
      }
      // マイページ
      if (empty($code) == false) {
        if ($code == $honnin) {
          print '<p><label for="kousin">更新</label></p>';
          print '<a href="../mypage/record.php">記録</a>';
        }
      }
      ?>
      <a href="../mypage/mylist.php">質問リスト</a>
      <a href="member-list.php">メンバーリスト</a>

      <!-- 他の人のページ -->
      <?php if (empty($code) == false) {
        if ($code !== $honnin) {
          print '<a href="select.php?code=' . $code . '">しつもんする</a>';
        }
      }
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
            <textarea class="area" name="task" required><?php
              empty($task) == false ? print $task : print '※自分が今していることを周りの人にも共有しましょう。';?></textarea>
          </div>
          <div class="time">
            <p class="title">どれくらいかかりそうですか？</p>
            <input type="number" name="bytime1_1" max="24" min="0"
              value="<?php empty($bytime1_1) == false ? print $bytime1_1 : print '00';?>" maxlength="2" required>:
            <input type="number" name="bytime1_2" max="59" min="0"
              value="<?php empty($bytime1_2) == false ? print $bytime1_2 : print '00';?>" maxlength="2" required>～
            <input type="number" name="bytime2_1" max="24" min="0"
              value="<?php empty($bytime2_1) == false ? print $bytime2_1 : print '00';?>" maxlength="2" required>:
            <input type="number" name="bytime2_2" max="59" min="0"
              value="<?php empty($bytime2_2) == false ? print $bytime2_2 : print '00';?>" maxlength="2" required>
          </div>
        </div>
        <!--zenhan1-->
        <div class="emotion">
          <p class="title">今日の気分は？</p>
          <div class="kibun">
            <label>
              <div><img src="../favicon/kao1.png"></div>
              <input type="radio" name="emotion" value="余裕" required
                <?php $emotion == '余裕' ? print 'checked' : print '';?>>余裕
            </label>

            <label>
              <div><img src="../favicon/kao2.png"></div>
              <input type="radio" name="emotion" value="普通"
                <?php $emotion == '普通' ? print 'checked' : print ''; ?>>普通
            </label>

            <label>
              <div><img src="../favicon/kao3.png"></div>
              <input type="radio" name="emotion" value="余裕がない"
                <?php $emotion == '余裕がない' ? print 'checked' : print ''; ?>>余裕がない
            </label>

            <label>
              <div><img src="../favicon/kao4.png"></div>
              <input type="radio" name="emotion" value="忙しい"
                <?php $emotion == '忙しい' ? print 'checked' : print ''; ?>>忙しい
            </label>

            <label>
              <div><img src="../favicon/kao5.png"></div>
              <input type="radio" name="emotion" value="手伝ってほしい"
                <?php $emotion == '手伝ってほしい' ? print 'checked' : print ''; ?>>手伝ってほしい
            </label>
          </div>
        </div>
      </div>
      <div class="kouhan">
        <div class="kohan1">
          <div class="zikan">
            <p class="title">都合がいい時間</p>
            <input type="number" name="time1_1" v max="24" min="0"
              value="<?php empty($time1_1) == false ? print $time1_1 : print '00';?>" maxlength="2" required>:
            <input type="number" name="time1_2" v max="59" min="0"
              value="<?php empty($time1_2) == false ? print $time1_2 : print '00';?>" maxlength="2" required>～
            <input type="number" name="time2_1" v max="24" min="0"
              value="<?php empty($time2_1) == false ? print $time2_1 : print '00';?>" maxlength="2" required>:
            <input type="number" name="time2_2" v max="59" min="0"
              value="<?php empty($time2_2) == false ? print $time2_2 : print '00';?>" maxlength="2" required>
          </div>
          <div class="tyui">
            <p class="title">質問時の注意事項</p>
            <textarea class="area" name="attention" required><?php
              isset($attention) == true ? print $attention : print '※質問する前に留意してほしいことを書いてください。';?></textarea>
          </div>
        </div>
        <div class="makasete">
          <p class="title">ここは私に任せて！</p>
          <div class="makasete1">
            <p>1</p>
            <textarea class="a" type="text" name="strong1" required><?php
              empty($strong1) == false ? print $strong1 : print '※あなたの得意分野を教えてください。&#13;&#10;誰に質問するべきか、分かるようになります。';?></textarea>
            <p>2</p>
            <textarea class="b" type="text" name="strong2"><?php
              empty($strong2) == false ? print $strong2 : print '';?></textarea>
            <p>3</p>
            <textarea class="c" type="text" name="strong3"><?php
              empty($strong3) == false ? print $strong3 : print '';?></textarea>
            <input type="hidden" name="code" value="<?php print $code; ?>">
          </div>
        </div>
      </div>
      <div class="navzentai">

        <!--  下ナビ  -->
        <div class="nav2">
          <?php
          if (empty($code) == true) {
            print '<p><input id="kousin" type="submit" onclick="" value="更新"></p>';
            print '</form>';
            print '<p><a href="../mypage/record.php">記録</a></p>';
            if (empty($task || $bytime1_1 || $bytime1_2 || $bytime2_1 || $bytime2_2 || $emotion || $time1_1 || $time1_2 || $time2_1 || $time2_2 || $attention || $strong1) == true) {
          ?><script>
                document.getElementById('kousin').onclick = function() {
                  window.alert('未記入のため更新できませんでした。');
                };
              </script><?php
                      } else { ?><script>
                document.getElementById('kousin').onclick = function() {
                  window.alert('更新しました。');
                };
              </script>
              <?php }
                    } else {
                      if ($code == $honnin) {
                        print '<p><input id="kousin" type="submit" value="更新"></p>';
                        print '</form>';
                        print '<p><a href="../mypage/record.php">記録</a></p>';
                        if (empty($task || $bytime1_1 || $bytime1_2 || $bytime2_1 || $bytime2_2 || $emotion || $time1_1 || $time1_2 || $time2_1 || $time2_2 || $attention || $strong1) == true) {
              ?><script>
                  document.getElementById('kousin').onclick = function() {
                    window.alert('未記入のため更新できませんでした。');
                  };
                </script><?php
                        } else { ?><script>
                  document.getElementById('kousin').onclick = function() {
                    window.alert('更新しました。');
                  };
                </script>
              <?php }
                      }
                    }
                    print '<p><a href="../mypage/mylist.php">質問リスト</a></p>';
                    print '<p><a href="member-list.php">メンバーリスト</a></p>';
                    if (empty($code) == false) {
                      if ($code !== $honnin) {
              ?> <p><a id="shitu" href="select.php?code=<?php print $code; ?>">しつもんする</a></p>
          <?php }
                    }
          ?>
        </div>
      </div>
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
  </script>

  </html>
<?php
}
