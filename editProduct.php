<?php
    require_once('db.php');
?>
<?php
	if(!check_admin() && !check_menager() && !check_store_woner()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>
<?php
	$conf_msg = "";
	
	if(isset($_GET['msg'])){
		$conf_msg = $_GET['msg'];
	}
?>
<?php
	if(isset($_GET['pid'])){
		$e_product_id = $_GET['pid'];
		
		//select product data for editing
		$e_sql_products_detail = " SELECT * FROM products where ProductID=$e_product_id ";
		$e_result_products_detail = mysql_query($e_sql_products_detail);
		$e_product_detail = mysql_fetch_array($e_result_products_detail);
		
		//retrive product image 
		$e_sql_product_image=" SELECT * FROM productimage where productId=$e_product_id ";
		$e_result_product_image = mysql_query($e_sql_product_image);
		
		//retrive product option group
		$e_sql_product_opg = " SELECT * FROM productoption WHERE productId=$e_product_id ";
		//$e_rsult_product_opg = mysql_query($e_sql_product_opg);
		
		//retriving product category
		$e_sql_product_cat = "SELECT productcat.categoryId FROM `productcat` ";
		$e_sql_product_cat .= "INNER JOIN `products` ON products.ProductID = productcat.ProductID ";
		$e_sql_product_cat .= "INNER JOIN `productcategories` ON productcategories.categoryID = productcat.categoryId ";
		$e_sql_product_cat .= "WHERE productcat.ProductId={$e_product_id} ";
		
		//$e_result_product_cat = mysql_query($e_sql_product_cat);
	
	}
	/*while($d=mysql_fetch_array($e_result_product_cat)){
		echo $d['categoryId']."<br>";
	}*/
?>

<?php
    if(isset($_POST['updateProduct'])){
		//count($_POST['productPic']);
		
		if(isset($_POST['product_id_edit']) && $_POST['product_id_edit']>0){
			
			 
			$product_id_edit = $_POST['product_id_edit'];
			
			$product_name = $_POST['product_name'];
			$product_longDes = $_POST['product_longDescription'];
			$product_shortDes = $_POST['product_shortDescription'];
			$product_main_image = $_POST['mainImageSrc'];
			
			$product_category=$_POST['checkboxCategory'];
			
			
			$product_price=$_POST['product_price'];
			$product_prev_price = $_POST['product_prev_price'];
			$product_status = $_POST['product_active'];
			$product_offer = $_POST['prduct_offer'];
			
			del_all_product_attr($product_id_edit);
			///$sql_del_from_imge = " DELETE FROM productimage WHERE productId= '$product_id_edit' ";
			///$rs_del_from_image = mysql_query($sql_del_from_imge);
			
			$date = get_current_date();
			//echo $vaa;
			
			$sql = "UPDATE `products` SET 
				   ProductName = '$product_name',
				   ProductPrice = '$product_price',
				   prevPrice = '$product_prev_price',
				   ProductShortDesc = '$product_shortDes',
				   ProductLongDesc = '$product_longDes',
				   ProductImage = '$product_main_image',
				   ProductUpdateDate = '$date',
				   ProductLive = '$product_status',
				   productOffer = '$product_offer'
				   WHERE ProductID = {$product_id_edit} ";
			
			$result=mysql_query($sql,$con);
			$product_id= $product_id_edit;
			
			//for insert catagory
			for($j = 0; $j < count($product_category); $j++) {
				$cat_id = $_POST["checkboxCategory"][$j];
				$pql="INSERT INTO productcat(ProductId,categoryId)VALUES ('$product_id','$cat_id')";
				$result2=mysql_query($pql,$con);
			}
			
			//for insert product option
			if(isset( $_POST['checkboxOptionGroup'])){	
				$product_options = $_POST['checkboxOptionGroup'];
				
				for($j=0; $j<count($product_options); $j++){
					$optGrpId=$product_options[$j];
					$pql="INSERT INTO productoption(productId,optiongroutId)VALUES ('$product_id','$optGrpId')";
					$result3=mysql_query($pql,$con);
				}
			}
			
			
			//for insert pic
			for($j = 0; $j < count($_POST['productPic']); $j++) {
				$image_src = $_POST["productPic"][$j];
				$main_image=$_POST['mainImageIndex'];
				
				if($main_image==$j){
					$pql="INSERT INTO productimage(productId,imageUrl,mainImage)VALUES ('$product_id','$image_src','1')";
					$result4=mysql_query($pql,$con);
				}else{
					$pql="INSERT INTO productimage(productId,imageUrl,mainImage)VALUES ('$product_id','$image_src','0')";
					$result4=mysql_query($pql,$con);
				}
			}
			$url = "editProduct.php?pid=".$product_id_edit."&msg=update product successfully";
			windowLocation($url);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,700' rel='stylesheet' type='text/css'/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600,700' rel='stylesheet' type='text/css'/>
	<link href='css/font-awesome.min.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="css/camera.css">
    <link rel="stylesheet" type="text/css" href="css/elements.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
	
	<script>
	</script>
	
  </head>

  <body onload="init();">

	<?php require_once('include/dashbord_top_menu_bar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php require_once('include/dashbord_sideBar.php'); ?>
        </div>
		
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
			<?php 
				if($conf_msg != ""){ 
			?>
					<div class="alert alert-success" role="alert"><p><?php echo $conf_msg; ?></p></div>
			<?php 
				}
			?>
		</div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
          <h1 class="page-header">Edit Product</h1>
			<div id="main-content">
            <div class="page-title">
                <input type="button" value="Add Image" onClick="div_show()" class="btn btn-info" >
                <br><br>


                <div id="abc">
                <!-- Popup Div Starts Here -->
                    <div id="whitBac" class="container whitBac">
                        <img id="close" src="logo/3.png" width="20px" height="20px" onClick="check()">
						<div class="col-md-12">
							<h2 class="h2">Insert Image</h2>
						</div>
						<div class="row">
							<button id="uploafFile" class="uploafFile" onClick="show_upload()">Upload File</button> 
							<button id="library" class="library" onClick="div_show()">Media Library</button>
							 <button id="recentUp" class="recentUp" onClick="recent_file()">Recent Upload </button>
							<!--   content-->   
							<div id="dvContents" class="col-md-12 popupMaxheight">    
							</div>
								<!--upload-->
							<div id="uploadForm" class="col-md-12 popupMinheight">
								<form enctype="multipart/form-data" id="image_upload_form">
									<input type="file" id="image1" name="file1" class="ingIp">
									<input type="button" value="Upload File" onClick="uploadFile()">
								</form>
							</div>
								
								<!--recentfile-->
							<div id="recentFile" class="col-md-12 popupMinheight">
								No recent File Added
							</div>
						</div>
                        
                            
						<!--insertpost-->
						<div id="button" class="col-md-12 text-center">
							<input type="button" value="add To post" id="sub" onClick="insImage()"/>
							<input type="button" value="Load More" id="loadMore" onClick="loadMoreImage()"/>
						</div>
                    </div>
                    <!-- Popup Div Ends Here -->
                </div>



            </div>
            <div class="row">
            <input type="hidden" id="offsetValue" value="11">
			<!-- form start -->
                <form id="form1" method="post" action="" class="form-horizontal">
					<!-- start product name-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Product Name <span class="asterisk">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $e_product_detail['ProductName']; ?>" name="product_name">
						</div>
					</div>
					<!-- end product name -->
					<!-- start long des-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Long Description <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<textarea rows="6" name="product_longDescription" class="form-control"  placeholder="Description goes here..."> <?php echo $e_product_detail['ProductLongDesc']; ?> </textarea>
						</div>
					</div>
					<!-- end long -->
					<!-- start short des-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Short description</label>
						<div class="col-sm-9">
							<textarea rows="4" name="product_shortDescription" class="form-control" placeholder="Maximum 220 characters"><?php echo $e_product_detail['ProductShortDesc']; ?></textarea>
						</div>
					</div>
					<!-- end short -->
					<!-- start catagory-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Categories <span class="asterisk">*</span></label>
						<div class="col-sm-9 scrol">
							
							<?php
								$sql = "select * from productcategories";
								$sql = mysql_query($sql);
								while($d = mysql_fetch_array($sql)){
									
									$found = false;
									$e_result_product_cat = mysql_query($e_sql_product_cat);
									
									while($e_cat = mysql_fetch_array($e_result_product_cat)){
										if( $e_cat['categoryId'] == $d['CategoryID'] ){
							?> 
											<input type="checkbox" checked name="checkboxCategory[]" value="<?php echo $d['CategoryID'];?>"/><span><?php echo"{$d[1]}";?></span>
							<?php
											$found = true;
											break ;
										}
									}
									if(!$found){
							?>
										<input type="checkbox"  name="checkboxCategory[]" value="<?php echo $d['CategoryID'];?>"/><span><?php echo"{$d[1]}";?></span>
							<?php  
									}
								}
							?>

						</div>
					</div>
					<!-- End catagory -->
					<!-- option start -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Product Option <span class="asterisk">*</span></label>
						<div class="col-sm-9 scrol">
							
							<?php
								$sql = " SELECT * FROM optiongroups";
								$sql = mysql_query($sql);
								while($d = mysql_fetch_array($sql)){
									$found = false;
									$e_rsult_product_opg = mysql_query($e_sql_product_opg);
								   
									while($e_opg = mysql_fetch_array($e_rsult_product_opg)){
										if( $e_opg['optiongroutId'] == $d['OptionGroupID'] ){
							?> 
											<input type="checkbox" checked name="checkboxOptionGroup[]" value="<?php echo $d['OptionGroupID'];?>"/><span><?php echo $d['optionDescription'];?></span>
							<?php
											$found = true;
											break ;
										}
									}
									if($found==false){
							?>
										<input type="checkbox" name="checkboxOptionGroup[]" value="<?php echo $d['OptionGroupID'];?>"/><span><?php echo $d['optionDescription'];?></span>
							<?php  
									}
								}
							?>

						</div>
					</div>
					<!-- option end -->
					<!-- start privce-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Price <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<input type="number" name="product_price" class="form-control" value="<?php echo $e_product_detail['ProductPrice']; ?>" min="1" />
						</div>
					</div>
					<!-- end price -->
					<!-- start prev price-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Previous Price <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<input type="number" name="product_prev_price" class="form-control" value="<?php echo $e_product_detail['prevPrice']; ?>" min="1" />
						</div>
					</div>
					<!-- end prev price -->
					<!-- start offer -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Offer <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="prduct_offer" class="form-control" value="<?php echo $e_product_detail['productOffer']; ?>" >
						</div>
					</div>
					<!-- end offer -->
					<!-- start live -->
					<div class="form-group">
						<label class="col-sm-3 control-label m-t-10">Status <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-md-3">
									<label>
										<input type="radio" value="1" name="product_active"  <?php if( $e_product_detail['ProductLive'] == 1 ) { echo "checked"; } ?> >Online
									</label>
								</div>
								<div class="col-md-3">
									<label>
										<input type="radio" value="0" name="product_active" <?php if( $e_product_detail['ProductLive'] == 0 ) { echo "checked"; } ?> >Offline
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- end live -->
					<!-- start image chocher -->
					<table id="product-review" class="table">
						<thead>
							<tr>
								<th style="min-width:100px"><strong>Preview</strong>
								<th style="min-width:150px"><strong>Src</strong>
								</th>
								<th><strong>Main image</strong>
								</th>
								<th class="text-center"><strong>Actions</strong>
								</th>
							</tr>
						</thead>
						<?php
							$i = 0;
							$m_img_index = "";
							$m_img_src = "";
							while( $pimg = mysql_fetch_array($e_result_product_image)){
						?>
								<tr>
									<td style="width:20%">
										<img src="<?php echo $pimg['imageUrl']; ?>" alt="" class="img-responsive" >
									</td>
									<td>
										<input type="text" name="productPic[]" class="form-control m-t-10" value="<?php echo $pimg['imageUrl']; ?>" readonly>
									</td>
									<td>
										<input class="mainPic" onclick="edit_mainPicSelect(this)" type="radio" name="productProfileImage[]" value="1" <?php if( $pimg['mainImage']==1 ){ echo "checked"; $m_img_index = $i; $m_img_src = $pimg['imageUrl']; } ?> class="m-t-10">
									</td>
									<td class="text-center">
										<button type="button" class="delete-img btn btn-sm btn-default m-t-10"  onclick="removeImage(this)">
											<i class="fa fa-times-circle"></i> Remove
										</button>
									</td>
								</tr>
						<?php
								$i++;
							}
						?>
					</table>
					<!-- end image chochooer  -->
					<input type="hidden" name="product_id_edit" value="<?php echo $e_product_id; ?>" >
					<input type="hidden" name="mainImageIndex" id="mainImageIndex" value="<?php echo $m_img_index; ?>" >
					<input type="hidden" name="mainImageSrc" id="mainImageSrc" value="<?php echo $m_img_src; ?>" >
					<input class="btn btn-success m-t-10" type="submit" name="updateProduct" value="Save Change">
				</form>
				<!-- end form -->
            </div>
        </div>

        </div>
		  
		  
        </div>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/sapphire.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/uploadPic.js"></script>
    <script type="text/javascript" src="js/browser.js"></script>
    <script type="text/javascript" src="js/wysiwyg.js"></script>
    <script type="text/javascript" src="js/my_js.js"></script>
  </body>
</html>
