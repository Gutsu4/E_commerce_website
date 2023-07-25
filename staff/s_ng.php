<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>

	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<title>テスト</title>
	</head>

	<!--bodyココカラ-->
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
		</div>
		スタッフが選択されていません。<br/>
		<a href = "s_list.php">戻る</a>
	</body>
</html>