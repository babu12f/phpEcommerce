<?php
    require_once('../db.php');
?>
<?php
	$product_found = false;
	$product_index=null;
	$product_id=11;
	if(isset($_SESSION['cart'])){
		$total_product_in_cart = count($_SESSION['cart']);
	}else{
		$total_product_in_cart = 0;
	}
	$next_cart = $total_product_in_cart+1;
		//print_r ($_SESSION['cart']);
		//echo "<br>";
	
	if(isset($_POST['addToCart'])){
		//echo "addToCart is clicked"."<br>";
		
		$product_id = $_POST['product_id'];
		$product_qun = $_POST['product_qun'];
		$product_price = $_POST['product_price'];
		$product_attribute = "";
		
		if(isset($_POST['product_attribute'])){
			$len = count($_POST['product_attribute']);
			for($i=0; $i<$len; $i++){
				$product_attribute .= ucfirst($_POST['product_attribute_name'][$i])." : ";
				$product_attribute .= $_POST['product_attribute'][$i];
				if($i!=$len-1){
					$product_attribute .=", ";
				}
			}
		}
		if(isset($_SESSION['cart'])){
			foreach($_SESSION['cart'] as $id => $value){
				if($value['productid']==$product_id){
					$product_index=$id;
					if( strcmp($_SESSION['cart'][$product_index]['attribute'],$product_attribute)==0){
						$_SESSION['cart'][$product_index]['quantity'] = $_SESSION['cart'][$product_index]['quantity']+$product_qun;
						$_SESSION['cart'][$product_index]['total']=$_SESSION['cart'][$product_index]['quantity']*$product_price;
						$product_found = true;
						break;
					}
				}
			}
		}
		
		if(!$product_found){
			$_SESSION['cart'][$next_cart]=array( 
						"productid" => $product_id,
                        "quantity" => $product_qun, 
                        "price" => $product_price,
						"attribute" => $product_attribute,
						"total" => $product_qun*$product_price
                    );
		}
		//header("Location: cart.php");
		windowLocation('cart.php');
	}
	//echo count($_SESSION['cart']);
	//session_destroy();
	/*foreach($_SESSION['cart'] as $id => $value){
		if($value['productid']==$product_id){
			$product_found = true;
			$product_index=$id;
			echo $product_index."<br>";
			//break;
		}
	}*/
	//echo $_SESSION['cart'][$product_index]['attribute']."<br>";
	//echo strcmp($_SESSION['cart'][$product_index]['attribute'],"green, XXL, blue");
	//session_destroy();
	
	if(isset($_POST['updateCart'])){
		unset($_SESSION['cart']);
		$len = count($_POST['up_quantity']);
		$count = 1;
		for($i=0; $i<$len; $i++){
			//echo $_POST['up_quantity'][$i]." ".$_POST['up_price'][$i]." ".$_POST['up_total'][$i]." ".$_POST['up_attribute'][$i]." ".$_POST['up_productid'][$i]."<br>";
			if($_POST['up_quantity'][$i]>0){
				$_SESSION['cart'][$count]=array( 
						"productid" => $_POST['up_productid'][$i],
                        "quantity" => $_POST['up_quantity'][$i], 
                        "price" => $_POST['up_price'][$i],
						"attribute" => $_POST['up_attribute'][$i],
						"total" => $_POST['up_quantity'][$i]*$_POST['up_price'][$i]
                    );
				$count++;
			}
		}
		//header("Location: cart.php");
		windowLocation('cart.php');
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | AmarFashionbd</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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
					<div class="col-sm-6" >
						<div class="social-icons pull-right">
							
							<ul class="nav navbar-nav"> 
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-skype"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
							<a href="index.php"><img src="../logo/logo.png" alt="" height="120px" width="100%" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<?php require_once('include/middleMenuBar.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle amar kaz seh-->
	
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
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php">Products</a></li>
                                    </ul>
                                </li> 
								
								
								
								<li><a href="contact-us.php">Contact</a></li>
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
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li class="active"><h3>Your Shopping Basket</h3></li>
				</ol>
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
							<td></td>
						</tr>
					</thead>
					<tbody>
						<form id="updataCartForm" class="updataCartForm" name="updataCartForm" method="post" action="">
						<?php 
							foreach($_SESSION['cart'] as $id => $value){
								$sql_for_cart = "SELECT * FROM products where ProductID={$value['productid']}";
								$result_for_cart = mysql_query($sql_for_cart);
								$cart_product_detail = mysql_fetch_array($result_for_cart);
						?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="../<?php echo $cart_product_detail[10]; ?>" alt="" width="110px" height="110px" ></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $cart_product_detail[2]; ?></a></h4>
									<p><?php echo $value['attribute']; ?></p>
								</td>
								<td class="cart_price">
									<p>৳<?php echo $cart_product_detail[3]; ?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="" onclick="return incermentCartProduct(this)" > + </a>
										<input class="cart_quantity_input" type="text" name="up_quantity[]" value="<?php echo $value['quantity']; ?>" autocomplete="off" size="2" />
										<a class="cart_quantity_down" href="" onclick="return decermentCartProduct(this)" > - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">৳<?php echo $value['total']; ?></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="" onclick="return removeCartProduct(this)" ><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<input type="hidden" name="up_productid[]" value="<?php echo $value['productid']; ?>">
							<input type="hidden" name="up_price[]" value="<?php echo $value['price']; ?>">
							<input type="hidden" name="up_total[]" value="<?php echo $value['total']; ?>">
							<input type="hidden" name="up_attribute[]" value="<?php echo $value['attribute']; ?>">
						<?php 
							}
						?>
					</tbody>
				</table>
				
			</div>
		</div>
		<div class="container text-right">
		<?php 
			if(isset($_POST['addToCart'])){
		?>
			<a class="btn btn-default cart" href="" onclick="backToShopping()">Continue Shopping</a>
		<?php 
			}
		?>
			<a href="clear_cart.php" class="btn btn-fefault cart" >
				Clear Cart
			</a>
			<button type="submit" class="btn btn-fefault cart" name="updateCart">
				Update Cart
			</button>
		</div>
		</form>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Cart Summary</h3>
				<p>Not Added your delivery cost.</p>
			</div>
			<?php 
				$total_amount = 0;
				foreach($_SESSION['cart'] as $id => $value){
					$total_amount += $value['total'];
				}
				$grand_total = $total_amount;
			?>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>৳<?php echo $total_amount; ?></span></li>
							<li>Total <span>৳<?php echo $grand_total; ?></span></li>
						</ul>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<?php
		}else{
	?>
		<div class="container" style="min-height:520px;">
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
	


    <script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
    <script type="text/javascript" src="../js/wysiwyg.js"></script>
</body>
</html>