<?php 
	$url = (!empty($_SERVER['HTTPS'])) ? 
		"https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : 
		"http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$url = $_SERVER['REQUEST_URI'];
	$my_url = explode('wp-content' , $url);
	$path = $_SERVER['DOCUMENT_ROOT']."/".$my_url[0]; 
	
	include_once $path . '/wp-config.php'; 
	include_once $path . '/wp-includes/wp-db.php'; 
	include_once $path . '/wp-includes/pluggable.php'; 
	global $wpdb;
	//code coming soon :)
	if($_POST['s_id'] > 0 && $_POST['u_id'] > 0 && $_POST['status'] >= 0){
		/*var_dump($wpdb);
		die();*/
		$query = "SELECT * FROM wp_sponsor_users_statuses where s_id={$_POST['s_id']} AND u_id = {$_POST['u_id']}";
		$result = $wpdb->get_results($query);
		$num_rows = count($result);
		
		if ($num_rows>0){
			$query = "UPDATE wp_sponsor_users_statuses SET status = {$_POST['status']} where s_id={$_POST['s_id']} AND u_id = {$_POST['u_id']}";
			$result = $wpdb->query($query);
		}
		else{
			$query = "INSERT INTO wp_sponsor_users_statuses(s_id,u_id,status) VALUES({$_POST['s_id']},{$_POST['u_id']},{$_POST['status']})";
			$result = $wpdb->query($query);
		}
	}
?>