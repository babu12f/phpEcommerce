<?php
    require_once('db.php');
?>
<?php
	if(!check_admin() && !check_menager() && !check_store_woner()){
		redirect_to('login.php?msg=Plese Login First');
	}
?>
<?php
	if(isset($_GET['oUid'])){
		$order_uniq_id = clean($_GET['oUid']);
        $user_detail = null;

        //for ordere over view 
        $sql_for_order = "SELECT * FROM orders WHERE OrderUniqueId={$order_uniq_id} ";
        $rs_for_order = mysql_query($sql_for_order);
        $order_overview = mysql_fetch_array($rs_for_order);
        $user_id = $order_overview['OrderUserID'];

        //for user
        if($user_id){
            $sql_for_user = "SELECT * FROM users WHERE UserID={$user_id} ";
            $user_detail = mysql_fetch_array(mysql_query($sql_for_user));
        }
		
        //for order detail
		$sql_for_get_order_detail = "SELECT * FROM orderdetails WHERE DetailOrderIDUnique={$order_uniq_id} ";
		$rs_for_get_order_detail = mysql_query($sql_for_get_order_detail);

	}
?>
<?php
    if(isset($_POST['addStatus'])){
        $order_status = $_POST['addStasusSelect'];

        if($order_status != ""){
            $sql_for_add_status = " UPDATE orders SET OrderStatus={$order_status}  WHERE OrderUniqueId={$order_uniq_id} ";
            $rs_for_update_status = mysql_query($sql_for_add_status);
            $url = "orderDetail.php?oUid=".$order_uniq_id;
            redirect_to($url);
        }else{
            $alert= createJSalert("NO Status Select !!!");
            echo $alert;
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
		    <!--BEGAIN MAIN CONTENT-->
        <div id="main-content">
            <div class="page-title">
                <i class="icon-custom-left"></i>
                <h3><strong style="margin-right:10px;">Invoice NO : <?php echo $order_overview['OrderUniqueId']; ?></strong> 
                    <small> <?php echo date('M d, Y - g:i A', strtotime($order_overview['OrderDate'])); ?></small></h3>
                <br>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabcordion">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"><a href="#order_resume" data-toggle="tab">Overview</a></li>
                            <li><a href="#order_details" data-toggle="tab">Items Details</a></li>
                            <li><a href="#customer_details" data-toggle="tab">Customer Details</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="order_resume">
                                <div class="row p-20">
                                    <div class="col-md-6">
                                        <h3 class="m-t-0 m-b-20">Global infos</h3>
                                        <form class="form-horizontal p-20">
                                            <div class="form-group">
                                                <div class="col-sm-2">Order Number:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong> <?php echo $order_overview['OrderUniqueId']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Date:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong> <?php echo date('d-m-Y', strtotime($order_overview['OrderDate'])); ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Client Name:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong><a href="#" data-rel="tooltip" title="Edit customer"><?php echo $order_overview['OrderGuestName']; ?></a></strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Total Amount:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong>৳ <?php echo $order_overview['OrderAmount']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Item Numbers:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong> <?php echo $order_overview['OrderQuntity']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Product Numbers:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong> <?php 
                                                    $sql_for_product_count = "SELECT SUM(DetailQuantity) AS qun FROM orderdetails WHERE DetailOrderIDUnique={$order_uniq_id} ";
                                                    $rs_for_product_count = mysql_fetch_array(mysql_query($sql_for_product_count));
                                                    echo $rs_for_product_count['qun'];
                                                     ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Destination:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong> <?php echo $order_overview['OrderCity']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-2">Actual Status:
                                                </div>
                                                <div class="col-sm-7">
                                                    <strong>Waiting shipment</strong>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="m-t-0 m-b-20">Address Infos</h3>
                                        <form class="form-horizontal p-20">
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Shipping Address Short :
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong> <?php echo $order_overview['OrderShipName']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Shipping Address Detail :
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong> <?php echo $order_overview['OrderShipAddress']; ?> </strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Payment Method:
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong>Cash on Delevary</strong>
                                                </div>
                                            </div>
                                            <div class="form-group m-t-60">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <a class="btn btn-block btn-primary" href="#">See Invoice</a>
                                                </div>
                                            </div>
                                        </form>

                                        <form id="addStasusForm" name="addStasusForm" class="form-horizontal p-20 " method="post" action="" > 
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Add status :
                                                </div>
                                                <div class="col-sm-8">
                                                    <select name="addStasusSelect" class="selectpicker">
														<option style="display:hide;" value=""></option>
                                                        <option value="0"> Order </option>
                                                        <option value="1"> Shipped </option>
                                                        <option value="2"> Waiting for payment </option>
                                                        <option value="3"> payment receved / ND </option>
                                                        <option value="4"> Refund </option>
                                                        <option value="5"> Froud </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-4">
                                                <button type="submit" name="addStatus" class="btn btn-block btn-primary" >
                                                    Add Status
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="order_details">
                                <div class="row p-20">
                                    <div class="col-md-12">
                                        <table id="products-table" class="table">
                                            <thead>
                                                <tr>
                                                    <th style="min-width:70px"><strong>SL</strong>
                                                    <th><strong>Product</strong>
                                                    </th>
                                                    <th><strong>Product ID</strong>
                                                    </th>
                                                    <th><strong>Product Detail</strong>
                                                    </th>
                                                    <th><strong>Price</strong>
                                                    </th>
                                                    <th><strong>Quantity</strong>
                                                    </th>
                                                    <th><strong>Total</strong>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                        <?php 
                                            $i=1;
                                            while ( $pdi = mysql_fetch_array($rs_for_get_order_detail) ) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><a href="ecommerce_product_view.html" data-rel="tooltip" title="Edit Product"> <?php echo $pdi['DetailName']; ?> </a></td>
                                                    <td> <?php echo $pdi['DetailProductID']; ?> </td>
                                                    <td> <?php echo $pdi['DetailAttribute']; ?> </td>
                                                    <td> <?php echo $pdi['DetailPrice']; ?> </td>
                                                    <td> <?php echo $pdi['DetailQuantity']; ?> </td>
                                                    <td> <?php echo $pdi['DetailPrice']*$pdi['DetailQuantity']; ?> </td>
                                                </tr>
                                        <?php 
                                                $i++;
                                            }   
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row p-20">
                                    <div class="col-md-12">
                                        <div class="col-md-7 col-md-offset-5">
                                            <div class="well">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="glyph-icon flaticon-shopping80 f-80"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row align-right m-b-10">
                                                            <div class="col-md-8">
                                                                 Total before Shipping Cost:
                                                            </div>
                                                            <div class="col-md-4 w-600">
                                                                 <p>৳<?php echo " ".$order_overview['OrderAmount']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row align-right m-b-10">
                                                            <div class="col-md-8">
                                                                 Shipping:
                                                            </div>
                                                            <div class="col-md-3 w-600">
                                                                ৳<?php echo " ".$order_overview['OrderShippingCost']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row align-right m-b-10">
                                                            <div class="col-md-8">
                                                                 Grand Total:
                                                            </div>
                                                            <div class="col-md-3 w-600">
                                                                ৳<?php echo " ".$order_overview['OrderShippingCost']+$order_overview['OrderAmount']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="customer_details">
                                <div class="row p-20">
                                    <div class="col-md-12">
                                        <form class="form-horizontal">
                                            <div class="col-md-6">
                                                <h3 class="m-t-0 m-b-20">Customer info</h3>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Customer Name:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong><a href="#" data-rel="tooltip" title="Edit customer"> <?php if($user_detail == null){echo $order_overview['OrderGuestName'];}else{echo $user_detail['UserFullName'];} ?> </a></strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Address:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo $order_overview['OrderShipAddress'];}else{echo $user_detail['UserDetailAddress'];} ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">City:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo $order_overview['OrderCity'];}else{echo $user_detail['UserDistrict'];} ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Country:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo $order_overview['OrderCountry'];}else{echo $user_detail['UserCountry'];} ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Phone Number:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo $order_overview['OrderMobile'];}else{echo $user_detail['UserMobile'];} ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Email:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo $order_overview['OrderEmail'];}else{echo $user_detail['UserEmail'];} ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Customer OR Guest :
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php if($user_detail == null){echo "Gust";}else{echo "Registred Customer";} ?> </strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="m-t-0 m-b-20">Shipping info</h3>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Delivery Address Name:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderShipName']; ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Address:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderShipAddress']; ?> </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">City:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderCity']; ?>  </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Country:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderCountry']; ?>  </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Phone Number Home:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderPhone']; ?>  </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Mobile Number:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderMobile']; ?>  </strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">Email:
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <strong> <?php echo $order_overview['OrderEmail']; ?>  </strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
