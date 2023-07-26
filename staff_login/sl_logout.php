<?php
	session_start();
	$_SESSION = array();

	if(isset($_COOKIE[session_name()]) == true){
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
?>

<!DOCTYPE html>
<html>

	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../staff_css/style.css">
		<link rel="stylesheet" type="text/css" href="./staff_css/sl_login.css">
		<title>スタッフログアウト</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<h2>ログアウトしました。</h2><br/>
		<br/>
		<a href = "../staff_login/index.html" class=relogin-button>ログイン画面へ</a>
	</body>
</html>
