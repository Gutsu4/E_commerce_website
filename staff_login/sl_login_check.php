<?php
	try{

		$staff_code = $_POST['code'];
		$staff_pass = $_POST['pass'];

		$staff_code = htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8');
		$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

		$staff_pass = md5($staff_pass);

		$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn, $user, $password);
		$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT name FROM staff_list WHERE code = ? AND password = ?';

		$stmt = $dbh -> prepare($sql);
		$data[] = $staff_code;
		$data[] = $staff_pass;
		$stmt -> execute($data);

		$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

		$dbh = null;

		if($rec == false){

			print 'スタッフコードが間違っています。<br/>';
			print '<a href = "index.html">戻る</a>';

		}else{

			session_start();		
			$_SESSION['login'] = 1;		
			$_SESSION['staff_code'] = $staff_code;
			$_SESSION['staff_name'] = $rec['name'];

			header('Location: sl_top.php');
			exit();

		}

	}catch(Exception $e){

		print "障害発生中";
		exit();
	}
?>