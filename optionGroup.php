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

	//add optin group
	if(isset($_POST['addOptionGroup'])){
		$opg_name = clean($_POST['optionGroupName']);
		$opg_des = clean($_POST['optionGroupDes']);
		
		$sql_for_add_opg = "insert into optiongroups(`OptionGroupName`,`optionDescription`)
											  values('$opg_name','$opg_des')";
		$rs_for_opg = mysql_query($sql_for_add_opg);
		
		//redirect_to('optionGroup.php');
		windowLocation('optionGroup.php?msg=Add option group successfully');
	}
	
	//delete opg
	if(isset($_GET['opgId'])){
		$opg_id = clean($_GET['opgId']);
		
		$sql_for_delete_opg = "delete from optiongroups where OptionGroupID={$opg_id}";
		$rs_for_delete_opg = mysql_query($sql_for_delete_opg);
		
		$sql_for_delete_all_opt = "delete from options where OptionGroupID={$opg_id} ";
		$rs_for_delete_opt = mysql_query($sql_for_delete_all_opt);
		
		//redirect_to('optionGroup.php');
		windowLocation('optionGroup.php?msg=Delete option group successfully');
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
		function DeleteOptGrpFromData(url){
			if(confirm("Are you sure To Delete Option Group?")) {
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
		
          <h1 class="page-header">Product Option Group Setting</h1>
			<div id="main-content">
            <div class="page-title">
            </div>
            <div class="row">
				<table id="product-review" class="table">
					<thead>
						<tr>
							<th style="min-width:100px"> <strong>Option Group Name</strong> </th>
							<th style="min-width:150px"> <strong>Deccription</strong> </th>
							<th> <strong>Add Options</strong> </th>
							<th class="text-center"> <strong>Actions</strong> </th>
						</tr>
					</thead>
					<?php 
						$sql_for_option_group = " select * from optiongroups ";
						$result_for_option_group = mysql_query($sql_for_option_group);
						while($r = mysql_fetch_array($result_for_option_group)){
					?>
					<tr>
						<td>
							<p><?php echo $r[1]; ?></p>
						</td>
						<td >
							<h5><?php echo $r[2]; ?></h5>
						</td>
						<td class="text-center">
							<a href="options.php?opGId=<?php echo $r[0]; ?>" class="delete-img btn btn-sm btn-default m-t-10"><i class="fa fa-plus"></i> Add Options</a>
						</td>
						<td class="text-center">
							<a href="javascript:DeleteOptGrpFromData('optionGroup.php?opgId=<?php echo $r[0]; ?>')" class="delete-img btn btn-sm btn-default m-t-10"><i class="fa fa-times-circle"></i> Remove</a>
						</td>
					</tr>
					<?php
						}
					?>
				</table>

				<div class="col-sm-12 text-center">
					<h3>Add Option Group</h3>
				</div>

				<!-- form start -->
                <form id="form_add_optionGroup" method="post" action="" class="form-horizontal">
					<!-- start product name-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Option Group Name<span class="asterisk">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="slide_product_id" class="form-control" value="" name="optionGroupName">
						</div>
					</div>
					<!-- end product name -->
					<!-- start slide text-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Option Group Description<span class="asterisk">*</span>
						</label>
						<div class="col-sm-9">
							<textarea rows="6" name="optionGroupDes" class="form-control" placeholder="Description goes here..."></textarea>
						</div>
					</div>
					<!-- end slide text -->
					<input class="btn btn-success m-t-10" type="submit" name="addOptionGroup" value="Add Option Group">
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
