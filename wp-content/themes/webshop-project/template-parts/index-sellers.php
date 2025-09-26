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

  <!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 sm:px-10 ">
        <?php
        $args = array(
            'post_type' => 'post', // TO BE CHANGED to webshop post type(I guess) later
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <!--Article Card -->
                <?php get_template_part('template-parts/index-articles', 'card'); ?>
            
            <?php endwhile;?>
            <?php wp_reset_postdata(); ?>

            <?php else : ?>
            <p>No products found.</p>
        <?php endif; ?>
  </div>
</section>