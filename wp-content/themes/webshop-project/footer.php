<?php?>

<footer id="colophon" class="site-footer" style="background:#0a2c5e; color:white; padding:40px 0;">
    <div class="container" style="display:grid; grid-template-columns: repeat(5, 1fr); gap:30px; text-align:left;">

       
        <div class="footer-column">
            <ul style="list-style:none; padding:0; margin:0;">
                <li><a href="<?php echo home_url(); ?>" style="color:white; text-decoration:none;">Frontpage</a></li>
                <li><a href="<?php echo home_url('/blog'); ?>" style="color:white; text-decoration:none;">Blog</a></li>
                <li><a href="<?php echo home_url('/contact'); ?>" style="color:white; text-decoration:none;">Contact us</a></li>
                <li><a href="<?php echo home_url('/privacy-policy'); ?>" style="color:white; text-decoration:none;">Privacy and Policy</a></li>
                <li><a href="<?php echo home_url('/shipping-methods'); ?>" style="color:white; text-decoration:none;">Shipping methods</a></li>
                <li><a href="<?php echo home_url('/faq'); ?>" style="color:white; text-decoration:none;">FAQ</a></li>
            </ul>
        </div>

       
        <div class="footer-column">
            <h4>Address</h4>
            <p>body text</p>
        </div>

        
        <div class="footer-column">
            <h4>Social Media</h4>
            <ul style="list-style:none; padding:0; margin:0;">
                <li><a href="#" style="color:white; text-decoration:none;">Instagram</a></li>
                <li><a href="#" style="color:white; text-decoration:none;">Facebook</a></li>
                <li><a href="#" style="color:white; text-decoration:none;">TikTok</a></li>
            </ul>
        </div>

        
        <div class="footer-column">
            <h4>Contact Form</h4>
            <form method="post" action="#">
                <input type="text" name="username" placeholder="Username" style="width:100%; margin-bottom:10px; padding:8px;">
                <input type="email" name="email" placeholder="e-mail" style="width:100%; margin-bottom:10px; padding:8px;">
                <textarea name="message" placeholder="Leave a message" style="width:100%; margin-bottom:10px; padding:8px;"></textarea>
                <button type="submit" style="background:#3baae3; border:none; color:white; padding:8px 16px; cursor:pointer;">Send</button>
            </form>
        </div>


        <div class="footer-column">
            <h4>Payment</h4>
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" style="height:30px; display:block; margin-bottom:10px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard" style="height:30px; display:block; margin-bottom:10px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" style="height:30px; display:block;">
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
