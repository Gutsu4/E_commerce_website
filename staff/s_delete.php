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
		<link rel="stylesheet" type="text/css" href="../staff_css/delete.css">
		<title>スタッフ一覧</title>
	</head>
	<!--bodyココカラ-->
	<body>
		<div class="header">
            <?php
                if(isset($_SESSION['login']) == false) {
                    echo '<h2>ログインされていません。</h2><br/>';
                    echo '<a href="../staff_login/index.html" class="relogin-button">ログイン画面へ</a>';
                    exit();
                } else {
                    echo '<span class=login-name>ログイン名 : ' . $_SESSION['staff_name'] . '</span>';
                    echo '<br/>';                    
                }
            ?>
			<h1>スタッフ削除</h1>
        </div>
		<?php
			try{
				$staff_code = $_GET['staffcode'];
				
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = 'SELECT name FROM staff_list WHERE code = ?';
				$stmt = $dbh -> prepare($sql);
				$data[] = $staff_code;
				$stmt -> execute($data);

				$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
				$staff_name = $rec['name'];				

				$dbh = null;

			}
			catch(Exception $e){
				print '障害発生中';
				exit();
			}
		?>

		<form method = "post" action = "s_delete_done.php">
		<?php
			print '<div class="staff-info">スタッフコード<br/>' . $staff_code . '<br/><br/>スタッフ名<br/>' . $staff_name . '</div><br/>';
		?>
			<input type = 'hidden' name = 'code' value = "<?php print $staff_code;?>">
			<input type = 'submit' value = "OK">
			<input type = 'button' onclick = 'history.back()' value = "戻る">
		</form>
	</body>
</html>