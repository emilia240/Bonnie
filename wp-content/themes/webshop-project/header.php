<?php
/**
 * The header for Terraqua theme (static version, no ACF)
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">

  <!-- Upper header -->
  <div class="header-top" style="background:#0b2a57; color:#fff; padding:12px 20px; display:flex; align-items:center; justify-content:space-between;">
    
    <!-- Logo -->
    <div class="logo">
      <a href="<?php echo home_url(); ?>" style="color:#fff; text-decoration:none; font-weight:bold; font-size:22px;">
        TERRAQUA
      </a>
    </div>

    <!-- Search -->
    <div class="search-bar" style="flex:1; margin:0 30px;">
      <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="position:relative;">
        <input type="search" name="s" placeholder="Search" style="width:100%; padding:8px 14px; border-radius:20px; border:1px solid #ccc;">
      </form>
    </div>

    <!-- Links -->
    <nav class="top-links" style="margin-right:20px; font-size:14px;">
      <a href="#" style="color:#fff; margin:0 10px;">Reorder</a>
      <a href="#" style="color:#fff; margin:0 10px;">Favorites</a>
      <a href="#" style="color:#fff; margin:0 10px;">Shipping</a>
      <a href="#" style="color:#fff; margin:0 10px;">Contact us</a>
    </nav>

    <!-- Login & Basket -->
    <div class="user-actions" style="display:flex; gap:12px;">
      <a href="#" style="background:#222; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:14px;">👤 Login</a>
      <a href="#" style="background:#222; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:14px;">🛒 Basket</a>
    </div>
  </div>

  <!-- Lower header (nav menu) -->
  <div class="header-bottom" style="background:#f0f0f0; padding:12px 20px;">
    <nav class="main-nav" style="display:flex; gap:40px; font-weight:bold;">
      <a href="#" style="color:#000; text-decoration:none;">Pets</a>
      <a href="#" style="color:#000; text-decoration:none;">Food &amp; supplies</a>
      <a href="#" style="color:#000; text-decoration:none;">Terrariums</a>
      <a href="#" style="color:#000; text-decoration:none;">Offers</a>
      <a href="#" style="color:#000; text-decoration:none; border-bottom:3px solid #0b2a57; padding-bottom:2px;">Blog</a>
    </nav>
  </div>

</header>
