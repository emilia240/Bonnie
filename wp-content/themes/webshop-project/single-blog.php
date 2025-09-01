<?php get_header(); ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Heading -->
            <?php if (get_field('heading')) : ?>
                <h1 class="post-title"><?php the_field('heading'); ?></h1>
            <?php else: ?>
                <h1 class="post-title"><?php the_title(); ?></h1>
            <?php endif; ?>

            <!-- Date & Author -->
            <div class="post-meta" style="display: flex; gap: 20px; margin-bottom: 20px;">
                <span class="post-date"><?php the_field('date') ?: get_the_date(); ?></span>
                <span class="post-author"><?php the_field('author') ?: get_the_author(); ?></span>
            </div>

            <!-- Main content: image left, text right -->
            <div class="post-content" style="overflow: hidden;">
                
                <!-- Left side image -->
                <?php if (get_field('featured_image') || has_post_thumbnail()) : ?>
                    <div class="post-image" style="float: left; margin-right: 20px; margin-bottom: 20px; width: 300px;">
                        <?php if (get_field('featured_image')) : ?>
                            <img src="<?php the_field('featured_image'); ?>" style="width:100%; height:auto;" />
                        <?php else : ?>
                            <?php the_post_thumbnail('large', ['style' => 'width:100%; height:auto;']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Right side text -->
                <div class="post-text">
                    <?php if (get_field('post_text')) : ?>
                        <?php the_field('post_text'); ?>
                    <?php else: ?>
                        <?php the_content(); ?>
                    <?php endif; ?>
                </div>

                <div style="clear: both;"></div>
            </div>

            <!-- Comments Section -->

        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

            <!-- Related Posts -->
            <div class="related-posts" style="margin-top: 40px;">
                <h3>Related Posts</h3>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <?php
                    $categories = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'ids'));
                    if ($categories) :
                        $related = new WP_Query(array(
                            'post_type' => 'blog',
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

                        while ($related->have_posts()) : $related->the_post(); ?>
                            <div class="related-post" style="flex: 0 0 30%;">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', ['style' => 'width:100%; height:auto;']); ?>
                                    <?php endif; ?>
                                    <h4><?php the_title(); ?></h4>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>




        </article>


     

<?php
    endwhile;
endif;
?>

<?php get_footer(); ?>
