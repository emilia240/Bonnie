<?php get_header(); ?>

<section class="max-w-3xl mx-auto !py-12 !px-4">
  <h1 class="text-responsive-lg !mb-8 text-[#1C3361]" style="font-family: 'Bodoni MT', serif;">
    Tag: <span class="text-[#1C3361]" style="font-family: 'Skolar Sans', sans-serif; font-weight: 600;"><?php single_term_title(); ?></span>
  </h1>

  <?php if (have_posts()) : ?>
    <ul class="space-y-8">
      <?php while (have_posts()) : the_post(); ?>
        <li class="bg-[#1C3361] text-[#F4F4F4] rounded-lg shadow lg:hover:bg-white lg:hover:text-[#1C3361] lg:hover:border lg:hover:border-[#1C3361] transition-colors duration-200 !p-8">
    
         <a href="<?php the_permalink(); ?>" style="font-family: 'Aquavit', sans-serif;">
            <h2 class="text-responsive-md"><?php the_title(); ?></h2>
         </a>
         <p class="text-responsive-sm !mt-4" style="font-family: 'Skolar Sans', sans-serif;"><?php echo esc_html(get_the_excerpt()); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else : ?>
    <p class="text-responsive-sm text-[#1D1D1D] bg-[#F4F4F4] rounded-lg shadow !p-6">No posts found with this tag.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
