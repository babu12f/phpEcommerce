<?php
	require_once('db.php');
	
	$id = clean($_GET['id']);
	if(!check_admin() && !check_menager()){
		redirect_to('login.php?msg=Plese Login First');
	}
	
	mysql_query("delete from store where store_id='{$id}'");

	windowLocation('all_store.php');


?>