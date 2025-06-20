<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Sets the site charset -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive design for mobile devices -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect to Google Fonts static resources -->
 
    <?php wp_head(); ?> <!-- WordPress hook for including styles and scripts -->
</head>
<body <?php body_class(); ?>> <!-- Adds contextual classes to the body tag -->
<header class="site-header">
    <div class="container header flexbox">
        <div class="header-logo">
            <?php the_custom_logo(); ?> <!-- Displays the custom logo set in the theme -->
        </div>
        <nav class="header-menu" id="main-menu">
            <?php
            // Displays the main navigation menu
            wp_nav_menu([
                'theme_location' => 'main_menu',
                'container'      => false,
                'menu_class'     => 'menu',
            ]);
            ?>
        </nav>
        <div class="header-btn">
            <!-- Contact button, hidden on mobile -->
            <a href="<?php echo esc_url(get_theme_mod('contacts_btn_url', '/contacts')); ?>" class="btn contact-btn hidden-mobile">
                <?php echo esc_html(get_theme_mod('contacts_btn_text', 'Contact Us')); ?>
            </a>
        </div>
        <!-- Burger button for opening the mobile menu -->
        <button class="burger" id="burger-btn" aria-label="Open menu">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="mobile-menu" id="mobile-menu">
        <!-- Close button for the mobile menu -->
        <button class="close-mobile-menu" id="close-mobile-menu" aria-label="Close menu">&times;</button>
        <?php
        // Displays the main navigation menu in the mobile menu
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container'      => false,
            'menu_class'     => 'menu',
        ]);
        ?>
        <!-- Contact button in the mobile menu -->
        <a href="<?php echo esc_url(get_theme_mod('contacts_btn_url', '/contacts')); ?>" class="btn contact-btn">
            <?php echo esc_html(get_theme_mod('contacts_btn_text', 'Contact Us')); ?>
        </a>
    </div>
    <!-- Overlay for the mobile menu -->
    <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
</header>