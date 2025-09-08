<footer id="colophon" class="site-footer">
    <div class="footer-container">

        <div class="footer-column">
            <ul>
                <li><a href="<?php echo home_url(); ?>"><?php echo esc_html(pll_e('Frontpage')); ?></a></li>
                <li><a href="<?php echo home_url('/blog'); ?>"><?php echo esc_html(pll_e('Blog')); ?></a></li>
                <li><a href="<?php echo home_url('/contact'); ?>"><?php echo esc_html(pll_e('Contact us')); ?></a></li>
                <li><a href="<?php echo home_url('/privacy-policy'); ?>"><?php echo esc_html(pll_e('Privacy and Policy')); ?></a></li>
                <li><a href="<?php echo home_url('/shipping-methods'); ?>"><?php echo esc_html(pll_e('Shipping methods')); ?></a></li>
                <li><a href="<?php echo home_url('/faq'); ?>"><?php echo esc_html(pll_e('FAQ')); ?></a></li>
            </ul>
        </div>

        <div class="footer-column">
            <div class="footer-block">
                <h4><?php echo esc_html(pll_e('Address')); ?></h4>
                <p>
                    <?php
                        if ( function_exists('pll_current_language') ) {
                        $lang = pll_current_language();
                        if ($lang == 'en') {
                            the_field('address_uk', 'option');
                        } elseif ($lang == 'de') {
                            the_field('address_de', 'option');
                        }
                        }
                    ?>
                </p>
            
            </div>
            <div class="footer-block">
                <h4><?php echo esc_html(pll_e('Opening Hours')); ?></h4>
                <p>
                    <?php
                        if ( function_exists('pll_current_language') ) {
                        $lang = pll_current_language();
                        if ($lang == 'en') {
                            the_field('hours_uk', 'option');
                        } elseif ($lang == 'de') {
                            the_field('hours_de', 'option');
                        }
                        }
                    ?>
                </p>

            </div>
        </div>
        

        <div class="footer-column">
            <h4>Social Media</h4>
            <ul>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">TikTok</a></li>
            </ul>
        </div>


        <div class="footer-column" >
            <h4>Contact Form</h4>
            <form method="post" action="#">
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="e-mail">
                <textarea name="message" placeholder="Leave a message"></textarea>
                <button type="submit">Send</button>
            </form>
        </div>

       
        <div class="footer-column ml-20px">
            <h4>Payment</h4>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">
        </div>
    </div>
</footer>
