<?php
    require_once('db.php');
?>

<?php
	if(!check_admin() && !check_menager()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>

<?php
	
	$conf_msg = "";
	
	if(isset($_GET['msg'])){
		$conf_msg = $_GET['msg'];
	}
	
	$sql_for_view_slide = "select * from slider";
	$resust_for_view_slide = mysql_query($sql_for_view_slide);
	
	//delete slide
	if(isset($_GET['slideId'])){
		$id = clean($_GET['slideId']);
		$sql_for_delect_slide = "DELETE FROM slider WHERE id={$id} ";
		mysql_query($sql_for_delect_slide);

		windowLocation('slider.php?msg=Delete slide successfully');
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
		function DeleteSlideFromData(url){
			if(confirm("Are you sure To Delect Slide?")) {
				document.location = url;
			}
		}
		
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
		
          <h1 class="page-header">All Sliding Product</h1>
			<div id="main-content">
            <div class="page-title">
            </div>
            <div class="row">
				<table id="product-review" class="table">
					<thead>
						<tr>
							<th style="min-width:100px"> <strong>Preview</strong> </th>
							<th style="min-width:150px"> <strong>Slide Text</strong> </th>
							<th> <strong>Product Name</strong> </th>
							<th class="text-center"> <strong>Actions</strong> </th>
						</tr>
					</thead>
					<?php 
						while($r = mysql_fetch_array($resust_for_view_slide)){
							$sql_for_product_nem = "select ProductName,ProductImage from products where ProductID={$r[1]} ";
							$result_product_name = mysql_fetch_array(mysql_query($sql_for_product_nem))
					?>
					<tr>
						<td style="width:20%">
							<a href="product-details.php?id=<?php echo $r[1]; ?>" class="magnific" title="Nature 1">
								<img src="<?php echo $result_product_name[1]; ?>" alt="animal1" class="img-responsive">
							</a>
						</td>
						<td>
							<p><?php echo $r[2]; ?></p>
						</td>
						<td >
							<h5><?php echo $result_product_name[0]; ?></h5>
						</td>
						<td class="text-center">
							<a href="javascript:DeleteSlideFromData('slider.php?slideId=<?php echo $r[0]; ?>')" class="delete-img btn btn-sm btn-default m-t-10"><i class="fa fa-times-circle"></i> Remove</a>
						</td>
					</tr>
					<?php
						}
					?>
				</table>
				<!-- end image chochooer  -->
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
