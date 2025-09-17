<?php get_header(); ?>

<section class="max-w-3xl mx-auto !py-12 !px-4">
  <h1 class="text-xl !mb-8 text-[#1C3361]" style="font-family: 'Bodoni MT', serif;">
    Category: <span class="text-[#1C3361] underline uppercase" style="font-family: 'Skolar Sans', sans-serif; font-weight: 600;"><?php single_term_title(); ?></span>
  </h1>

  <?php if (have_posts()) : ?>
    <ul class="space-y-8">
      <?php while (have_posts()) : the_post(); ?>
        <li class="bg-[#f4f4f4] text-[#1C3361] rounded-lg shadow hover:shadow-lg transition-shadow duration-200 transition-transform duration-300 hover:scale-105 !p-8">
          <a href="<?php the_permalink(); ?>" class="text-2xl" style="font-family: 'Aquavit', sans-serif;">
            <h2><?php the_title(); ?></h2>
          </a>
          <p class="text-sm !mt-4" style="font-family: 'Skolar Sans', sans-serif;"><?php echo esc_html(get_the_excerpt()); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else : ?>
    <p class="text-lg text-[#1D1D1D] bg-[#F4F4F4] rounded-lg shadow !p-6">No posts found in this category.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
