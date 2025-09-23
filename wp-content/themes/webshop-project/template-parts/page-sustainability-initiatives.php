<section class="w-full !py-12">

<?php
$initiativesHeadline = get_field('initiatives_headline');
?>

<!-- Header with lines on the side -->
  <header class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', sans-serif; font-weight: 500;">
      <?php if ($initiativesHeadline): ?>
        <?php echo esc_html($initiativesHeadline); ?>
      <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </header>

  <?php if (have_rows('initiatives_list')): ?>
    <?php $i = 0; ?>
    <div class="cards px-10">
      <?php while (have_rows('initiatives_list')): the_row(); ?>
        <?php $i++; ?>
        <section class="card">
          <figure class="icon">
            <?php 
              $icon = get_sub_field('initiative_icon'); 
              if ($icon): 
                $icon_id = is_array($icon) ? $icon['ID'] : $icon;
                echo wp_get_attachment_image($icon_id, 'full'); 
              endif; 
            ?>
          </figure>
          <h3 class="text-responsive-md" style="font-family: var(--font-headers);"><?php the_sub_field('initiative_header'); ?></h3>
          <p class="text-responsive-sm" style="font-family: var(--font-body);"><?php the_sub_field('initative_description'); ?></p>
          <?php if (get_sub_field('initiative_link_button')): ?>
            <a href="#i<?php echo $i; ?>" class="learn-more-btn text-responsive-xs" style="font-family: var(--font-body);">
              <?php echo get_sub_field('button_text') ? get_sub_field('button_text') : 'Learn More'; ?>
            </a>
          <?php endif; ?>
        </section>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</section>
