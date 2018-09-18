<?php
	require_once('db.php');
	$sql_catagory="SELECT * FROM productcategories";
	$result_category = mysql_query($sql_catagory);
?>
<?php
	//if alreary loged in

	//session_destroy();
	$errflag = false;
	$errmsg = "";
	
	if(isset($_GET['msg'])){
		$errmsg = clean($_GET['msg']);
	}
	
	if(isset($_POST['login'])){
		//Sanitize the POST values
		$login = clean($_POST['login_UserName']);
		$password = clean($_POST['login_Password']);
		//Input Validations
		if($login == '' || $password == '') {
			$errmsg = 'Login ID OR Password missing';
			$errflag = true;
		}
		if(!$errflag){
			//Create query
			$qry = "SELECT * FROM users WHERE UserEmail='$login' AND UserPassword='$password'";
			$result = mysql_query($qry);
			
			//Check whether the query was successful or not
			if($result) {
				if(mysql_num_rows($result) == 1) {
					//Login Successful
					session_regenerate_id();
					$member = mysql_fetch_array($result);
					$_SESSION['SESS_USER_ID'] = $member['UserID'];
					$_SESSION['SESS_USER_NAME'] = $member['UserEmail'];
					$_SESSION['ACCESS'] = $member['UserType'];
					if($_SESSION['ACCESS']==1){
						$_SESSION['SESS_USER_TYPE'] = "admin";
						redirect_to('ff.php');
						session_write_close();
					}
					else if($_SESSION['ACCESS']==2){
						$_SESSION['SESS_USER_TYPE'] = "maneger";
						redirect_to('ff.php');
						session_write_close();
					}
					else if($_SESSION['ACCESS']==4){
						$_SESSION['SESS_USER_TYPE'] = "s_woner";

						$s_w_id = mysql_fetch_array(mysql_query("select store_id from `store`,`users` WHERE store.store_woner=users.UserID and users.UserID='{$member['UserID']}' "));
						$_SESSION['SESS_S_W_ID'] = $s_w_id['store_id'];
						redirect_to('ff.php');
						session_write_close();
					}
					else{
						$_SESSION['SESS_USER_TYPE'] = "customer";
						redirect_to('index.php');
						session_write_close();
					}
					$errmsg = "successful ".$_SESSION['ACCESS'];
				}else {
					//Login failed
					$errmsg = "User name or Pssword not Match Pleas Try Again";
				}
			}else{
				$errmsg = "User name or Pssword not Match Pleas Try Again";
			}
		}
	}
	
	//sign Up
	
	if(isset($_POST['signUp'])){
		
		$s_fname = clean(trim($_POST['s_fname']));
		$s_lname = clean(trim($_POST['s_lname']));
		$s_fullname = $s_fname." ".$s_lname;
		$s_email = clean(trim($_POST['s_email']));
		$s_pass = clean(trim($_POST['s_pass']));
		$s_passConf = clean(trim($_POST['s_passConf']));
		$s_city = clean(trim($_POST['s_city']));
		$s_district = $_POST['s_district'];
		$s_country = $_POST['s_country'];
		$s_zip = clean(trim($_POST['s_zip']));
		$s_phon_home = clean(trim($_POST['s_phon_home']));
		$s_mobile = clean(trim($_POST['s_mobile']));
		$s_shotAddress = clean(trim($_POST['s_shotAddress']));
		$s_detailAddress = clean(trim($_POST['s_detailAddress']));
		
		$s_user_type = 3;
		if(isset($_POST['s_user_type'])){
			$s_user_type = $_POST['s_user_type'];
		}
		
		
		
		$sql_for_add_user = "INSERT INTO users( `UserFullName`, `UserEmail`, `UserPassword`, `UserFirstName`, `UserLastName`, `UserCity`, `UserDistrict`, `UserZip`, `UserPhone`, `UserMobile`, `UserCountry`, `UserShortAddress`, `UserDetailAddress`, `UserType`) 
									    VALUES( '$s_fullname', '$s_email', '$s_pass', '$s_fname', '$s_lname', '$s_city', '$s_district', '$s_zip', '$s_phon_home', '$s_mobile', '$s_country', '$s_shotAddress', '$s_detailAddress', '$s_user_type')";
		$rs_for_add_user = mysql_query($sql_for_add_user);	
		
		redirect_to('index.php');
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | amarfashionbd</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
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
<script type="text/javascript" src="https://gc.kis.scr.kaspersky-labs.com/1B74BD89-2A22-4B93-B451-1C9E1052A0EC/main.js" charset="UTF-8"></script>

<script type="text/javascript">
	function _(id){
		return document.getElementById(id);
	}
	function validateSignUpForm(){
		
		var form = document.getElementById("signUpForm");
		var errorFlag = true;

		var fname = form.elements["s_fname"].value;
		var lname = form.elements["s_lname"].value;
		var email = form.elements["s_email"].value;
		var email_pass = form.elements["email_valid_or_not"].value;
		var pass = form.elements["s_pass"].value;
		var pasConf = form.elements["s_passConf"].value;
		var city = form.elements["s_city"].value;
		var district = form.elements["s_district"].selectedIndex;
		var county = form.elements["s_country"].selectedIndex;
		var mobile = form.elements["s_mobile"].value;
		var detailAddress = form.elements["s_detailAddress"].value;

		fname = String(fname);
		fname = fname.trim();

		if(fname.length<3){
			errorFlag = false;
			document.getElementById("s_fname_err").innerHTML = "* Plese Enter a valid name";
		}else{
			document.getElementById("s_fname_err").innerHTML = "";
		}

		email = String(email);
		if(email.length<1 || email_pass==0){
			errorFlag = false;
			_("s_email_err").innerHTML = "* Plese Enter A valid Email";
		}else{
			_("s_email_err").innerHTML = "";
		}

		pass = String(pass);
		if(pass.length<4){
			errorFlag = false;
			_("s_pass_err").innerHTML = "* Password Must Be 4 Character";
		}else{
			if(pass != pasConf){
				errorFlag = false;
				_("s_pass_err").innerHTML = "* Password did not Match";
			}else{
				_("s_pass_err").innerHTML = "";
			}
		}

		city = String(city);
		city = city.trim();

		if(city.length<3){
			errorFlag = false;
			_("s_city_err").innerHTML = "* Plese Enter A Valid City"
		}else{
			_("s_city_err").innerHTML = "";
		}

		if(district<1){
			errorFlag = false;
			_("s_district_err").innerHTML = "* Select District"
		}else{
			_("s_district_err").innerHTML = "";
		}
		if(county<1){
			errorFlag = false;
			_("s_country_err").innerHTML = "* Plese Select Country";
		}else{
			_("s_country_err").innerHTML = "";
		}

		mobile = String(mobile); 
		mobile = mobile.trim();
		var index = mobile.indexOf(".");
		var indexOfMinus = mobile.indexOf("-");
		if(index>-1 || mobile.length<11 || indexOfMinus>-1 || mobile.length>11){
			errorFlag = false;
			_("s_mobile_err").innerHTML = "* Plese Enter A Valid Mobile Number";
		}else{
			_("s_mobile_err").innerHTML = "";
		}

		detailAddress = String(detailAddress); 
		detailAddress  = detailAddress.trim();
		if(detailAddress.length<10){
			errorFlag = false;
			_("s_detailAddress_err").innerHTML = "* Plese Enter Detail Address";
		}else{
			_("s_detailAddress_err").innerHTML = "";
		}




		return errorFlag;
	}
</script>

<script>
	function check_email_valid(val){
	    if(!val.match(/\S+@\S+\.\S+/)){ 
	        return false;
	    }
	    if( val.indexOf(' ')!=-1 || val.indexOf('..')!=-1){
	        return false;
	    }
	    return true;
	}

	function signUpCheckEmail(email){

		if(check_email_valid(email)){

			$.ajax({
			     type: 'post',
			     url: 'ajax_check_emal.php',
			     data: {
			       data_email:email  //variable name : value
			     },
			     success: function (response) {
			     	if(response=="0"){
			     		_("email_valid_or_not").value = 0;
			     		$('#s_email_err').html("<span style='color:red;'> * This Email Id Allready Taken </span>");
			     	}else{
			     		_("email_valid_or_not").value = 1;
			     		$('#s_email_err').html("<span style='color:green;'> Email Taken</span>");
			     	}
			       //$('#s_email_err').html(response);
			     }
			});

		}else{
			_("email_valid_or_not").value = 0;
			$('#s_email_err').html("* Enter A valid Emails");
		}

	}
</script>

</head><!--/head-->

<body>
<?php //pf($_SESSION); ?>
	<?php require_once('include/header.php'); ?>
	
	<div class="container">
		<?php 
			if($errmsg != ""){ 
		?>
			<div class="alert alert-danger" role="alert"><p><?php echo $errmsg; ?></p></div>
		<?php 
			}
		?>
	</div>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form id="loginForm" name="loginForm" method="post" action="" >
							<input type="text" name="login_UserName" placeholder="User Name/ Email" />
							<input type="password" name="login_Password" placeholder="Password" />
							<button type="submit" name="login" class="btn btn-default">Login</button>
						</form>
						<span><a href="">Forgot Password?</a></span>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="" id="signUpForm" name="signUpForm" method="post" onSubmit="return validateSignUpForm();" >
							
							<span id="s_fname_err" style="color:red;"></span>
							<input type="text" name="s_fname" placeholder="First Name"/>

							<span id="s_lname_err" style="color:red;"></span>
							<input type="text" name="s_lname" placeholder="Last Name"/>

							<span id="s_email_err" style="color:red;"></span>
							<input type="email" name="s_email" placeholder="Email Address" onfocusout="signUpCheckEmail(this.value);" />
							
							<input type="hidden" name="email_valid_or_not" id="email_valid_or_not" value="0">
							
							<input type="password" name="s_pass" placeholder="Password"/>
							
							<span id="s_pass_err" style="color:red;"></span>
							<input type="password" name="s_passConf" placeholder="Retype Password"/>
							
							<span id="s_city_err" style="color:red;"></span>
							<input type="text" name="s_city" placeholder="Your City"/>
							
							<span id="s_district_err" style="color:red;"></span>
							<select name="s_district" style="margin-bottom:10px">
								<option>-- District --</option>
								<?php
									$sql_for_select_dis = " SELECT * FROM  servicearea";
									$rs_for_select_dis = mysql_query($sql_for_select_dis);
									while($dis=mysql_fetch_array($rs_for_select_dis)){
										echo'<option value="'.$dis['district'].'">'.$dis['district'].'</option>';
									}
								?>
							</select>
							
							<span id="s_country_err" style="color:red;"></span>
							<select name="s_country" style="margin-bottom:10px">
								<option>-- Country --</option>
								<option>Bangladesh</option>
							</select>
							
							<input type="text" name="s_zip" placeholder="Zip Code"/>
							
							<input type="number" name="s_phon_home" placeholder="Phon Home" min="0"/>
							
							<span id="s_mobile_err" style="color:red;"></span>
							<input type="number" name="s_mobile" placeholder="Mobile" min="0" />
							
							<input type="text" name="s_shotAddress" placeholder="Short Address"/>
							
							<span id="s_detailAddress_err" style="color:red;"></span>

							<?php
								if(check_admin()){
							?>
								<select name="s_user_type" style="margin-bottom:10px">
									<option value="2">Menager</option>
									<option value="3">Customer</option>
								</select>
							<?php
								}
							?>
							
							<textarea name="s_detailAddress" rows="4" placeholder="Detail Address" style="margin-bottom:10px" ></textarea>
							
							<button type="submit" name="signUp" class="btn btn-default">Signup</button>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<?php require_once('include/footer.php'); ?>
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

</body>
</html>