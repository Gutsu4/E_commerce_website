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
		<title>商品追加</title>
	</head>

	<!--bodyココカラ-->
	<body>
		商品追加<br/>
		<br/>
		<form method = "post" action = "p_add_check.php" enctype = "multipart/form-data">
			商品名を入力してください。<br/>
			<input type = "text" name = "name" style = "width:100px"><br/>
			価格を入力してください。<br/>
			<input type = "text" name = "price" style = "width:50px"><br/>
			画像を選んでください。<br/>
			<input type = "file" name = "gazou" style = "width:400px"><br/>
			<br/>
			<input type = "button" onclick = "history.back()" value = "戻る">
			<input type = "submit" value = "OK">
		</form>
	</body>
</html>
