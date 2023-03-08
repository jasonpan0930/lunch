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

    if(!isset($_SESSION["restaurant"])) header("Location: root.php");

    $name = "";
    $price = "";
    $restaurant = $_SESSION['restaurant'];
    if (isset($_POST["name"])) $name = $_POST["name"];
    if (isset($_POST["price"])) $price = $_POST["price"];

    if ($name != "" && $price != "") {
        $link = mysqli_connect("localhost", "root", "", "lunch")
                or die("無法開啟MySQL資料庫連接!<br/>");
        $sql = 'select * from ' . $restaurant . ' where dish="' . $name . '"';
        $result = mysqli_query($link, $sql);
        $exist = mysqli_num_rows($result);
        if ($exist>0) echo "the dish has been existed";
        else {
            $link = mysqli_connect("localhost", "root", "", "lunch")
                or die("無法開啟MySQL資料庫連接!<br/>");
            $sql = 'INSERT INTO ' . $restaurant . ' VALUES("' . $name . '",' . $price . ')';
            if (mysqli_query($link, $sql)) echo "The dish is updated successfully.";
            else echo "failed";
        }
    }


    ?>
    <form action="" method="post">
        <label for="name">餐點名稱:</label>
        <input type="text" name="name" id="name" required autofocus />
        <br>
        <label for="price">價錢:</label>
        <input type="text" name="price" id="price" required />
        <br>
        <input type="submit" value="確認" name="confirm">
    </form>
    <a href='inspect_dish.php?'>回上頁</a>
</body>

</html>