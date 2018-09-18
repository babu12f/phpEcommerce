<?php
    require_once('db.php');
?>
<?php
	if(!check_admin() && !check_menager() && !check_store_woner()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>
<?php
	$store_id = getstoreid();
    if(isset($_POST['submit'])){
		count($_POST['productPic']);
		$product_name=$_POST['product_name'];
		$product_longDes=$_POST['product_longDescription'];
		$product_shortDes=$_POST['product_shortDescription'];
		$product_main_image = $_POST['mainImageSrc'];
		
		$product_category=$_POST['checkboxCategory'];
		
		
		$product_unique_id = getUniqueproductID();
		
		$product_price=$_POST['product_price'];
		$product_prev_price = $_POST['product_prev_price'];
		$product_status=$_POST['product_active'];
		$product_offer = $_POST['prduct_offer'];
		
		//$product_pic=$_POST['productPic'];
		
		$date = get_current_date();
		
		$sql="INSERT INTO products(`ProductUniqueID`, `ProductName`, `ProductPrice`,`prevPrice`,`ProductShortDesc`, `ProductLongDesc`,`ProductImage`,`ProductAddDate`, `ProductUpdateDate`,`ProductLive`,`productOffer`,`product_store`) 
							VALUES('$product_unique_id','$product_name','$product_price','$product_prev_price','$product_shortDes','$product_longDes','$product_main_image', '$date', '$date','$product_status','$product_offer','$store_id')";
		
		$result=mysql_query($sql,$con);
		$product_id= mysql_insert_id();
		
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
          <h1 class="page-header">Add Product in <span style="color:green;"><?php echo getstorename(); ?></span></h1>
			<div id="main-content">
            <div class="page-title">
                <input type="button" value="Add Image" onClick="div_show()" class="btn btn-primary">
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
							<div id="button" class="col-md-12 text-center">
							<input type="button" value="add To post" id="sub" onClick="insImage()"/>
							<input type="button" value="Load More" id="loadMore" onClick="loadMoreImage()"/>
						</div>
                            
						<!--insertpost-->
						
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
                            <input type="text" class="form-control" value="" name="product_name">
						</div>
					</div>
					<!-- end product name -->
					<!-- start long des-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Long Description <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<textarea rows="6" name="product_longDescription" class="form-control" placeholder="Description goes here..."></textarea>
						</div>
					</div>
					<!-- end long -->
					<!-- start short des-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Short description</label>
						<div class="col-sm-9">
							<textarea rows="4" name="product_shortDescription" class="form-control" placeholder="Maximum 220 characters"></textarea>
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
							?> 
								   <input type="checkbox" name="checkboxCategory[]" value="<?php echo $d['CategoryID'];?>"/><span><?php echo"{$d[1]}";?></span>
							<?php  
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
							?> 
								   <input type="checkbox" name="checkboxOptionGroup[]" value="<?php echo $d[0];?>"/><span><?php echo $d[2];?></span>
							<?php  
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
							<input type="number" name="product_price" class="form-control" value="" min="1" />
						</div>
					</div>
					<!-- end price -->
					<!-- start prev price-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Previous Price <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<input type="number" name="product_prev_price" class="form-control" value="" min="1" />
						</div>
					</div>
					<!-- end prev price -->
					<!-- start offer -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Offer <span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<input type="text" name="prduct_offer" class="form-control" value="">
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
										<input type="radio" value="1" name="product_active" checked>Online
									</label>
								</div>
								<div class="col-md-3">
									<label>
										<input type="radio" value="0" name="product_active">Offline
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
					</table>
					<!-- end image chochooer  -->
					<input type="hidden" name="mainImageIndex" id="mainImageIndex" value="">
					<input type="hidden" name="mainImageSrc" id="mainImageSrc" value="">
					<input class="btn btn-success m-t-10" type="submit" name="submit" value="Add Product">
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