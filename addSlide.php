<?php
    require_once('db.php');
?>

<?php
	if(!check_admin() && !check_menager()){
		//redirect_to('login.php?msg=Plese Login First');
		windowLocation('login.php?msg=Plese Login First');
	}
?>

<?php
	
	$conf_msg = "";
	
	if(isset($_GET['msg'])){
		$conf_msg = $_GET['msg'];
	}

	//add slide
	if(isset($_POST['addToSlide'])){
		$slide_product_id = clean($_POST['slide_product_id']);
		$slide_slider_text = clean($_POST['slider_text']);
		
		$sql_for_add_slide = "insert into slider(`productId`,`sliderText`)
										  values('$slide_product_id','$slide_slider_text')";
		$resust_add_slide = mysql_query($sql_for_add_slide);
		
		//redirect_to('addSlide.php');
		windowLocation('addSlide.php?msg=Add slide successfully');
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

  <body>

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
		
          <h1 class="page-header">Add Slide</h1>
			<div id="main-content">
            <div class="page-title">
            </div>
            <div class="row">
			<!-- form start -->
                <form id="form_add_slide" method="post" action="" class="form-horizontal">
					<!-- start catagory-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Categories <span class="asterisk"></span></label>
						<div class="col-sm-9">
							<select class="selectpicker" name="product_category" onChange="load_product_forCategory(this.value);" >
								<option value="" style="display:none;"></option>
							<?php
							   $sql = "select * from productcategories";
							   $sql = mysql_query($sql);
							   while($d = mysql_fetch_array($sql)){
							?> 
								   <option value="<?php echo $d['CategoryID'];?>"><?php echo"{$d[1]}";?></option>
							<?php  
								}
							?>
							</select>

						</div>
					</div>
					<!-- End catagory -->
					<!-- option start -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Products <span class="asterisk"></span></label>
						<div class="col-sm-9">
							<select name="load_product" id="load_product" style="width:220px;" onChange="load_product_id(this.value);" >
							</select>
						</div>
					</div>
					<!-- option end -->
					<!-- start product name-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Or Enter Product Id <span class="asterisk">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="slide_product_id" class="form-control" value="" name="slide_product_id">
						</div>
					</div>
					<!-- end product name -->
					<!-- start slide text-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Slider Text<span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<textarea rows="6" name="slider_text" class="form-control" placeholder="Description goes here..."></textarea>
						</div>
					</div>
					<!-- end slide text -->
					<input class="btn btn-success m-t-10" type="submit" name="addToSlide" value="Add To Slide">
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

    <script type="text/javascript">
    	function load_product_forCategory(val){
    		//alert('ajax');
    		$.ajax({
			     type: 'post',
			     url: 'get_product_list.php',
			     data: {
			       get_option:val  //variable name : value
			     },
			     success: function (response) {
			       //document.getElementById("load_product").innerHTML=response; 
			       $('#load_product').html(response);
			     }
			});
    	}

    	function load_product_id(val){
    	
    		document.getElementById("slide_product_id").value=val;
    	}

    </script>

  </body>
</html>
