<?php
    require_once('db.php');
?>
<?php
	if(!check_admin() && !check_menager() && !check_store_woner()){
		windowLocation('login.php?msg=Plese Login First');
	}
?>
<?php
	if(isset($_GET['pid'])){
		$product_id = clean($_GET['pid']);

		$sql_del_from_product = "DELETE FROM products WHERE ProductID= {$product_id} ";
		$rs_del_from_product = mysql_query($sql_del_from_product);

		$sql_del_form_cat = " DELETE FROM productcat WHERE ProductId= {$product_id} ";
		$rs_del_from_cat = mysql_query($sql_del_form_cat);

		$sql_del_from_imge = " DELETE FROM productimage WHERE productId= {$product_id} ";
		$rs_del_from_image = mysql_query($sql_del_from_imge);

		$sql_del_form_opg = " DELETE FROM productoption WHERE productId= {$product_id} ";
		$rs_del_from_opg = mysql_query($sql_del_form_opg);

		$pre = "<script>";
		$pre .= "history.go(-2);";
		$pre .= "</script>";

		echo $pre;
		
		header('Location: index.php');
	}

?>