<section class="w-full !py-12">



   <?php
    $tipHeadline = get_field('tip_headline');
    $tipNewsletterHeader = get_field('tip_newsletter_header');
    $tipNewsletterDescription = get_field('tip_newsletter_description');
    $newsletterButton = get_field('newsletter_button');

  ?>

  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        <?php if ($tipHeadline): ?>
            <?php echo esc_html($tipHeadline); ?>
        <?php endif; ?>
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>
  
  <div class="flex flex-col items-center justify-center text-xl !mb-16">
    <!-- Wrapper to align headline + green box -->
   <div class="w-full max-w-4xl">
   
    <p class="mb-6 text-left text-xl" style="font-family: var(--font-body);">
            <?php echo esc_html($tipNewsletterHeader); ?>
    </p>

    <div class="!min-h-[200px] md:min-h-[400px] rounded-xl bg-[#74B24B] p-14">
      <form class="flex flex-col gap-4">
        <div class="flex flex-col items-center gap-4 md:flex-row">
          <input 
            type="email" 
            placeholder="write your email here....." 
            class="flex-1 rounded-lg bg-[#F4F4F4] w-full px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-700" style="font-family: var(--font-body);"
          />
          <button 
            type="submit" 
            class="rounded-md bg-[#1C3361] px-6 lg:w-[130px] md:w-[300px] py-3 font-semibold text-lg text-[#F4F4F4] hover:bg-white hover:text-[#1C3361] 
            hover:border hover:border-[#1C3361] transition-colors duration-200" style="font-family: var(--font-body);"
          >
            <?php echo esc_html($newsletterButton); ?></h3>
          </button>
        </div>

         
        <p class="md:text-sm lg:text-sm text-[#F4F4F4]" style="font-family: var(--font-body);">
            <?php echo esc_html($tipNewsletterDescription); ?>
        </p>
      </form>
    </div>
  </div>
 </div>



</section>
