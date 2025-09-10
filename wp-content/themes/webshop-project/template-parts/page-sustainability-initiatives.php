<?php
    $initiativesHeadline = get_field('initiatives_headline');

    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-5">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($initiativesHeadline): ?>
            <?php echo esc_html($initiativesHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>