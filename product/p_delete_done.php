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
		<title>商品追加実行</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			try{	
				$p_code = $_POST['code'];
				$p_gazou = $_POST['gazou_name'];

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = 'DELETE FROM product_list WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[] = $p_code;
				$stmt -> execute($data);

				$dbh = null;

				if($p_gazou != ''){
					unlink('./gazou/'.$p_gazou);
				}

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
				
		?>
		削除しました。<bt/>
		<bt/>
		<a href = "p_list.php">戻る</a>

	</body>
</html>
