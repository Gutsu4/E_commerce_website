<?php
	
	/*年プルダウンリスト関数*/
	function pulldown_year(){
		print '<select name = "year">';
		print '<option value = "2020">2020</option>';
		print '<option value = "2021">2021</option>';
		print '<option value = "2022">2022</option>';
		print '<option value = "2023">2023</option>';
		print '</select>';
	}

    function pulldown_month(){

        print '<select name = "month">';
        for ($i = 1; $i <=12; $i++) {
            
            if ($i < 10) {

                print ('<option value="' .'0'. $i. '">' . '0' . $i . '</option>');

            }else{

                print ('<option value="' . $i. '">' . $i . '</option>');
            }    
        }

		print '</select>';

    }    

    function pulldown_day(){

        print '<select name = "day">';
        for ($i = 1; $i <=31; $i++) {

            if ($i < 10) {

                print ('<option value="' .'0'. $i. '">' . '0'.$i . '</option>');

            }else{

                print ('<option value="' . $i. '">' . $i . '</option>');
            }
        }
		print '</select>';

    } 

?>
