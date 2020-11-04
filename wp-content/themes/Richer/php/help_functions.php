<?php





//echo '<pre>';

//print_r($wpdb);

//echo '</pre>';



function setCustomField($user_id, $metakey_name, $value){


	global $wpdb;

	$query = 	"SELECT * FROM wp_usermeta 
				WHERE user_id={$user_id} AND meta_key='{$metakey_name}'";

	$result = $wpdb->get_results($query);
	$num_rows = count($result);

	if($num_rows==0){

		$query = 	"INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
					VALUES({$user_id}, '{$metakey_name}', '{$value}')";
	}
	else{
		$query = 	"UPDATE wp_usermeta
					SET meta_value = '{$value}'
					WHERE meta_key='{$metakey_name}' AND user_id='{$user_id}'";
	}		

	$result = $wpdb->query($query);
	return $result;
}



function clearCusomField( $user_id, $field_name ){

	global $wpdb;

	$query = 	"UPDATE wp_usermeta
				SET meta_value = ''
				WHERE user_id = {$user_id} AND meta_key='{$field_name}'";

	print_r($query);
	$result = $wpdb->query($query);

	return $result;

}





?>