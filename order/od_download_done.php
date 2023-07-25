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
		<title>注文ダウンロード</title>
	</head>

	<!--bodyココカラ-->
	<body>
		<?php
			try{

				/*値受取り*/
				$year = $_POST['year'];
				$month = $_POST['month'];
				$day = $_POST['day'];

				/*DB接続*/
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				/*SQL文生成*/
				$sql = '
				SELECT 
					order_list.code,
					order_list.date,
					order_list.code_member,
					order_list.name AS user_name,
					order_list.email,
					order_list.postal1,
					order_list.postal2,
					order_list.address,
					order_list.tel,
					order_item_list.code_iproduct,
					order_item_list.price,
					order_item_list.quantity,
					product_list.name AS product_name
						
				FROM 
					order_list, order_item_list, product_list
				WHERE 
					order_list.code = order_item_list.code_order
					AND order_item_list.code_iproduct = product_list.code
					AND substr(order_list.date, 1, 4) = ? 
					AND substr(order_list.date, 6, 2) = ? 
					AND substr(order_list.date, 9, 2) = ?
				';

				/*SQL文実行*/
				$stmt = $dbh -> prepare($sql);
				$data[] = $year;
				$data[] = $month;
				$data[] = $day;
				$stmt -> execute($data);

				/*DB切断*/
				$dbh = null;

				/*CSVに書き込む文字列を生成*/
				$csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
				$csv .= "\n";
				
				/*SELECTしたレコードのループ*/
				while(true){

					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
					if($rec == false){
						break;
					}
				
					/*CSVに書き込む文字列を作成していく*/
					$csv .= $rec['code'];                         //注文コード
					$csv .= ',';
					$csv .= $rec['date'];                         //注文日時
					$csv .= ',';
					$csv .= $rec['code_member'];                  //会員番号
					$csv .= ',';
					$csv .= $rec['user_name'];                    //お名前
					$csv .= ',';
					$csv .= $rec['email'];                        //メール
					$csv .= ',';
					$csv .= $rec['postal1'].'-'.$rec['postal2'];  //郵便番号
					$csv .= ',';
					$csv .= $rec['address'];                      //住所
					$csv .= ',';				
					$csv .= $rec['tel'];                          //TEL
					$csv .= ',';
					$csv .= $rec['code_iproduct'];                //商品コード
					$csv .= ',';
					$csv .= $rec['product_name'];                 //商品名
					$csv .= ',';
					$csv .= $rec['price'];                        //価格
					$csv .= ',';
					$csv .= $rec['quantity'];                     //数量
					$csv .= ',';
					$csv .= "\n";
				}
				

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}

			/*CSVに書き込む文字列を確認　※確認後コメントアウト忘れずに※*/
			//print nl2br($csv);

			$str = './../order_output/' .$data[0] . $data[1] . $data[2] . '.csv';
			$file = fopen($str,'w');
			$csv = mb_convert_encoding($csv,'SJIS','UTF-8');
			fputs($file,$csv);
			fclose($file);
		?>

		<br/>
		<a href = "../staff_login/sl_top.php">トップメニューへ</a><br/>

	</body>
</html>
