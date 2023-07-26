<?php
    session_start();
    session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
	<!--headココカラ-->
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/list.css">
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
			<h1>スタッフ管理</h1>
        </div>

		<?php

			try{
				$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
				$user = 'root';
				$password = '';
				$dbh = new PDO($dsn, $user, $password);
				$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = 'SELECT code, name FROM staff_list WHERE 1';
				$stmt = $dbh -> prepare($sql);
				$stmt -> execute();
				$dbh = null;
			
				print '<form method = "post" action = "s_branch.php">';
				print '<table>';
				print '<thead>';  
				print '<tr>';
				print '<th></th>';  
				print '<th>スタッフコード</th>'; 
				print '<th>スタッフ氏名</th>'; 
				print '</tr>';
				print '</thead>'; 
				while(true){
					$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
				
					if($rec == false){
						break;
					}
				
					print '<tr>';
					print '<td class=radio-button><input type = "radio" name = "staffcode" value = "'.$rec['code'].'"></td>';
					print '<td>' . $rec['code'] . '</td>';
					print '<td>' . $rec['name'] . '</td>';
					print '</tr>';
				}
				print '</table>';
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
		<a href = "../staff_login/sl_top.php" class='topmenu'>トップメニューへ</a><br/>
	</body>
</html>
