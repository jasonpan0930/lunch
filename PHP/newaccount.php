<html>

<head>
    <meta charset="utf-8">
    <title>你要做什麼</title>
</head>

<body>


    <?php
    if (isset($_POST["confirm"])) {
        $name = "";
        $password = "";
        // 取得表單欄位值
        if (isset($_POST["seat"]))
            $seat = $_POST["seat"];
        if (isset($_POST["name"]))
            $name = $_POST["name"];
        if (isset($_POST["password"]))
            $password = $_POST["password"];
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        mysqli_query($link, 'SET NAMES utf8');
        // 建立SQL指令字串
        $sql = "SELECT * FROM student WHERE account='" . $name . "'";
        $result = mysqli_query($link, $sql);
        $total_records = mysqli_num_rows($result);
        if ($total_records > 0) echo "帳號名稱重複";
        else {
            $sql = "INSERT INTO `student` VALUES(" . $seat . ", '" . $name . "', '" . $password . "',0,0)";
            if (mysqli_query($link, $sql)) {
                echo "Account is updated successfully.";
            } else {
                echo "failed";
            }
        }
    }
    ?>
    <form action="newaccount.php" method="post">
        <label for="seat">座號:</label>
        <input type="text" name="seat" id="seat" require autofocus />
        <br>
        <label for="name">帳號:</label>
        <input type="text" name="name" id="name" required />
        <br>
        <label for="password">密碼:</label>
        <input type="password" name="password" id="password" required />
        <br>
        <br>
        <input type="submit" value="確認" name="confirm" />
        <a href='login.php'>回登入頁面</a>
    </form>
</body>

</html>