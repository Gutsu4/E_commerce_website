<!DOCTYPE html>
<html>

	<head>
		<meta charset = "UTF-8">
		<title>商品注文</title>
	</head>

	<body>
		<?php

			/*フラグ変数*/
			$flg = true;
			$od_flg = false;
			
			/*値受取と同時にエスケープ処理*/
			$onamae = htmlspecialchars($_POST['onamae'], ENT_QUOTES, 'UTF-8');	
			$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
			$postal1 = htmlspecialchars($_POST['postal1'], ENT_QUOTES, 'UTF-8');	
			$postal2 = htmlspecialchars($_POST['postal2'], ENT_QUOTES, 'UTF-8');
			$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
			$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
			$pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
			$pass2 = htmlspecialchars($_POST['pass2'], ENT_QUOTES, 'UTF-8');
			$od = htmlspecialchars($_POST['od'], ENT_QUOTES, 'UTF-8');
			$gen = htmlspecialchars($_POST['gen'], ENT_QUOTES, 'UTF-8');
			$born_year = htmlspecialchars($_POST['year'], ENT_QUOTES, 'UTF-8');

			/*名前チェック*/
			if($onamae == ''){
				print 'お名前が入力されていません。<br/><br/>';
				$flg = false;
			}
			
			/*メールアドレスチェック*/
			if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0){
				print 'メールアドレスを正確に入力してください。<br/><br/>';
				$flg = false;
			}
		
			/*郵便番号チェック*/
			if(preg_match('/\A[0-9]+\z/', $postal1) == 0 || preg_match('/\A[0-9]+\z/',$postal2) == 0){
				print '郵便番号は半角英数字で入力してください。<br/><br/>';
				$flg = false;
			}

			/*住所チェック*/
			if($address == ''){
				print '住所が入力されていません。<br/><br/>';
				$flg = false;
			}

			/*電話番号チェック*/
			if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0){
				print '電話番号を正確に入力してください。<br/><br/>';
				$flg = false;
			}

			/*登録するかチェック*/ 
			if($od == 'regi'){
				$od_flg = true;

				if($pass == ''){
					print 'パスワードが入力されていません<br/>';
					$flg = false;
				}
				
				if($pass != $pass2){
					print 'パスワードが一致しません<br/>';
					$flg = false;
				}


			}else{
				$od_flg = false;
			}
			

			/*分岐*/
			if($flg == true){

				/*情報表示*/
				print 'お名前<br/>';
				print $onamae;
				print '<br/><br/>';
				print 'メールアドレス<br/>';
				print $email;
				print '<br/><br/>';
				print '郵便番号<br/>';
				print $postal1;
				print ' - ';
				print $postal2;
				print '<br/><br/>';
				print '住所<br/>';
				print $address;
				print '<br/><br/>';
				print '電話番号<br/>';
				print $tel;
				print '<br/><br/>';
				print '会員登録を行う<br/>';

				/*登録情報を表示*/
				if($od_flg == true){
					print 'はい<br/>';
				}else{
					print 'いいえ<br/>';
				}
				print '<br/><br/>';
				print '性別<br/>';
				if($gen == "male"){
					print '男性<br/>';
				}else{
					print '女性<br/>';
				}
				print '<br/><br/>';
				print '生まれ年<br/>';
				print $born_year;
				print '<br/><br/>';

				

			
				/*次ページ処理*/
				print '<form method = "post" action = "o_form_done.php">';
				print '<input type="hidden" name="onamae" value="'.$onamae.'">';
				print '<input type="hidden" name="email" value="'.$email.'">';
				print '<input type="hidden" name="postal1" value="'.$postal1.'">';
				print '<input type="hidden" name="postal2" value="'.$postal2.'">';
				print '<input type="hidden" name="address" value="'.$address.'">';
				print '<input type="hidden" name="tel" value="'.$tel.'">';
				
				print '<input type="hidden" name="gen" value="'.$gen.'">';
				print '<input type="hidden" name="pass" value="'.$pass.'">';
				print '<input type="hidden" name="od" value="'.$od.'">';
				print '<input type="hidden" name="year" value="'.$born_year.'">';

				print '<input type = "button" onclick = "history.back()" value = "戻る">';
				print '<input type = "submit" value = "確定"><br/>';
				print '</form>';
			}
			else{
				print '<form>';
				print '<input type = "button" onclick = "history.back()" value = "戻る">';
				print '</form>';
			}
		?>
		
	</body>
</html>
