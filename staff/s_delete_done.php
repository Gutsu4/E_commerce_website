<?php
	session_start();
	session_regenerate_id(true);
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
				$staff_code = $_POST['code'];

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = 'DELETE FROM staff_list WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[] = $staff_code;
				$stmt -> execute($data);

				$dbh = null;

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
				
		?>
		削除しました。<bt/>
		<bt/>
		<a href = "s_list.php">戻る</a>

	</body>
</html>
