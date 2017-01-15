<?php 
$parse_uri  =  explode ('wp-content' , $_SERVER ['SCRIPT_FILENAME']) ;
require_once( $parse_uri[ 0 ] . 'wp-load.php') ;
global $wpdb;
$zip = (int)($_GET['zip']);
$nc_consultant = $wpdb->get_blog_prefix() . 'nc_consultant';
$nc_zip = $wpdb->get_blog_prefix() . 'nc_zip';

$lat_lng = $wpdb->get_row("SELECT ORT_LAT, ORT_LON FROM $nc_zip
	WHERE POSTLEITZAHL = $zip ");

if(!$lat_lng){
	exit("<div class='vc_not_result'>Die Postleitzahl wurde nicht gefunden!!</div>");
}
$lat = $lat_lng->ORT_LAT;
$lon = $lat_lng->ORT_LON;
$cons_query = "SELECT DISTINCT title, address, description,((ACOS(SIN($lat * PI() / 180) * SIN(lat * PI() / 180) + COS($lat * PI() / 180)
 * COS(lat * PI() / 180) * COS(($lon - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance
  FROM $nc_consultant HAVING distance<='100'  ORDER BY distance ASC LIMIT 0, 10 ";
  $cons = $wpdb->get_results($cons_query);
  if(!$cons){
	exit("<div class='vc_not_result'>Nicht gefunden!!</div>");
}
  echo '<div class="nc_cons_box">
		<table class="nc_cons_table">
			<tr>
   				<th>№</th><th>Name</th><th>Adresse</th><th>Position</th>
			</tr>
  		';
  $count = 0;	
  $res_cont;	
  foreach ($cons as $con) {
  	$name = $con->description;
  	if(!isset($res_cont["$name"])){
  		$address = $con->address;
  		$title = $con->title;
  		$dist = $con->distance;
  		$res_cont["$name"]['address'] = $address;
  		$res_cont["$name"]['title'] = $title;
  		$res_cont["$name"]['name'] = $name;
  		$res_cont["$name"]['dist'] = $dist;
  	}
  }
  //var_dump($res_cont);
  foreach ($res_cont as $res){
  	$count++;
  	if($count == 4){
		break;
	}
	echo "
		<tr>
		   <td>" . $count . "</td>
		   <td>" . $res['name'] . "</td>
		   <td>" . $res['address'] . "</td>
		   <td>" . $res['title'] . "</td>
		   
  		</tr>
	";
  }
  	//<td>" . $res['dist'] . "</td>

echo '</table></div>';