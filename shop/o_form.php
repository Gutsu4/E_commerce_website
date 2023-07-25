<!DOCTYPE html>
<html>

	<head>
		<meta charset = "UTF-8">
		<title>商品注文</title>
	</head>

	<body>
		お客様情報を入力してください。<br/><br/>
		<form method = "post" action = "o_form_check.php">
		お名前<br/>
		<input type = "text" name = "onamae" style = "width:200px"><br/>
		メールアドレス<br/>
		<input type = "text" name = "email" style = "width:200px"><br/>
		郵便番号<br/>
		<input type = "text" name = "postal1" style = "width:50px"> -
		<input type = "text" name = "postal2" style = "width:80px"><br/>
		住所<br/>
		<input type = "text" name = "address" style = "width:500px"><br/>
		電話番号<br/>
		<input type = "text" name = "tel" style = "width:150px"><br/><br/>
		
		<input type = "radio" name = "od" value = "not_regi" checked>今回だけの注文<br/>
		<input type = "radio" name = "od" value = "regi">会員登録しての注文<br/>
		<br/>
		※会員登録する方は以下の項目も入力してください。<br/>
		パスワードを入力してください。<br/>
		<input type = "password" name = "pass" style = "width:200px"><br/>
		パスワードをもう一度入力してください。<br/>
		<input type = "password" name = "pass2" style = "width:200px"><br/>
		性別<br/>
		<input type = "radio" name = "gen" value = "male" checked>男性<br/>
		<input type = "radio" name = "gen" value = "female">女性<br/>

		<?php
		print '<select name = "year">';
		print ('<option value="'. '1990' . '" >' . '1990年代'.'</option>');

        for ($i = 1910; $i <=2010; $i++) {
 	       print ('<option value="' . $i. '" >' . $i . '年代'.'</option>');  
        }

		print '</select>';
		?>

		<input type = "submit" value = "OK"><br/>
		</form>
	</body>
</html>
