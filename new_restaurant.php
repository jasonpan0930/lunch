<html>

<head>
    <meta charset="utf-8">
    <title>新增餐廳</title>
</head>

<body>
    <?php
    session_start();  // 啟用交談期
    // 檢查Session變數是否存在, 表示是否已成功登入
    if ($_SESSION["login_session"] != true) header("Location: login.php");
    if ($_SESSION["name"] != "root") header("Location: index.php");
    echo "歡迎使用者進入網站!<br/>";
    echo "你的名字是" . $_SESSION["name"];
    echo "<br><br><br>";

    // 建立MySQL的資料庫連接 
    $link = mysqli_connect("localhost", "root", "", "lunch")
        or die("無法開啟MySQL資料庫連接!<br/>");
    //送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8');
    $name = "";
    $tel = "";

    if (isset($_POST["confirm"])) {
        if (isset($_POST["name"])) {
            $name = $_POST["name"];
            if (isset($_POST["tel"])) $tel = $_POST["tel"];
            else $tel = "NULL";
            //判斷店家是否已存在
            $sql = 'select * from restaurants where restaurant="' . $name . '"';
            $result = mysqli_query($link, $sql);
            $exist = mysqli_num_rows($result);
            if ($exist > 0) echo "the restaurant has been existed";
            else {
                //新增資料庫
                $sql = 'INSERT INTO `restaurants` VALUES("' . $name . '","' . $tel . '")';
                if (mysqli_query($link, $sql)) echo "New restauarnt is updated successfully.";
                else echo "failed";

                $sql = 'CREATE TABLE '.$name.'(`dish` VARCHAR(100), `price` INT)';
                if (mysqli_query($link, $sql)) echo "New restauarnt table is updated successfully.";
                else echo "failed";

            }
        }
    }

    // 建立SQL指令字串

    ?>
    <form action="" method="post">
        <label for="name">請輸入店家名稱:</label>
        <input type="text" name="name" required>
        <br>

        <label for="phone">請輸入店家電話:</label>
        <input type="tel" name="tel">
        <br>
        <input type="submit" value="確認" name="confirm">
    </form>
    <a href='index.php?'>回首頁</a>
</body>

</html>