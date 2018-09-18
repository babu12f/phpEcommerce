<?php
    require_once('db.php');
?>
<?php
	if(isset($_POST['data_email'])){
		$email = $_POST['data_email'];

		$sql_for_check_email = "select * from users where UserEmail='$email' ";
		$result_for_check_email = mysql_fetch_array(mysql_query($sql_for_check_email));

		if($result_for_check_email){
			//echo "<span style='color:red;'>*This Email Id Allready Taken </span>";
			echo "0";
		}else{
			//echo "<span style='color:green;'>Email Taken</span>";
			echo "1";
		}
	}
?>