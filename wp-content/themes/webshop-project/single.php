<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>

			<!-- Heading -->
			<h1 class="post-title" style="font-family: 'Aquavit', sans-serif;"><?php the_title(); ?></h1>

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
			$post_tags = get_the_tags();
			if ($post_tags) : ?>
			    <div class="post-tags">
			        <?php foreach ($post_tags as $tag) : ?>
			            <span class="tag-button">
			                <a href="<?php echo get_tag_link($tag->term_id); ?>">
			                    <?php echo esc_html($tag->name); ?>
			                </a>
			            </span>
			        <?php endforeach; ?>
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
			<div class="related-posts w-full !py-12">
				<!-- Header with lines on the side -->
				<div class="flex items-center w-full !mb-10">
					<hr class="flex-grow border-t border-[var(--color-dark)]">
					<h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
						<?php echo esc_html(pll_e('Related Posts')); ?>
					</h2>
					<hr class="flex-grow border-t border-[var(--color-dark)]">
				</div>

				<!-- Related Article Cards Grid -->
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
							<p>No related articles found.</p>
						<?php endif;
					endif;
					?>
				</div>
			</div>

		</article>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>