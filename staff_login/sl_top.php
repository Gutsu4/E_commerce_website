<?php
    session_start();
    session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="./css/sl_top.css">
        <title>ショップ管理</title>
    </head>

    <body>
        <div class="header">
            <?php
                if(isset($_SESSION['login']) == false) {
                    echo '<h2>ログインされていません。</h2><br/>';
                    echo '<a href="../staff_login/index.html" class="relogin-button">ログイン画面へ</a>';
                    exit();
                } else {
                    echo '<span class=login-name>ログイン名 : ' . $_SESSION['staff_name'] . '</span>';
                    echo '<br/>';                    
                }
            ?>
            <h1>ショップ管理トップメニュー</h1>
        </div>

        <div class="menu-grid">
            <a href="../staff/s_list.php" class="menu-button">スタッフ管理</a>
            <a href="../product/p_list.php" class="menu-button">商品管理</a>
            <a href="../order/od_download.php" class="menu-button">注文ダウンロード</a>
            <a href="sl_logout.php" class="menu-button">ログアウト</a>
        </div>
    </body>
</html>
