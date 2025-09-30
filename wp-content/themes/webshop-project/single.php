<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        
        <main class="max-w-4xl !mx-auto !p-8 bg-white rounded-lg text-[#1D1D1D] !leading-[1.4]" style="font-family: 'Skolar Sans', sans-serif;">
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="flex items-center gap-4 text-[#1D1D1D]/80 !mb-2" style="font-family: 'Skolar Sans', sans-serif;">
                    <p class="text-responsive-xs"><?php echo get_the_date(); ?></p>
                    <p class="text-responsive-sm font-bold"><?php echo get_the_author(); ?></p>
                </div>

                <h1 class="text-responsive-lg !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php the_title(); ?></h1>

                
                <?php
                $categories_list = get_the_category_list(', '); ?>

                <?php if ($categories_list) : ?>
                    <div class="!mb-4">
                        <p style="font-family: 'Skolar Sans', sans-serif;" class="text-[#1C3361] uppercase text-responsive-sm inline-block lg:hover:underline"><?php echo $categories_list; ?></p>
                    </div>
                <?php endif; ?>

                <?php 
                $post_tags = get_the_tags();
                if ($post_tags) : ?>
                    <div class="!mb-4 flex flex-wrap gap-2">
                        <?php foreach ($post_tags as $tag) : ?>
                            <div style="font-family: 'Skolar Sans', sans-serif;" class="bg-[#1C3361] text-white !px-4 !py-2 rounded text-responsive-xs inline-block lg:hover:bg-[#F4F4F4] lg:hover:text-[#1C3361] border-2 border-transparent lg:hover:border-[#1C3361] transition">
                                <a href="<?php echo get_tag_link($tag->term_id); ?>">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="post-content !mb-8" style="font-family: 'Skolar Sans', sans-serif;">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="float-left !mr-5 !mb-5 max-w-xs w-full">
                            <?php the_post_thumbnail('large', ['class' => 'rounded-lg w-full h-auto']); ?>
                        </div>
                    <?php endif; ?> <div class="prose text-responsive-sm text-justify">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <div class="!my-10">
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                </div>

            </article>
        </main>

        <div class="w-full !py-12 px-10">
            <div class="flex items-center w-full !mb-10">
                <hr class="flex-grow border-t border-[var(--color-dark)]">
                <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
                    <?php echo esc_html(pll_e('Related Posts')); ?>
                </h2>
                <hr class="flex-grow border-t border-[var(--color-dark)]">
            </div>

            <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 sm:px-10">
                <?php
                $categories = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'ids'));
                if ($categories) :
                    $related = new WP_Query(array(
                        'post_type' => 'post',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'term_id',
                                'terms' => $categories,
                            ),
                        ),
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => 3
                    ));
                    if ($related->have_posts()):
                        while ($related->have_posts()): $related->the_post();
                            get_template_part('template-parts/index-articles', 'card');
                        endwhile;
                        wp_reset_postdata();
                    else: ?>
                        <p class="text-responsive-sm">No related articles found.</p>
                    <?php endif;
                endif;
                ?>
            </div>
        </div>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>