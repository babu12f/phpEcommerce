<?php
	session_start();
	
	unset($_SESSION["SESS_USER_ID"]);
	unset($_SESSION["SESS_USER_NAME"]);
	unset($_SESSION["ACCESS"]);
	unset($_SESSION["SESS_USER_TYPE"]);
	unset($_SESSION["SESS_S_W_ID"]);
	
	header("location:index.php");
?>