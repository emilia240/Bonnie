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
  <?php
    $logo = pll__('logo');
    $reorder = pll__('reorder');
    $favorites = pll__('favorites');
    $sustainability = pll__('sustainability');
    $contact_us = pll__('contact_us');
    $login = pll__('login');
    $basket = pll__('basket');
    $search_placeholder = pll__('search_placeholder');
    $pets = pll__('pets');
    $food_supplies = pll__('food_supplies');
    $terrariums = pll__('terrariums');
    $offers = pll__('offers');
    $blog = pll__('blog');
  ?>

  <div class="header-top">
    <div class="logo">
      <a href="<?php echo home_url(); ?>"><?php echo $logo; ?></a>
    </div>


    <div class="search-bar">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" placeholder="<?php echo esc_attr($search_placeholder); ?>" value="<?php echo get_search_query(); ?>">
      </form>
    </div>


    <nav class="top-links">
      <a href="#"><?php echo $reorder; ?></a>
      <a href="#"><?php echo $favorites; ?></a>
      <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="<?php if (is_page('sustainability')) echo 'active'; ?>"><?php echo $sustainability; ?></a>
      <a href="#"><?php echo $contact_us; ?></a>
    </nav>

    
  <ul class="language-picker">
    <?php pll_the_languages(array(
      "show_flags" => 1,
      "show_names" => 0
    )); ?>
  </ul>

 
    <div class="user-actions">
      <a href="#" class="login">👤 <?php echo $login; ?></a>
      <a href="#" class="basket">🛒 <?php echo $basket; ?></a>
    </div>
  </div>

 
  <div class="header-bottom">
    <nav class="main-nav">
      <a href="<?php echo esc_url(home_url('/pets')); ?>" class="<?php if (is_page('pets')) echo 'active'; ?>"><?php echo $pets; ?></a>
      <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'active'; ?>"><?php echo $food_supplies; ?></a>
      <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'active'; ?>"><?php echo $terrariums; ?></a>
      <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'active'; ?>"><?php echo $offers; ?></a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'active'; ?>"><?php echo $blog; ?></a>
    </nav>
  </div>

 

</header>
<?php wp_footer(); ?>
</body>
</html>
