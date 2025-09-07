<footer id="colophon" class="site-footer" style="background:#0a2c5e; color:white; padding:40px 40px;">
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
    <div style="margin-bottom:40px;">
        <h4>Address</h4>
        <p>5 Fleet Street, London EC4Y 1AA</p>
    </div>
    <div>
        <h4>Opening hours/Schedule</h4>
        <p>Mon - Fri: 9:00 AM - 6:30 PM </p>
        <p>Weekdays: 10:00 AM - 5:00 PM </p>
    </div>
</div>

        
        <div class="footer-column">
            <h4>Social Media</h4>
            <ul style="list-style:none; padding:0; margin:0;">
                <li><a href="#" style="color:white; text-decoration:none;">Instagram</a></li>
                <li><a href="#" style="color:white; text-decoration:none;">Facebook</a></li>
                <li><a href="#" style="color:white; text-decoration:none;">TikTok</a></li>
            </ul>
        </div>

        
        <div class="footer-column" style="margin-right:20px">
            <h4>Contact Form</h4>
            <form method="post" action="#">
                <input type="text" name="username" placeholder="Username" style="width:100%; margin-bottom:10px; padding:8px; border-radius:4px;">
                <input type="email" name="email" placeholder="e-mail" style="width:100%; margin-bottom:10px; padding:8px; border-radius:4px;">
                <textarea name="message" placeholder="Leave a message" style="width:100%; margin-bottom:10px; padding:8px; border-radius:4px;"></textarea>
                <button type="submit" style="background:#3baae3; border:none; color:white; padding:8px 16px; cursor:pointer; border-radius:4px;">Send</button>
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
