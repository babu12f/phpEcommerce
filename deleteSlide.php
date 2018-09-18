<?php
	require_once('db.php');
?>

<?php
	if(!check_admin() && !check_menager()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>

<?php
	if(isset($_GET['slideId'])){
		$id = $_GET['slideId'];
		$sql_for_delect_slide = "DELETE FROM slider WHERE id={$id} ";
		mysql_query($sql_for_delect_slide);

		redirect_to('slider.php');
	}
?>