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
				$p_price = $rec['price'];
				$p_gazou_old = $rec['picture'];
				

				$dbh = null;

				if($p_gazou_old == ''){
					$disp_gazou = '';
				}
				else{
					$disp_gazou = '<img src = "./gazou/'.$p_gazou_old.'">';
				}

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		商品修正<br/>
		<br/>
		商品コード<br/>
		<?php print $p_code;?>
		<br/>
		<form method = "post" action = "p_edit_check.php" enctype = "multipart/form-data">
			<input type = 'hidden' name = 'code' value = "<?php print $p_code;?>">
			<input type = 'hidden' name = 'gazou_name_old' value = "<?php print $p_gazou_old;?>">			
			商品名<br/>
			<input type = 'text' name = 'name' style = "width:200px" value = "<?php print $p_name;?>"><br/>
			<br/>
			価格<br/>
			<input type = 'text' name = 'price' style = "width:200px" value = "<?php print $p_price;?>"><br/>
			<?php print $disp_gazou;?>
			<br/>
			画像を選んでください。<br/>
			<input type = 'file' name = 'gazou' style = "width:400px">
			<br/>
			<input type = 'button' onclick = 'history.back()' value = "戻る">
			<input type = 'submit' value = "OK">
			
		</form>
	</body>
</html>