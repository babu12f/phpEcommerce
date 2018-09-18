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
	
	
	//$result_for_options = null;
	if(isset($_GET['opGId'])){
		$opGId = clean($_GET['opGId']);
		$sql_for_options = " select * from options where OptionGroupID={$opGId}";
		$result_for_options = mysql_query($sql_for_options);
		
		$sql_for_option_group_name = " select OptionGroupName from optiongroups where OptionGroupID={$opGId}";
		$result_opg_neme = mysql_fetch_array(mysql_query($sql_for_option_group_name));
		
	}else{
		//redirect_to('optionGroup.php');
		windowLocation('optionGroup.php?msg=plese select a opton group');
	}
	
	//addd option
	if(isset($_POST['addOptions'])){
		$opg_id = clean($_POST['opgId']);
		$opt_name = clean($_POST['optionName']);
		
		$sql_for_add_opg = "insert into options(`OptionGroupID`,`OptionName`)
										 values('$opg_id','$opt_name')";
		$rs_for_opg = mysql_query($sql_for_add_opg);
		
		$url = "options.php?opGId=".$opGId."&msg=Add option successfully";
		//redirect_to($url);
		windowLocation($url);
	}
	
	//delete opg
	if(isset($_GET['optId'])){
		$optId = clean($_GET['optId']);
		$sql_for_options = " delete from options where OptionID={$optId}";
		$result_for_options = mysql_query($sql_for_options);
		
		$url = "options.php?opGId=".$opGId."&msg=Delete option successfully";
		//redirect_to($url);
		windowLocation($url);
		
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
		function DeleteOptionFromData(url){
			if(confirm("Are you sure To Delect Option?")) {
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
		
          <h3 class="page-header">Product Options Of Option Group : <?php echo $result_opg_neme[0]; ?></h3>
			<div id="main-content">
            <div class="page-title">
            </div>
            <div class="row">
				<table id="product-review" class="table">
					<thead>
						<tr>
							<th style="min-width:100px"> <strong>Option Group Name</strong> </th>
							<th style="min-width:150px"> <strong>Option</strong> </th>
							<th class="text-center"> <strong>Actions</strong> </th>
						</tr>
					</thead>
					<?php 
						while($r = mysql_fetch_array($result_for_options)){
					?>
					<tr>
						<td>
							<p><?php echo $result_opg_neme[0]; ?></p>
						</td>
						<td >
							<h5><?php echo $r[2]; ?></h5>
						</td>
						<td class="text-center">
							<a href="javascript:DeleteOptionFromData('options.php?opGId=<?php echo $opGId; ?>&optId=<?php echo $r[0]; ?>')" class="delete-img btn btn-sm btn-default m-t-10"><i class="fa fa-times-circle"></i> Remove</a>
						</td>
					</tr>
					<?php
						}
					?>
				</table>

				<div class="col-sm-12 text-center">
					<h3>Add Option</h3>
				</div>

				<!-- form start -->
                <form id="form_add_options" method="post" action="" class="form-horizontal">
					<!-- start product name-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Option Name<span class="asterisk">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="option_name" class="form-control" value="" name="optionName">
						</div>
					</div>
					<!-- end product name -->
					<input type="hidden" name="opgId" value="<?php echo $opGId; ?>" >
					<input class="btn btn-success m-t-10" type="submit" name="addOptions" value="Add Option">
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
