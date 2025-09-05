<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>

			<!-- Heading -->
			<h1 class="post-title"><?php the_title(); ?></h1>

			<!-- Date & Author -->
			<div class="post-meta">
				<span class="post-date"><?php echo get_the_date(); ?></span>
				<span class="post-author"><?php echo get_the_author(); ?></span>
			</div>
			
			<?php
			$categories_list = get_the_category_list(', '); ?>

			<?php if ($categories_list) : ?>
				<div class="post-categories">
					<span class= "category-button"><?php echo $categories_list; ?></span> 
				</div>
			<?php endif; ?>

			<?php 
			$post_tags = get_the_tag_list('', ', '); ?>
			<?php if ($post_tags) : ?>
				<div class="post-tags">
					<span class= "tag-button"><?php echo $post_tags; ?></span> 
				</div> 
			<?php endif; ?>

			<!-- Main content with floated image -->
			<div class="post-content">
				<?php if (has_post_thumbnail()) : ?>
					<div class="post-image-wrap">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php endif; ?>

				<?php the_content(); ?>
			</div>

			<!-- Comments Section -->
			<div class="comments-section">
				<?php if (comments_open() || get_comments_number()) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			</div>

			<!-- Related Posts -->
			<div class="related-posts">
				<h3>Related Posts</h3>
				<div class="related-grid">
					<?php
					$categories = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'ids')); ?>
					<?php if ($categories) : ?>
						<?php $related = new WP_Query(array(
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
						?>

						<?php while ($related->have_posts()) : $related->the_post(); ?>
							<div class="related-post">
								<a href="<?php the_permalink(); ?>">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('medium'); ?>
									<?php endif; ?>
									<h4><?php the_title(); ?></h4>
								</a>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>

		</article>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>