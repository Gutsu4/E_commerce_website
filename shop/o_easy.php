<?php
	session_start();
	session_regenerate_id(true);

    //ログインされていない
	if(isset($_SESSION['member_login']) == false){
		print 'ログインされていません。<br/>';
		print '<a href = "sh_list.php">商品一覧へ</a><br/>';
		exit();
	}

    //ログイン時
    $code = $_SESSION['member_code'];

    //DB接続
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SQL実行
    //氏名、メールアドレス、郵便番号、住所、電話番号を抽出
    $sql = 'SELECT name,email,postal1,postal2,address,tel FROM member_list WHERE code = ?';
    $stmt = $dbh -> prepare($sql);
	$data[0] = $code;
    $stmt -> execute($data);

    //レコードを変数に格納
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

    //DB切断
    $dbh = null;

    //変数にそれぞれ格納
    $onamae = $rec['name'];
    $email = $rec['email'];
    $postal1 = $rec['postal1'];
    $postal2 = $rec['postal2'];
    $address = $rec['address'];
    $tel = $rec['tel'];


    //画面に表示
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
    print substr($tel,0,3). ' - '.substr($tel,3,4).' - '.substr($tel,7,10) .'<br/>';
    print '<br/><br/>';                


    //次の画面に情報を渡す
    /*次ページ処理*/
    print '<form method = "post" action = "easy_done.php">';
        print '<input type="hidden" name="onamae" value="'.$onamae.'">';
        print '<input type="hidden" name="email" value="'.$email.'">';
        print '<input type="hidden" name="postal1" value="'.$postal1.'">';
        print '<input type="hidden" name="postal2" value="'.$postal2.'">';
        print '<input type="hidden" name="address" value="'.$address.'">';
        print '<input type="hidden" name="tel" value="'.$tel.'">';
        print '<input type = "button" onclick = "history.back()" value = "戻る">';
		print '<input type = "submit" value = "確定"><br/>';
	    print '</form>';
?>