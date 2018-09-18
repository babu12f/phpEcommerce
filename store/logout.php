<?php
	session_start();
	
	unset($_SESSION["SESS_USER_ID"]);
	unset($_SESSION["SESS_USER_NAME"]);
	unset($_SESSION["ACCESS"]);
	unset($_SESSION["SESS_USER_TYPE"]);
	
	header("location:index.php");
?>