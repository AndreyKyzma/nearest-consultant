<?php
function nc_search_shortcode( $atts ) {
    $ajax_url = NC__PLUGIN_URL . 'includes/ajax/request_consultants.php';
	$result_class = 'result_class';
	
	$form = '';
	$form = '<form role="search" class="search-form" onsubmit=" return s_nc_result()">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input id="zip_input_short" type="search" class="search-field" placeholder="' . __( 'Search zip', 'nc' ) . '" value="" />
				</label>
				<input type="button" id="nc_seach_b_short" onclick="return s_nc_result()" class="search-submit" value="'. __( 'S', 'nc' ) .'" />
			</form>';
	
		$form .= '<div class="result_class_short"></div>';
		$form .= '
			<script type="text/javascript">
				function s_nc_result(){
		        	var zip_v = jQuery("#zip_input_short").val();
		        	if(zip_v){
		        	jQuery.get(
						  " '. $ajax_url . '",
						  {
						    zip: zip_v
						  },
						  onAjaxSuccess
						);
						}else{
							//jQuery("#zip_input_short").css("border", "1px solid red");

						} 
						function onAjaxSuccess(data)
						{
						  jQuery(".result_class_short").html(data);
						} 
					return false;
			    }
			</script>
		';
		return $form;
}
add_shortcode( 'nc_zip_search', 'nc_search_shortcode' );