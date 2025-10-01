<?php get_header(); ?>

    <!-- categories filter -->
    <section class="flex lg:flex-row flex-wrap justify-center !gap-4 !my-8 !px-4">
        <!-- ALL option -->
        <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
            <button class="text-responsive-sm" type="submit" name="cat" value="" class="uppercase font-bold px-4 py-2 text-[#1D1D1D] lg:hover:underline lg:hover:text-[#1C3361]" style="font-family: 'Skolar Sans', sans-serif; font-weight: 400;">
                ALL
            </button>
        </form>

        <?php
        $categories = get_categories(array('hide_empty' => true)); 
        ?>
        <?php foreach ($categories as $category): ?>
            <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                <button class="text-responsive-sm" type="submit" name="cat" value="<?php echo esc_attr($category->term_id); ?>" class="uppercase px-4 py-2 text-[#1D1D1D] lg:hover:underline lg:hover:text-[#1C3361]" style="font-family: 'Skolar Sans', sans-serif; font-weight: 400;">
                  <?php echo esc_html($category->name); ?>
                </button>
            </form>
        <?php endforeach; ?>
    </section>

    <!-- Article cards -->
    <section class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-8 px-10 ">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                    <!--Article Card -->
                <?php get_template_part('template-parts/index-articles', 'card'); ?>
            
            <?php endwhile;?>
            <?php wp_reset_postdata(); ?>

            <?php else : ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </section>

    <!-- Custom Pagination-->
   <div class="flex items-center justify-center gap-2 my-8">
        <?php
        $links = paginate_links(array(
            'type' => 'array',
            'prev_text' => 'Prev',
            'next_text' => 'Next'
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


   
<?php get_footer(); ?>