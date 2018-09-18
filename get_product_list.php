<?php
	require_once('db.php');
?>
<?php
	if(isset($_POST['get_option'])){
		$category_id = $_POST['get_option'];

		
		$sql_for_load_product = "SELECT products.ProductID, products.ProductName FROM `productcat` ";
		$sql_for_load_product.=	"INNER JOIN `products` ON products.ProductID = productcat.ProductID ";
		$sql_for_load_product.=	"INNER JOIN `productcategories` ON productcategories.categoryID = productcat.categoryId ";
		$sql_for_load_product.=	"WHERE productcat.categoryId={$category_id} ";

		$result_load_product = mysql_query($sql_for_load_product);
		
		echo "<option style='display:none;'></option>";
		
		while ($result = mysql_fetch_array($result_load_product)) {

			echo "<option value='$result[0]'>{$result[1]}</option>";

		}


	}
?>