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
		<link rel="stylesheet" type="text/css" href="../staff_css/add.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/img.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/file.css">
		<title>商品追加</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<h1>商品追加</h1>
		<form method = "post" action = "p_add_check.php" enctype = "multipart/form-data">
			商品名を入力してください<br/>
			<input type = "text" name = "name"><br/>
			価格を入力してください<br/>
			<input type = "text" name = "price"><br/>
			画像を選んでください<br/><br/>
			<div class="file-input-container">
				<button type="button" class="file-input-button">ファイルの選択</button>
				<span id="file-name"></span>
				<input type="file" name="gazou" id="file-input">
			</div>
			<br/>
			<input type = "button" onclick = "history.back()" value = "戻る">
			<input type = "submit" value = "OK">
		</form>

		<script>
			document.getElementById('file-input').addEventListener('change', function() {
				document.getElementById('file-name').textContent = this.files[0].name;
			});
			document.querySelector('.file-input-button').addEventListener('click', function() {
				document.getElementById('file-input').click();
			});
		</script>

	</body>
</html>
