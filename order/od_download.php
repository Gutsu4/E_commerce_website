<?php

	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login']) == false){
		print 'ログインされていません。<br/>';
		print '<a href = "../staff_login/sl_login.html">ログイン画面へ</a>';
		exit();
	}
	
	else{
		print 'ログイン中：';
		print $_SESSION['staff_name'];
		print '<br/>';
	}
?>

<!DOCTYPE html>
<html>

	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<title>注文ダウンロード</title>
	</head>

	<!--bodyココカラ-->
	<body>

		<?php
			require_once('../common/common.php');
		?>

		ダウンロードしたい注文日を選んでください。<br/>
		<form method = "post" action = "od_download_done.php">
		<?php 
			pulldown_year();
		?>
		年
		<?php 
			pulldown_month();
		?>
        月
        <?php 
			pulldown_day();
		?>
        日
        <br/>
        <input type="submit" value="ダウンロードへ" >
		</form>
	</body>
</html>