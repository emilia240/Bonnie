<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css"> 
  <!-- If this is in functions.php, you can remove it from here -->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">


  <div class="header-top">
    <div class="logo">
      <a href="<?php echo home_url(); ?>">TERRAQUA</a>
    </div>


    <div class="search-bar">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" placeholder="Search">
      </form>
    </div>


    <nav class="top-links">
      <a href="#">Reorder</a>
      <a href="#">Favorites</a>
      <a href="#">Shipping</a>
      <a href="#">Contact us</a>
    </nav>

 
    <div class="user-actions">
      <a href="#" class="login">👤 Login</a>
      <a href="#" class="basket">🛒 Basket</a>
    </div>
  </div>

 
  <div class="header-bottom">
    <nav class="main-nav">
      <a href="<?php echo esc_url(home_url('/pets')); ?>" class="<?php if (is_page('pets')) echo 'active'; ?>">Pets</a>
      <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'active'; ?>">Food &amp; supplies</a>
      <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'active'; ?>">Terrariums</a>
      <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'active'; ?>">Offers</a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'active'; ?>">Blog</a>
    </nav>
</div>

 

</header>
<?php wp_footer(); ?>
</body>
</html>
