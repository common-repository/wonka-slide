<?php
/**
* The admin-specific functionality of the plugin.
*
* @link       https://wonkasoft.com
* @since      1.0.0
*
* @package    Wonka_Slide
* @subpackage wonka-slide/admin/partials
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package    Wonka_Slide
* @subpackage wonka-slide/admin/partials
* @author     Wonkasoft <info@wonkasoft.com>
*/

add_filter( 'plugin_action_links_'. WONKA_SLIDE_BASENAME, 'wonka_slide_add_settings_link_filter' , 10, 1);

function wonka_slide_add_settings_link_filter( $links ) { 
	global $wonka_slide_page;
	$links_addon = '<a href="' . menu_page_url( $wonka_slide_page, 0 ) . '" target="_self">Settings</a>';
	array_unshift($links, $links_addon);
	$links[] = '<a href="https://paypal.me/Wonkasoft" target="blank"><img src="' . plugins_url( '../img/wonka-logo.svg', __FILE__ ) . '" style="width: 20px; height: 20px; display: inline-block;
    vertical-align: text-top; float: none;" /></a>';
 return $links; 
}

add_filter( 'plugin_row_meta', 'wonka_slide_add_description_link_filter', 10, 2);

function wonka_slide_add_description_link_filter( $links, $file ) {
	global $wonka_slide_page;
	if ( strpos($file, 'wonka-slide.php') !== false ) {
		$links[] = '<a href="' . menu_page_url( $wonka_slide_page, 0 ) . '" target="_self">Settings</a>';
		$links[] = '<a href="https://paypal.me/Wonkasoft" target="blank">Donate <img src="' . plugins_url( '../img/wonka-logo.svg', __FILE__ ) . '" style="width: 20px; height: 20px; display: inline-block;
    vertical-align: text-top;" /></a>';
	}
 return $links; 
}