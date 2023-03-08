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
    echo "你的名字是" . $_SESSION["name"] . "<br>";
    echo "你現在在" . $_SESSION["restaurant"];
    echo "<br><br><br>";

    if (!isset($_SESSION["restaurant"])) header("Location: root.php");

    $restaurant = $_SESSION['restaurant'];

    $link = mysqli_connect("localhost", "root", "", "lunch")
        or die("無法開啟MySQL資料庫連接!<br/>");
    $sql = "SELECT * FROM `" . $restaurant . "`";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_row($result)) {
        echo $row[0] . '=>' . $row[1] . '<br>';
    }

    if (isset($_POST["edit"])) header("Location: edit_dish.php");
    if (isset($_POST["new"])) header("Location: new_dish.php");
    if (isset($_POST["delete"])) header("Location: delete_dish.php");

    ?>

    <form action="" method="post">
        <input type="submit" value="修改餐點" name="edit">
        <input type="submit" value="新增餐點" name="new">
        <input type="submit" value="刪除餐點" name="delete">
    </form>
    <a href='inspect_restaurants.php?'>回上頁</a>
</body>

</html>