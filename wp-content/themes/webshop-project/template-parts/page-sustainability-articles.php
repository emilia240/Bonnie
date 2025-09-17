<section class="w-full !py-12">
  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mb-10">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', sans-serif; font-weight: 500;">
      <?php echo esc_html(pll__('Sustainable Blogs')); ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

    

  <!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 sm:px-10">
        <?php
        // Get the category ID for 'Sustainable'
        $sustainable_cat = get_category_by_slug('sustainable');
        $cat_id = $sustainable_cat ? $sustainable_cat->term_id : 0;

        $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'cat' => $cat_id,
        'orderby' => 'date',
        'order' => 'DESC',
        );
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <?php get_template_part('template-parts/index-articles', 'card'); ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php else : ?>
        <p>No sustainable articles found.</p>
        <?php endif; ?>
  </div>

  <div class="flex justify-center mt-10">
    <a href="<?php echo esc_url(home_url('/blog')); ?>"
       class="bg-[#1C3361] text-white !px-8 !py-3 rounded-full font-semibold text-lg transition-colors hover:bg-[#78BDE8] hover:text-[#1C3361] no-underline">
        <p><?php echo esc_html(pll__('See all blog posts')); ?></p>
    </a>
</div>
</section>