<?php
    require_once('db.php');
    require_once('pagination.php');
?>

<?php
	if(!check_admin() && !check_menager() && !check_store_woner()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>
<?php
    $table_name = "products";
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $per_page = 10;
    if(check_admin() || check_menager()){
        $total_count = count_all_form_table($table_name);
    }else if(check_store_woner()){
        $store_id = getstoreid();

        $sql_for_order = "SELECT count(*) FROM {$table_name} ";
        $sql_for_order .= "where `product_store`='{$store_id}' ";

        $total_count = mysql_fetch_array(mysql_query($sql_for_order))[0];
    }
    
    $pagination = new Pagination($page, $per_page, $total_count);
    
    if(check_admin() || check_menager()){
        $sql_for_order = "SELECT * FROM {$table_name} ";
        $sql_for_order .= "ORDER BY `products`.`ProductAddDate` DESC ";
        $sql_for_order .= "LIMIT {$per_page} ";
        $sql_for_order .= "OFFSET {$pagination->offset()}";
    }else if(check_store_woner()){
        $store_id = getstoreid();

        $sql_for_order = "SELECT * FROM {$table_name} ";
        $sql_for_order .= "WHERE `product_store`='{$store_id}' ";
        $sql_for_order .= "ORDER BY `products`.`ProductAddDate` DESC ";
        $sql_for_order .= "LIMIT {$per_page} ";
        $sql_for_order .= "OFFSET {$pagination->offset()}";
    }


    $rs_for_order = mysql_query($sql_for_order);
    //echo $sql_for_order;

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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
  </head>

  <body>

    <?php require_once('include/dashbord_top_menu_bar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php require_once('include/dashbord_sideBar.php'); ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="main-content">
            <div class="page-title">
                <h3><strong>All Product in: <span style="color:green;"><?php echo getstorename(); ?></span> </strong></h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    <table id="products-table" class="table table-tools table-hover">
                                        <thead>
                                            <tr>
                                                <th style="min-width:70px"><strong>Product ID</strong>
                                                <th><strong>Add Date</strong>
                                                </th>
                                                <th><strong>Product Name</strong>
                                                </th>
                                                <th><strong>Short Description</strong>
                                                </th>
                                                <th><strong>Product Price</strong>
                                                </th>
                                                <th class="text-center"><strong>Status</strong>
                                                </th>
                                                <th class="text-center"><strong>Actions</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            
                                            while ($d = mysql_fetch_array($rs_for_order)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $d['ProductUniqueId']; ?></td>
                                                <td> <?php echo date('d-m-Y', strtotime($d['ProductAddDate'])); ?> </td>
                                                <td><?php echo $d['ProductName']; ?></td>
                                                <td> <?php echo $d['ProductShortDesc']; ?> </td>
                                                <td>৳ <?php echo $d['ProductPrice']; ?> </td>
                                                <td> <?php echo $d['ProductLive']; ?> </td>
                                                <td class="text-center"> 
                                                    <a href="product-details.php?id=<?php echo $d['ProductID']; ?>" class="view btn btn-sm btn-default"><i class="fa fa-search"></i> View</a>
                                                </td>
                                            </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>

                                            <!--start tr for pagination-->
                                            <tr class="text-center">
                                                <td colspan="9">
                                                    <ul class="pagination">
													
													<?php
														if($pagination->total_pages() > 1) {
															
															if($pagination->has_previous_page()) { 
																$string = "<li>";
																$string .= "<a href='all_stroe_product.php?page={$pagination->previous_page()}'> Prev </a>";
																$string .= "</li>";
																
																echo $string;
															}

															for($i=$page-$per_page; $i<$page; $i++){
																if($i>0){
																	if($i == $page) {
																		$string = "<li class='active'>";
																		$string .= "<a> {$i} </a>";
																		$string .= "</li>";
																		
																		echo $string;
																	} else {
																		$string = "<li>";
																		$string .= "<a href='all_stroe_product.php?page={$i}'> {$i} </a>";
																		$string .= "</li>";
																		
																		echo $string;
																	}
																}
															}

															for($i=$page; $i <= $pagination->total_pages() && $i<=$page+$per_page; $i++) {
																if($i == $page) {
																	$string = "<li class='active'>";
																	$string .= "<a> {$i} </a>";
																	$string .= "</li>";
																	
																	echo $string;
																} else {
																	$string = "<li>";
																	$string .= "<a href='all_stroe_product.php?page={$i}'> {$i} </a>";
																	$string .= "</li>";
																	
																	echo $string;
																}
															}

															if($pagination->has_next_page()) { 
																$string = "<li>";
																$string .= "<a href='all_stroe_product.php?page={$pagination->next_page()}'> Next </a>";
																$string .= "</li>";
																
																echo $string;
															}
															
														}

													?>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!--end tr for pagination-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
		
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
  </body>
</html>
