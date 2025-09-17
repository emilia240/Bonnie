<?php get_header(); ?>

    <!-- categories filter -->
    <section class="flex flex-row justify-center !gap-4 !my-8 !px-4">
        <!-- ALL option -->
        <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
            <button type="submit" name="cat" value="" class="uppercase font-bold px-4 py-2 text-[#1D1D1D] hover:underline hover:text-[#1C3361]" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;">
                <p>ALL</p>
            </button>
        </form>

        <?php
        $categories = get_categories(array('hide_empty' => true)); 
        ?>
        <?php foreach ($categories as $category): ?>
            <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                <button type="submit" name="cat" value="<?php echo esc_attr($category->term_id); ?>" class="uppercase px-4 py-2 text-[#1D1D1D] hover:underline hover:text-[#1C3361]" style="font-family: 'Skolar Sans', sans-serif; font weight: 400;">
                    <p><?php echo esc_html($category->name); ?></p>
                </button>
            </form>
        <?php endforeach; ?>
    </section>

<!-- Article cards -->
    <section class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-8 sm:px-10 ">
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

    <!-- Pagination -->
        <!-- to style later -->
    <div class="mt-8 flex justify-center">
        <?php echo paginate_links(); ?>
    </div>


   
<?php get_footer(); ?>