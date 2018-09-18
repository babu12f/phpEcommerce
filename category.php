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

	$sql_for_category = " select * from productcategories ";
	$result_for_category = mysql_query($sql_for_category);
	
	
	//add category
	if(isset($_POST['addCategory'])){

		$cat_name = ucfirst(clean($_POST['categoryName']));

		$sql_for_check_cat = "SELECT CategoryID FROM productcategories WHERE CategoryName='$cat_name' ";
		$result_for_check_cat = mysql_query($sql_for_check_cat);

		$cat_found = mysql_num_rows($result_for_check_cat);

		if($cat_found < 1){
			$sql_for_add_cat = "INSERT INTO productcategories(`CategoryName`)
											 		   VALUES('$cat_name')";
			$rs_for_cat = mysql_query($sql_for_add_cat);
			
			$url = "category.php?msg=Add category successfully";
			//redirect_to($url);
			windowLocation($url);
		}else{
			echo createJSalert('This Category Already Added');
		}
	}
	
	if(isset($_GET['catId'])){
		$catId = clean($_GET['catId']);
		$sql_for_del_cat = " delete from productcategories where CategoryID={$catId}";
		$result_for_del_cat = mysql_query($sql_for_del_cat);
		
		//redirect_to('category.php');
		windowLocation('category.php?msg=delete catagory successfully');
		
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
		function DeleteCategoryFromData(url){
			if(confirm("Are you sure To Delect category?")) {
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
		
          <h3 class="page-header"> Category </h3>
			<div id="main-content">
            <div class="page-title">
            	<?php  ?>
            </div>
            <div class="row">
				<table id="product-review" class="table">
					<thead>
						<tr>
							<th style="min-width:100px"> <strong> Category Name </strong> </th>
							<th class="text-center"> <strong>Actions</strong> </th>
						</tr>
					</thead>
					<?php 
						while($r = mysql_fetch_array($result_for_category)){
					?>
					<tr>
						<td >
							<h5><?php echo $r['CategoryName']; ?></h5>
						</td>
						<td class="text-center">
							<a href="javascript:DeleteCategoryFromData('category.php?catId=<?php echo $r['CategoryID']; ?>')" class="delete-img btn btn-sm btn-default m-t-10">
							<i class="fa fa-times-circle"></i> Remove</a>
						</td>
					</tr>
					<?php
						}
					?>
				</table>

				<div class="col-sm-12 text-center">
					<h3>Add Category</h3>
				</div>

				<!-- form start -->
                <form id="form_add_category" name="form_add_category" method="post" action="" class="form-horizontal">
					<!-- start product name-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Option Name<span class="asterisk">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="categoryName" class="form-control" value="" name="categoryName">
						</div>
					</div>
					<!-- end product name -->
					<input class="btn btn-success m-t-10" type="submit" name="addCategory" value="Add Category">
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
