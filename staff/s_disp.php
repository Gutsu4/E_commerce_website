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
		<link rel="stylesheet" type="text/css" href="../css/disp.css">
		<title>スタッフ一覧</title>
	</head>
	<!--bodyココカラ-->
	<body>
		<?php
			try{
				$staff_code = $_GET['staffcode'];
				
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = 'SELECT name FROM staff_list WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[] = $staff_code;
				$stmt -> execute($data);

				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
				$staff_name = $rec['name'];				

				$dbh = null;

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		
		<h1>スタッフ情報参照</h1>

		<?php
			print '<div class="staff-info">スタッフコード<br/>' . $staff_code . '<br/><br/>スタッフ名<br/>' . $staff_name . '</div>';
		?>
		<input type = 'button' onclick = 'history.back()' value = "戻る">		
		
	</body>
</html>