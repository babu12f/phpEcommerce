<?php
    require_once('db.php');
?>
<?php
	$error_msg = "";
	//for getting data from database
	$product_id=1;
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$product_id = clean($_GET['id']);
	}
	else{
		windowLocation('index.php');
	}
	
    $sql_catagory="SELECT * FROM productcategories";
	$result_category = mysql_query($sql_catagory);
	
	$sql_products_detail="SELECT * FROM products where ProductID=$product_id";
	$result_products_detail = mysql_query($sql_products_detail);
	$product_detail = mysql_fetch_array($result_products_detail);
	
	if(!$product_detail){
		windowLocation('index.php');
	}
	
	$sql_product_image="SELECT * FROM productimage where productId=$product_id";
	$result_product_image = mysql_query($sql_product_image);
	
	$sql_for_pro_comments = "SELECT * FROM comments WHERE productId = {$product_id}";
	$rs_for_pro_comments = mysql_query($sql_for_pro_comments);
	
?>
<?php
	if(isset($_POST['product_comment']) && is_login()){
		$user_id = $_SESSION['SESS_USER_ID'];
		$product_id = $_POST['product_id'];
		$comment_body = clean($_POST['comment_body']);
		
		$sql_for_insert_comment = "INSERT INTO `comments` (`productId`, `comment`, `userId`) VALUES ('$product_id', '$comment_body', '$user_id')";
		$result_for_comment_insert = mysql_query($sql_for_insert_comment);
		
		//header('Location: product-details.php?id='.$product_id);
		$url = "product-details.php?id=".$product_id."&msg=comment Add successfully";
		windowLocation($url);
	}
	if(isset($_POST['product_comment']) && !is_login()){
		$url = "product-details.php?id=".$product_id."&msg=Plese Login First";
		windowLocation($url);
	}
	if(isset($_GET['msg'])){
		$error_msg = $_GET['msg'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | amarfashionbd</title>
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
	<script src='js/jquery-1.8.3.min.js'></script>
	<script src='js/jquery.elevatezoom.js'></script>
	<script src='js/jquery.fancybox-1.3.4.js'></script>
	
	<script>
	
	function DeleteProductFromData(url){
		if(confirm("Are you sure To Delect Product?")) {
				document.location = url;
			}
	}
	
	function afb_viewThisImage(src){
		var x=document.getElementById('afb_imageView');
		x.setAttribute("src",src);
	}
	
	function submitAddtoCaryForm(){
		var form = document.getElementById("addTocartForm");
		var flag = true;
		
		var val = form.elements["product_qun"].value;
		if(isNaN(val)==true || val<1){
			alert('Plese Select Quantity');
			form.elements["product_qun"].value=1;
			flag = false;
		}
		
		
		var len = form.elements["product_attribute_name[]"].length;
		var attribute = form.elements["product_attribute_name[]"].value; 
		var selectOpt = form.elements["product_attribute[]"];
		
		var attributeLen = form.elements["product_attribute_name[]"];
			
		if(!len){
			var errBox = document.getElementById("errMsg0");
			
			if(selectOpt){
				if(selectOpt.value==""){
					flag = false;
					errBox.innerHTML = "* Please Select A "+attribute;
				}else{
					errBox.innerHTML = "";
				}
			}			
		}else{
			for(i=0; i<len; i++){
				id = "errMsg"+i;
				var errBox = document.getElementById(id);
				
				if(selectOpt[i].value==""){
					errBox.innerHTML = "* Please Select A "+attributeLen[i].value;

					flag = false;
				}else{
					errBox.innerHTML = "";
				}
			}
		}
		return flag;
	}
	
	</script>
	
</head><!--/head-->

<body>
	<?php require_once('include/header.php'); ?>
	
	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
								$result_category = mysql_query($sql_catagory);
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
					<?php 
						if($error_msg != ""){ 
					?>
						<div class="alert alert-success" role="alert"><p><?php echo $error_msg; ?></p></div>
					<?php 
						}
					?>
					<?php 
						$sql_productimage="SELECT * FROM productimage where productId=$product_id and mainImage='1'";
						$result_main_image=mysql_query($sql_productimage);
						$product_image=mysql_fetch_array($result_main_image);
					?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
						
							<div class="view-product">
								<img id="afb_imageView" src="<?php echo $product_image[1]; ?>" alt="" data-zoom-image="<?php echo $product_image[1]; ?>" />
							</div>
							
							<div id="similar-product" class="carousel slide" >
								<div id="gal1" class="item">
								<?php 
									$sql_productimage="SELECT * FROM productimage where productId=$product_id ";
									$result_image_galary=mysql_query($sql_productimage);
									while($d=mysql_fetch_array($result_image_galary)){
										$src=$d[1];
								?>
									<a href="#" data-image="<?php echo $src; ?>" data-zoom-image="<?php echo $src; ?>">
									<img class="borderdImage" id="afb_imageView" src="<?php echo $src; ?>" alt="" width="90px" height="90px" ></a>
								<?php
									} 
								?>
								</div>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2><?php echo $product_detail[2]; ?></h2>
								<p>Product ID: <?php echo $product_detail[1]; ?></p>
								
								<p><b>Product Price:</b> ৳<?php echo " ".$product_detail[3]; ?></p>
								
									
								<p><b>Availability:</b><?php if($product_detail['ProductLive']==1){echo " Available "; }else{ echo " Out Of Stock"; }?></p>
								
								<?php 
									if($product_detail[18]!=null){
								?>
									<p><b>Offer:</b> <?php echo $product_detail[18]; ?></p>
								<?php
									}
								?>
								
								<p><b>Brand:</b> amarfashionbd</p>
								
								<form id="addTocartForm" name="addTocartForm" method="post" action="cart.php"  onSubmit="return submitAddtoCaryForm();">
								<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
								<input type="hidden" name="product_store"  value="<?php echo $product_detail['product_store']; ?>" >
								<input type="hidden" name="product_price" value="<?php echo $product_detail['ProductPrice']; ?>">
								<label>Quantity:</label>
									<input name="product_qun" type="number" value="1" min="1" />
									
								<div class="col-sm-12 nopad">
								<?php
									$i=0;
									$sql_for_option="SELECT * FROM `productoption` where productId={$product_id}";
									$result_optGrp=mysql_query($sql_for_option);
									while($option=mysql_fetch_array($result_optGrp)){
										$sql_for_option="SELECT * FROM `optiongroups` where OptionGroupID={$option[1]}";
										$result_option=mysql_fetch_array(mysql_query($sql_for_option));
										
										$sql_for_select="SELECT * FROM `options` where OptionGroupID={$option[1]}";
										$result_for_select=mysql_query($sql_for_select);
								?>
									<div class="col-sm-6 nopad mrTop">
									<b><?php echo $result_option[1]; ?></b>
										<input type="hidden" name="product_attribute_name[]" value="<?php echo $result_option[1]; ?>">
										<select class="selectpicker" name="product_attribute[]" >
										<option value="" style="display:none;"></option>
										<?php 
											while($select=mysql_fetch_array($result_for_select)){
										?>
											<option><?php echo $select[2]; ?></option>
										<?php
											}
										?>
										</select>
										<span id="errMsg<?php echo $i; ?>" style="color:red;" ></span>
									</div>
								<?php
										$i++;
									} 
								?>
								</div>
								
								<button type="submit" class="btn btn-fefault cart" name="addToCart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
								</button>
								</form>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<?php
						
					?>
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#comment" data-toggle="tab">Comments</a></li>
								<li><a href="#reviews" data-toggle="tab"> give Review</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active fade in" id="details" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<p><?php echo $product_detail[8]; ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade " id="comment" >
								<div class="col-sm-12 commentboxminheight">
								<?php 
									while( $comment = mysql_fetch_array($rs_for_pro_comments)){
										$comment_id = $comment['userId'];
										
										$sql_for_comment_usr = "SELECT UserFullName FROM users WHERE UserID={$comment_id}";
										$comment_user = mysql_fetch_array(mysql_query($sql_for_comment_usr));
								?>
										<h4 style="color:#09DAC8;" ><?php echo $comment_user['UserFullName']; ?></h4>
										<p><?php echo $comment['comment']; ?></p>
								<?php
									}
								?>
									
								</div>
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<p></p>
									<p><b>Write Your Review</b></p>
									
									<form method="post" id="product_review_form" class="product_review_form" name=product_review_form" action="#" >
										<input type="hidden" name="product_id" value="<?php echo $product_detail[0]; ?>" />
										<textarea name="comment_body" ></textarea>
										<button type="submit" name="product_comment"  class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					
					
				</div>
			</div>
		</div>
	</section>
	
	<div class="container text-center">
        <?php 
            if(check_admin() || p_woner($product_id) || check_menager() ){
        ?>
            <a class="btn btn-fefault cart" href="editProduct.php?pid=<?php echo $product_id ?>"> Edit</a> <a class="btn btn-fefault cart" href="javascript:DeleteProductFromData('delectProduct.php?pid=<?php echo $product_id; ?>')"> delete</a> 
        <?php
            }
        ?>
    </div>
	
	<?php require_once('include/footer.php'); ?>
	
	<script>
	$("#afb_imageView").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active'}); 
		$("#afb_imageView").bind("click", function(e) {  
		  var ez =   $('#afb_imageView').data('elevateZoom'); 
		 $.fancybox(ez.getGalleryList());
		  return false;
		});
	</script>
	
  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>