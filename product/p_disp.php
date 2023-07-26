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
		<link rel="stylesheet" type="text/css" href="../css/img.css">
		<title>スタッフ一覧</title>
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
				$p_price = $rec['price'];
				$p_gazou = $rec['picture'];

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
		<h1>商品情報参照</h1>
		<div class="staff-info">
			<p>
				商品コード : 
				<?php print $p_code;?>
			</p>
			
			<p>商品名 : 
				<?php print $p_name;?>
			</p>
			<p>価格 : 
				<?php print $p_price;?>
				<?php print $disp_gazou;?>
			</p>
		</div>
		<input type = 'button' onclick = 'history.back()' value = "戻る">		
	</body>
</html>