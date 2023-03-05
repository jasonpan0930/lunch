<html>

<head>
    <meta charset="utf-8">
    <title>確認結束訂單</title>
</head>

<body>
    <?php
    session_start();  // 啟用交談期
    // 檢查Session變數是否存在, 表示是否已成功登入
    if ($_SESSION["login_session"] != true)
        header("Location: login.php");
    if ($_SESSION["name"] != "root") header("Location: index.php");
    echo "歡迎管理員進入網站!<br/>";
    echo "<br><br><br>";

    if (isset($_POST['yes'])) {
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "TRUNCATE `order`";
        if (mysqli_query($link, $sql)) echo "orders are truncated successfully.<br>";
        else echo "failed<br>";

        $sql = "UPDATE int_parameters set `value` = 0  WHERE `name`= 'ordering'";
        if (mysqli_query($link, $sql)) echo "ordering is updated successfully.<br>";
        else echo "failed<br>";

        $sql = "UPDATE varchar_parameters set `value` = 'NULL'  WHERE `name`= 'today_restaurant'";
        if (mysqli_query($link, $sql)) echo "today_restaurant is updated successfully.<br>";
        else echo "failed<br>";
    }

    if (isset($_POST['no'])) {
        header("Location: root.php");
    }


    ?>

    是否確認結束訂單？
    <form action="" method="post">
        <input type="submit" value="是" name="yes">
        <input type="submit" value="否" name="no">
    </form>
    <a href='root.php'>回首頁</a>

</body>

</html>