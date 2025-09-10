<?php
    $promiseHeadline = get_field('promise_headline');
    $promiseText = get_field('promise_text');
    ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($promiseHeadline): ?>
            <?php echo esc_html($promiseHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>


  <div class="max-w-5xl mx-auto bg-gray-200 !mb-20 rounded-xl p-14">
  <p class="text-lg">
   <?php echo esc_html($promiseText); ?>
  </p>
</div>

