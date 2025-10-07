</main> <!-- Close main content area -->

<footer class="bg-[#1C3361] text-[#F4F4F4] !py-12 !px-10" style="font-family: 'Skolar Sans', sans-serif;" role="contentinfo">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 text-left">

        <nav class="footer-column" role="navigation" aria-label="Footer navigation">
            <ul class="flex flex-col gap-2">
                <li><a href="<?php echo home_url(); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Frontpage')); ?></a></li>
                <li><a href="<?php echo home_url('/blog'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Blog')); ?></a></li>
                <li><a href="<?php echo home_url('/contact'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Contact us')); ?></a></li>
                <li><a href="<?php echo home_url('/privacy-policy'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Privacy and Policy')); ?></a></li>
                <li><a href="<?php echo home_url('/shipping-methods'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('Shipping methods')); ?></a></li>
                <li><a href="<?php echo home_url('/faq'); ?>" class="lg:hover:text-[#78BDE8] transition-colors"><?php echo esc_html(pll_e('FAQ')); ?></a></li>
            </ul>
        </nav>

        <div>
            <div class="!mb-6" role="contentinfo" aria-label="Store address">
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
            <div class="!mb-6" role="contentinfo" aria-label="Store opening hours">
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
    

    <!-- Social Media Section -->
    <div role="navigation" aria-label="Social media links">
    <div class="flex flex-col gap-2">
        <?php if (function_exists('pll_current_language')) {
            $lang = pll_current_language();
            if ($lang == 'en') { ?>
                <a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank" aria-label="Facebook" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook.svg" alt="Facebook" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">Facebook</span>
                </a>
                <a href="<?php the_field('instagram_url', 'option'); ?>" target="_blank" aria-label="Instagram" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram.svg" alt="Instagram" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">Instagram</span>
                </a>
                <a href="<?php the_field('tiktok_url', 'option'); ?>" target="_blank" aria-label="TikTok" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/tiktok.svg" alt="TikTok" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">TikTok</span>
                </a>
            <?php } else { ?>
                <a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank" aria-label="Facebook" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/facebook.svg" alt="Facebook" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">Facebook</span>
                </a>
                <a href="<?php the_field('instagram_url', 'option'); ?>" target="_blank" aria-label="Instagram" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/instagram.svg" alt="Instagram" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">Instagram</span>
                </a>
                <a href="<?php the_field('whatsapp_url', 'option'); ?>" target="_blank" aria-label="WhatsApp" class="flex items-center gap-3 group">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg" alt="WhatsApp" class="w-8 h-8 transition duration-200 filter invert lg:group-hover:text-[#78BDE8]">
                    <span class="text-white transition-colors duration-200 lg:group-hover:text-[#78BDE8]">WhatsApp</span>
                </a>
            <?php }
        } ?>
    </div>
</div>

    <!-- Contact Form Section -->
    <div class="footer-column">
        <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;">
            <?php echo esc_html(pll_e('Contact Form')); ?>
        </p>
        <?php if (function_exists('pll_current_language')) : ?>
            <form method="post" action="#" class="flex flex-col gap-2">
                <input type="text" name="username" placeholder="<?php echo esc_attr(pll__('Username')); ?>" 
                       class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]">
                <input type="email" name="email" placeholder="<?php echo esc_attr(pll__('Email')); ?>" 
                       class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]">
                <textarea name="message" placeholder="<?php echo esc_attr(pll__('Leave a message')); ?>" 
                          class="w-full !mb-2 !px-3 !py-2 rounded bg-[#F4F4F4] text-[#1D1D1D]"></textarea>
                <button type="submit" class="bg-[#1D1D1D] lg:hover:bg-[#78BDE8] text-white !px-4 !py-2 rounded transition w-fit">
                    <?php echo esc_html(pll_e('Send')); ?>
                </button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Payment Methods Section -->
    <div>
        <p class="text-responsive-md !mb-2" style="font-family: 'Aquavit', sans-serif;">
            <?php echo esc_html(pll_e('Payment')); ?>
        </p>
        <?php if (function_exists('pll_current_language')) : 
            $payment_methods = [
                'visa' => 'https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png',
                'mastercard' => 'https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png',
                'paypal' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg'
            ];
            foreach ($payment_methods as $method => $logo) : ?>
                <img src="<?php echo esc_url($logo); ?>" 
                     alt="<?php echo ucfirst($method); ?>" 
                     class="!h-8 !mb-3 filter brightness-0 invert transition lg:hover:filter-none">
            <?php endforeach;
        endif; ?>
    </div>
<?php wp_footer(); ?>

</body>
</html>
