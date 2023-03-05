<html>

<head>
    <meta charset="utf-8">
    <title>新增餐點</title>
</head>

<body>
    <?php
    session_start();  // 啟用交談期
    // 檢查Session變數是否存在, 表示是否已成功登入
    if ($_SESSION["login_session"] != true)
        header("Location: login.php");
    echo "歡迎使用者進入網站!<br/>";
    echo "你的名字是" . $_SESSION["name"] . "<br>";
    echo "你現在在" . $_SESSION["restaurant"];
    echo "<br><br><br>";

    if (!isset($_SESSION["restaurant"])) header("Location: root.php");

    $name = "";
    $restaurant = $_SESSION['restaurant'];
    if (isset($_POST["name"])) $name = $_POST["name"];

    if ($name != "") {
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = 'select * from ' . $restaurant . ' where dish="' . $name . '"';
        $result = mysqli_query($link, $sql);
        $exist = mysqli_num_rows($result);
        if ($exist == 0) echo "the dish isn't exist";
        else {
            $link = mysqli_connect("localhost", "root", "", "lunch")
                or die("無法開啟MySQL資料庫連接!<br/>");
            $sql = "DELETE FROM ".$restaurant." WHERE dish='" . $name . "'";
            if (mysqli_query($link, $sql)) echo "The dish has been deleted.";
            else echo "failed";
        }
    }


    ?>
    <form action="" method="post">
        <label for="name">餐點名稱:</label>
        <input type="text" name="name" id="name" required autofocus />
        <br>
        <input type="submit" value="確認" name="confirm">
    </form>
    <a href='inspect_dish.php?'>回上頁</a>
</body>

</html>