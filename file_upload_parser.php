<?php
	require_once('db.php');
?>
<?php 
	$fileAutoName = 1;

	$fileName = $_FILES["file1"]["name"];
	$fileTmpLoc = $_FILES["file1"]["tmp_name"];
	$fileType = $_FILES["file1"]["type"];
	$fileSize = $_FILES["file1"]["size"];
	$fileErrorMsg = $_FILES["file1"]["error"];
	
	$fileExtension = pathinfo($fileName);
	$fileExtension = $fileExtension["extension"];
	

	$sql_for_data_date = "SELECT date FROM namegenarate WHERE id=1";
	$result_for_data_date = mysql_fetch_array(mysql_query($sql_for_data_date));
	
	$data_date = $result_for_data_date[0];
	$today_date = date("Y-m-d");
	
	if($data_date==$today_date){
		$sql_for_file_name = "SELECT imageName  FROM namegenarate WHERE id=1";
		$result_for_file_name = mysql_fetch_array(mysql_query($sql_for_file_name));
		
		$fileAutoName = $result_for_file_name[0]+1;
		
		$sql_for_updata_data = "UPDATE namegenarate SET imageName = '$fileAutoName'  WHERE id = 1";
		mysql_query($sql_for_updata_data);
	}else{
		$sql_for_updata_data = "UPDATE namegenarate SET date = '$today_date' , imageName = '1' WHERE id = 1";
		mysql_query($sql_for_updata_data);
	}
	//echo $fileAutoName."<br>";
	$d=date("Ymd");
	$fileName = $d.$fileAutoName.".".$fileExtension;
	
	if(!$fileTmpLoc){
		echo "ERROR: Plese brows for a fole before clicking the upload Button";
		exit();
	}
	if(move_uploaded_file($fileTmpLoc,"images/$fileName")){
		echo "images/$fileName";
	}
	else {
		echo"move_upload_file function failed";
	}
	
?>