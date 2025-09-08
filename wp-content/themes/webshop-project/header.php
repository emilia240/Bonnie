<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">

  <!-- //storing strings for translation -->
   

  <div class="header-top">
    <div class="logo">
      <a href="<?php echo home_url(); ?>"><?php echo esc_html(pll__('TERRAQUA')); ?></a>
    </div>


    <div class="search-bar">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" placeholder="<?php echo esc_attr(pll__('Search')); ?>">
      </form>
    </div>


    <nav class="top-links">
      <a href="#"><?php echo esc_html(pll__('Reorder')); ?></a>
      <a href="#"><?php echo esc_html(pll__('Favorites')); ?></a>
      <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="<?php if (is_page('sustainability')) echo 'active'; ?>"><?php echo esc_html(pll__('Sustainability')); ?></a>
      <a href="#"><?php echo esc_html(pll__('Contact us')); ?></a>
    </nav>

    
  <ul class="language-picker">
    <?php pll_the_languages(array(
      "show_flags" => 1,
      "show_names" => 0
    )); ?>
  </ul>

 
    <div class="user-actions">
      <a href="#" class="login">👤 <?php echo esc_html(pll__('Login')); ?></a>
      <a href="#" class="basket">🛒 <?php echo esc_html(pll__('Basket')); ?></a>
    </div>
  </div>

 
  <div class="header-bottom">
    <nav class="main-nav">
      <a href="<?php echo esc_url(home_url('/pets')); ?>" class="<?php if (is_page('pets')) echo 'active'; ?>"><?php echo esc_html(pll__('Pets')); ?></a>
      <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'active'; ?>"><?php echo esc_html(pll__('Food & supplies')); ?></a>
      <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'active'; ?>"><?php echo esc_html(pll__('Terrariums')); ?></a>
      <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'active'; ?>"><?php echo esc_html(pll__('Offers')); ?></a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'active'; ?>"><?php echo esc_html(pll__('Blog')); ?></a>
    </nav>
  </div>

 

</header>
<?php wp_footer(); ?>
</body>
</html>
