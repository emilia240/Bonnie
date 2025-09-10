<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="bg-[#1C3361] text-[#F4F4F4]">

  <div class="flex items-center justify-around bg-[#1C3361] text-[#F4F4F4] !py-3 !px-5">
    <div class="font-bold text-2xl">
      <a href="<?php echo home_url(); ?>" class="text-[#F4F4F4] no-underline font-bold text-2xl"><?php echo esc_html(pll__('TERRAQUA')); ?></a>
    </div>


    <div class="!mx-4">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" class="w-fit !px-4 !py-2 rounded-full border border-gray-300 text-[#1D1D1D] bg-[#F4F4F4]" placeholder="<?php echo esc_attr(pll__('Search')); ?>">
      </form>
    </div>


    <nav class="flex !gap-2 text-sm">
      <a href="#" class="text-[#F4F4F4] !mx-2 no-underline hover:text-[#78BDE8] transition-colors transition-transform hover:scale-105"><?php echo esc_html(pll__('Reorder')); ?></a>
      <a href="#" class="text-[#F4F4F4] !mx-2 no-underline hover:text-[#78BDE8] transition-colors transition-transform hover:scale-105"><?php echo esc_html(pll__('Favorites')); ?></a>
      <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="<?php if (is_page('sustainability')) echo 'active'; ?> text-[#F4F4F4] !mx-2 no-underline hover:text-[#78BDE8] transition-colors transition-transform hover:scale-105"><?php echo esc_html(pll__('Sustainability')); ?></a>
      <a href="#" class="text-[#F4F4F4] !mx-2 no-underline hover:text-[#78BDE8] transition-colors transition-transform hover:scale-105"><?php echo esc_html(pll__('Contact us')); ?></a>
    </nav>

  <ul class="flex !gap-4 items-center">
    <?php pll_the_languages(array(
      "show_flags" => 1,
      "show_names" => 0,
      'post_id' => get_queried_object_id()
    )); ?>
  </ul>

 
    <div class="flex !gap-3">
      <a href="#" class="bg-[#1D1D1D] text-[#F4F4F4] !px-4 !py-2 rounded-full no-underline text-sm">👤 <?php echo esc_html(pll__('Login')); ?></a>
      <a href="#" class="bg-[#1D1D1D] text-[#F4F4F4] !px-4 !py-2 rounded-full no-underline text-sm">🛒 <?php echo esc_html(pll__('Basket')); ?></a>
    </div>
  </div>


  <div class="bg-[#efefef] !py-3 text-lg" style="font-family: 'Bodoni MT', serif;">
    <nav class="flex justify-evenly">
      <a href="<?php echo esc_url(home_url('/pets')); ?>" class="<?php if (is_page('pets')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px]"><?php echo esc_html(pll__('Pets')); ?></a>
      <a href="<?php echo esc_url(home_url('/food-supplies')); ?>" class="<?php if (is_page('food-supplies')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px]"><?php echo esc_html(pll__('Food & supplies')); ?></a>
      <a href="<?php echo esc_url(home_url('/terrariums')); ?>" class="<?php if (is_page('terrariums')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px]"><?php echo esc_html(pll__('Terrariums')); ?></a>
      <a href="<?php echo esc_url(home_url('/offers')); ?>" class="<?php if (is_page('offers')) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px]"><?php echo esc_html(pll__('Offers')); ?></a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="<?php if (is_home() || is_single()) echo 'active'; ?> text-[#1D1D1D] no-underline !px-4 !py-2 transition-transform hover:scale-105 border-b-4 border-transparent [&.active]:border-[#1C3361] [&.active]:!mb-[-6px]"><?php echo esc_html(pll__('Blog')); ?></a>
    </nav>
  </div>

 

</header>
<?php wp_footer(); ?>
</body>
</html>
