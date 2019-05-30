<?php
    // Scripts
    function xkcd_add_scripts(){
        // Add main CSS
        wp_enqueue_style('xkcd_main_style', plugins_url().'/xkcd/includes/css/style.css');
        // Add JS
        wp_enqueue_script('xkcd_main_script', plugins_url().'/xkcd/includes/js/main.js');

    }

    add_action('wp_enqueue_scripts', 'xkcd_add_scripts');
