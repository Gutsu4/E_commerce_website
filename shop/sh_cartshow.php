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
		<title>カート一覧</title>
	</head>
	<!--bodyココカラ-->
	<body>
		<?php
			try{
				if(isset($_SESSION['cart']) == true){
					$cart = $_SESSION['cart'];
					$kazu = $_SESSION['kazu'];
					$max = count($cart);
				}else{
					$max = 0;
				}

				if($max == 0){

					print 'カートに商品が入っていません。<br/>';
					print '<br/>';
					print '<a href = "sh_list.php">商品一覧へ戻る</a>';
					exit();

				}

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				foreach($cart as $key => $val){
					$sql = 'SELECT code,name,price, picture FROM product_list WHERE code = ?';
					$stmt = $dbh -> prepare($sql);
					$data[0] = $val;
					$stmt -> execute($data);

					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

					$p_name[] = $rec['name'];
					$p_price[] = $rec['price'];

					if($rec['picture'] == ''){
						$p_gazou[] = '';
					}else{
						$p_gazou[] = '<img src = "../product/gazou/'.$rec['picture'].'">';
					}

				}
				$dbh = null;

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		カートの中身<br/>
		<br/>
		<form method="post" action = "sh_numchange.php">
				
		<table border = "1">
		<tr>
		<td><center>商品</center></td>
		<td><center>商品画像</center></td>
		<td><center>価格</center></td>
		<td><center>数量</center></td>
		<td><center>小計</center></td>
		<td><center>削除</center></td>
		</tr>


		<?php 
			for($i = 0; $i < $max; $i++){
		?>
		<tr>
				<td><?php print $p_name[$i]; ?></td>
				<td><?php print $p_gazou[$i]; ?></td>
				<td><?php print $p_price[$i]; ?>円</td>
				<td><input type = "text" name = "kazu<?php print $i;?>" size = "1" value = "<?php print $kazu[$i]; ?>"></td>
				<td><?php print $p_price[$i] * $kazu[$i]; ?>円</td>
				<td><input type = "checkbox" name = "sakujo<?php print $i; ?>"></td>
				<br/>
		</tr>
		<?php
			}		
		?>
		</table>
			<input type = 'hidden' name = "max" value = "<?php print $max; ?>">
			<input type = 'submit' value = "数量変更"><br/>
			<input type = 'button' onclick = 'history.back()' value = "戻る">
		</form>
		<br/>
		<a href = "o_form.php">ご購入手続きに進む</a><br />
		<a href = "sh_cartclear.php">カートを空にする</a><br />
		
		<?php
			if(isset($_SESSION["member_login"]) == true){
				print '<a href = "o_easy.php">らくらく注文へ進む</a><br/>';
			}
		?>

	</body>
</html>