<?php
    require_once('../db.php');
    require_once('../pagination.php');
?>

<?php
    $sql_catagory="SELECT * FROM productcategories";
	$result_category = mysql_query($sql_catagory);
	
	//product data with pagination
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_page = 12;
	$total_count = countAllProduct();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	$sql_products = "SELECT * FROM products ";
	$sql_products .= "ORDER BY ProductUpdateDate DESC ";
	$sql_products .= "LIMIT {$per_page} ";
	$sql_products .= "OFFSET {$pagination->offset()}";
	$result_products = mysql_query($sql_products);
	
	//slider data
	$sql_for_slider = "SELECT * FROM slider LIMIT 10";
	$result_for_slider = mysql_query($sql_for_slider);
	
	
?>

<?php
	//echo get_current_date();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | amarfashionbd</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
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
								<li><a href="#"><i class="fa fa-phone"></i> +8801814772282</a></li>
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
							<?php require_once('../include/middleMenuBar.php'); ?>
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
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
								$i=0;
								while($all_slider = mysql_fetch_array($result_for_slider)){
							?>
								<?php 
									if($i==0){
								?>
									<li data-target="#slider-carousel" data-slide-to=<?php echo $i; ?> class="active"></li>
								<?php 
									}else{
								?>
									<li data-target="#slider-carousel" data-slide-to=<?php echo $i; ?> ></li>
							<?php 
									}
									$i++;
								}
							?>
						</ol>
						
						<div class="carousel-inner">
						<?php
							$i=0;
							$result_for_slider = mysql_query($sql_for_slider);
							while($all_slider = mysql_fetch_array($result_for_slider)){
								$product_id = $all_slider[1];
								$sql_productDetail = "SELECT * FROM products where ProductID=$product_id ";
								$result_productDetail = mysql_query($sql_productDetail);
								$r=mysql_fetch_array($result_productDetail)
						?>
							<div class="item<?php if($i==0){echo " active"; }?>" >
								<div class="col-sm-6">
									<h1><span>AMAR</span>Fashionbd</h1>
									<h2><?php echo $r[2]; ?></h2>
									<p><?php echo $all_slider[2]; ?></p>
									<a href="product-details.php?id=<?php echo $product_id; ?>" type="button" class="btn btn-default get">Order to buy</a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo $r[10]; ?>" class="" alt="" height="450px" width="80%"/>
								</div>
							</div>
						<?php
								$i++;
							}
						?>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
						
						
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
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
						<h2 class="title text-center">Our product</h2>
						
						<?php 
							while($d = mysql_fetch_array($result_products)){
								$product_id=$d[0];
								$sql_productimage="SELECT * FROM productimage where productId=$product_id and mainImage='1'";
								$result_main_image=mysql_query($sql_productimage);
								$r=mysql_fetch_array($result_main_image)
						?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="../<?php echo $r[1]; ?>" alt="" />
											<h2>৳<?php echo $d[3]; ?></h2>
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
						<ul class="pagination">
						<?php
							if($pagination->total_pages() > 1) {
								
								if($pagination->has_previous_page()) { 
									$string = "<li>";
									$string .= "<a href='index.php?page={$pagination->previous_page()}'> Prev </a>";
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
											$string .= "<a href='index.php?page={$i}'> {$i} </a>";
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
										$string .= "<a href='index.php?page={$i}'> {$i} </a>";
										$string .= "</li>";
										
										echo $string;
									}
								}

								if($pagination->has_next_page()) { 
									$string = "<li>";
									$string .= "<a href='index.php?page={$pagination->next_page()}'> Next </a>";
									$string .= "</li>";
									
									echo $string;
								}
								
							}

						?>
						</ul>
				</div>
			</div>
		</div>
	</section>
	
	<?php require_once('../include/footer.php');	?>
	

  
    <script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/price-range.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>