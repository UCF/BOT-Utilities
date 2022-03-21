<?php
/*
Plugin Name: BOT Utilities
Description: Provides extra functionality and utilities for the BOT website.
Version: 1.0.4
Author: UCF Web Communications
License: GPL3
GitHub Plugin URI: UCF/BOT-Utilities
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'BOT_UTILITIES_URL', plugin_dir_url( __FILE__ ) );
define( 'BOT_UTILITIES_STATIC_URL', BOT_UTILITIES_URL . '/static' );
define( 'BOT_UTILITIES_IMG_URL', BOT_UTILITIES_STATIC_URL . '/img' );

include_once 'includes/people-functions.php';
include_once 'includes/shortcodes.php';

?>
