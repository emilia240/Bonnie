<section class="w-full py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex items-center w-full mb-10 px-4">
            <h3 id="review-form-heading" class="mx-6 text-responsive-md" style="font-family: 'Aquavit', sans-serif; font-weight: 500;">
                <?php echo esc_html(pll_e('Submit Your Review')); ?>
            </h3>
        </div>

        <?php if (!is_user_logged_in()): ?>
            <!-- Not logged in - show registration link -->
            <div class="bg-[#efefef] px-4 py-3 rounded mb-6">
                <p><?php echo esc_html(pll_e('You must be logged in to submit a review.')); ?></p>
                <a href="<?php echo wp_registration_url(); ?>" class="text-[#1C3361] underline" style="font-family: var(--font-body);">
                    <?php echo esc_html(pll_e('Register here')); ?>
                </a>
                <?php echo esc_html(pll_e(' or ')); ?>
                <a href="<?php echo wp_login_url(); ?>" class="text-[#1C3361] underline" style="font-family: var(--font-body);">
                    <?php echo esc_html(pll_e('Login')); ?>
                </a>
            </div>
        <?php else: ?>
            <!-- Logged in - show form -->
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" enctype="multipart/form-data"
                  class="w-full max-w-full sm:max-w-md md:max-w-2xl lg:max-w-5xl rounded-lg bg-gray-100 p-4 sm:p-6 md:p-8 shadow-sm text-gray-900" role="form">
                
                <!-- Security nonce -->
                <?php wp_nonce_field('submit_review', 'review_nonce'); ?>
                <input type="hidden" name="action" value="submit_review">

                <!-- Name -->
                <div class="mb-6">
                    <label for="reviewer_name" class="block text-sm text-[#1D1D1D] mb-2" style="font-family: var(--font-body);">
                        <?php echo esc_html(pll_e('Your Name')); ?> <span class="text-[#1C3361]">*</span>
                    </label>
                    <input type="text" id="reviewer_name" name="reviewer_name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1C3361]">
                </div>

                <!-- Photo -->
                <div class="mb-6"> 
                    <label for="reviewer_image" class="block text-sm text-[#1D1D1D] mb-2" style="font-family: var(--font-body);">
                        <?php echo esc_html(pll_e('Your Photo')); ?> <?php echo esc_html(pll_e('(Optional)')); ?>
                    </label>
                    <input type="file" id="reviewer_image" name="reviewer_image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Rating -->
                <div class="mb-6">
                    <label class="block text-sm text-[#1D1D1D] mb-2" style="font-family: var(--font-body);">
                        <?php echo esc_html(pll_e('Rating')); ?> <span class="text-[#1C3361]">*</span>
                    </label>
                    <div class="flex gap-2" style="font-family: var(--font-body);">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <label class="flex items-center">
                                <input type="radio" name="stars" value="<?php echo $i; ?>" required class="mr-1">
                                <span><?php echo $i; ?> ⭐</span>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Review Text -->
                <div class="mb-6">
                    <label for="review_text" class="block text-sm text-[#1D1D1D] mb-2" style="font-family: var(--font-body);">
                        <?php echo esc_html(pll_e('Your Review')); ?> <span class="text-[#1C3361]">*</span>
                    </label>
                    <textarea id="review_text" name="review_text" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1C3361]"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"  style="font-family: var(--font-body);"
                            class="w-full sm:w-[130px] cursor-pointer rounded-md bg-[#1C3361] px-6 py-3 text-[#F4F4F4] text-responsive-sm lg:hover:bg-white lg:hover:text-[#1C3361]
                            lg:hover:border lg:hover:border-[#1C3361] transition-colors duration-200">
                        <?php echo esc_html(pll_e('Submit Review')); ?>
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>