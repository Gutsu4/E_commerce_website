<?php
	try{

		$member_code = $_POST['email'];
		$member_pass = $_POST['pass'];

		$member_code = htmlspecialchars($member_code, ENT_QUOTES, 'UTF-8');
		$member_pass = htmlspecialchars($member_pass, ENT_QUOTES, 'UTF-8');

		$member_pass = md5($member_pass);

		$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn, $user, $password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT code,name FROM member_list WHERE email = ? AND password = ?';

		$stmt = $dbh -> prepare($sql);
		$data[] = $member_code;
		$data[] = $member_pass;
		$stmt -> execute($data);

		$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

		$dbh = null;

		if($rec == false){

			print '電子メールアドレスが間違っています。<br/>';
			print '<a href = "member_login.html">戻る</a>';

		}else{

			session_start();		
			$_SESSION['member_login'] = true;		
			$_SESSION['member_code'] = $rec['code'];
			$_SESSION['member_name'] = $rec['name'];

			header('Location: sh_list.php');
			exit();

		}

	}catch(Exception $e){

		print "障害発生中";
		exit();
	}
?>