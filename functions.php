<?php

/**
 * Modified Version of:
 * Class Name: Custom Admin Branding Forked
 * Fork GitHub URI: https://github.com/JWestarp/WP-Custom-Admin-Branding
 * Master GitHub URI: https://github.com/JWestarp/WP-Custom-Admin-Branding/commits?author=chrisguitarguy
 * Description: A class to allow theme/plugin developers to easily brand the WordPress login and admin screens
 * License: GPL-2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
define('CUSTOM_BACKEND_BRANDING_DIRECTORY', get_stylesheet_directory() . "/inc/custom-backend-branding");
define('CUSTOM_BACKEND_BRANDING_DIRECTORY_URI', get_stylesheet_directory_uri() . "/inc/custom-backend-branding");
require_once( CUSTOM_BACKEND_BRANDING_DIRECTORY . "/index.php" );
