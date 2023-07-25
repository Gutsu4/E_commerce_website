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
					$disp_gazou = '<img src = "../product/gazou/'.$p_gazou.'">';
				}
				print '<a href = "sh_cartin.php?p_code='.$p_code.'">カートに入れる</a><br/><br/>';

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		商品情報参照<br/>
		<br/>
		商品コード<br/>
		<?php print $p_code;?>
		<br/>
		商品名<br/>
		<?php print $p_name;?>
		<br/>
		価格<br/>
		<?php print $p_price;?>
		<br/>
		<?php print $disp_gazou;?>
		<br/>
			<input type = 'button' onclick = 'history.back()' value = "戻る">		
		</form>
	</body>
</html>