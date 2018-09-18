<?php
	session_start();
	$con = mysql_connect("localhost","root","");
	 if (!$con){
	 	die('Could not connect: ' . mysql_error());
	 }
	 $db=mysql_select_db("bsm", $con);
	 
	 //real skip function
	 function MS($str){
		$str= mysql_real_escape_string($str);
		return $str;
	 }
	 function pf($data){
	 	echo "<pre>";
	 	print_r($data);
	 	echo "</pre>";
	 }
	 
	 //set default time zone 

	date_default_timezone_set('Asia/Dhaka');
	//date_default_timezone_set('Europe/Berlin');

	 
	 //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
		    exit;
		}
	}
	function is_login(){
		if(isset($_SESSION['SESS_USER_ID'])){
			return true;
		}else{
			return false;
		}
	}
	function check_admin(){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==1){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}	
	function check_menager(){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==2){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function check_store_woner(){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==4){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function p_woner($pid){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==4){
				$r = mysql_fetch_array(mysql_query("SELECT product_store FROM products WHERE ProductID='{$pid}' and product_store='{$_SESSION['SESS_S_W_ID']}'"));
				if($r){
					return true;
				}else{
					return false;
				}
			}
		}
	}

	function getstoreid(){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==4){
				return $_SESSION['SESS_S_W_ID'];
			}
		} 
	}

	function getstorename(){
		if(isset($_SESSION['ACCESS'])){
			if($_SESSION['ACCESS']==4){
				return mysql_fetch_array(mysql_query("SELECT `store_name` FROM `store` where `store_woner`='{$_SESSION['SESS_USER_ID']}'"))[0];
			}else{
				return "";
			}
		}
	}
	
	//functon for java script

	function createJSalert($msg){
		return "<script> alert('{$msg}'); </script>";
		
	}
	
	function windowLocation($location){
		$loc = "<script>";
		$loc .= "self.location='{$location}'";
		$loc .= "</script>";
		
		echo $loc;
	}

	function count_all_form_table($table_name){

		$sql="SELECT COUNT(*) as num FROM {$table_name}";

		$total_pages = mysql_fetch_array(mysql_query($sql));
		$total_pages = $total_pages[0];
		return $total_pages;
	}

	function countAllProduct($id=NULL){
		$total_pages=null;
		if($id!=NULL){
			$sql="SELECT COUNT(*) as num FROM `productcat` INNER JOIN `products` ON products.ProductID = productcat.ProductID INNER JOIN `productcategories` ON productcategories.categoryID = productcat.categoryId WHERE productcat.categoryId={$id}";
			
			$total_pages = mysql_fetch_array(mysql_query($sql));
			$total_pages = $total_pages[0];

		}
		else{
			$sql="SELECT COUNT(*) as num FROM `products`";

			$total_pages = mysql_fetch_array(mysql_query($sql));
			$total_pages = $total_pages[0];
		}
		return $total_pages;
	}
	
	function getUniqueproductID(){
		$sql_for_data_date = "SELECT date FROM namegenarate WHERE id=1";
		$result_for_data_date = mysql_fetch_array(mysql_query($sql_for_data_date));
		
		$data_date = $result_for_data_date[0];
		$today_date = date("Y-m-d");
		
		if($data_date==$today_date){
			$sql_for_file_name = "SELECT ProductIdGenarate  FROM namegenarate WHERE id=1";
			$result_for_file_name = mysql_fetch_array(mysql_query($sql_for_file_name));
			
			$fileAutoName = $result_for_file_name[0]+1;
			
			$sql_for_updata_data = "UPDATE namegenarate SET ProductIdGenarate = '$fileAutoName'  WHERE id = 1";
			mysql_query($sql_for_updata_data);
		}else{
			$sql_for_updata_data = "UPDATE namegenarate SET date = '$today_date' , ProductIdGenarate = 1 WHERE id = 1";
			mysql_query($sql_for_updata_data);
			$fileAutoName = 1;
		}
		//echo $fileAutoName."<br>";
		$d=date("Ymd");
		$fileName = $d.$fileAutoName;

		return $fileName;
	}

	function getUniqueorderID(){
		$sql_for_data_date = "SELECT date FROM namegenarate WHERE id=1";
			$result_for_data_date = mysql_fetch_array(mysql_query($sql_for_data_date));
			
			$data_date = $result_for_data_date[0];
			$today_date = date("Y-m-d");
			$fileAutoName = 1;
			
			if($data_date==$today_date){
				$sql_for_file_name = "SELECT OrderUniqueId  FROM namegenarate WHERE id=1";
				$result_for_file_name = mysql_fetch_array(mysql_query($sql_for_file_name));
				
				$fileAutoName = $result_for_file_name[0]+1;
				
				$sql_for_updata_data = "UPDATE namegenarate SET OrderUniqueId = '$fileAutoName'  WHERE id = 1";
				mysql_query($sql_for_updata_data);
			}else{
				$sql_for_updata_data = "UPDATE namegenarate SET date = '$today_date' , OrderUniqueId = '1' WHERE id = 1";
				mysql_query($sql_for_updata_data);
			}
			$d=date("Ymd");
			$order_unique_id = $d.$fileAutoName;

			return $order_unique_id;
	}
	
	function del_all_product_attr($id){
		
		$product_id = $id;
		
		$sql_del_form_cat = " DELETE FROM productcat WHERE ProductId= {$product_id} ";
		$rs_del_from_cat = mysql_query($sql_del_form_cat);

		$sql_del_from_imge = " DELETE FROM productimage WHERE productId= '$product_id' ";
		$rs_del_from_image = mysql_query($sql_del_from_imge);

		$sql_del_form_opg = " DELETE FROM productoption WHERE productId= {$product_id} ";
		$rs_del_from_opg = mysql_query($sql_del_form_opg);
		
	}
	
	//date functon
	function datetime_to_text($datetime="") {
	  	$unixdatetime = strtotime($datetime);
	  	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
	}
	
	function get_current_date(){
		$d = strtotime("NOW");
		$current_date = date("Y-m-d H:i:s",$d);
		
		return $current_date;
	}






?>