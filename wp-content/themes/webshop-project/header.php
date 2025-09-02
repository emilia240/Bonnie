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
      <a href="#">Pets</a>
      <a href="#">Food &amp; supplies</a>
      <a href="#">Terrariums</a>
      <a href="#">Offers</a>
      <a href="#" class="active">Blog</a>
    </nav>
  </div>

     <ul class="language-switcher">
   <?php pll_the_languages(array("show_flags" => true)) ?>
      </ul>

</header>
<?php wp_footer(); ?>
</body>
</html>
