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
		<title>ログアウト</title>
	</head>

	<!--bodyココカラ-->
	<body>
		ログアウトしました。<br/>
		<br/>
		<a href = "../shop/sh_list.php">商品一覧へ</a>
	</body>
</html>
