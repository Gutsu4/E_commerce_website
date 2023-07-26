<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>

	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../staff_css/style.css">
		<link rel="stylesheet" type="text/css" href="./css/od_download.css">
		<title>注文ダウンロード</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			require_once('../common/common.php');
		?>

		<h1>注文日を選んでください。</h1>
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
		<a href = "../staff_login/sl_top.php" class='topmenu'>トップメニューへ </a>
	</body>
</html>
