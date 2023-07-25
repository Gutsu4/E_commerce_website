<?php

	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login']) == false){
		print 'ログインされていません。<br/>';
		print '<a href = "../staff_login/sl_login.html">ログイン画面へ</a>';
		exit();
	}
	
	else{
		print 'ログイン中：';
		print $_SESSION['staff_name'];
		print '<br/>';
	}
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
	スタッフが選択されていません。<br/>
	<a href = "s_list.php">戻る</a>

	</body>
</html>