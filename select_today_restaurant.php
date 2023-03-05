<html>

<head>
    <meta charset="utf-8">
    <title>選擇今日店家</title>
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
    // 建立MySQL的資料庫連接 
    $link = mysqli_connect("localhost", "root", "", "lunch")
        or die("無法開啟MySQL資料庫連接!<br/>");
    mysqli_query($link, 'SET NAMES utf8');
    $sql = "SELECT `value` FROM int_parameters WHERE `name`='ordering'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($result);
    if ($row[0] == 1) header("location:root.php");




    // 建立MySQL的資料庫連接 
    $link = mysqli_connect("localhost", "root", "", "lunch")
        or die("無法開啟MySQL資料庫連接!<br/>");
    //送出UTF8編碼的MySQL指令
    mysqli_query($link, 'SET NAMES utf8');

    $str = '<form action="" method="post">
                <select name="choose">
                <option value="" disabled selected>選擇餐廳</option>';

    $sql = "SELECT `restaurant` FROM `restaurants`";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $name = $row[0];
        $str .= '<option value="' . $name . '">' . $name . '</option>';
    }

    $str .= '</select><br>';
    $str .= '<input type="submit" value="確認" name="confirm">';
    $str .= '</form>';
    echo $str;

    if (isset($_POST['confirm'])) {
        if (!empty($_POST['choose'])) {
            $selected = $_POST['choose'];
            $sql = "UPDATE varchar_parameters set `value` = '" . $selected . "' WHERE `name`= 'today_restaurant'";
            $sql2 = "UPDATE int_parameters set `value` = 1 WHERE `name`= 'ordering'";
            if (mysqli_query($link, $sql) && mysqli_query($link, $sql2)) {
                echo "Records were updated successfully.";
            } else echo "failed";
        } else echo "please select value";
    }
    ?>

    <a href='index.php?'>回首頁</a>
</body>

</html>