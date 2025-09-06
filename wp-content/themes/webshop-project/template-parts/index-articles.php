<section class="w-full !py-12">

  <?php
    $headline = get_field('articles_headline');
    $subtitle = get_field('articles_subtitle');
  ?>


  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mb-6">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
      <?php echo esc_html($headline); ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

  <!-- Subtitle and button row -->
  <div class="flex lg:flex-row sm:flex-row flex-col gap-2 items-center justify-between !mb-8 sm:px-10">
    <div class="text-lg font-body max-w-2xl" style="font-family: var(--font-body);">
      <?php echo esc_html($subtitle); ?>
    </div>
    <a  href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
    class="bg-[#1C3361] text-[#F4F4F4] !px-6 !py-2 rounded-full inline-flex items-center !gap-2 no-wrap hover:bg-white hover:text-[#1C3361] 
            hover:border hover:border-[#1C3361] transition-colors duration-200" style="font-family: 'Bodoni MT', serif; font-weight: 500;">
      Our blogs
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <line x1="4" y1="12" x2="18" y2="12" stroke="currentColor" stroke-width="2"/>
            <polyline points="12,6 18,12 12,18" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </a>
  </div>

  <!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 sm:px-10 ">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
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
            <p>No articles found.</p>
        <?php endif; ?>
  </div>
</section>