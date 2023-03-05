<html>

<head>
  <meta charset="utf-8">
  <title>檢視我的訂單</title>
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
  echo "<br><br><br>";


    // 建立MySQL的資料庫連接 
    $link = mysqli_connect("localhost", "root", "", "lunch")
      or die("無法開啟MySQL資料庫連接!<br/>");
    //送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8');
    // 建立SQL指令字串

    $sql = "SELECT * FROM varchar_parameters WHERE `name`='today_restaurant'";
    $result = mysqli_query($link, $sql);
    $today_restaurant = mysqli_fetch_row($result)[1];
    if ($today_restaurant == 'NULL') echo "今日店家尚未決定";
    

    echo "您的訂單如下：<br><br>";
    $sql = "SELECT student.account, `order`.dish
    FROM student 
    INNER JOIN `order` 
    ON student.account = `order`.student_name 
    INNER JOIN " . $today_restaurant . " 
    ON `order`.dish = " . $today_restaurant .".dish 
    WHERE student.account = '".$_SESSION["name"]."'";

    // echo "echo ".$sql;
    $result = mysqli_query($link, $sql);
    while($row=mysqli_fetch_row($result))
    {
      echo $row[1]."<br>";
    }
  ?>
  <a href='index.php'>回首頁</a>

</body>

</html>