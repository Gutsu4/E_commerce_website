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
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = 'SELECT code ,name, price FROM product_list WHERE 1';
				$stmt = $dbh -> prepare($sql);
				$stmt -> execute();
				$dbh = null;
				print '商品一覧<br/><br/>';
			
				print '<form method = "post" action = "p_branch.php">';
				while(true){
					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
		
					if($rec == false){
						break;
					}
					
					print '<input type = "radio" name = "p_code" value = "'.$rec['code'].'">';
					print $rec['name'].'---';
					print $rec['price'].'円';
					print '<br/>';
				}
				print '<input type = "submit" name = "disp" value = "参照">';
				print '<input type = "submit" name = "add" value = "追加">';
				print '<input type = "submit" name = "edit" value = "修正">';
				print '<input type = "submit" name = "delete" value = "削除">';
				print '</form>';
			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		<br/>
		<a href = "../staff_login/sl_top.php">トップメニューへ</a><br/>
	</body>
</html>