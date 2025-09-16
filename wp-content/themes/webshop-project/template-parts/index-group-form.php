
  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-14">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        Community Group
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>


<div class="flex lg:flex-row sm:flex-row flex-col gap-2 items-center justify-between !mb-10 sm:px-10">
    <div class="text-lg font-body max-w-2xl" style="font-family: var(--font-body);">
      <h3> We would like to know if our users are interested in a private Facebook group. Please fill out the questions below!</h3>
    </div>
  </div>

<div class="flex justify-center mb-10 px-4">
  <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" 
        class="w-full max-w-full sm:max-w-md md:max-w-2xl lg:max-w-5xl rounded-lg bg-gray-100 p-4 sm:p-6 md:p-8 shadow-sm text-gray-900">
    <input type="hidden" name="action" value="save_survey_response" style="font-family: var(--font-body);" />

    <div class="mb-6 text-base sm:text-lg">
      <label class="mb-3 block font-medium">
        Would you be interested in a private Facebook group for our community?
      </label>
      <div class="flex flex-col gap-3 text-base sm:text-lg">
        <label for="fb_yes" class="flex cursor-pointer items-center gap-2">
          <input type="radio" name="fb_group_interest" value="yes" id="fb_yes" 
                 class="h-5 w-5 border-gray-300 text-gray-800 focus:ring-[#1C3361]"/>
          <span>Yes</span>
        </label>
        <label for="fb_no" class="flex cursor-pointer items-center gap-2">
          <input type="radio" name="fb_group_interest" value="no" id="fb_no" 
                 class="h-5 w-5 border-gray-300 text-[#1C3361] focus:ring-[#1C3361]"/>
          <span>No</span>
        </label>
      </div>
    </div>

    <!-- We can use what Thomas showed us today for this one -->
    <div class="mb-6">
      <label class="mb-3 block text-base sm:text-lg font-medium">
        If yes, how often do you use Facebook?
      </label>
      <div class="flex flex-col gap-3 text-base sm:text-lg" style="font-family: var(--font-body);">
        <label for="fb_daily" class="flex cursor-pointer items-center gap-2">
          <input type="checkbox" name="fb_usage[]" value="daily" id="fb_daily" 
                 class="h-5 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
          <span>Daily</span>
        </label>
        <label for="fb_weekly" class="flex cursor-pointer items-center gap-2">
          <input type="checkbox" name="fb_usage[]" value="weekly" id="fb_weekly" 
                 class="h-5 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
          <span>Weekly</span>
        </label>
        <label for="fb_monthly" class="flex cursor-pointer items-center gap-2">
          <input type="checkbox" name="fb_usage[]" value="monthly" id="fb_monthly" 
                 class="h-5 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
          <span>Few times a month</span>
        </label>
        <label for="fb_never" class="flex cursor-pointer items-center gap-2">
          <input type="checkbox" name="fb_usage[]" value="never" id="fb_never" 
                 class="h-5 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
          <span>I don’t use Facebook</span>
        </label>
      </div>
    </div>

    <div class="mb-6">
      <label for="fb_expectations" class="mb-3 block text-base sm:text-lg font-medium">
        What kind of content would you like to see in our group?
      </label>
      <textarea name="fb_expectations" id="fb_expectations" rows="3" 
                placeholder="e.g. care tips, contact with breeders, pet help..." 
                class="w-full h-[180px] sm:h-[200px] md:h-[230px] rounded-md border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
    </div>

    <div class="flex justify-end">
      <input type="submit" value="Submit" 
             class="w-full sm:w-[130px] rounded-md bg-[#2c5282] px-6 py-3 font-semibold text-base sm:text-lg text-white transition hover:bg-blue-800" />
    </div>
  </form>
</div>


<!-- Semantics! visual consistency?! - fonts family and size? ALIGNMENT on the page? button style consistency? mobile responsiveness?-->
