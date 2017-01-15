 <?php
 function delete_table(){
 	global $wpdb;
 	$table_name = $wpdb->get_blog_prefix() . 'nc_consultant';
 	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
    	$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
	}
	$table_zip = $wpdb->get_blog_prefix() . 'nc_zip';
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_zip'") == $table_zip) {
    	$wpdb->query( "DROP TABLE IF EXISTS $table_zip" );
	}
}