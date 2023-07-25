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
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>スタッフログアウト</title>
	</head>

	<!--bodyココカラ-->
	<body>
		ログアウトしました。<br/>
		<br/>
		<a href = "../staff_login/index.html">ログイン画面へ</a>
	</body>
</html>
