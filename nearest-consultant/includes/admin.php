<?php
add_action( 'admin_menu', 'nc_zip_menu' );

function nc_zip_menu() {
	add_menu_page( 'NC Zip', 'NC Zip', 'manage_options', 'nc_zip_page', 'nc_zip_options' );
}


function nc_zip_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	if(isset($_POST['add'])){
		$nc_zip = $_POST['nc_zip'];
		$nc_ort_name = $_POST['nc_ort_name'];
		$nc_gemeinde_name = $_POST['nc_gemeinde_name'];
		$nc_lat = $_POST['nc_lat'];
		$nc_lng = $_POST['nc_lng'];
		$result = add_zip($nc_zip, $nc_ort_name, $nc_gemeinde_name, $nc_lat, $nc_lng);
		if($result){
			echo "<div class='wrap result true'><h2>The zip code added successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The zip code  not added successfully !!!</h2></div>";
		}
	}
	if(isset($_POST['delete'])){
		$id = $_POST['nc_id'];
		$result = delete_zip($id);
		if($result){
			echo "<div class='wrap result true'><h2>The zip code delete successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The zip code  not delete successfully !!!</h2></div>";
		}
	}

	if(isset($_POST['update'])){
		$id = $_POST['nc_id'];
		$nc_zip = $_POST['nc_zip'];
		$nc_ort_name = $_POST['nc_ort_name'];
		$nc_gemeinde_name = $_POST['nc_gemeinde_name'];
		$nc_lat = $_POST['nc_lat'];
		$nc_lng = $_POST['nc_lng'];
		$result = update_zip($id, $nc_zip, $nc_ort_name, $nc_gemeinde_name, $nc_lat, $nc_lng);
		if($result){
			echo "<div class='wrap result true'><h2>The zip code update successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The zip code  not update successfully !!!</h2></div>";
		}
	}

	$page = 1;

	if(isset($_GET['p'])){
		$page = $_GET['p'];
		$limit_end = $page * 20;
		$limit_start = $limit_end - 20;
		$zips = get_zips($limit_start, $limit_end);
	}else{
		$zips = get_zips();
	}
	//var_dump($zips);
	?>

	<div class='wrap'>
	<h2>NC Zip code</h2>
	</div>
	<div class='wrap nc-add-box'>
		<div class='wrap'>
			<h3>Add Zip code</h3>
		</div>
		<form method="post">
			<input type="text" placeholder="Zip" name="nc_zip" required>
			<input type="text" placeholder="Ort_name" name="nc_ort_name" required>
			<input type="text" placeholder="Lat" name="nc_lat" required>
			<input type="text" placeholder="Lng" name="nc_lng" required>
			<input type="text" placeholder="Gemeinde_name" name="nc_gemeinde_name" required>
			<input type="submit" name="add" class="button button-primary button-large" value="add">
		</form>
	</div>
	<div class='wrap nc-all-box'>
		<div class='wrap'>
			<h3>All Zip code</h3>
		</div>
		<?php 
			if(!$zips){
			echo "<h4>Zips not found</h4>";
			}
		?>
		
		<?php foreach ($zips as $zip) :?>
			<form method="post">
			<input type="hidden" value="<?php echo $zip->id; ?>"  name="nc_id">
			<input type="text"   value="<?php echo $zip->POSTLEITZAHL; ?>" name="nc_zip" required>
			<input type="text"   value="<?php echo $zip->ORT_NAME; ?>" name="nc_ort_name" required>
			<input type="text"   value="<?php echo $zip->ORT_LAT; ?>" name="nc_lat" required><br>
			<input type="text"   value="<?php echo $zip->ORT_LON; ?>" name="nc_lng" required>
			<input type="text"   value="<?php echo $zip->GEMEINDE_NAME; ?>" name="nc_gemeinde_name" required>
			<input type="submit" name="update" class="button button-primary button-large" value="update">
			<input type="submit" name="delete" class="button button-primary button-large" value="delete"><br><hr><br>
			</form>
		<?php endforeach;?>
		
		<div class='wrap pagination'>
		<?php if($page <= 1){
			$next = $page+1;
			$prev = home_url() . "/wp-admin/admin.php?page=nc_zip_page";
			$next = home_url() . "/wp-admin/admin.php?page=nc_zip_page&p=" . $next;
		}else{
			$next = $page+1;
			$prev = $page-1;
			$prev = home_url() . "/wp-admin/admin.php?page=nc_zip_page&p=" . $prev;
			$next = home_url() . "/wp-admin/admin.php?page=nc_zip_page&p=" . $next;
		}
		if($page > 1){
			echo "<a href=" . $prev . "><   </a>";
		}
		if($zips){
			echo "<a href=" . $next . ">   ></a>";
		}
		?>
		</div>
	</div>
	<?php
}


add_action( 'admin_menu', 'nc_consultant_menu' );

function nc_consultant_menu() {
	add_menu_page( 'NC Consultant', 'NC Consultant', 'manage_options', 'nc_consultant_page', 'nc_consultant_options' );
}

function nc_consultant_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	if(isset($_POST['add'])){
		$nc_name = $_POST['nc_name'];
		$nc_address = $_POST['nc_address'];
		$nc_position = $_POST['nc_position'];
		$nc_lat = $_POST['nc_lat'];
		$nc_lng = $_POST['nc_lng'];
		$result = add_consultant($nc_name, $nc_address, $nc_position, $nc_lat, $nc_lng);
		if($result){
			echo "<div class='wrap result true'><h2>The consultant added successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The consultant  not added successfully !!!</h2></div>";
		}
	}
	if(isset($_POST['delete'])){
		$id = $_POST['nc_id'];
		$result = delete_consultant($id);
		if($result){
			echo "<div class='wrap result true'><h2>The consultant delete successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The consultant  not delete successfully !!!</h2></div>";
		}
	}

	if(isset($_POST['update'])){
		$id = $_POST['nc_id'];
		$nc_name = $_POST['nc_name'];
		$nc_address = $_POST['nc_address'];
		$nc_position = $_POST['nc_position'];
		$nc_lat = $_POST['nc_lat'];
		$nc_lng = $_POST['nc_lng'];
		$result = update_consultant($id, $nc_name, $nc_address, $nc_position, $nc_lat, $nc_lng);
		if($result){
			echo "<div class='wrap result true'><h2>The consultant update successfully !!!</h2></div>";
		}else{
			echo "<div class='wrap result false'><h2>The consultant  not update successfully !!!</h2></div>";
		}
	}

	$page = 1;

	if(isset($_GET['p'])){
		$page = $_GET['p'];
		$limit_end = $page * 20;
		$limit_start = $limit_end - 20;
		$consultants = get_consultants($limit_start, $limit_end);
	}else{
		$consultants = get_consultants();
	}
	?>

	<div class='wrap'>
	<h2>NC Consultant</h2>
	</div>
	<div class='wrap nc-add-box'>
		<div class='wrap'>
			<h3>Add Consultant</h3>
		</div>
		<form method="post">
			<input type="text" placeholder="Address" name="nc_address" required>
			<input type="text" placeholder="Name" name="nc_name" required>
			<input type="text" placeholder="Lat" name="nc_lat" required>
			<input type="text" placeholder="Lng" name="nc_lng" required>
			<input type="text" placeholder="Position" name="nc_position" required>
			<input type="submit" name="add" class="button button-primary button-large" value="add">

		</form>
	</div>
	<div class='wrap nc-all-box'>
		<div class='wrap'>
			<h3>All Consultants</h3>
		</div>
		<?php 
			if(!$consultants){
			echo "<h4>Consultants not found</h4>";
			}
		?>
		
		<?php foreach ($consultants as $consultant) :
			//var_dump($consultant);
		?>
			<form method="post">
			<input type="hidden" value="<?php echo $consultant->id; ?>"  name="nc_id">
			<input type="text"   value="<?php echo $consultant->address; ?>" name="nc_address" required>
			<input type="text"   value="<?php echo $consultant->description; ?>" name="nc_name" required>
			<input type="text"   value="<?php echo $consultant->lat; ?>" name="nc_lat" required><br>
			<input type="text"   value="<?php echo $consultant->lng; ?>" name="nc_lng" required>
			<input type="text"   value="<?php echo $consultant->title; ?>" name="nc_position" required>
			<input type="submit" name="update" class="button button-primary button-large" value="update">
			<input type="submit" name="delete" class="button button-primary button-large" value="delete"><br><hr><br>
			</form>
		<?php endforeach;?>
		
		<div class='wrap pagination'>
		<?php if($page <= 1){
			$next = $page+1;
			$prev = home_url() . "/wp-admin/admin.php?page=nc_consultant_page";
			$next = home_url() . "/wp-admin/admin.php?page=nc_consultant_page&p=" . $next;
		}else{
			$next = $page+1;
			$prev = $page-1;
			$prev = home_url() . "/wp-admin/admin.php?page=nc_consultant_page&p=" . $prev;
			$next = home_url() . "/wp-admin/admin.php?page=nc_consultant_page&p=" . $next;
		}
		if($page > 1){
			echo "<a href=" . $prev . "><   </a>";
		}
		if($consultants){
			echo "<a href=" . $next . ">   ></a>";
		}
		?>
		</div>
	</div>
	<?php
}

add_action( 'admin_menu', 'nc_consultant_info' );

function nc_consultant_info() {
	add_menu_page( 'NC Consultant', 'NC Info', 'manage_options', 'nc_info_page', 'nc_info_options' );
}

function nc_info_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class='wrap'>
	<h2>NC Info</h2>
	</div>
	<div class='wrap nc-add-box'>
		<div class='wrap'>
			<h3>NC function</h3>
		</div>
		<p>
			If you need to output a consultants search form on PHP code than use this function
			   get_nc_form('result_class').<br>
			The function takes a parameter that is a unit class where the result will be displayed.
			If the parameter is not put in than the result will be displayed by a search form.<br>
			The function return a search form.
		</p>
	</div>
	<div class='wrap nc-add-box'>
		<div class='wrap'>
			<h3>NC shortcode</h3>
		</div>
		<p>
			To output a search form via admin panel use a shortcode - [nc_zip_search].
		</p>
	</div>
	<?php
}