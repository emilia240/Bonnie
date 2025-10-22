<?php get_header(); ?>


<section class="max-w-3xl mx-auto !py-12 !px-4">
  <h1 class="text-responsive-lg !mb-8 text-[#1D1D1D]" style="font-family: 'Bodoni MT', serif;">
  <?php echo esc_html(pll_e('Search results for:')); ?><span class="text-[#74B24B]" style="font-family: 'Skolar Sans', sans-serif; font-weight: 600;"><?php echo esc_html(get_search_query()); ?></span>
  </h1>

  <?php if (have_posts()) : ?>
    <ul class="space-y-8">
      <?php while (have_posts()) : the_post(); ?>
        <li class="bg-[#74B24B] text-[#1D1D1D] rounded-lg shadow lg:hover:shadow-lg transition-shadow duration-200 transition-transform duration-300 lg:hover:scale-105 !p-8">
          <a href="<?php the_permalink(); ?>" style="font-family: 'Aquavit', sans-serif;">
            <h2 class="text-responsive-md"><?php the_title(); ?></h2>
            <p class="text-responsive-sm !mt-4" style="font-family: 'Skolar Sans', sans-serif;"><?php echo esc_html(get_the_excerpt()); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else : ?>
    <p class="text-responsive-sm text-[#1D1D1D] bg-[#F4F4F4] rounded-lg shadow !p-6"><?php echo esc_html(pll_e('No results found.')); ?></p>
  <?php endif; ?>

      <!-- Custom Pagination-->
   <div class="flex items-center justify-center gap-2 my-8">
        <?php
        $links = paginate_links(array(
            'type' => 'array',
            'prev_text' => pll__('Prev'),
            'next_text' => pll__('Next')
        ));
        
        if ($links) {
            foreach ($links as $link) {
                if (strpos($link, 'current') !== false) {
                    // Current page - blue background
                    echo str_replace('page-numbers current', 'border rounded-lg border-[#1C3361] px-3 py-2 bg-[#1C3361] text-white min-w-[40px] text-center', $link);
                } else {
                    // Other pages - white background
                    echo str_replace('page-numbers', 'border rounded-lg border-[#1C3361] px-3 py-2 text-[#1C3361] lg:hover:bg-[#1C3361] lg:hover:text-white transition-colors min-w-[40px] text-center', $link);
                }
            }
        }
        ?>
    </div>

</section>

<?php get_footer(); ?>