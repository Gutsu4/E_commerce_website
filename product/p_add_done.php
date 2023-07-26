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
		<title>商品追加実行</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			try{
				$p_name = $_POST['name'];
				$p_price = $_POST['price'];
				$p_gazou_name = $_POST['gazou_name'];

				$p_name = htmlspecialchars($p_name, ENT_QUOTES, 'UTF-8');
				$p_price = htmlspecialchars($p_price, ENT_QUOTES, 'UTF-8');

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = 'INSERT INTO product_list(name, price,picture) VALUES (?,?,?)';
				$stmt = $dbh -> prepare($sql);
				$data[] = $p_name;
				$data[] = $p_price;
				$data[] = $p_gazou_name;
				$stmt -> execute($data);

				$dbh = null;

				print '<h2>';
				print $p_name;
				print 'を追加しました。<br/>';
				print '</h2>';

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}	
		?>
		<a href = "p_list.php" class="back-button">戻る</a>

	</body>
</html>
