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
		<title>テスト</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<h2>スタッフが選択されていません。</h2><br/>
		<a href = "s_list.php" class=back-button>戻る</a>
	</body>
</html>