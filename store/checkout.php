<?php
	require_once('db.php');
?>
<?php
	$errorMsg="";
	if(isset($_POST['checkOut'])){
		$order_unique_id="";
		$order_shipping_cost = clean($_POST['shipping_cost']);
		$order_amount=0;
		$total_amount = 0;
		$order_quntity = 0;
		
		foreach($_SESSION['cart'] as $id => $value){
			$total_amount += $value['total'];
			$order_quntity++;
		}
		$order_amount = $total_amount;
		
		$order_user_id=null;
		$order_user_type=$_POST['shippedRegisterAddress'];
		$flag = false;
		
		if(isset($_SESSION['SESS_USER_ID']) && $order_user_type==1 ){
			$order_user_id = $_SESSION['SESS_USER_ID'];
		}

		if($order_user_type==1 && $order_user_id !=null){
			$flag = true;
		}else{
			
		}
		
		if($order_user_type==2 || $flag==true){
			
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
			
			$order_date = get_current_date();
			
			if($order_user_type==1){
				$sql_for_user = "SELECT * FROM users WHERE UserID='$order_user_id' ";
				$result_for_user = mysql_fetch_array(mysql_query($sql_for_user));
				
				$sql_shipping_cost = "SELECT cost FROM servicearea WHERE district='{$result_for_user[7]}'";
				$shipping_cost_user = mysql_fetch_array(mysql_query($sql_shipping_cost));
				$order_shipping_cost = $shipping_cost_user['cost'];
				
				$order_gust_neme = $result_for_user[1];
				$order_user_email = $result_for_user[2];
				$order_short_address = $result_for_user[16];
				$order_phon = $result_for_user[13];
				$order_country = $result_for_user[15];
				$order_disrict = $result_for_user[7];
				$order_zip = $result_for_user[8];
				$order_mobile = $result_for_user[14];
				$order_detail_address = $result_for_user[17];
			}else{
				//form data
				$order_gust_neme = trim($_POST['fullName']);
				$order_user_email = $_POST['email'];
				$order_short_address = trim($_POST['shortAddress']);
				$order_phon = $_POST['phone'];
				$order_country = $_POST['country'];
				$order_disrict = $_POST['district'];
				$order_zip = $_POST['zip'];
				$order_mobile = $_POST['mobile'];
				$order_detail_address = trim($_POST['detailAddress']);
			}
			
			$sql_for_checkout = "INSERT INTO orders(`OrderUniqueId`, `OrderUserID`, `OrderGuestName`, `OrderAmount`, `OrderQuntity`, `OrderShipName`,`OrderShipAddress`,`OrderCity`, `OrderZip`, `OrderCountry`, `OrderPhone`, `OrderMobile`, `OrderShippingCost`, `OrderEmail`, `OrderDate`,`OrderShipped`) 
											 VALUES('$order_unique_id','$order_user_id','$order_gust_neme','$order_amount','$order_quntity','$order_short_address','$order_detail_address','$order_disrict','$order_zip','$order_country','$order_phon','$order_mobile','$order_shipping_cost','$order_user_email', '$order_date','0')";
			$result=mysql_query($sql_for_checkout);
			
			foreach($_SESSION['cart'] as $id => $value){
				$sql_for_cart = "SELECT ProductName FROM products where ProductID={$value['productid']}";
				$result_for_cart = mysql_query($sql_for_cart);
				$cart_product_detail = mysql_fetch_array($result_for_cart);
				
				$detail_product_name = $cart_product_detail[0];
				$detail_product_id = $value['productid'];
				$detail_price = $value['price'];
				$detail_quntity = $value['quantity'];
				$detail_attribute = $value['attribute'];
				
				$sql_for_order_detail = "INSERT INTO orderdetails(`DetailOrderIDUnique`, `DetailProductID`, `DetailName`, `DetailPrice`, `DetailAttribute`, `DetailQuantity`) 
														   VALUES('$order_unique_id','$detail_product_id','$detail_product_name','$detail_price','$detail_attribute','$detail_quntity') ";
				$result_for_detail = mysql_query($sql_for_order_detail);
				
			}
			unset($_SESSION['cart']);
			windowLocation('index.php');
		}else{
			$errorMsg = "plese login first";
			windowLocation('login.php?msg=plese login first');
		}
		//echo "else";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout | amarfashionbd</title>
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
	
	function submitCheckOutForm(){
		var form = document.getElementById("checkOutForm");

		var userType = form.elements["shippedRegisterAddress"].value;
		if(userType==2){

			var fullName = form.elements["fullName"].value;
			fullName = String(fullName); 
			fullName  = fullName.trim();
			if(fullName.length<5){
				alert('Enter Your Full Name');
				return false;
			}

			var email = form.elements["email"].value;
			email = String(email);
			if(email.length<1){
				alert('Enter Your Email');
				return false;
			}

			var shortAddress = form.elements["shortAddress"].value;
			shortAddress = String(shortAddress); 
			shortAddress  = shortAddress.trim();
			if(shortAddress.length<4){
				//alert('Enter A Valid Short Address');
				//return false;
			}

			var phon = form.elements["mobile"].value;
			phon = String(phon); 
			phon = phon.trim();
			var index = phon.indexOf(".");
			var indexOfMinus = phon.indexOf("-");
			if(index>-1 || phon.length<11 || indexOfMinus>-1 || phon.length>11){
				alert("Enter a valid mobile number");
				return false;
			}

			var country = form.elements["country"].selectedIndex;
			
			if(country<1){
				alert('plese Chose Your Country');
				return false;
			}

			var district = form.elements["district"].selectedIndex;
			
			if(district<1){
				alert('plese Chose Your district');
				return false;
			}

			var longAddress = form.elements["detailAddress"].value;
			longAddress = String(longAddress); 
			longAddress  = longAddress.trim();
			if(longAddress.length<10){
				alert('Enter Address Detaily');
				return false;
			}
		}
		else
			return true;
		//return false;
	}
</script>

</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +8801829913207</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i><strong> luminousfuturebd@gmail.com</strong></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"> <img src="logo/logo.png" alt="" height="120px" width="100%" /> </a>
						</div>
						<div class="btn-group pull-right">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<?php require_once('include/middleMenuBar.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown"><a href="">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php">Products</a></li>
                                    </ul>
                                </li> 
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<?php
		if(isset($_SESSION['cart'])){
	?>
	<section id="cart_items">
		<div class="container">

			<div class="step-one">
				<h2 class="heading">Checkout</h2>
			</div>
			
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($_SESSION['cart'] as $id => $value){
								$sql_for_cart = "SELECT * FROM products where ProductID={$value['productid']}";
								$result_for_cart = mysql_query($sql_for_cart);
								$cart_product_detail = mysql_fetch_array($result_for_cart);
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo $cart_product_detail[10]; ?>" alt="" width="110px" height="110px" ></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $cart_product_detail[2]; ?></a></h4>
								<p><?php echo $value['attribute']; ?></p>
							</td>
							<td class="cart_price">
								<p>৳<?php echo $cart_product_detail[3]; ?></p>
							</td>
							<td class="cart_quantity">
								<p><?php echo $value['quantity']; ?></p>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"> ৳ <?php echo $value['total']; ?></p>
							</td>
						</tr>
						<?php 
							}
						?>
						<?php 
							$total_amount = 0;
							foreach($_SESSION['cart'] as $id => $value){
								$total_amount += $value['total'];
							}
							$grand_total = $total_amount;
						?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>৳<?php echo $grand_total; ?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td id="text_shipping_cost"></td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span id="text_cart_total"></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="checkout-options">
				<h3>Checkout options</h3>
				<p></p>
				<ul class="nav">
					<form name="checkOutForm" id="checkOutForm" method="post" action="" onSubmit="return submitCheckOutForm();">
						<li>
							<label><input type="radio" name="shippedRegisterAddress" value="1">Shipped Register Address</label>
						</li>
						<li>
							<label><input type="radio" name="shippedRegisterAddress" value="2" checked="checked"> Guest Checkout</label>
						</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use <b>Shipped To Register Address</b> And Checkout to easily to your register Address NO need to fill up form again, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-7 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<input type="text" placeholder="Full Name*" name="fullName">
								<input type="email" placeholder="me@example.com*" name="email">
								<input type="text" placeholder="Short Address" name="shortAddress">
								<input type="number" placeholder="Phone Home" name="phone">
							</div>
							<div class="form-two">
								<input type="number" placeholder="Zip / Postal Code " name="zip" min="0" >
								<select name="country">
									<option>-- Country --</option>
									<option>Bangladesh</option>
								</select>
								<select name="district" onChange="load_shipping_cost(this, <?php echo $grand_total ?>);" >
									<option>-- District --</option>
									<?php
										$sql_for_select_dis = " SELECT * FROM  servicearea";
										$rs_for_select_dis = mysql_query($sql_for_select_dis);
										while($dis=mysql_fetch_array($rs_for_select_dis)){
									?>
											<option disId="<?php echo $dis['id']; ?>" value="<?php echo $dis['district']; ?>"> <?php echo $dis['district']; ?> </option>
									<?php	
										}
									?>
								</select>
								+88<input type="number" placeholder="Mobile Phone *" name="mobile">
							</div>
						</div>
					</div>
					<input type="hidden" value="" name="shipping_cost" id="valuefromAjax" >
					<div class="col-sm-5">
						<div class="order-message">
							<p>Detail Address</p>
							<textarea name="detailAddress"  placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea>
						</div>
						<button type="submit" class="btn btn-fefault cart" name="checkOut">
							Continue
						</button>
					</div>
					</form>
				</div>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox" checked="checked"> Cash On Delevary </label>
					</span>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<?php
		}else{
	?>
		<div class="container" style="min-height:532px;">
			<h3>NO PRODUCT IN YOUR Cart!!</h3>
		</div>
	<?php 
		}
	?>
	

	
    <footer id="footer"><!--Footer-->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
					<p class="pull-left">Copyright © amarfashionbd. All rights reserved.</p>
					</div>
					<div>
					<p class="pull-left">Designed by <span><a target="_blank" href="https://www.facebook.com/mohibriyad">RIYAD</a></span></p>
					</div>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	
	<script type="text/javascript">
		function load_shipping_cost(obj, total){
			var area = obj.options[obj.selectedIndex].getAttribute("disId");
    		//alert(area);
    		$.ajax({
			     type: 'post',
			     url: 'get_cost_for_area.php',
			     data: {
			       area_id:area  //variable name : value
			     },
			     success: function (response) {
			       //$('#load_product').html(response);
				   //x="30.5";
				   var cost = Number(response);
				   
				   $('#text_shipping_cost').html('৳'+cost);
				   $('#text_cart_total').html('৳'+(cost+total));
				   $('#valuefromAjax').val(cost);

			     }
			});
    	}
	</script>
	
</body>
</html>