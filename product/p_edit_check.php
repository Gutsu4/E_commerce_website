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
		<link rel="stylesheet" type="text/css" href="../staff_css/edit.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/img.css">
		<link rel="stylesheet" type="text/css" href="../staff_css/file.css">
		<title>商品追加チェック</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			$p_code = $_POST['code'];
			$p_name = $_POST['name'];
			$p_price = $_POST['price'];

			$p_code = htmlspecialchars($p_code, ENT_QUOTES, 'UTF-8');
			$p_name = htmlspecialchars($p_name, ENT_QUOTES, 'UTF-8');
			$p_price = htmlspecialchars($p_price, ENT_QUOTES, 'UTF-8');	
			$p_gazou_old = $_POST['gazou_name_old'];	
			$p_gazou = $_FILES['gazou'];	

			if($p_gazou['size'] > 0){
				if($p_gazou['size'] > 1000000){
					print'画像サイズが大きすぎます！';
				}
				else{
					move_uploaded_file($p_gazou['tmp_name'], './gazou/'.$p_gazou['name']);
					print '<img src = "./gazou/'.$p_gazou['name'].'">';
					print'<br/>';
				}
			}

			if($p_name == '' ||preg_match('/\A[0-9]+\z/', $p_price) == 0){
				print '<form>';
				print '<input type = "button" onclick = " history.back()" value = "戻る">';
				print '</form>';
			}
			else{
				
				print '<form method = "post" action = "p_edit_done.php">';
				print '<h2>変更後の商品内容</h2>';
				if($p_name == ''){
					print '商品名が入力されていません<br/>';
				}
				else{
					print '<p>';
					print '商品名 : ';
					print $p_name;
					print '</p>';
				}

				if(preg_match('/\A[0-9]+\z/', $p_price) == 0){

					print '価格の入力が不正です<br/>';
				}
				else{
					print '<p>';
					print '価格 : ';
					print $p_price . '円';
					print '</p>';
				}
				print '<input type = "hidden" name = "code" value = "'.$p_code.'">';
				print '<input type = "hidden" name = "name" value = "'.$p_name.'">';
				print '<input type = "hidden" name = "price" value = "'.$p_price.'">';
				print '<input type = "hidden" name = "gazou_name_old" value = "'.$p_gazou_old.'">';
				print '<input type = "hidden" name = "gazou_name" value = "'.$p_gazou['name'].'">';
				print '<br/>';
				print '<input type = "submit" value = "OK">';
				print '<input type = "button" onclick = "history.back()" value = "戻る">';
				print '</form>';
			}
		?>
	</body>
</html>
