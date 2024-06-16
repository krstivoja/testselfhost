<?php

/*
 * Plugin Name:       Test SelfHost
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */


 
function myplugin_scripts() {
    wp_register_style( 'foo-styles',  plugin_dir_url( __FILE__ ) . 'style.css' );
    wp_enqueue_style( 'foo-styles' );
}
add_action( 'wp_enqueue_scripts', 'myplugin_scripts' );