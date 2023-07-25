<?php
	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login']) == false){
		print 'ログインされていません。<br/>';
		print '<a href = "../staff_login/sl_login.html">ログイン画面へ</a>';
		exit();
	}

	if(isset($_POST['add']) == true){
		header('Location: p_add.php');
		exit();

	}
	else if(isset($_POST['edit']) == true){

		if(isset($_POST['p_code']) == false){

			header('Location: p_ng.php');
			exit();
		}
	
		$p_code = $_POST['p_code'];
		header('Location: p_edit.php?p_code='.$p_code);
		exit();

	}
	else if(isset($_POST['delete']) == true){
		
		if(isset($_POST['p_code']) == false){

			header('Location: p_ng.php');
			exit();
		}

		$p_code = $_POST['p_code'];
		header('Location: p_delete.php?p_code='.$p_code);
		exit();

	}
	else if(isset($_POST['disp']) == true){

		if(isset($_POST['p_code']) == false){

			header('Location: p_ng.php');
			exit();
		}

		$p_code = $_POST['p_code'];
		header('Location: p_disp.php?p_code='.$p_code);
		exit();

	}
	else{
		print 'Unexpected Error';
	}
?>
