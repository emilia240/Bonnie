<?php get_header(); ?>

<!-- <main id="main-content">

</main> -->




<?php if(have_posts()): ?>
	<?php while(have_posts()): the_post() ?>









<?php if(comments_open() || get_comments_number()): ?>
				<?php comments_template(); ?>
			<?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>