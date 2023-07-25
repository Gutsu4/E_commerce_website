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
		<title>スタッフ追加実行</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			try{
				$staff_name = $_POST['name'];
				$staff_pass = $_POST['pass'];

				$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
				$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = 'INSERT INTO staff_list(name, password) VALUES (?,?)';
				$stmt = $dbh -> prepare($sql);
				$data[] = $staff_name;
				$data[] = $staff_pass;
				$stmt -> execute($data);

				$dbh = null;

				print $staff_name;
				print 'さんを追加しました。<br/>';

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
				
		?>

		<a href = "s_list.php">戻る</a>

	</body>
</html>