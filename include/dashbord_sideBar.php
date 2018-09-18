<ul class="nav nav-sidebar">
    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
    <?php if(check_admin() || check_menager()): ?>
    <li><a href="ff.php">Add Product</a></li>
    <li><a href="addSlide.php">Add Slide</a></li>
    <li><a href="addServiceArea.php">Add Service Area</a></li>
    <li><a href="slider.php"> Slider </a></li>
    <li><a href="category.php">Category</a></li>
	<li><a href="optionGroup.php">optionGroup</a></li>
  
  <?php else:?>
  <li><a href="ff.php">Add Product</a></li>
  <?php endif; ?>
  <?php if(check_admin() || check_menager()): ?>
    </ul>
    <ul class="nav nav-sidebar">
      <li><a href="all_store.php">Store List</a></li>

    </ul>
<?php endif;?>
  <ul class="nav nav-sidebar">
    <li><a href="orderList.php"> All Orders </a></li>
    <li><a href="current_order.php"> Current Orders </a></li>
    <?php if(check_admin() && check_menager()): ?>
    <li><a href="all_stroe_product.php"> All product</a></li>
  <?php else:?>
    <li><a href="all_stroe_product.php"> Store Product  </a></li>
  <?php endif; ?>
  </ul>