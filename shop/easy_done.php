<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset = "UTF-8">
		<title>商品確定</title>
	</head>

	<body>
		<?php
			try{	
				$onamae = $_POST['onamae'];
				$email = $_POST['email'];
				$postal1 = $_POST['postal1'];
				$postal2 = $_POST['postal2'];
				$address = $_POST['address'];
				$tel = $_POST['tel'];

				$msg = '';
				$msg .= $onamae. "様\n\n この度はご注文ありがとうございます。";
				$msg .= "\n";
				$msg .= "ご注文商品\n";
				$msg .= "--------------\n";

				$cart = $_SESSION['cart'];
				$kazu = $_SESSION['kazu'];
				$max = count($cart);

				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				for($i = 0; $i < $max; $i++){

					$sql = 'SELECT name, price FROM product_list WHERE code = ?';
					$stmt = $dbh -> prepare($sql);
					$data[0] = $cart[$i];
					$stmt -> execute($data);

					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

					$name = $rec['name'];
					$price = $rec['price'];
					$kakaku[] = $price;
					$suryo = $kazu[$i];
					$shoukei = $price * $suryo;

					$msg .= $name.'';
					$msg .= $price.'円 ×';
					$msg .= $suryo.'個 = ';
					$msg .= $shoukei. "円\n";
				}

				$sql = 'LOCK TABLES order_list WRITE , order_item_list WRITE, member_list WRITE';
				$stmt = $dbh -> prepare($sql);
				$stmt -> execute();

				$sql = 'SELECT LAST_INSERT_ID()';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				$lastcode = $rec['LAST_INSERT_ID()'];

				//改変
				$sql = 'INSERT INTO order_list(code_member, name, email, postal1, postal2, address, tel) VALUES(?,?,?,?,?,?,?)';
				$stmt = $dbh->prepare($sql);
				$data = array();
				$data[] = $_SESSION['member_code'];
				$data[] = $onamae;
				$data[] = $email;
				$data[] = $postal1;
				$data[] = $postal2;
				$data[] = $address;
				$data[] = $tel;
				$stmt->execute($data);

				$sql = 'SELECT LAST_INSERT_ID()';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				$lastcode = $rec['LAST_INSERT_ID()'];

				for($i = 0; $i < $max; $i++){
					$sql = 'INSERT INTO order_item_list(code_order, code_iproduct, price, quantity) VALUES(?,?,?,?)';
					$stmt = $dbh->prepare($sql);
					$data = array();
					$data[] = $lastcode;
					$data[] = $cart[$i];
					$data[] = $kakaku[$i];
					$data[] = $kazu[$i];
					$stmt->execute($data);
				}				

				$sql = 'UNLOCK TABLES';
				$stmt = $dbh -> prepare($sql);
				$stmt -> execute();

				$dbh = null;
				

			}
			catch(Exception $e){
				print '障害発生中';
				print $e;
				exit();
			}

			print $onamae.'様<br/><br/>';
			print 'ご注文ありがとうございました。<br/>';
			print $email.'にメールを送りましたのでご確認ください。<br/>';
			print '商品は以下の住所に発送させていただきます<br/>';
			print '〒' . $postal1.'-'.$postal2.'<br/>';
			print $address.'<br/>';
			print substr($tel,0,3). ' - '.substr($tel,3,4).' - '.substr($tel,7,10) .'<br/>';
			
		?>
		
	</body>
</html>
