<?php
    session_start();
    session_regenerate_id(true);

    $max = $_POST['max'];

    for($i = 0;$i < $max; $i++){

        if(preg_match("/\A[0-9]+\z/", $_POST['kazu'. $i]) == 0){
            print '数量に誤りがあります。';
            print '<a href = "sh_cartshow.php"><br/>カートに戻る</a>';
            exit();
        }
        
        if($_POST['kazu'.$i] < 1 || 100 < $_POST['kazu'.$i]){
            print '数量は1個以上、100個までです。';
            print '<a href = "sh_cartshow.php"><br/>カートに戻る</a>';
            exit();
        }

        $kazu[] = $_POST['kazu'.$i];
    }

    $cart = $_SESSION['cart'];

    for($i = $max; 0 <= $i; $i--){

        if(isset($_POST['sakujo'.$i]) == true){
            array_splice($cart,$i,1);
            array_splice($kazu,$i,1);

        }

    }

    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

    header('Location: sh_cartshow.php');
    exit();

?>