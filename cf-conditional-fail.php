<?php
/**
 * Plugin Name: Conditional Fail for Caldera Forms
 * Plugin URI:  
 * Description: Fails a submission based on set conditions
 * Version:     1.0.0
 * Author:      David Cramer
 * Author URI:  
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */



// add filters
add_filter('caldera_forms_get_form_processors', 'cf_conditional_fail_register_processor');

function cf_conditional_fail_register_processor($pr){
	$pr['conditional_fail'] = array(
		"name"              =>  __('Conditional Fail', 'cf-conditional-fail'),
		"description"       =>  __("Fail submission based on conditions", 'cf-conditional-fail'),
		"author"            =>  'David Cramer',
		"author_url"        =>  'http://cramer.co.za',
		"pre_processor"		=>  'cf_conditional_fail_submit',
		"template"          =>  plugin_dir_path(__FILE__) . "config.php",
	);
	return $pr;
}

function cf_conditional_fail_submit($config, $form){
	global $transdata;

	$return = array(
		'type' => 'error',
		'note'	=>	Caldera_Forms::do_magic_tags( $config['message'] )
	);
	return $return;
}
