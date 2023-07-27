<?php
  // headの記載
  require_once('../common.php');
  $cmn = new Common();
  $cmn->printNotIncludedHead('../css/announce.css');
?>

<body>

  <div class="box">

    <div class="title">

      <p id="date"></p>

      <script>
        'use strict';

        function countTime() {
          let now = new Date();
          let year = now.getFullYear();
          let month = now.getMonth();
          let date = now.getDate();
          let hour = now.getHours();
          let min = now.getMinutes();
          let min2 = String(min).padStart(2, '0');

          let output = `${year} ${month + 1}/${date} ${hour}:${min2}`;
          document.getElementById('date').textContent = output;
        }
        setInterval("countTime()", 1000);
      </script>

      <p>　周知内容</p>

    </div>

    <form action="insert-announce.php" method="post">

      <textarea name="content" rows="8" cols="50" placeholder="周知事項を記載してください。" required></textarea>

      <div class="button">
        <input type="submit" value="登  録">
        <a href="index.php">もどる</a>
      </div>

    </form>

  </div>
</body>

</html>