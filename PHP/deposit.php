<html>

<head>
    <meta charset="utf-8">
    <title>儲值系統</title>
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

    $deposit = "";
    $account = "";
    if (isset($_POST["deposit"])) $deposit = $_POST["deposit"];
    if (isset($_POST["account"])) $account = $_POST["account"];
    if ($deposit != "" && $account != "") {
        // 建立MySQL的資料庫連接 
        $link = mysqli_connect("localhost", "root", "", "lunch")
            or die("無法開啟MySQL資料庫連接!<br/>");
        //送出UTF8編碼的MySQL指令
        mysqli_query($link, 'SET NAMES utf8');
        // 建立SQL指令字串
        $sql = "SELECT * FROM student where account = '" . $account . "'";
        $result = mysqli_query($link, $sql);
        $row = $result->fetch_assoc();
        $money = $row["money"];
        echo "除值前您有" . $money . "元<br>";
        $money += $deposit;
        $sql = "UPDATE student set `money` = '" . $money . "' WHERE `account`= '" . $account . "'";
        if (mysqli_query($link, $sql)) {
            echo "Records were updated successfully.";
            $sql = "SELECT * FROM student where account = '" . $account . "'";
            $result = mysqli_query($link, $sql);
            $row = $result->fetch_assoc();
            echo "現在您有： " . $row["money"] . " 元<br>";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    ?>
    <form action="deposit.php" method="post">
        <label for="account">帳號名稱:</label>
        <input type="text" name="account" id="account" required />
        <br>
        <label for="deposit">儲值金額:</label>
        <input type="text" name="deposit" id="deposit" required />
        <br>
        <input type="submit" value="確認" name="submit">
    </form>
    <a href='root.php'>回首頁</a>
</body>

</html>