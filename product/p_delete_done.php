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
		<link rel="stylesheet" type="text/css" href="../staff_css/delete.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/img.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/file.css">
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
		<h2>削除しました。</h2>
		<a href = "p_list.php" class="back-button">戻る</a>

	</body>
</html>
