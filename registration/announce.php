<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>しつもん</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
  <link rel="stylesheet" href="../css/announce.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP">
  <link rel="icon" type="image/png" href="../favicon/p-favicon.png">
</head>

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