
  <!-- Header with lines on the side -->
  <div class="flex items-center w-full !mt-10 !mb-20">
    <hr class="flex-grow border-t border-[var(--color-dark)]">
    <h2 class="!mx-6 text-3xl" style="font-family: 'Aquavit', san-serif; font-weight: 500;">
        Community Group
    </h2>
    <hr class="flex-grow border-t border-[var(--color-dark)]">
  </div>

<!-- Header is a placeholder, also could remove the whole element -->

 <div class="flex justify-center mb-20 px-4">
  <h3 class="text-2xl max-w-full text-center">
    We would like to know if our users are interested in a private Facebook group. 
    Please answer our questions below!
  </h3>
</div>


<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="flex flex-col !ml-10 gap-6 text-gray-900">
  <input type="hidden" name="action" value="save_survey_response" />
<div>
  <label class="mb-5 block text-2xl">
    Would you be interested in a private Facebook group for our community?
  </label>
  <div class="flex items-center gap-6 text-xl">
    <label for="fb_yes" class="flex cursor-pointer items-center gap-2">
      <input type="radio" name="fb_group_interest" value="yes" id="fb_yes" class="h-5 w-5 border-gray-300 text-[#1C3361] focus:ring-blue-500"/>
      <span>Yes</span>
    </label>
    <label for="fb_no" class="flex cursor-pointer items-center gap-2">
      <input type="radio" name="fb_group_interest" value="no" id="fb_no" class="h-5 w-5 border-gray-300 text-[#1C3361] focus:ring-blue-500"/>
      <span>No</span>
    </label>
  </div>
</div>


  <!-- We can use what Thomas showed us today for this one -->

  <div>
    <label class="mb-5 block text-2xl">If yes, how often do you use Facebook?</label>
    <div class="flex flex-wrap gap-6 text-xl">
      <label for="fb_daily" class="flex cursor-pointer items-center gap-2">
        <input type="checkbox" name="fb_usage[]" value="daily" id="fb_daily" class="h-4 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
        <span>Daily</span>
      </label>
      <label for="fb_weekly" class="flex cursor-pointer items-center gap-2">
        <input type="checkbox" name="fb_usage[]" value="weekly" id="fb_weekly" class="h-4 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
        <span>Weekly</span>
      </label>
      <label for="fb_monthly" class="flex cursor-pointer items-center gap-2">
        <input type="checkbox" name="fb_usage[]" value="monthly" id="fb_monthly" class="h-4 w-5 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
        <span>Few times a month</span>
      </label>
      <label for="fb_never" class="flex cursor-pointer items-center gap-2">
        <input type="checkbox" name="fb_usage[]" value="never" id="fb_never" class="h-4 w-4 rounded border-gray-300 text-[#1C3361] focus:ring-blue-500" />
        <span>I don’t use Facebook</span>
      </label>
    </div>
  </div>

  <div>
    <label for="fb_expectations" class="mb-5 block text-2xl">What kind of content would you like to see in such group?</label>
    <textarea name="fb_expectations" id="fb_expectations" rows="3" placeholder="e.g. care tips, contact with breeders, pet help" class="h-[200px] w-[600px] rounded-md border border-gray-900 p-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
  </div>

  <div>
    <input type="submit" value="Submit" class="h-[55px] w-[130px] cursor-pointer rounded-lg bg-[#1C3361] px-6 py-2 text-lg mb-10 font-bold text-white hover:bg-blue-800" />
  </div>
</form>
