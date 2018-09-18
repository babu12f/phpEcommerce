<?php
	require_once('db.php');
?>
<?php
	if(isset($_POST['area_id'])){
		$area_id = $_POST['area_id'];

		
		$sql_for_load_cost = "SELECT cost from servicearea WHERE id={$area_id}";

		$cost = mysql_fetch_array(mysql_query($sql_for_load_cost));
		
		echo $cost['cost'];
	}
?>