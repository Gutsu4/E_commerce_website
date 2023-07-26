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
		<link rel="stylesheet" type="text/css" href="../staff_css/edit.css">
		<title>スタッフ修正チェック</title>
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
                }
            ?>
        </div>

		<?php
			$staff_code = $_POST['code'];
			$staff_name = $_POST['name'];
			$staff_pass = $_POST['pass'];
			$staff_pass2 = $_POST['pass2'];

			$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
			$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');		
			$staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');	

			if($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2){
				print '<form>';
				
				if($staff_name == ''){
					print '<p>スタッフ名が入力されていません</p><br/>';
				}
	
				if($staff_pass == ''){
					print '<p>パスワードが入力されていません</p><br/>';
				}
				
				if($staff_pass != $staff_pass2){
					print '<p>パスワードが一致しません</p><br/>';
				}
				print '<input type = "button" onclick = " history.back()" value = "戻る">';
				print '</form>';
			}
			else{
				$staff_pass = md5($staff_pass);
				print '<form method = "post" action = "s_edit_done.php">';
				print '<input type = "hidden" name = "code" value = "'.$staff_code.'">';
				print '<input type = "hidden" name = "name" value = "'.$staff_name.'">';
				print '<input type = "hidden" name = "pass" value = "'.$staff_pass.'">';
				print '<br/>';
				print '<p>編集スタッフ名 : ';
				print $staff_name;
				print '</p>';
				print '<input type = "submit" value = "OK">';
				print '<input type = "button" onclick = "history.back()" value = "戻る">';
				print '</form>';
			}
		?>
	</body>
</html>
