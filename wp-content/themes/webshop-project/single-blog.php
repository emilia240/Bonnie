<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>

        <!-- Heading -->
        <?php if (get_field('heading')) : ?>
            <h1 class="post-title"><?php the_field('heading'); ?></h1>
        <?php else: ?>
            <h1 class="post-title"><?php the_title(); ?></h1>
        <?php endif; ?>

        <!-- Date & Author -->
        <div class="post-meta">
            <span class="post-date"><?php the_field('date') ?: get_the_date(); ?></span>
            <span class="post-author"><?php the_field('author') ?: get_the_author(); ?></span>
        </div>
        
         <?php
         $categories_list = get_the_category_list(', ');
         if ($categories_list) : ?>
            <div class="post-categories">
                <strong>Categories:</strong> <?php echo $categories_list; ?>
            </div>
         <?php endif; ?>

         <?php 
         $post_tags = get_the_tag_list('', ', ');
         if ($post_tags) : ?>
         <div class="post-tags">
            <strong>Tags:</strong> <?php echo $post_tags; ?>
         </div> 
         <?php endif; ?>

        <!-- Main content: image left, text right -->
        <div class="post-content">
            
            <!-- Left side image -->
            <?php if (get_field('featured_image') || has_post_thumbnail()) : ?>
                <div class="post-image">
                    <?php if (get_field('featured_image')) : ?>
                        <img src="<?php the_field('featured_image'); ?>" alt="<?php the_title(); ?>" />
                    <?php else : ?>
                        <?php the_post_thumbnail('large'); ?>
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
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <?php if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif; ?>
        </div>

        <!-- Related Posts -->
        <div class="related-posts">
            <h3>Related Posts</h3>
            <div class="related-grid">
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
                        <div class="related-post">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
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
 
<?php endwhile; endif; ?>

<?php get_footer(); ?>
