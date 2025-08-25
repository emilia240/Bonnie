<?php get_header(); ?>
    <!-- //variables -->

    <?php if ($loop -> have_posts() ) : ?>
        
        <?php while ( $loop -> have_posts() ) : $loop -> the_post(); ?>
        <!-- //content -->
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

    <?php endif; ?>
<?php get_footer(); ?>