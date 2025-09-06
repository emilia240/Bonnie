<section class="w-full !py-12">

    <?php
    $headline = get_field('services_headline');
    $image = get_sub_field('service_image');
    $title = get_sub_field('service_title');
    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mb-6">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($headline): ?>
            <?php echo esc_html($headline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

  <!-- Services grid -->
  <div class="grid gap-10 w-full grid-cols-1 sm:grid-cols-3 !px-4 !sm:px-10">
    <?php if (have_rows('services_list')): ?>
      <?php while (have_rows('services_list')): the_row(); ?>
        <!-- Service Item -->
        <div class="flex flex-col items-center">
          <?php $image = get_sub_field('service_image'); ?>
          <?php if ($image): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="w-32 h-32 object-cover rounded-full !mb-4" />
          <?php endif; ?>
          <h3 class="text-xl font-bold text-center" style="font-family: 'Aquavit', san-serif;">
            <?php echo esc_html($title); ?>
          </h3>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

</section>