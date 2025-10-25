<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="crabs, terrarium kits, custom aquariums UK, exotic pets UK, order exotic animals, legal exotic pets UK, shrimps, what exotic pets are legal in UK">
  <meta name="author" content="Terraqua">
  <title ><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
<!-- Skip to main content link -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded z-50" aria-label="<?php echo esc_attr(pll__('Skip to main content')); ?>"><?php echo esc_html(pll__('Skip to main content')); ?></a>


<header class="bg-[#1C3361] text-[#F4F4F4]" role="banner">

  <div class="flex items-center lg:justify-evenly justify-between bg-[#1C3361] text-[#F4F4F4] !py-3 !px-5">

    <div class="font-bold text-responsive-md" >
      <a href="<?php echo home_url(); ?>" class="text-[#F4F4F4] no-underline"><?php echo esc_html(pll__('TERRAQUA')); ?></a>
    </div>

    <!-- Mobile hamburger button -->
    <button id="mobile-menu-toggle" class="lg:hidden flex flex-col gap-1 p-2" aria-label="<?php echo esc_attr(pll__('Toggle mobile menu')); ?>" aria-expanded="false" aria-controls="mobile-menu">
      <span class="w-6 h-0.5 bg-[#F4F4F4] transition-all"></span>
      <span class="w-6 h-0.5 bg-[#F4F4F4] transition-all"></span>
      <span class="w-6 h-0.5 bg-[#F4F4F4] transition-all"></span>
    </button>

    <!-- Search bar + nav(hidden on small screens)- desktop view -->
    <div class="hidden lg:flex lg:items-center lg:gap-6">
      <div class="!mx-4">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(pll__('Site search')); ?>">
          <label for="search-input" class="sr-only"><?php echo esc_html(pll__('Search')); ?></label>
          <input type="search" id="search-input" name="s" class="w-fit min-w-[400px] !px-8 !py-2 rounded-full border border-gray-300 text-[#1D1D1D] bg-[#F4F4F4]" placeholder="<?php echo esc_attr(pll__('Search')); ?>">
        </form>
      </div>
    

      <!-- Top nav links -->
      <nav class="lg:flex lg:flex-row flex-col flex-wrap !gap-2 text-responsive-xs text-center" aria-label="<?php echo esc_attr(pll__('Top navigation')); ?>" role="navigation">
        <a href="#" class="text-[#F4F4F4] !mx-2 no-underline lg:hover:text-[#78BDE8] transition-colors transition-transform lg:hover:scale-105"><?php echo esc_html(pll__('Reorder')); ?></a>
        <a href="#" class="text-[#F4F4F4] !mx-2 no-underline lg:hover:text-[#78BDE8] transition-colors transition-transform lg:hover:scale-105"><?php echo esc_html(pll__('Favorites')); ?></a>
        <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="<?php if (is_page('sustainability')) echo 'active'; ?> text-[#F4F4F4] !mx-2 no-underline lg:hover:text-[#78BDE8] transition-colors transition-transform lg:hover:scale-105"><?php echo esc_html(pll__('Sustainability')); ?></a>
        <a href="#" class="text-[#F4F4F4] !mx-2 no-underline lg:hover:text-[#78BDE8] transition-colors transition-transform lg:hover:scale-105"><?php echo esc_html(pll__('Contact us')); ?></a>
      </nav>


      <!-- Language picker -->
      <div aria-label="<?php echo esc_attr(pll__('Language picker')); ?>" role="navigation">
        <ul class="flex flex-wrap !gap-4 items-center">
          <?php 
          $current_id = null;
          if (is_single() || is_page()) {
              $current_id = get_the_ID();
          } elseif (is_home()) {
              $current_id = get_option('page_for_posts');
          } else {
              $current_id = get_queried_object_id();
          }
          pll_the_languages(array(
            "show_flags" => 1,
            "show_names" => 0,
            'post_id' => $current_id
          )); ?>
        </ul>
      </div>

      <!-- Login/Basket -->
      <div class="flex flex-wrap !gap-3" role="navigation" aria-label="<?php echo esc_attr(pll__('User account and shopping basket')); ?>">
<<<<<<< Updated upstream
        <a href="#" class="bg-[#] text-[#f4f4f4] !px-4 !py-2 rounded-full no-underline text-responsive-xs border-2 border-[#f4f4f4] transition-colors duration-200 hover:bg-[#f4f4f4] hover:text-[#1C3361]">👤 <?php echo esc_html(pll__('Login')); ?></a>
        <a href="<?php echo esc_url(home_url('/cart')); ?>" class="bg-[#1C3361] text-[#f4f4f4] !px-4 !py-2 rounded-full no-underline text-responsive-xs border-2 border-[#f4f4f4] transition-colors duration-200 hover:bg-[#f4f4f4] hover:text-[#1C3361]">'🛒 <?php echo esc_html(pll__('Basket')); ?></a>
=======
        <?php 
        $my_account_url = esc_url( wc_get_page_permalink( 'myaccount' ) );$link_text = is_user_logged_in() ? pll__('My Account') : pll__('Login');?>
        <a href="<?php echo $my_account_url; ?>" class="bg-[#1D1D1D] text-[#F4F4F4] !px-4 !py-2 rounded-full no-underline text-responsive-xs">👤 <?php echo esc_html($link_text); ?></a>
        <a href="<?php echo esc_url(home_url('/cart')); ?>" class="bg-[#1D1D1D] text-[#F4F4F4] !px-4 !py-2 rounded-full no-underline text-responsive-xs">🛒 <?php echo esc_html(pll__('Basket')); ?></a>
>>>>>>> Stashed changes
      </div>
    </div>
  </div>

  <!-- Menu- mobile view(hidden on desktop) -->
  <div id="mobile-menu" class="lg:hidden hidden fixed inset-0 z-50 overflow-y-auto bg-[#1C3361]" aria-label="<?php echo esc_attr(pll__('Mobile menu')); ?>" role="navigation" aria-hidden="true">
    <div class="flex flex-col justify-between min-h-screen space-y-4">
      <!-- Close button at the top -->
      <div class="flex justify-end">
        <button id="mobile-menu-close" class="text-[#F4F4F4] text-responsive-sm p-2" aria-label="<?php echo esc_attr(pll__('Close menu')); ?>" aria-expanded="false" aria-controls="mobile-menu">
          ✕
        </button>
      </div>

      <!-- Mobile search -->
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(pll__('Site search')); ?>">
        <input type="search" name="s" class="w-full px-8 py-4 rounded-full border border-gray-300 text-[#1D1D1D] bg-[#F4F4F4]" placeholder="<?php echo esc_attr(pll__('Search')); ?>">
      </form>

      <!-- Mobile nav links -->
      <nav class="flex flex-col items-center space-y-3 text-responsive-sm" aria-label="<?php echo esc_attr(pll__('Top navigation')); ?>">
        <a href="#" class="text-[#F4F4F4] py-2"><?php echo esc_html(pll__('Reorder')); ?></a>
        <a href="#" class="text-[#F4F4F4] py-2"><?php echo esc_html(pll__('Favorites')); ?></a>
        <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="text-[#F4F4F4] py-2"><?php echo esc_html(pll__('Sustainability')); ?></a>
        <a href="#" class="text-[#F4F4F4] py-2"><?php echo esc_html(pll__('Contact us')); ?></a>
      </nav>

      <!-- Mobile language picker -->
      <ul class="flex gap-8 items-center justify-center py-2" aria-label="<?php echo esc_attr(pll__('Language picker')); ?>" >
        <?php pll_the_languages(array("show_flags" => 1, "show_names" => 0, 'post_id' => $current_id)); ?>
      </ul>

      <!-- Mobile login/basket -->
      <div class="flex flex-col gap-6 items-center justify-center py-2" aria-label="<?php echo esc_attr(pll__('User account and shopping basket')); ?>">
        <a href="#" class="bg-[#1D1D1D] text-[#F4F4F4] px-4 py-2 rounded-full no-underline text-responsive-xs">👤 <?php echo esc_html(pll__('Login')); ?></a>
        <a href="<?php echo esc_url(home_url('/cart')); ?>" class="bg-[#6a3ab2] text-white font-semibold py-2 px-4 rounded-md shadow-lg transition-all duration-200 hover:bg-[#552a9e] hover:shadow-xl">🛒 <?php echo esc_html(pll__('Basket')); ?></a>
      </div>

      <!-- Mobile bottom navigation -->
      <nav class="flex flex-col items-center bg-[#efefef]" aria-label="<?php echo esc_attr(pll__('Main navigation')); ?>" >
        <a href="<?php echo esc_url(home_url('/shop')); ?>" class="<?php if (is_page('shop')) echo 'text-[#78BDE8]'; else echo 'text-[#1D1D1D]'; ?> py-2 text-responsive-base" style="font-family: 'Bodoni MT', serif;"><?php echo esc_html(pll__('Pets')); ?></a>
        <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'text-[#78BDE8]'; else echo 'text-[#1D1D1D]'; ?> py-2 text-responsive-base" style="font-family: 'Bodoni MT', serif;"><?php echo esc_html(pll__('Food & supplies')); ?></a>
        <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'text-[#78BDE8]'; else echo 'text-[#1D1D1D]'; ?> py-2 text-responsive-base" style="font-family: 'Bodoni MT', serif;"><?php echo esc_html(pll__('Terrariums')); ?></a>
        <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'text-[#78BDE8]'; else echo 'text-[#1D1D1D]'; ?> py-2 text-responsive-base" style="font-family: 'Bodoni MT', serif;"><?php echo esc_html(pll__('Offers')); ?></a>
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'text-[#78BDE8]'; else echo 'text-[#1D1D1D]'; ?> py-2 text-responsive-base" style="font-family: 'Bodoni MT', serif;"><?php echo esc_html(pll__('Blog')); ?></a>
      </nav>
    </div>

  </div>

  <!-- Bottom navigation (desktop view) -->
  <div class="hidden lg:block bg-[#efefef] !py-3 text-responsive-base" style="font-family: 'Bodoni MT', serif;" role="navigation" aria-label="<?php echo esc_attr(pll__('Main navigation')); ?>">
    <nav class="flex justify-evenly min-w-max lg:min-w-0">
      <a href="<?php echo esc_url(home_url('/shop')); ?>" class="<?php if (is_page('shop')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform lg:hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px] whitespace-nowrap"><?php echo esc_html(pll__('Pets')); ?></a>
      <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform lg:hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px] whitespace-nowrap"><?php echo esc_html(pll__('Food & supplies')); ?></a>
      <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform lg:hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px] whitespace-nowrap"><?php echo esc_html(pll__('Terrariums')); ?></a>
      <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform lg:hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px] whitespace-nowrap"><?php echo esc_html(pll__('Offers')); ?></a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform lg:hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px] whitespace-nowrap"><?php echo esc_html(pll__('Blog')); ?></a>
    </nav>
  </div>

 

</header>

<main id="main-content" role="main" class="flex-1">