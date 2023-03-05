<html>

<head>
  <meta charset="utf-8">
  <title>你要做什麼</title>
</head>

<body>


  <?php
  session_start();  // 啟用交談期
  // 檢查Session變數是否存在, 表示是否已成功登入
  if ($_SESSION["login_session"] != true)
    header("Location: login.php");
  if($_SESSION["name"]=="root") header("Location: root.php");
  echo "歡迎使用者進入網站!<br/>";
  echo "你的名字是" . $_SESSION["name"];
  echo "<br><br><br>";

  if (isset($_POST['confirm'])) {
    if (!empty($_POST['choose'])) {
      $selected = $_POST['choose'];
      if ($selected == '1') header("Location: select_dish_negetive_deposit_is_allowed.php");
      elseif ($selected == '3') header("Location: personal_view.php");
    } else echo "please select value";
  }

  if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
  }
  ?>




  <form action="" method="post">
    <select name="choose">
      <option value="" disabled selected>你要做什麼</option>
      <option value="1">訂餐</option>
      <option value="3">查看訂單狀況</option>
    </select>
    <br>
    <input type="submit" value="確認" name="confirm">
    <input type="submit" value="登出" name="logout">
  </form>
</body>

</html>