<?php
	session_start();
	session_regenerate_id(true);

	if(isset($_SESSION['member_login']) == false){
		print 'ようこそゲスト様。<br/>';
		print '<a href = "member_login.html">ログイン画面へ</a><br/>';
		print '<br/>';
	}
	else{
		print 'ようこそ';
		print $_SESSION['member_name'];
		print '様　';
		print '<a href = "member_logout.php">ログアウト</a><br/>';
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
			
				while(true){
					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
		
					if($rec == false){
						break;
					}
					
					print '<a href = "sh_item.php?p_code='.$rec['code'].'">';
					print $rec['name'].'---';
					print $rec['price'].'円';
					print '</a>';
					print '<br/>';
					
				}
				print '<br/>';
				print '<a href = "sh_cartshow.php">カートを見る</a><br/>';	
			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
	</body>
</html>