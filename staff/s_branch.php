<?php

	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login']) == false){
		print 'ログインされていません。<br/>';
		print '<a href = "../staff_login/sl_login.html">ログイン画面へ</a>';
		exit();
	}


	if(isset($_POST['add']) == true){
		header('Location: s_add.php');
		exit();

	}
	else if(isset($_POST['edit']) == true){

		if(isset($_POST['staffcode']) == false){

			header('Location: s_ng.php');
			exit();
		}
	
		$staff_code = $_POST['staffcode'];
		header('Location: s_edit.php?staffcode='.$staff_code);
		exit();

	}
	else if(isset($_POST['delete']) == true){
		
		if(isset($_POST['staffcode']) == false){

			header('Location: s_ng.php');
			exit();
		}

		$staff_code = $_POST['staffcode'];
		header('Location: s_delete.php?staffcode='.$staff_code);
		exit();

	}
	else if(isset($_POST['disp']) == true){

		if(isset($_POST['staffcode']) == false){

			header('Location: s_ng.php');
			exit();
		}

		$staff_code = $_POST['staffcode'];
		header('Location: s_disp.php?staffcode='.$staff_code);
		exit();

	}
	else{
		print 'Unexpected Error';
	}
?>
