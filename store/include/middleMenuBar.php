<ul class="nav navbar-nav">
	<li> 
	<?php
		if(is_login()){
	?>
		<a href="my_acount.php"><i class="fa fa-user"></i> Account</a> 
	<?php
		}
	?>
	</li>
	<li> 
	<?php
		if(check_admin() || check_menager()){
	?>
		<a href="orderList.php"><i class="fa fa-user"></i> Dashbord</a> 
	<?php
		}
	?>
	</li>
	<li><a href="checkout.php" <?php if (strpos($_SERVER['PHP_SELF'], 'checkout.php')) echo 'class="active"';?> > <i class="fa fa-crosshairs"></i> Checkout</a></li>	
	<li><a href="cart.php" <?php if (strpos($_SERVER['PHP_SELF'], 'cart.php')) echo 'class="active"';?> > <i class="fa fa-shopping-cart"></i> Cart 
		
		<?php
			if(isset($_SESSION['cart'])){
		?>
			<span class="badge" id="nop_in_cart"> <?php echo count($_SESSION['cart']); ?> </span>
		<?php
			}
		?>
		</a>
	</li>
	<li>
	<?php 
		if(is_login()){
	?>
		<a href="logout.php"><i class="fa fa-unlock"></i>Logout</a>
	<?php
		}else{
	?>
		<a href="login.php" <?php if (strpos($_SERVER['PHP_SELF'], 'login.php')) echo 'class="active"';?>><i class="fa fa-lock"></i>Login</a>
	<?php
		}
	?>
	</li>
</ul>