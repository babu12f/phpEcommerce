<?php
    require_once('db.php');
    require_once('pagination.php');
?>

<?php
    $sql_catagory="SELECT * FROM productcategories";
	$result_category = mysql_query($sql_catagory);
	
	$sql_products="SELECT * FROM products";
	$result_products = mysql_query($sql_products);
	
	//$category_id=6;
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$category_id = clean($_GET['id']);
	}
	else{
		redirect_to('index.php');
	}
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = 12;
	$total_count = countAllProduct($category_id);
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	$sql_main = "SELECT products.* FROM `productcat` ";
	$sql_main .= "INNER JOIN `products` ON products.ProductID = productcat.ProductID ";
	$sql_main .= "INNER JOIN `productcategories` ON productcategories.categoryID = productcat.categoryId ";
	$sql_main .= "WHERE productcat.categoryId={$category_id} ";
	$sql_main .= "ORDER BY products.ProductUpdateDate DESC ";
	$sql_main.=	"LIMIT {$per_page} ";
	$sql_main.=	"OFFSET {$pagination->offset()}";
	
	//echo $total_count;
	$result_catProduct=mysql_query($sql_main);
	/*while($d=mysql_fetch_array($result_catProduct)){
		echo $d[0];
	}*/
	$sql_search="SELECT CategoryName FROM productcategories where CategoryID={$category_id}";
	$result_search = mysql_query($sql_search);
	$result_search = mysql_fetch_array($result_search);
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop |amarfashionbd</title>
	<!--bootstrap-->
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom css for template -->
    <link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="elusive-icons/css/elusive-icons.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!--end bootstrap-->
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
								<li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php" class="active">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li>  
                                    </ul>
                                </li> 
								
								<li><a href="contact-us.html">Contact us</a></li>
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
			</div>
	</header>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
								while($d = mysql_fetch_array($result_category)){
							?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href='shop.php?id=<?php echo $d[0];?>'><?php echo $d[1]; ?></a></h4>
									</div>
								</div>
							<?php 
								}
							?>
						</div><!--/category-products-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">product of <?php echo $result_search[0]; ?> category</h2>
						
						<?php 
							while($d = mysql_fetch_array($result_catProduct)){
								$product_id=$d[0];
								$sql_productimage="SELECT * FROM productimage where productId=$product_id and mainImage='1'";
								$result_main_image=mysql_query($sql_productimage);
								$r=mysql_fetch_array($result_main_image)
						?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $r[1]; ?>" alt="" />
											<h2>৳ <?php echo $d[3]; ?></h2>
											<p><?php echo $d[2]; ?></p>
											<a href="product-details.php?id=<?php echo $product_id ?>" class="btn btn-default add-to-cart"><i class="fa fa-default"></i>Order to buy</a>
										</div>
									</div>
								</div>
							</div>
						<?php
							}
						?>
					</div><!--features_items-->
					
					
						<!--<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">»</a></li>
						</ul>-->
						
						<nav>
						<ul class="pagination">
						
						<?php
							if($pagination->total_pages() > 1) {
								
								if($pagination->has_previous_page()) { 
									$string = "<li>";
									$string .= "<a href='shop.php?id={$category_id}&page={$pagination->previous_page()}'> Prev </a>";
									$string .= "</li>";
									
									echo $string;
								}

								for($i=$page-3; $i<$page; $i++){
									if($i>0){
										if($i == $page) {
											$string = "<li class='active'>";
											$string .= "<a> {$i} </a>";
											$string .= "</li>";
											
											echo $string;
										} else {
											$string = "<li>";
											$string .= "<a href='shop.php?id={$category_id}&page={$i}'> {$i} </a>";
											$string .= "</li>";
											
											echo $string;
										}
									}
								}

								for($i=$page; $i <= $pagination->total_pages() && $i<=$page+3; $i++) {
									if($i == $page) {
										$string = "<li class='active'>";
										$string .= "<a> {$i} </a>";
										$string .= "</li>";
										
										echo $string;
									} else {
										$string = "<li>";
										$string .= "<a href='shop.php?id={$category_id}&page={$i}'> {$i} </a>";
										$string .= "</li>";
										
										echo $string;
									}
								}

								if($pagination->has_next_page()) { 
									$string = "<li>";
									$string .= "<a href='shop.php?id={$category_id}&page={$pagination->next_page()}'> Next </a>";
									$string .= "</li>";
									
									echo $string;
								}
								
							}

						?>
						</ul>
						</nav>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		
		
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © amarfashionbd. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/mohibriyad">riyad</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>