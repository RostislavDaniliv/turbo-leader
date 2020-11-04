<?php
/*
Plugin Name: Дополнительные поля для профиля
Description: Добавляет новые поля в профиль пользователя.
Version: 1.0
*/

// дополнительные данные на странице профиля
add_action('show_user_profile', 'my_profile_new_fields_add');
add_action('edit_user_profile', 'my_profile_new_fields_add');

add_action('personal_options_update', 'my_profile_new_fields_update');
add_action('edit_user_profile_update', 'my_profile_new_fields_update');

function my_profile_new_fields_add(){ 
	global $user_ID;
	$uid = $user_ID;
	if ($_GET['user_id']){
		$uid = $_GET['user_id'];
	}
	$id_company = get_user_meta( $uid, "id_company", 1 );
	
	?>
	<h3>Дополнительные данные</h3>
	<table class="form-table">
		<tr>
			<th><label for="user_fb_txt">ID компании</label></th>
			<td>
				<input type="text" name="id_company" value="<?php echo $id_company; ?>"><br>
			</td>
		</tr>
	</table>
	<?php            
}

// обновление
function my_profile_new_fields_update(){
	global $user_ID;
	
	$uid = $user_ID;
	if ($_POST['user_id']){
		$uid = $_POST['user_id'];
	}
	update_user_meta( $uid, "id_company", $_POST['id_company'] );
}