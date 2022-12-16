<?php
//require_once('libs/consts/AppConstants.php');
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  print 'ログインしていません。';
  print '<a href="../registration/login.html">ログインへ</a>';
  exit();
} else {
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
    if (isset($_GET['code']) == true) {
      $code = $_GET['code'];
    } else {
      $code = 0;
    }
    try {
      require_once '../new-db/new-select.php';
      $SelectDb = new SelectDb();

      //ログインか登録から。
      if (empty($_GET['code']) == true) {
        $rec = $SelectDb->selectDb4($honnin);
        $count = count($rec);
        if ($count > 0) {
          $rec = $rec[$count - 1];
        }
        require_once './hozyo.php';
      } else {
        if ($code == $honnin) {
          //リストから自分のマイページ
          $rec = $SelectDb->selectDb4($honnin);
          $count = count($rec);
          if ($count > 0) {
            $rec = $rec[$count - 1];
          }
          require_once './hozyo.php';
        } else {
          //リストから他の人のマイページ
          $rec = $SelectDb->selectDb5($code);
          $count = count($rec);
          if ($count > 0) {
            $rec = $rec[$count - 1];
          }
          require_once './hozyo.php';
        }
      }
    } catch (Exception $e) {
      print 'ただいま障害中です。<br>前回のデータを読み取れませんでした。<br>';
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
        <?php if (empty($code) == true) {
          print '<div class="migi">';
          print '<span>' . $_SESSION['name'] . 'さん</span> のマイページ<br>今日も頑張ろう。';
          print '</div>';
        ?>
          <script>
            'use strict';
            document.querySelector('span').style.borderBottom = "thick solid #B0DEEC";
          </script>
          <?php
        }
        //member-listから。
        else {
          try {
            //member-listから自分のマイページへ。
            if ($code == $honnin) {
              print '<div class="migi">';
              print '<span>' . $_SESSION['name'] . 'さん</span> のマイページ<br>今日も頑張ろう。';
              print '</div>';
              //$rec = $SelectDb->selectDb13($honnin);
          ?>
              <script>
                'use strict';
                document.querySelector('span').style.borderBottom = "thick solid #B0DEEC";
              </script>
            <?php
            }
            //member-listから他の人のマイページへ。
            else {
              $rec = $SelectDb->selectDb52($code);
              print '<div class="migi">';
              print '<span>' . $rec['name'] . 'さん</span> のページ<br>注意書きによく目を通してしつもんしましょう。';
              print '</div>';
            ?>
              <script>
                'use strict';
                let names = '<?php print $rec['name']; ?>';
                let message = names + 'さんのページ。\nよく読んで質問しましょう。';
                window.alert(message);
                document.querySelector('span').style.borderBottom = "thick solid #5fa5ba";
              </script>
        <?php
            }
          } catch (Exception $e) {
            print '<div class="migi">';
            print '誰のマイページかわかりません。ログインしなおしてください。';
            print '</div>';
            var_dump($e);
          }
        }
        ?>
      </div>
    </div>
    <!--.header-->
    <nav>
      <?php
      if (empty($code) == true) {
        print '<p><label for="kousin">更新</label></p>';
        print '<a href="../mypage/record.php">記録</a>';
      }
      if (empty($code) == false) {
        if ($code == $honnin) {
          print '<p><label for="kousin">更新</label></p>';
          print '<a href="../mypage/record.php">記録</a>';
        }
      }
      ?>
      <a href="../mypage/mylist.php">質問リスト</a>
      <a href="member-list.php">メンバーリスト</a>

      <?php if (empty($code) == false) {
        if ($code !== $honnin) {
          print '<a href="select.php?code=' . $code . '">しつもんする</a><br><br>';
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
            今は何をしていますか？ <br><br>
            <textarea class="area" name="task" placeholder="※自分が今していることを周りの人にも共有しましょう。" required>
              <?php
                if (empty($task) == false) {
                  print $task;
                }
              ?>
            </textarea><br><br><br>
          </div>
          <!--now-->
          <div class="time">
            どれくらいかかりそうですか？ <br><br>
            <input type="number" name="bytime1_1" max="24" min="0" value="
              <?php if (empty($bytime1_1) == false) {
                  print $bytime1_1;
                } else {
                  print '00';
                }
              ?>" maxlength="2" required>:
            <input type="number" name="bytime1_2" max="59" min="0" value="<?php if (empty($bytime1_2) == false) {
                                                                            print $bytime1_2;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>
            ～
            <input type="number" name="bytime2_1" max="24" min="0" value="<?php if (empty($bytime2_1) == false) {
                                                                            print $bytime2_1;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>:
            <input type="number" name="bytime2_2" max="59" min="0" value="<?php if (empty($bytime2_2) == false) {
                                                                            print $bytime2_2;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>
            <br><br><br>
          </div>
          <!--time-->
        </div>
        <!--zenhan1-->
        <div class="emotion">
          <p>今日の気分は？</p><br>
          <div class="kibun">
            <label><img src="../favicon/kao1.png"><br>
              <input type="radio" name="emotion" value="余裕" required <?php
                                                                      if (isset($emotion) == true) {
                                                                        if ($emotion == '余裕') {
                                                                          print 'checked';
                                                                        }
                                                                      }
                                                                      ?>>余裕
            </label>

            <label><img src="../favicon/kao2.png"><br>
              <input type="radio" name="emotion" value="普通" <?php
                                                            if (isset($emotion) == true) {
                                                              if ($emotion == '普通') {
                                                                print 'checked';
                                                              }
                                                            }
                                                            ?>>普通
            </label>

            <label><img src="../favicon/kao3.png"><br>
              <input type="radio" name="emotion" value="余裕がない" <?php
                                                                if (isset($emotion) == true) {
                                                                  if ($emotion == '余裕がない') {
                                                                    print 'checked';
                                                                  }
                                                                }
                                                                ?>>余裕がない
            </label>

            <label><img src="../favicon/kao4.png"><br>
              <input type="radio" name="emotion" value="忙しい" <?php
                                                              if (isset($emotion) == true) {
                                                                if ($emotion == '忙しい') {
                                                                  print 'checked';
                                                                }
                                                              }
                                                              ?>>忙しい
            </label>

            <label><img src="../favicon/kao5.png"><br>
              <input type="radio" name="emotion" value="手伝ってほしい" <?php
                                                                  if (isset($emotion) == true) {
                                                                    if ($emotion == '手伝ってほしい') {
                                                                      print 'checked';
                                                                    }
                                                                  }
                                                                  ?>>手伝ってほしい
            </label>
          </div>
          <!--kibun-->
        </div>
        <!--emotion-->
      </div>
      <!--zenhan-->
      <div class="kouhan">
        <div class="kohan1">
          <div class="zikan">
            都合がいい時間 <br><br>
            <input type="number" name="time1_1" v max="24" min="0" value="<?php if (empty($time1_1) == false) {
                                                                            print $time1_1;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>:
            <input type="number" name="time1_2" v max="59" min="0" value="<?php if (empty($time1_2) == false) {
                                                                            print $time1_2;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>
            ～
            <input type="number" name="time2_1" v max="24" min="0" value="<?php if (empty($time2_1) == false) {
                                                                            print $time2_1;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>:
            <input type="number" name="time2_2" v max="59" min="0" value="<?php if (empty($time2_2) == false) {
                                                                            print $time2_2;
                                                                          } else {
                                                                            print '00';
                                                                          } ?>" maxlength="2" required>
            <br><br><br>
          </div>
          <!--zikan-->
          <div class="tyui">
            質問時の注意事項 <br><br>
            <textarea class="area" name="attention" placeholder="※質問する前に見ておいてほしいことを書いてください。" required><?php
                                                                                                      if (isset($attention) == true) {
                                                                                                        print $attention;
                                                                                                      } ?></textarea><br><br>
          </div>
          <!--tyui-->
        </div>
        <!--kohan1-->
        <div class="makasete">
          ここは私に任せて！ <br><br><br>
          <div class="makasete1">
            1<br>
            <textarea class="a" type="text" name="strong1" placeholder="※あなたの得意分野を教えてください。&#13;&#10;誰に質問するべきか、お互いに把握できるようになります。" required><?php if (empty($strong1) == false) {
                                                                                                                                    print $strong1;
                                                                                                                                  } ?></textarea>
            2<br>
            <textarea class="b" type="text" name="strong2"><?php if (empty($strong2) == false) {
                                                              print $strong2;
                                                            } ?></textarea>
            3<br>
            <textarea class="c" type="text" name="strong3"><?php if (empty($strong3) == false) {
                                                              print $strong3;
                                                            } ?></textarea>
            <input type="hidden" name="code" value="<?php print $code; ?>">
          </div>
          <!--makasete1-->
        </div>
        <!--makasete-->
      </div>
      <!--zenhan-->
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
        <!--nav2-->

      </div>
      <!--navzentai-->
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
