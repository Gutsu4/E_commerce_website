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
				
				if(isset($_SESSION['cart']) == true){
					$cart = $_SESSION['cart'];
					$kazu = $_SESSION['kazu'];

					if(in_array($p_code,$cart) == true){

						print 'その商品はすでにカートに入っています。<br/>';
						print '<a href = "sh_list.php">商品一覧に戻る</a>';
						exit();

					}

				}

				$cart[] = $p_code;
				$kazu[] = 1;

				$_SESSION['cart'] = $cart;
				$_SESSION['kazu'] = $kazu;
			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>
		カートに追加しました。<br/>
		<br/>
		<a href = "sh_list.php">商品一覧に戻る</a>
	</body>
</html>