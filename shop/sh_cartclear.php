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
		<title>カート削除</title>
	</head>

	<!--bodyココカラ-->
	<body>
		カートを空にしました。<br/>
		<br/>
		<a href = "sh_list.php">商品一覧へ</a>
	</body>
</html>
