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
		<link rel="stylesheet" type="text/css" href="../css/add.css">
		<title>スタッフ追加</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<h1>スタッフ追加</h1>
		<form method = "post" action = "s_add_check.php">
			スタッフ名を入力してください。<br/>
			<input type = "text" name = "name"><br/>
			パスワードを入力してください。<br/>
			<input type = "password" name = "pass"><br/>
			パスワードをもう一度入力してください。<br/>
			<input type = "password" name = "pass2"><br/>
			<br/>
			<input type = "submit" value = "OK">
			<input type = "button" onclick = "history.back()" value = "戻る">
		</form>
	</body>
</html>
