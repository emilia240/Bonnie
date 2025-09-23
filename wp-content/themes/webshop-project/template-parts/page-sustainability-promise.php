<section class="w-full !py-12">


  <?php
    $promiseHeadline = get_field('promise_headline');
    $promiseText = get_field('promise_text');
  ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full md:max-xl:flex !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-responsive-lg" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($promiseHeadline): ?>
            <?php echo esc_html($promiseHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

  <!-- Content box -->
  <div class="max-w-4xl mx-auto bg-gray-200 rounded-xl p-6 md:p-10 lg:p-14">
    <p class="text-responsive-base" style="font-family: var(--font-body);">
      <?php echo esc_html($promiseText); ?>
    </p>
  </div>

</section>
