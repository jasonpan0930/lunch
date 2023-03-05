<html>

<head>
  <meta charset="utf-8">
  <title>測試</title>
</head>

<body>
  <?php

  session_start();  // 啟用交談期
  // 檢查Session變數是否存在, 表示是否已成功登入
  if ($_SESSION["login_session"] != true)
    header("Location: login.php");
  if ($_SESSION["name"] == "root") header("Location: root.php");
  echo "歡迎使用者進入網站!<br/>";
  echo "你的名字是" . $_SESSION["name"];
  $student_name = $_SESSION["name"];
  echo "<br><br><br>";

  $link = mysqli_connect("localhost", "root", "", "lunch")
    or die("無法開啟MySQL資料庫連接!<br/>");

  $sql = "SELECT * FROM varchar_parameters WHERE `name`='today_restaurant'";
  $result = mysqli_query($link, $sql);
  $today_restaurant = mysqli_fetch_row($result)[1];
  if ($today_restaurant == 'NULL') header("Location: index.php");


  $sql = "SELECT * FROM int_parameters WHERE `name`='ordering'";
  $result = mysqli_query($link, $sql);
  $ordering=mysqli_fetch_row($result)[1];
  if($ordering==0) header("Location: index.php");
  else {
    $sql = "SELECT * FROM restaurants WHERE `restaurant`='" . $today_restaurant . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($result);
    echo '今日店家為' . $row[0] . '<br>';
  }
  $sql = "SELECT `dish`, `price` FROM `" . $today_restaurant . "`";
  $result = mysqli_query($link, $sql);

  $str = '<form action="select_dish_negetive_deposit_is_allowed.php" method="post">';
  while ($dish = mysqli_fetch_row($result)) {
    $str .= '<label for="' . $dish[0] . '">' . $dish[0] ."(".$dish[1]."元)". '</label>';
    $str .= '<input type="number" value=0 name="' . $dish[0] . '"/><br>';
  }
  $str .= '<br><input type="submit" value="確認" />';
  $str .= '</form>';
  print_r($str);


  $sql = "SELECT `dish`, `price` FROM `" . $today_restaurant . "`";
  $result = mysqli_query($link, $sql);
  while ($dish = mysqli_fetch_row($result)) {
    if (isset($_POST[$dish[0]])) {
      if ($_POST[$dish[0]] > 0) {
        echo $dish[0] . $_POST[$dish[0]] . "<br>";

        for ($i = 0; $i < $_POST[$dish[0]]; $i++) {

          $sql = "SELECT * FROM student where account = '" . $student_name . "'";
          $result2 = mysqli_query($link, $sql);
          $row = $result2->fetch_assoc();
          $money = $row["money"];
          $money -= $dish[1];
          $sql = "UPDATE student set `money` = '" . $money . "' WHERE `account`= '" . $student_name . "'";
          $sql2 = 'INSERT INTO `order` VALUES("' . $student_name . '","' . $dish[0] . '")';

          if (mysqli_query($link, $sql) && mysqli_query($link, $sql2)) 
            echo "order is updated.<br>.You still have".$money."dollars.<br>";
          else echo "failed";
        }
      }
    }
  }

  print_r($_POST);
  ?>


  <br>
  <a href='index.php?'>回首頁</a>
</body>

</html>