<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../staff_css/style.css">
	<link rel="stylesheet" type="text/css" href="../staff_css/edit.css">
	<link rel="stylesheet" type="text/css" href="../staff_css/img.css">
	<link rel="stylesheet" type="text/css" href="../staff_css/file.css">
	<title>商品修正</title>
</head>

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

	<h1>商品修正</h1>

	<?php print "商品コード : " . $p_code; ?>

	<br/>
	<form method="post" action="p_edit_check.php" enctype="multipart/form-data">
		<input type="hidden" name="code" value="<?php print $p_code;?>">
		<input type="hidden" name="gazou_name_old" value="<?php print $p_gazou_old;?>">			

		商品名<br/>
		<input type="text" name="name" style="width:200px" value="<?php print $p_name;?>">
		<br/><br/>

		価格<br/>
		<input type="text" name="price" style="width:200px" value="<?php print $p_price;?>">
		<br/>

		<?php print $disp_gazou;?><br/>

		画像を選んでください<br/>
		<div class="file-input-container">
			<button type="button" class="file-input-button">ファイルの選択</button>
			<span id="file-name"></span>
			<input type="file" name="gazou" id="file-input">
		</div>

		<br/>
		<input type="submit" value="OK">
		<input type="button" onclick="history.back()" value="戻る">
	</form>

	<script>
		document.getElementById('file-input').addEventListener('change', function() {
			document.getElementById('file-name').textContent = this.files[0].name;
		});
		document.querySelector('.file-input-button').addEventListener('click', function() {
			document.getElementById('file-input').click();
		});
	</script>
</body>
</html>
