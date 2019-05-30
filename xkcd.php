<?php
/*
Plugin Name: xkcd
Plugin URI: https://xkcd.com
Description: Displays daily xkcd post
Version: 0.1.0
Author: Danial Malik
Author URI: http://github.com/danialmalik
Text Domain: xkcd
Domain Path: /languages
*/

// Exit if accessed directly
if (!defined('ABSPATH')){
    exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/xkcd-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/xkcd-class.php');

function register_xkcd(){
    register_widget('Xkcd_widget');
}

// Hook in function
add_action('widgets_init', 'register_xkcd');
