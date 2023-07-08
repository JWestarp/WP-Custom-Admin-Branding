<?php

// Create a new instance of the `Custom_Admin_Branding` class
// Pass in whatever values you want (see the "Arguments" section below)
new Custom_Admin_Branding( array(

    'designer_url'                => 'https://comon-werbeagentur.de/',
    'designer_anchor'             => 'com.on | DEINE AGENTUR',
    'login_footer_image'          => CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/images/logo-286x90-white.svg",
    'login_footer_image_width'    => '127',
    'login_footer_image_height'   => '40',
    'backend_footer_image'        => CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/images/logo-reduces-284x72.svg",
    'backend_footer_image_width'  => '59',
    'backend_footer_image_height' => '15',
    'backend_footer_text'         => 'made by %image% with <span>❤️</span>', // USE '%image%' as placeholder
    'favicon_url'                 => CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/images/favicon-32x32.png",
    'admin_bar_icon_url'          => CUSTOM_BACKEND_BRANDING_DIRECTORY_URI . "/images/logo-icon-32x32-green.svg"

  ) ); ?>
