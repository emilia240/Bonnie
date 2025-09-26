<footer class="bg-[#1C3361] text-[#F4F4F4] !py-12 !px-10" style="font-family: 'Skolar Sans', sans-serif;">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 text-left">

        <div class="footer-column">
            <ul class="flex flex-col gap-2">
                <li><a href="<?php echo home_url(); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Frontpage')); ?></a></li>
                <li><a href="<?php echo home_url('/blog'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Blog')); ?></a></li>
                <li><a href="<?php echo home_url('/contact'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Contact us')); ?></a></li>
                <li><a href="<?php echo home_url('/privacy-policy'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Privacy and Policy')); ?></a></li>
                <li><a href="<?php echo home_url('/shipping-methods'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Shipping methods')); ?></a></li>
                <li><a href="<?php echo home_url('/faq'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('FAQ')); ?></a></li>
            </ul>
        </div>

        <div>
            <div class="!mb-6">
                <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php echo esc_html(pll_e('Address')); ?></h4>
                <p>
                    <?php
                    if ( function_exists('pll_current_language') ) {
                        $lang = pll_current_language();
                        the_field('address_' . $lang, 'option');
                    }
                    ?>
                </p>
            
            </div>
            <div class="!mb-6">
                <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php echo esc_html(pll_e('Opening Hours')); ?></p>
                <p>
                    <?php
                        if ( function_exists('pll_current_language') ) {
                        $lang = pll_current_language();
                        the_field('hours_' . $lang, 'option');
                        }
                    ?>
                </p>

            </div>
        </div>
        

        <div>
            <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php echo esc_html(pll_e('Social Media')); ?></p>
            <div class="flex flex-col gap-2">
                <a href="#" target="_blank" aria-label="Facebook" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook.svg" alt="Facebook" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:invert-1 lg:group-hover:brightness-0 lg:group-hover:sepia lg:group-hover:hue-rotate-[180deg] lg:group-hover:saturate-[7] lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]"><?php echo esc_html(pll_e('Facebook')); ?></span>
                </a>
                <a href="#" target="_blank" aria-label="Instagram" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram.svg" alt="Instagram" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:invert-1 lg:group-hover:brightness-0 lg:group-hover:sepia lg:group-hover:hue-rotate-[180deg] lg:group-hover:saturate-[7] lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]"><?php echo esc_html(pll_e('Instagram')); ?></span>
                </a>
                <a href="#" target="_blank" aria-label="TikTok" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/tiktok.svg" alt="TikTok" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:invert-1 lg:group-hover:brightness-0 lg:group-hover:sepia lg:group-hover:hue-rotate-[180deg] lg:group-hover:saturate-[7] lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]"><?php echo esc_html(pll_e('TikTok')); ?></span>
                </a>
            </div>
        </div>


        <div class="footer-column" >
            <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php echo esc_html(pll_e('Contact Form')); ?></p>
            <form method="post" action="#" class="flex flex-col gap-2">
                <input type="text" name="username" placeholder="Username" class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]">
                <input type="email" name="email" placeholder="e-mail" class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]">
                <textarea name="message" placeholder="Leave a message" class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]"></textarea>
                <button type="submit" class="bg-[#74B24B] lg:hover:bg-[#78BDE8] text-white !px-4 !py-2 rounded transition w-fit">Send</button>
            </form>
        </div>

       
        <div>
            <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;"><?php echo esc_html(pll_e('Payment')); ?></p>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" class="!h-8 !mb-3 filter brightness-0 invert transition lg:hover:filter-none">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard" class="!h-8 !mb-3 filter brightness-0 invert transition lg:hover:filter-none">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="!h-8 !mb-3 filter brightness-0 invert transition lg:hover:filter-none">
        </div>
    </div>
</footer>


    <!-- Back to top -->
    <div id="back-to-top"
        style="display:none; position:fixed; bottom:40px; right:40px; z-index:999;">
        <button onclick="window.scrollTo({top:0,behavior:'smooth'});"
            style="background:#74B24B; border:none; border-radius:50%; width:56px; height:56px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.15); cursor:pointer;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </button>
    </div>
<?php wp_footer(); ?>

</body>
</html>
