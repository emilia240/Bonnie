<?php get_header(); ?>

    <!-- categories filter here -->
    <div class="flex flex-row gap-4 mb-8 px-4">
        <!-- ALL option -->
        <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
            <button type="submit" name="cat" value="" class="uppercase px-4 py-2 rounded bg-[#1C3361] text-white hover:bg-white hover:text-[#1C3361] hover:border hover:border-[#1C3361] transition-colors duration-200">
                ALL
            </button>
        </form>
        <?php
        $categories = get_categories(array('hide_empty' => true)); ?>
        <?php foreach ($categories as $category): ?>
            <form method="get" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                <button type="submit" name="cat" value="<?php echo esc_attr($category->term_id); ?>" class="uppercase px-4 py-2 rounded bg-[#1C3361] text-white hover:bg-white hover:text-[#1C3361] hover:border hover:border-[#1C3361] transition-colors duration-200">
                    <?php echo esc_html($category->name); ?>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

<!-- Article cards -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mb-8 sm:px-10 ">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php
                    $url = get_the_permalink();
                    $categories = get_the_category();
                    $tags = get_the_tags();
                    $title = get_the_title();
                    $description = get_the_excerpt();
                    $image_id = get_post_thumbnail_id();
                    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';


                    $cat_id = isset($_GET['cat']) && $_GET['cat'] !== '' ? intval($_GET['cat']) : '';
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 15,
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    );
                    if ($cat_id) {
                        $args['cat'] = $cat_id;
                    }
                    $query = new WP_Query($args);
                ?>
                    <!--Article Card -->
                <?php get_template_part('template-parts/index-articles', 'card'); ?>
            
            <?php endwhile;?>
            <?php wp_reset_postdata(); ?>

            <?php else : ?>
            <p>No articles found.</p>

             <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <?php echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => get_query_var('paged') ? get_query_var('paged') : 1,
                )); ?>
            </div>
        <?php endif; ?>
    </div>


   
<?php get_footer(); ?>