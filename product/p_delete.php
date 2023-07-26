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
		<title>商品一覧</title>
	</head>
	<!--bodyココカラ-->
	<body>
		<?php
			try{
				$p_code = $_GET['p_code'];
				
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = 'SELECT name,price,picture FROM product_list WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[] = $p_code;
				$stmt -> execute($data);

				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
				$p_name = $rec['name'];	
				$p_gazou = $rec['picture'];
				$p_price = $rec['price'];				

				$dbh = null;

				if($p_gazou == ''){
		
					$disp_gazou = '';

				}
				else{
					$disp_gazou = '<img src = "./gazou/'.$p_gazou.'">';
				}

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		<h1>商品削除</h1>
		<form method = "post" action = "p_delete_done.php">
		<?php print '<p>商品コード : ' . $p_code . '</p>' ; ?>
		<?php print '<p>商品名 : ' . $p_name . '</p>'; ?>	
		<?php print '<p>商品価格 : ' . $p_price . '</p>'; ?>
		<?php print $disp_gazou;?>
		<p>この商品を削除してよろしいですか？</p>
			<input type = 'hidden' name = 'code' value = "<?php print $p_code;?>">
			<input type = 'hidden' name = 'gazou_name' value = "<?php print $p_gazou;?>">
			<input type = 'submit' value = "OK">
			<input type = 'button' onclick = 'history.back()' value = "戻る">
		</form>
	</body>
</html>