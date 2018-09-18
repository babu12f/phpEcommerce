<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +8801814772282</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i><strong> babu_12f@yahoo.com||babu12f@gmail.com</strong></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/babu.generous"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-skype"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
							
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="logo/logo.png" alt="" height="100px" width="120px" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<?php require_once('middleMenuBar.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle amar kaz seh-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Category<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	<?php
											while($d = mysql_fetch_array($result_category)):
										?>
                                        <li><a href="shop.php?id=<?php echo $d[0]; ?>"><?php echo $d[1];?></a></li>
										<?php endwhile; ?>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Store<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	<?php
                                    		$q = mysql_query("SELECT * FROM `store`");
											while($d = mysql_fetch_array($q)):
										?>
                                        <li><a href="store.php?s_id=<?php echo $d[0]; ?>"><?php echo $d[1];?></a></li>
										<?php endwhile; ?>
                                    </ul>
                                </li>  
								
								
								<li><a href="contact-us.php">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->