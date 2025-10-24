<section class="w-full !py-12 px-10">

    <?php
    $headline = get_field('sellers_headline');
    $subtitle = get_field('sellers_subtitle');
    $button_text = get_field('sellers_button_text');

    $button_url = home_url('/pets'); // Link to the pets page
    ?>


  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mb-10">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
      <?php echo esc_html($headline); ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

  <!-- Subtitle and button row -->
  <div class="flex lg:flex-row sm:flex-row flex-col gap-2 items-center justify-between !mb-8 sm:px-10">
    <p class="text-responsive-md font-body max-w-2xl" style="font-family: var(--font-body);">
        <?php if ($subtitle): ?>
            <?php echo esc_html($subtitle); ?>
        <?php endif; ?>
    </p>
    <a  href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
    class="bg-[#1C3361] text-[#F4F4F4] !px-6 !py-2 rounded-full inline-flex items-center !gap-2 no-wrap lg:hover:bg-white lg:hover:text-[#1C3361] 
            lg:hover:border lg:hover:border-[#1C3361] transition-colors duration-200" style="font-family: 'Bodoni MT', serif; font-weight: 500;">
        <?php if ($button_text): ?>
            <p class="text-responsive-base"><?php echo esc_html($button_text); ?></p>
        <?php endif; ?>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
            <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </a>
  </div>

  <!-- Product cards with Tailwind classes only -->
<div class="grid gap-6 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 sm:px-10">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query = new WP_Query($args);
    ?>

    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <?php
            global $product;
            $is_on_sale = $product->is_on_sale();
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_price();
            ?>
            
            <!-- Product Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <a href="<?php the_permalink(); ?>" class="block relative">
                    
                    <!-- Image Container -->
                    <div class="relative overflow-hidden rounded-2xl">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large', [
                                'class' => 'w-full h-64 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-300'
                            ]); ?>
                        <?php else: ?>
                            <div class="w-full h-64 bg-gray-200 rounded-2xl flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        <?php endif; ?>
                      
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/60 to-transparent rounded-2xl"></div>

                        <?php if ($is_on_sale): ?>
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-white/90 text-red-500 px-3 py-1 rounded-lg text-sm font-bold">
                                    Sale!
                                </span>
                            </div>
                        <?php endif; ?>
                       
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white z-10">
                           
                            <h3 class="text-lg font-bold mb-4 text-white leading-tight" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                <?php the_title(); ?>
                            </h3>
                            
                            <div class="flex flex-col gap-1 mb-4">
                                <?php if ($is_on_sale && $regular_price): ?>
                                    <span class="text-sm text-gray-300 line-through">
                                        <?php echo esc_html($regular_price); ?>,00 kr.
                                    </span>
                                <?php endif; ?>
                                <span class="text-xl font-bold text-white" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                    <?php echo esc_html($sale_price); ?>,00 kr.
                                </span>
                            </div>
                           
                            <button class="w-full bg-white/90 text-blue-800 py-2 px-4 rounded-lg font-medium hover:bg-white transition-colors duration-200">
                                ADD TO CART
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

    <?php else: ?>
        <p class="text-center col-span-full text-gray-600">No products found.</p>
    <?php endif; ?>
</div>
</section>