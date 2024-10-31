<?php
/*
  Plugin Name: Nepali Land Converter
  Plugin URI: http://www.padamshankhadev.com
  Description: A Nepali Land Converter Plugin
  Version: 2.0.0
  Author: Padam Shankhadev
  Author URI: http://www.padamshankhadev.com
 
*/

define('LANDCONVERTER', '2.0.0');
define('LANDCONVERTER__PLUGIN_URL', plugin_dir_url(__FILE__));
define('LANDCONVERTER__PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once( LANDCONVERTER__PLUGIN_DIR . 'class.landconverter-widget.php' );

/*function landconverter_js() {
	wp_enqueue_script('land-converter', LANDCONVERTER__PLUGIN_URL.'js/landconverter.js', array('jquery'), '1.0.0');
}
add_action('wp_enqueue_scripts', 'landconverter_js');*/

function landcoverter_widget() {
    register_widget('Nepali_Landconverter_Widget');
}
add_action('widgets_init', 'landcoverter_widget');
