<?php
    require_once('db.php');
?>

<?php
    if(isset($_POST['submit'])){
		//count($_POST['productPic']);
		$product_name=$_POST['product_name'];
		$product_longDes=$_POST['product_longDescription'];
		$product_shortDes=$_POST['product_shortDescription'];
		
		$product_category=$_POST['checkboxCategory'];
		
		$product_price=$_POST['product_price'];
		$product_status=$_POST['product_active'];
		
		$dsa = $_POST['ddd'];
		echo $dsa;
		
		
		for($j = 0; $j < count($_POST['productPic']); $j++) {
			$image_src = $_POST["productPic"][$j];
			
			echo $image_src;
			
		}
		
		//$product_pic=$_POST['productPic'];
		
		/*$date=date("Y-m-d");
		
		$sql="INSERT INTO products(`ProductName`, `ProductPrice`,`ProductShortDesc`, `ProductLongDesc`,`ProductAddDate`, `ProductLive`) 
		VALUES('$product_name','$product_price','$product_shortDes','$product_longDes','$date','$product_status')";
		
		$result=mysql_query($sql,$con);
		$product_id= mysql_insert_id();
		
		for($j = 0; $j < count($product_category); $j++) {
			$cat_id = $_POST["checkboxCategory"][$j];
			$pql="INSERT INTO productcat(ProductId,categoryId)VALUES ('$product_id','$cat_id')";
			$result2=mysql_query($pql,$con);
		}
		for($j = 0; $j < count($_POST['productPic']); $j++) {
			$image_src = $_POST["productPic"][$j];
			//$main_image=$_POST['productProfileImage'][$j];
			$main_image=0;
			if($main_image){
				$pql="INSERT INTO productimage(productId,imageUrl,mainIgage)VALUES ('$image_src','$cat_id',1)";
				$result3=mysql_query($pql,$con);
			}
			else{
				$pql="INSERT INTO productimage(productId,imageUrl,mainIgage)VALUES ('$image_src','$cat_id',0)";
				$result3=mysql_query($pql,$con);
			}
		}*/
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
  </head>

  <body>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
          <h1 class="page-header">Add Product</h1>
			<div id="main-content">
            <div class="page-title">
                <input type="button" value="Add Image" onClick="div_show()">
                <br><br>


                <div id="abc">
                <!-- Popup Div Starts Here -->
                    <div id="popupContact">
                        <img id="close" src="3.png" onClick="check()">
                        <h2 class="h2">Insert Image</h2>
                         <button id="uploafFile" class="uploafFile" onClick="show_upload()">Upload File</button> 
                           <button id="library" class="library" onClick="div_show()">Media Library</button>
                           <button id="recentUp" class="recentUp" onClick="recent_file()">Recent Upload </button>
                        <!--   content-->   
                            <div id="dvContents" class="dvContents">    
                            </div>
                            <!--upload-->
                            <div id="uploadForm" class="uploadForm">
                            <form enctype="multipart/form-data" id="image_upload_form">
                                <input type="file" id="image1" name="file1" class="ingIp">
                                <input type="button" value="Upload File" onClick="<uploadfile></uploadfile>">
                            </form>
                            </div>
                            
                            <!--recentfile-->
                            <div id="recentFile" class="recentFile">
                            
                            No recent File Added
                            </div>
                        
                            
                            <!--insertpost-->
                            <div id="button" style="margin-left:800px;"><input type="button" value="addTopost" id="sub" onClick="insImage()"/></div>
                        
                    </div>
                    <!-- Popup Div Ends Here -->
                </div>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabcordion">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"><a href="#product_general" data-toggle="pill" >General</a></li>
                            <li><a href="#product_images" data-toggle="pill">Images</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="product_general" data-toggle="pill" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="form1" method="post" action="" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Product Name <span class="asterisk">*</span>
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" value="" name="product_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Reference <span class="asterisk">*</span>
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Long Description <span class="asterisk">*</span>
                                            </label>
                                            <div class="col-sm-7">
                                                <textarea rows="6" name="product_longDescription" class="form-control" placeholder="Description goes here..."></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Short description</label>
                                            <div class="col-sm-7">
                                                <textarea rows="4" name="product_shortDescription" class="form-control" placeholder="Maximum 220 characters"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Categories <span class="asterisk">*</span></label>
                                            <div class="col-sm-7 scrol">
                                                
                                                <?php
                                                   $sql = "select * from productcategories";
                                                   $sql = mysql_query($sql);
                                                   while($d = mysql_fetch_array($sql)){
                                                ?> 
                                                       <input type="checkbox" name="checkboxCategory[]" value="<?php echo $d['CategoryID'];?>"/><?php echo"{$d[1]}";?>
                                                <?php  
                                                    }
                                                ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Price <span class="asterisk">*</span>
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="text" name="product_price" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label m-t-10">Status <span class="asterisk">*</span>
                                            </label>
                                            <div class="col-sm-7">
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
                                                    <div class="col-md-3">
                                                        <label>
                                                        <input type="radio" value="3" name="product_active">Draft
                                                    </label> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Comment
                                            </label>
                                            <div class="col-sm-7">
                                                <textarea rows="5" class="form-control valid" placeholder="Optional comment..."></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                          
                            <div class="tab-pane fade" id="product_images" data-toggle="pill" >
                                <div class="row">
                                    <div class="col-md-12">
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
                                        <!--<tbody>
                                            <tr>
                                                <td style="width:20%">
                                                    <a href="assets/img/gallery/animal1.jpg" class="magnific" title="Nature 1">
                                                        <img src="assets/img/gallery/animal1.jpg" alt="animal1" class="img-responsive">
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="text" name="productPic[]" class="form-control m-t-10" value="Product 1 main image">
                                                </td>
                                                <td >
                                                    <input type="checkbox" name="product_image" value="1" class="m-t-10" >
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="delete-img btn btn-sm btn-default m-t-10"><i class="fa fa-times-circle"></i> Remove</a>
                                                </td>
                                            </tr>
                                        </tbody>-->
                                    </table>
                                    
									<div class="form-group">
                                            <label class="col-sm-2 control-label">Comment
                                            </label>
                                            <div class="col-sm-7">
                                                <textarea rows="5" name="ddd" class="form-control valid" placeholder="Optional comment..."></textarea>
                                            </div>
                                        </div>
									
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12 m-t-20 m-b-40 align-center">
                    <a href="ecommerce_products.html" class="btn btn-default m-r-10 m-t-10"><i class="fa fa-reply"></i> Cancel</a>
                    <a href="ecommerce_products.html" class="btn btn-danger m-r-10 m-t-10"><i class="fa fa-times"></i> Delete Product</a>
                    <input class="btn btn-success m-t-10" type="submit" name="submit" value="Save changes">
                </div>
                </form>
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
