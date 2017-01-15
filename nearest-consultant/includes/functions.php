<?php
function load_nc_scripts_style() {
	wp_enqueue_style( 'nc_style',  NC__PLUGIN_URL . '/assets/css/nc_style.css');
	wp_enqueue_script('nc_script',  NC__PLUGIN_URL . '/assets/js/nc_script.js');
}
add_action( 'wp_enqueue_scripts', 'load_nc_scripts_style' );

function load_admin_nc_scripts_style() {
	wp_enqueue_style( 'nc_admin_style',  NC__PLUGIN_URL . '/assets/css/nc_admin_style.css');
	wp_enqueue_script('nc_admin_script',  NC__PLUGIN_URL . '/assets/js/nc_admin_script.js');
}
add_action( 'admin_enqueue_scripts', 'load_admin_nc_scripts_style' );


function get_nc_form($result_class = 'result_class'){
	$ajax_url = NC__PLUGIN_URL . 'includes/ajax/request_consultants.php';
	$form = '';
	$form = '<form role="search" class="search-form" onsubmit=" return nc_result()">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input id="zip_input" type="search" class="search-field" placeholder="' . __( 'Search zip', 'nc' ) . '" value="" />
				</label>
				<input type="button" id="nc_seach_b" onclick="return nc_result()" class="search-submit" value="'. __( 'S', 'nc' ) .'" />
			</form>';
	if($result_class == 'result_class'){
		$form .= '<div class="result_class"></div>';
	}	
	echo $form;		
	?>
	<script type="text/javascript">
	function nc_result(){
		var zip_v = jQuery("#zip_input").val();
        	console.log(zip_v);
        	if(zip_v){
        	jQuery.get(
				  "<?php echo $ajax_url; ?>",
				  {
				    zip: zip_v
				  },
				  onAjaxSuccess
				);
				}else{
					//jQuery("#zip_input").css('border', '1px solid red');

				} 
				function onAjaxSuccess(data)
				{
				  jQuery('.<?php echo $result_class; ?>').html(data);
				}
        return false;
	}
	</script>
	<?php
}
function get_consultants($limit_start = 0, $limit_end = 20){
	global $wpdb;
	$nc_consultant = $wpdb->get_blog_prefix() . 'nc_consultant';
	$cons_query = "SELECT *
	  FROM $nc_consultant  LIMIT $limit_start, $limit_end ";
	$cons = $wpdb->get_results($cons_query);
	return $cons;
}

function add_consultant($nc_name, $nc_address, $nc_position, $nc_lat, $nc_lng ){
	global $wpdb;
	$nc_consultant = $wpdb->get_blog_prefix() . 'nc_consultant';
	$result = $wpdb->insert(
				$nc_consultant,
				array(  'address' => $nc_address, 'description' => $nc_name,
				 	 'lat' => $nc_lat, 'lng' => $nc_lng, 'title' => $nc_position
				 	)
			);
	return $result;
}

function delete_consultant($id){
	global $wpdb;
	$nc_consultant = $wpdb->get_blog_prefix() . 'nc_consultant';
	$result = $wpdb->delete( $nc_consultant, array( 'id' => $id ) );
	return $result;
}

function update_consultant($id, $nc_name, $nc_address, $nc_position, $nc_lat, $nc_lng){
	global $wpdb;
	$nc_consultant = $wpdb->get_blog_prefix() . 'nc_consultant';
	$result = $wpdb->update( $nc_consultant,
	array(  'address' => $nc_address, 'description' => $nc_name,
			'lat' => $nc_lat, 'lng' => $nc_lng, 'title' => $nc_position),
	array( 'id' => $id )
	);
	return $result;
}

function get_zips($limit_start = 0, $limit_end = 20){
	global $wpdb;
	$nc_zip_t = $wpdb->get_blog_prefix() . 'nc_zip';
	$cons_query = "SELECT *
	  FROM $nc_zip_t  LIMIT $limit_start, $limit_end ";
	$zips = $wpdb->get_results($cons_query);
	return $zips;
}

function add_zip($nc_zip, $nc_ort_name, $nc_gemeinde_name, $nc_lat, $nc_lng){
	global $wpdb;
	$nc_zip_t = $wpdb->get_blog_prefix() . 'nc_zip';
	$result = $wpdb->insert(
				$nc_zip_t,
				array(  'POSTLEITZAHL' => $nc_zip, 'GEMEINDE_NAME' => $nc_gemeinde_name,
				 	 'ORT_LAT' => $nc_lat, 'ORT_LON' => $nc_lng, 'ORT_NAME' => $nc_ort_name
				 	)
			);
	return $result;
}

function delete_zip($id){
	global $wpdb;
	$nc_zip_t = $wpdb->get_blog_prefix() . 'nc_zip';
	$result = $wpdb->delete( $nc_zip_t, array( 'id' => $id ) );
	return $result;
}

function update_zip($id, $nc_zip, $nc_ort_name, $nc_gemeinde_name, $nc_lat, $nc_lng){
	global $wpdb;
	$nc_zip_t = $wpdb->get_blog_prefix() . 'nc_zip';
	$result = $wpdb->update( $nc_zip_t,
	array(  'POSTLEITZAHL' => $nc_zip, 'GEMEINDE_NAME' => $nc_gemeinde_name,
			'ORT_LAT' => $nc_lat, 'ORT_LON' => $nc_lng, 'ORT_NAME' => $nc_ort_name),
	array( 'id' => $id )
	);
	return $result;
}