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
    echo "歡迎使用者進入網站!<br/>";
    echo "你的名字是" . $_SESSION["name"];
    echo "<br><br><br>";
    ?>

    <a href='index.php?'>回首頁</a>
</body>
</html>


<?php
// 建立MySQL的資料庫連接 
$link = mysqli_connect("localhost", "root", "", "lunch")
    or die("無法開啟MySQL資料庫連接!<br/>");
mysqli_query($link, 'SET NAMES utf8');


//取得變數
$link = mysqli_connect("localhost", "root", "", "lunch")
    or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "SELECT `value` FROM int_parameters WHERE `name`='ordered'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);

//取得解果數量
mysqli_num_rows($result);

//轉頁面
header("Location: index.php");

//改變數
$link = mysqli_connect("localhost", "root", "", "lunch")
    or die("無法開啟MySQL資料庫連接!<br/>");
$sql = "UPDATE student set `money` = '" . $money . "' WHERE `account`= '" . $account . "'";
if (mysqli_query($link, $sql)) echo "Records were updated successfully.";
else echo "failed";

//新增資料
$link = mysqli_connect("localhost", "root", "", "lunch")
    or die("無法開啟MySQL資料庫連接!<br/>");
$sql = 'INSERT INTO `restaurants` VALUES("' . $name . '","' . $tel . '")';
if (mysqli_query($link, $sql)) echo "New restauarnt is updated successfully.";
else echo "failed";

//全查
while ($row = mysqli_fetch_row($result)) {
    $name = $row[0];
    $str .= '<option value="' . $name . '">' . $name . '</option>';
}
?>

//按鈕

<body>
    <?php
    if (isset($_POST["name"])) $name = $_POST["name"];

    if (isset($_POST['no'])) {
        //...
    }
    ?>

    <form action="" method="post">
        <label for="name">帳號:</label>
        <input type="text" name="name" id="name" required autofocus />

        <input type="submit" value="否" name="no">
    </form>

</body>