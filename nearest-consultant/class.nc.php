<?php
class nc {
	
	public static function init() {
			self::init_hooks();
			self::load_file();
	}

	private static function init_hooks() {
		self::load_file();
	}

	private static function load_file() {
		require_once( NC__PLUGIN_DIR . 'includes/functions.php' );
		require_once( NC__PLUGIN_DIR . 'includes/shortcodes.php' );
		require_once( NC__PLUGIN_DIR . 'includes/admin.php' );
	}

	public static function plugin_activation() {
		require_once( NC__PLUGIN_DIR . 'includes/activation/activation.php' );
		create_table();
	}

	public static function plugin_deactivation( ) {
		require_once( NC__PLUGIN_DIR . 'includes/deactivation/deactivation.php' );
		delete_table();
	}
}