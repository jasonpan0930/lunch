<html>

<head>
    <meta charset="utf-8">
    <title>管理員</title>
</head>

<body>
    <?php
    session_start();  // 啟用交談期
    // 檢查Session變數是否存在, 表示是否已成功登入
    if ($_SESSION["login_session"] != true)
        header("Location: login.php");
    if ($_SESSION["name"] != "root") header("Location: index.php");
    echo "歡迎管理員進入網站!<br/>";
    $link = mysqli_connect("localhost", "root", "", "lunch")
        or die("無法開啟MySQL資料庫連接!<br/>");


    $sql = "SELECT * FROM varchar_parameters WHERE `name`='today_restaurant'";
    $result = mysqli_query($link, $sql);
    $today_restaurant = mysqli_fetch_row($result)[1];
    if ($today_restaurant == 'NULL') echo "今日店家尚未決定";
    else {
        $sql = "SELECT * FROM restaurants WHERE `restaurant`='".$today_restaurant."'";
        $result = mysqli_query($link, $sql);
        $row=mysqli_fetch_row($result);
        echo '今日店家為' . $row[0] . '<br>';
        echo "電話號碼為：" . $row[1];
    }


    echo "<br><br><br>";

    if (isset($_POST['confirm'])) {
        if (!empty($_POST['choose'])) {
            $selected = $_POST['choose'];
            if ($selected == '1') header("Location: deposit.php");
            if ($selected == '2') header("Location: new_restaurant.php");
            if ($selected == '3') header("Location: inspect_restaurants.php");
            if ($selected == '4') header("Location: select_today_restaurant.php");
            if ($selected == '5') header("Location: view_simple_order.php");
            if ($selected == '6') header("Location: view_detailed_order.php");
        } else echo "please select value";
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    }

    if (isset($_POST['stop'])) {
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "UPDATE int_parameters set `value` = 0 where `name` = 'ordering'";
        if (mysqli_query($link, $sql)) echo "Records were updated successfully.";
        else echo "failed";
    }

    if (isset($_POST['restart'])) {
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = "UPDATE int_parameters set `value` = 1 where `name` = 'ordering'";
        if (mysqli_query($link, $sql)) echo "Records were updated successfully.";
        else echo "failed";
    }

    if (isset($_POST['end'])) header("Location: end.php");

    ?>


    <form action="" method="post">
        <select name="choose">
            <option value="" disabled selected>你要做什麼</option>
            <option value="4">選擇今日店家</option>
            <option value="1">儲值</option>
            <option value="2">新增店家</option>
            <option value="3">檢視店家</option>
            <option value='5'>查看簡易訂單</option>
            <option value='6'>查看詳細訂單</option>
        </select>
        <br>
        <input type="submit" value="確認" name="confirm">
        <br>
        <br>
        <input type="submit" value="停止訂餐" name="stop">
        <input type="submit" value="重啟訂餐" name="restart">
        <br>
        <input type="submit" value="清除訂單" name="end">
        <br><br>
        <input type="submit" value="登出" name="logout">

    </form>


</body>

</html>