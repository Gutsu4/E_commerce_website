<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>

	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/od_download.css">
		<title>注文ダウンロード</title>
	</head>

	<!--bodyココカラ-->
	<body>
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

		<?php
			require_once('../common/common.php');
		?>

		<h2>ダウンロードしたい注文日を選んでください。</h2>
		<br/>
		<form method = "post" action = "od_download_done.php">
		<div class="form-group">
			<?php pulldown_year(); ?>
			<span>年</span>
		</div>

		<div class="form-group">
			<?php pulldown_month(); ?>
			<span>月</span>
		</div>

		<div class="form-group">
			<?php pulldown_day(); ?>
			<span>日</span>
		</div>

        <input type="submit" value="ダウンロードへ" >
		</form>
	</body>
</html>
