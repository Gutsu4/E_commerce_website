<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
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
		スタッフ修正<br/>
		<br/>
		スタッフコード<br/>
		
		<?php print $staff_code;?>
		<br/>
		<br/>
		<form method = "post" action = "s_edit_check.php">
			<input type = 'hidden' name = 'code' value = "<?php print $staff_code;?>">
			スタッフ名<br/>
			<input type = 'text' name = 'name' style = "width:200px" value = "<?php print $staff_name;?>"><br/>
			パスワードを入力してください<br/>
			<input type = 'password' name = 'pass' style = "width:100px"><br/>
			パスワードをもう一度入力してください<br/>
			<input type = 'password' name = 'pass2' style = "width:100px"><br/>
			<br/>
			<input type = 'button' onclick = 'history.back()' value = "戻る">
			<input type = 'submit' value = "OK">
			
		</form>
	</body>
</html>