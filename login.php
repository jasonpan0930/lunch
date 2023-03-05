<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <title>login.php</title>
</head>

<body>
   <?php
   session_start();  // 啟用交談期
   $name = "";
   $password = "";
   // 取得表單欄位值
   if (isset($_POST["name"]))
      $name = $_POST["name"];
   if (isset($_POST["password"]))
      $password = $_POST["password"];
   // 檢查是否輸入使用者名稱和密碼
   if ($name != "" && $password != "") {
      // 建立MySQL的資料庫連接 
      $link = mysqli_connect(
         "localhost",
         "root",
         "",
         "lunch"
      )
         or die("無法開啟MySQL資料庫連接!<br/>");
      //送出UTF8編碼的MySQL指令
      mysqli_query($link, 'SET NAMES utf8');
      // 建立SQL指令字串
      $sql = "SELECT * FROM student WHERE `password`='". $password . "' AND account='" . $name . "'";
      // 執行SQL查詢
      $result = mysqli_query($link, $sql);
      $total_records = mysqli_num_rows($result);
      // 是否有查詢到使用者記錄
      if ($total_records > 0) {
         // 成功登入, 指定Session變數
         $_SESSION["login_session"] = true;
         $_SESSION["name"] = $name;
         if($_SESSION["name"] == "root") header("Location: root.php");
         else header("Location: index.php");
      } else {  // 登入失敗
         echo "<center><font color='red'>";
         echo "使用者名稱或密碼錯誤!<br/>";
         echo "</font>";
         $_SESSION["login_session"] = false;
      }
      mysqli_close($link);  // 關閉資料庫連接  
   }
   ?>
   <form action="login.php" method="post">
      <div align="center" style="background-color:#82FF82;padding:10px;margin-bottom:5px;">
         <br>
         <label for="name">帳號:</label>
         <input type="text" name="name" id="name" required autofocus />
         <br>
         <br>
         <label for="password">密碼:</label>
         <input type="password" name="password" id="password" required />
         <br>
         <br>
         <input type="submit" value="登入" />
      </div>
   </form>
   <a href='newaccount_with_password_confirm.php?'>新增帳號</a>
</body>

</html>