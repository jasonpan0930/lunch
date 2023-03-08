<html>

<head>
    <meta charset="utf-8">
    <title>檢視店家</title>
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
    while($row=mysqli_fetch_row($result))
    {
        $name=$row[0];
        $str .= '<option value="' . $name . '">' . $name . '</option>';
    }
    
    $str.='</select><br>';
    $str.='<input type="submit" value="確認" name="confirm">';
    $str.='</form>';
    echo $str;

    if (isset($_POST['confirm'])) {
        if (!empty($_POST['choose'])) {
            $selected = $_POST['choose'];
            $_SESSION['restaurant']=$selected;
            header("Location: inspect_dish.php");
        } else echo "please select value";
    }
    ?>

    <a href='index.php?'>回首頁</a>
</body>

</html>