<?php
    require_once('db.php');
	
	$sql_catagory="SELECT * FROM productcategories";
	$result_category = mysql_query($sql_catagory);
?>
<?php
	$error_msg = "";
	
	if(isset($_GET['msg'])){
		$error_msg = $_GET['msg'];
	}
?>
<?php
	if(is_login()){
		$profile_usr_id = $_SESSION['SESS_USER_ID'];
		
		$sql_for_profile_usr = "SELECT * FROM users WHERE UserID={$profile_usr_id}";
		$profile_usr_detail = mysql_fetch_array(mysql_query($sql_for_profile_usr));
		
		$sql_for_select_dis = " SELECT * FROM  servicearea";
		$rs_for_select_dis = mysql_query($sql_for_select_dis);
		
	}else{
		windowLocation('index.php');
	}
	
	if(isset($_POST['updateProfile']) && is_login() ){
		
		$prof_edit_flag = true;
		
		$prof_fname = clean(trim($_POST['prof_fname']));
		$prof_lname = clean(trim($_POST['prof_lname']));
		$prof_fullname = $prof_fname." ".$prof_lname;
		$prof_email = clean(trim($_POST['prof_email']));
		$prof_old_pass = clean($_POST['prof_old_pass']);
		$prof_new_pass = clean(trim($_POST['prof_new_pass']));
		$prof_new_passConf = clean(trim($_POST['prof_new_pass_conf']));
		$prof_city = clean(trim($_POST['prof_city']));
		$prof_district = $_POST['prof_district'];
		$prof_country = $_POST['prof_country'];
		$prof_zip = clean(trim($_POST['prof_zip']));
		$prof_phon_home = clean(trim($_POST['prof_phon_home']));
		$prof_mobile = clean(trim($_POST['prof_mobile']));
		$prof_shotAddress = clean(trim($_POST['prof_short_address']));
		$prof_detailAddress = clean(trim($_POST['prof_detail_address']));
		
		if($prof_new_pass || $prof_new_passConf){
			if($prof_old_pass == $profile_usr_detail['UserPassword']){
				if($prof_new_pass != $prof_new_passConf){
					$prof_edit_flag = false;
				}
			}else{
				$prof_edit_flag = false;
			}
		}else{
			$prof_new_pass = $profile_usr_detail['UserPassword'];
		}
		
		if($prof_edit_flag){
			$sql_for_update_profile = "UPDATE users SET
									   UserFullName = '$prof_fullname', 
									   UserEmail = '$prof_email', 
									   UserPassword = '$prof_new_pass', 
									   UserFirstName = '$prof_fname', 
									   UserLastName = '$prof_lname', 
									   UserCity = '$prof_city', 
									   UserDistrict = '$prof_district', 
									   UserZip = '$prof_zip', 
									   UserPhone = '$prof_phon_home', 
									   UserMobile = '$prof_mobile', 
									   UserCountry = '$prof_country', 
									   UserShortAddress = '$prof_shotAddress', 
									   UserDetailAddress = '$prof_detailAddress' 
									   WHERE UserID = {$profile_usr_id} ";
			
			$rs_for_update_profile = mysql_query($sql_for_update_profile,$con);
			
			windowLocation('my_acount.php?msg=Acount Update Successfull');
		}else{
			$url = "my_acount.php?msg=password did not match !!!";
			windowLocation($url);
		}
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | edit profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<style>
		.form-control:focus {
			border-color: #fff;
			outline: 0;
			-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6);
			box-shadow: inset 0 1px 1px rgba(222, 207, 207, 0.88),0 0 8px rgba(255, 255, 255, 0.42);
			background-color: rgb(66, 139, 202);
			color: #fff;
		}
		.riyad {
			background: rgba(11, 26, 130, 0.25);
			margin-top: 20px;
			padding-top: 8px;
			padding-right: 5px;
			border-radius: 5px;
        }
		.but-save button {
			width: 178px;
			margin-top: 20px;
			background-color: #6470F9;
			color: #fff;
			font-weight: bold;
		}
		.riyad h2 {
			color: #fff;
			text-transform: uppercase;
			text-shadow:5px 4px 8px  rgba(39, 0, 255, 0.88);
		}
		h4 a:hover{
			color:#fff;
		}
	</style>
	
	</head><!--/head-->
<body>
	<?php require_once('include/header.php'); ?>
	
	<div class="container">
		<?php 
			if($error_msg != ""){ 
		?>
				<div class="alert alert-success" role="alert"><p><?php echo $error_msg; ?></p></div>
		<?php 
			}
		?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="riyad">
					<h2 class="text-center"> Profile</h2>
					<form id="updateProfile_form" name="updateProfile_form" method="post" action="" class="updateProfile_form" >
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>First name </a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" name="prof_fname" class="form-control" value="<?php echo $profile_usr_detail['UserFirstName']; ?>" >
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Last name </a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" name="prof_lname" class="form-control" value="<?php echo $profile_usr_detail['UserLastName']; ?>" aria-describedby="basic-addon2">
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Email address</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="email" name="prof_email" class="form-control" value="<?php echo $profile_usr_detail['UserEmail']; ?>" aria-describedby="basic-addon2">
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Old Password</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="Password" name="prof_old_pass" class="form-control" aria-describedby="basic-addon2">
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a> New Password</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="Password" name="prof_new_pass" class="form-control" >
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Conf New Password</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="Password" name="prof_new_pass_conf" class="form-control" aria-describedby="basic-addon2">
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Your city</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" name="prof_city" class="form-control" value="<?php echo $profile_usr_detail['UserCity']; ?>" aria-describedby="basic-addon2">
								<a href="#l" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>District</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group-btn">
								<select class="selectpicker" name="prof_district" >
									<?php
										while($dis=mysql_fetch_array($rs_for_select_dis)){
											$dis_name = $dis['district'];
											
											if($dis_name != $profile_usr_detail['UserDistrict']){
												echo'<option value="'.$dis_name.'">'.$dis_name.'</option>';
											}else{
												echo'<option selected value="'.$dis_name.'">'.$dis_name.'</option>';
											}
											
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>country</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group-btn">
								<select class="selectpicker" name="prof_country" >
									<option value="Bangladesh" >Bangladesh</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Zip code</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="number" name="prof_zip" class="form-control" value="<?php echo $profile_usr_detail['UserZip']; ?>" aria-describedby="basic-addon2">
								<a href="#" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Phone home</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="number" name="prof_phon_home" class="form-control" value="<?php echo $profile_usr_detail['UserPhone']; ?>" aria-describedby="basic-addon2">
								<a href="#" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Mobile no</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<input type="number" name="prof_mobile" class="form-control" value="<?php echo $profile_usr_detail['UserMobile']; ?>" aria-describedby="basic-addon2">
								<a href="#" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Short address</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<textarea type="number" name="prof_short_address" class="form-control" aria-describedby="basic-addon2"><?php echo $profile_usr_detail['UserShortAddress']; ?></textarea>
								<a href="#" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h4 class="text-center"><a>Detail address</a></h4>
						</div>
						<div class="col-md-7">
							<div class="input-group">
								<textarea type="number" name="prof_detail_address" class="form-control" aria-describedby="basic-addon2"><?php echo $profile_usr_detail['UserDetailAddress']; ?></textarea>
								<a href="#" class="input-group-addon" id="basic-addon2"><i class="fa fa-edit"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="but-save text-center">
							<button type="submit" name="updateProfile" class="btn btn-Success">save & change</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
	<?php require_once('include/footer.php'); ?>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>