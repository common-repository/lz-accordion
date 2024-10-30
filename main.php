<?php
/*
Plugin Name: LZ Accordion
Plugin URI: http://nazmulislam.xyz/plugins/lz-accordion
Description: This plugin will add an expand collapse accordion feature inside a post or page.
Author: Nazmul Islam
Author URI: http://nazmulislam.xyz
Version: 1.0
*/


// Plugins Setup
define('LZ_ACCORDION', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


// Adding Latest jQuery from Wordpress
function lz_accordion_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'lz_accordion_jquery');

// Adding plugin javascript Main file
wp_enqueue_script('lz-accordion-main', LZ_ACCORDION.'js/main.js', array('jquery'));

// Adding plugin javascript active file
wp_enqueue_script('lz-accordion-script-active', LZ_ACCORDION.'js/active.js', array('jquery'), '1.0', true);

//Adding Plugin custm CSS file 
wp_enqueue_style('lz-accordion-style', LZ_ACCORDION.'css/style.css');





/* Add Slider Shortcode Button on Post Visual Editor */

function accordion_button() {
	add_filter ("mce_external_plugins", "accordion_button_js");
	add_filter ("mce_buttons", "accordionbutton");
}

function accordion_button_js($plugin_array) {
	$plugin_array['lz'] = plugins_url('js/accordian-button.js', __FILE__);
	return $plugin_array;
}

function accordionbutton($buttons) {
	array_push ($buttons, 'accordion-triger');
	return $buttons;
}
add_action ('init', 'accordion_button'); 




/* Generates Toggles Shortcode */
function accordion_code($atts, $content = null) {
	return ('<div id="lz-tabs">'.do_shortcode($content).'</div>');
}
add_shortcode ("lzaccordion", "accordion_code");

function accordion_toggles($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => ''
    ), $atts));
	
	return ('<h3>' .$title. '</h3><div><div class="tab_content">' .$content. '</div></div>');
}
add_shortcode ("lztoggle", "accordion_toggles");


?>