<?php
/**
 * Plugin Name: Nearest consultant
 * Description: Nearest consultant
 * Version: 1.0.0
 * Author: Wakeful
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'NC__PLUGIN_URL', plugin_dir_url( __FILE__ ));
define( 'NC__PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require_once( NC__PLUGIN_DIR . 'class.nc.php' );

add_action( 'init', array( 'nc', 'init' ) );

register_activation_hook( __FILE__, array( 'nc', 'plugin_activation' ));
register_deactivation_hook( __FILE__, array( 'nc', 'plugin_deactivation' ));