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

$action = $_POST['action'];

switch($action){	

	case 'updateEventButton':
		// РОЛИ: guest, contributor(верифиц. гость), vippartner, company(юр лицо - НЕ НАДО), subscriber(партнер), author(спикер)
		// ссылка гостевая http://udsonline.ru/guestmeeting
		// стартовый http://udsonline.ru/starttraining/
		// академия http://udsonline.ru/sbusiness/
	

		$uid = $_POST['user'];		
		$role = $_POST['role'];
		$event_type = isset($_POST['event_type']) ? $_POST['event_type'] : 'wb_event';
		$day = date('N'); // 1- пн, 7 - вс		

		$minToShow = 10;	
		$minToHide = -10;	

		$buttAr = array();
		$buttAr['minToStart'] = 0;
		$buttAr['enable'] = 0;
		$buttAr['href'] = '#';
		$buttAr['role']=$role;
		$current_time = new DateTime('+3 hours');
		$buttAr['now'] = $current_time->format("H:i"); // смещение времени сервера

		$game_roles = array( 'speaker-game', 'guest-game', 'partner-game', 'speaker-gy', 'partner-gy', 'admin' );
		$yoke_roles = array( 'speaker-yoke', 'guest-yoke', 'partner-yoke', 'speaker-gy', 'partner-gy', 'admin' );
		$guest_roles = array( 'guest-game', 'guest-yoke' );

		$is_game_role = in_array($role, $game_roles);
		$is_yoke_role = in_array($role, $yoke_roles);
		$is_guest_role = in_array($role, $guest_roles);

		// *** NEW

		$resArr = array();

		if( $is_game_role && $is_yoke_role ){ // GY
			$query = 	'SELECT id, product_id, type_id, day, TIME_FORMAT(time, "%H:%i") time FROM wp_events
						WHERE active=1 AND day='.$day;
		}
		elseif( $is_game_role ){
			$query =	'SELECT id, product_id, type_id, day, TIME_FORMAT(time, "%H:%i") time FROM wp_events
						WHERE active=1 AND day='.$day.' AND product_id=1';			
		}
		elseif( $is_yoke_role ){
			$query =	'SELECT id, product_id, type_id, day, TIME_FORMAT(time, "%H:%i") time FROM wp_events
						WHERE active=1 AND day='.$day.' AND product_id=2';	
		}

		if($role == 'guest-game' || $role == 'guest-yoke'){
			$query .= ' AND type_id=1';
		}

		$buttAr['query'] = $query;

		$event_rows = $wpdb->get_results($query);

		if( $event_type == 'start_biz' ){
			$minToHide = -65;	
			$minToShow = -30;
		}

		foreach ($event_rows as $event) {
			
			$buttAr['type'] = ( $event->product_id == 1 ) ? 'game' : 'yoke' ;
			$buttAr['time'] = $event->time;
				
			$minToStart = getMinDiff( $event->time ); //17 00	 = 20:00 мск = 22:00 тмн
			$buttAr['minToStart'] = $minToStart;
			$buttAr['minToShow'] = $minToShow;
			$buttAr['minToHide'] = $minToHide;

			if( ($event->type_id == 2 || !$is_guest_role) && ($event_type != 'start_biz') ){ // если мероприятие - бизнес-тренинг или это партнер, то кнопка доступна 40 мин
				$minToHide = -40;
			}

			//$minToHide = -200; // УБРАТЬ ПОТОМ

			$enableButton = ($minToStart<=$minToShow && $minToStart>=$minToHide) ? 1 : 0;	
			$buttAr['enable'] = $enableButton; 

			if( $enableButton ){	

				$buttAr['event_type'] = $event->type_id;			
				

				if( $event_type == 'start_biz' ){ // ЕСЛИ КНОПКА НАЧАТЬ БИЗНЕС
					$href = ( $event->product_id == 1 ) ? 'http://turbo-leader.com/uds-start-biz/' : 'http://turbo-leader.com/yoke-start-biz/';
					$buttAr['href'] = $href;

					break;			
				}
				else{ // ЕСЛИ ПРОСТО МЕРОПРИЯТИЕ
					$href = getClickMeetingLink( $event->product_id, $event->type_id );
				}
				
				$buttAr['href'] = $enableButton ? $href : '#';

				$resArr[] = $buttAr;
			}

			//$resArr[] = $buttAr;	
		}


		if( $event_type == 'start_biz' ){
			echo json_encode($buttAr);
		}
		else{
			echo json_encode($resArr);
		}
			
		//echo json_encode($buttAr);		

	break;

	case 'cp_getUsers':

		global $um_online;
		$user_id = get_current_user_id();

		//if($user_id==364) $user_id = 38;

		$len_id=strlen($user_id);

		$offset = $_POST['offset'];
		$filter = $_POST['filter'];
		$sf_value = $_POST['value'];
		$sf_type = $_POST['type'];
		$cart = $_POST['cart'];
		$only_online = $_POST['only_online'];


		// ОБРАБОТКА УСЛОВИЯ ФИЛЬТРА ====================================

		if(strlen($filter)>0){

			$filter_cond = '';

			if(substr($filter, 0, 2)=="fl"){ // дополнительная фильтрация

				switch ($filter) {
					case 'fl_was_online': 	$filter_cond = 'AND wViewGM.meta_value=1';
						break;
					
					case 'fl_click_sb':		$filter_cond = 'AND wBtnClick.meta_value=1';
						break;

					case 'fl_set_phone':	$filter_cond = 'AND wMobile.meta_value is not NULL';
						break;

					case 'fl_set_skype':	$filter_cond = 'AND wSkype.meta_value is not NULL';
						break;
				}

			}
			else{

				// ФИЛЬТРАЦИЯ ПО РОЛЯМ

				$values = explode(' ', $filter);			

				foreach ($values as $val) {				

					if(strlen($filter_cond)>0) $filter_cond.=' OR ';
					$filter_cond.= 'wRole.meta_value LIKE "%'.$val.'%"';
				}

				$filter_cond = ' AND ('.$filter_cond.')';

			}

			

		}

		// / ОБРАБОТКА УСЛОВИЯ ФИЛЬТРА ====================================
		// ОБРАБОТКА УСЛОВИЯ ПОИСКА =======================

		if(strlen($sf_type)>0){

			switch ($sf_type) {

				case 'lastname':						

						$filter_cond = ' AND wLName.meta_value LIKE "%'.$sf_value.'%"';

					break;				

				case 'email':

						$filter_cond = ' AND wMain.meta_value LIKE "%'.$sf_value.'%"';						

					break;

			}

		}

		// / ОБРАБОТКА УСЛОВИЯ ПОИСКА =======================

		//ОБРАБОТКА УСЛОВИЯ КОРЗИНЫ ===========================

		if($cart==1){

			$cart_cond = 'AND (wCart.meta_value=1)';

		}
		else{

			$cart_cond = 'AND (wCart.meta_value=0 OR wCart.meta_value is NULL)';

		}

		//ОБРАБОТКА УСЛОВИЯ КОРЗИНЫ ===========================

		$select_rows = 30;

		$limit = '';

		if(!$only_online==1){
			$limit = 'LIMIT '.$offset.','.$select_rows;
		}
		else{
			$cart_cond = '';
		}

		$query = 'SELECT 	wMain.user_id as User_id, 
						wMain.meta_value as Meta_keys,
						wPhoto.meta_value as Profile_photo, 
						COALESCE(wSkype.meta_value, "Не указан") as Skype,
						COALESCE(wMobile.meta_value, "Не указан") as Mobile_number,
						COALESCE(wCity.meta_value, "Не указан") as City_user,
						wFName.meta_value as First_name,
						wLName.meta_value as Last_name,
						wRole.meta_value as Role,
						wCart.meta_value as Cart,
						COALESCE(wNote.meta_value, "") as Note,
						COALESCE(wVkontakte.meta_value, "") as Vkontakte,
						COALESCE(wFacebook.meta_value, "") as Facebook,
						COALESCE(wInstagram.meta_value, "") as Instagram,
						COALESCE(wYoutube.meta_value, "") as Youtube,
						COALESCE(wVKlink.meta_value, "") as VK_login,
						COALESCE(wFBlink.meta_value, "") as FB_login,
						COALESCE(wSocialAva.meta_value, "") AS Social_ava,
						COALESCE(wViewGM.meta_value, "") AS View_GM,
						COALESCE(wBtnClick.meta_value, "") AS Click_SB

			FROM wp_usermeta wMain 

			LEFT JOIN wp_usermeta wPhoto 
				ON wPhoto.user_id=wMain.user_id and wPhoto.meta_key="profile_photo" 
			LEFT JOIN wp_usermeta wMobile 
				ON wMobile.user_id=wMain.user_id and wMobile.meta_key="mobile_number" 
			LEFT JOIN wp_usermeta wSkype 
				ON wSkype.user_id=wMain.user_id and wSkype.meta_key="skype" 
			LEFT JOIN wp_usermeta wCity 
				ON wCity.user_id=wMain.user_id and wCity.meta_key="city_user" 
			LEFT JOIN wp_usermeta wFName 
				ON wFName.user_id=wMain.user_id and wFName.meta_key="first_name" 
			LEFT JOIN wp_usermeta wLName 
				ON wLName.user_id=wMain.user_id and wLName.meta_key="last_name" 
			LEFT JOIN wp_usermeta wRole
				ON wRole.user_id=wMain.user_id and wRole.meta_key="role"
			LEFT JOIN wp_usermeta wCart
				ON wCart.user_id=wMain.user_id and wCart.meta_key="cart"
			LEFT JOIN wp_usermeta wNote
				ON wNote.user_id=wMain.user_id and wNote.meta_key="note_user"
			LEFT JOIN wp_usermeta wVkontakte
				ON wVkontakte.user_id=wMain.user_id and wVkontakte.meta_key="vkontakte"
			LEFT JOIN wp_usermeta wFacebook
				ON wFacebook.user_id=wMain.user_id and wFacebook.meta_key="facebook"
			LEFT JOIN wp_usermeta wInstagram
				ON wInstagram.user_id=wMain.user_id and wInstagram.meta_key="instagram"
			LEFT JOIN wp_usermeta wYoutube
				ON wYoutube.user_id=wMain.user_id and wYoutube.meta_key="youtube"
			LEFT JOIN wp_usermeta wVKlink
				ON wVKlink.user_id=wMain.user_id and wVKlink.meta_key="vk_link"
			LEFT JOIN wp_usermeta wFBlink
				ON wFBlink.user_id=wMain.user_id and wFBlink.meta_key="facebook_link"
			LEFT JOIN wp_usermeta wSocialAva
				ON wSocialAva.user_id=wMain.user_id and wSocialAva.meta_key="synced_profile_photo"
			LEFT JOIN wp_usermeta wViewGM
				ON wViewGM.user_id=wMain.user_id and wViewGM.meta_key="view_guest_meeting"
			LEFT JOIN wp_usermeta wBtnClick
				ON wBtnClick.user_id=wMain.user_id and wBtnClick.meta_key="start_biz_click"

			WHERE wMain.meta_key = "submitted" and POSITION("\"referer_id\";s:'.$len_id.':\"'.$user_id.'\"" IN wMain.meta_value)>0 '.$filter_cond.' '.$cart_cond.'
			ORDER BY wMain.user_id DESC '.$limit;

		$invited_users = $wpdb->get_results($query);

		//print_r($query);

		$result_arr = array();

		$i=0;

		foreach ($invited_users as $iUser){

			$inv_user = array();

			$inv_user['userID'] = $iUser->User_id;

			$is_online = $um_online->is_online($inv_user['userID']) ? true : false;

			if($only_online==1){

				if(!$is_online) continue;

			}

			$inv_user['onlinetitle'] = 'Оффлайн';
			$inv_user['onlinestatus'] = '';

			if($is_online){

				$inv_user['onlinestatus'] = 'active';
				$inv_user['onlinetitle'] = 'Онлайн';

			}

			// ПОЛУЧЕНИЕ РОЛИ
			$role = $iUser->Role;
			$inv_user['role'] = $role;			

			$inv_user['role_icon'] = 'fa-user';

			if($role=='partner-game') $inv_user['role_icon'] = 'fa-smile-o';
			if($role=='guest-game') $inv_user['role_icon'] = 'fa-meh-o';
			if($role=='company-game') $inv_user['role_icon'] = 'fa-briefcase';
			if($role=='partner-yoke') $inv_user['role_icon'] = 'fa-child';
			if($role=='guest-yoke') $inv_user['role_icon'] = 'fa-male';
			if($role=='speaker-yoke' || $role=='speaker-game') $inv_user['role_icon'] = 'fa-video-camera';
			if($role=='partner-gy' || $role=='speaker-gy')  $inv_user['role_icon'] = 'fa-rocket';


			$userdata = get_userdata($inv_user['userID']);

			$ava = '/no-avatar.png';

			if(strlen($iUser->Social_ava)>0){

				$ava = $iUser->Social_ava;

			}

			if(strlen($iUser->Profile_photo)>0){

				$ava = "/wp-content/uploads/ultimatemember/{$inv_user['userID']}/{$iUser->Profile_photo}";

			}

			$inv_user['email'] = $userdata->user_email;
			$inv_user['username'] = $iUser->First_name.' '.$iUser->Last_name;
			$inv_user['userAva'] = $ava;
			$date = new DateTime($userdata->user_registered);
			$inv_user['regdate'] = $date->format('d.m.Y');
			$inv_user['lastlogin'] = um_user_last_login_date( $userdata->ID);
			$inv_user['city'] = $iUser->City_user;
			$inv_user['skype'] = $iUser->Skype; 
			$inv_user['login'] = $userdata->user_login;
			$inv_user['mobile_number'] = $iUser->Mobile_number; 
			$inv_user['vkontakte'] = $iUser->Vkontakte;
			$inv_user['facebook'] = $iUser->Facebook;
			$inv_user['instagram'] = $iUser->Instagram;
			$inv_user['youtube'] = $iUser->Youtube;
			$inv_user['fb_link'] = $iUser->FB_login;
			$inv_user['vk_link'] = $iUser->VK_login;
			$inv_user['social_ava'] = $iUser->Social_ava;
			$inv_user['note'] = $iUser->Note;
			
			$inv_user['viewGMstatus'] = $iUser->View_GM ? 'active' : '';		
			$inv_user['viewGMtitle'] = $iUser->View_GM ? 'Был(а) на гостевой встрече' : 'Не был(а) на гостевой встрече';	
			$inv_user['clickSBstatus'] = $iUser->Click_SB ? 'active' : '';		
			$inv_user['clickSBtitle'] = $iUser->Click_SB ? 'Нажал(а) НАЧАТЬ БИЗНЕС' : 'Не нажимал(а) НАЧАТЬ БИЗНЕС';	

			$result_arr[$i++] = $inv_user;
		}

		echo json_encode($result_arr); 

	break;


	case 'cp_addToCart': // ДОБАВЛЕНИЕ В КОРЗИНУ

		$values = $_POST['values'];
		$IDs = explode(',', $values);
		$query = '';
		$res_ids = array();

		foreach ($IDs as $id) {			

			$query = 	"SELECT * FROM wp_usermeta 
						WHERE user_id={$id} AND meta_key='cart'";

			$result = $wpdb->get_results($query);
			$num_rows = count($result);

			if($num_rows==0){

				$query = 	"INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
							VALUES({$id}, 'cart', 1)";
			}
			else{

				$query = 	"UPDATE wp_usermeta
							SET meta_value=1
							WHERE user_id={$id} AND meta_key LIKE 'cart'";
			}

			$result = $wpdb->query($query);

			array_push($res_ids, $id);
		}		

		echo json_encode($res_ids);

	break;

	case 'cp_removeFromCart': // УДАЛЕНИЕ ИЗ КОРЗИНЫ

		$values = $_POST['values'];
		$IDs = explode(',', $values);
		$query = '';
		$res_ids = array();

		foreach ($IDs as $id) {			

			$query = 	"UPDATE wp_usermeta
						SET meta_value=0
						WHERE user_id={$id} AND meta_key LIKE 'cart'";

			$result = $wpdb->query($query);

		}

		echo 'success';

	break;


	case 'cp_addNote': // ДОБАВЛЕНИЕ ЗАМЕТКИ

		$value = $_POST['value'];
		$user_id = $_POST['user_id'];

		$query = 	"SELECT * FROM wp_usermeta 
					WHERE user_id={$user_id} AND meta_key='note_user'";

		$result = $wpdb->get_results($query);

		$num_rows = count($result);

		if($num_rows==0){

			$query = 	"INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
						VALUES({$user_id}, 'note_user', '{$value}')";
		}
		else{

			$query = 	"UPDATE wp_usermeta
						SET meta_value='{$value}'
						WHERE user_id={$user_id} AND meta_key LIKE 'note_user'";

		}

		$result = $wpdb->query($query);

		echo 'success';

	break;

	case 'cp_exportContacts': // ЭКСПОРТ СПИСКА КОНТАКТОВ

		$user_id = get_current_user_id();
		$len_id = strlen($user_id);

		$cond = '';

		if($user_id==1){

			$cond = 'wMain.meta_value LIKE "%first_name%"';

		}
		else{

			$cond = 'POSITION("\"referer_id\";s:'.$len_id.':\"'.$user_id.'\"" IN wMain.meta_value)>0';

		}

		$query = 'SELECT 	wMain.user_id as User_id, 
						wMain.meta_value as Meta_keys,	
						wFName.meta_value as First_name,
						wLName.meta_value as Last_name,
						wRole.meta_value as Role

			FROM wp_usermeta wMain 

			LEFT JOIN wp_usermeta wFName 
				ON wFName.user_id=wMain.user_id and wFName.meta_key="first_name" 
			LEFT JOIN wp_usermeta wLName 
				ON wLName.user_id=wMain.user_id and wLName.meta_key="last_name" 
			LEFT JOIN wp_usermeta wRole
				ON wRole.user_id=wMain.user_id and wRole.meta_key="role"
			LEFT JOIN wp_usermeta wCart
				ON wCart.user_id=wMain.user_id and wCart.meta_key="cart"

			WHERE wMain.meta_key = "submitted" and (wCart.meta_value is NULL or wCart.meta_value=0) and '.$cond.' 
			ORDER BY wMain.user_id DESC';

			$invited_users = $wpdb->get_results($query);

			$result_arr = array();
			$i=0;

			foreach ($invited_users as $iUser){

				$inv_user = array();
				$inv_user['userID'] = $iUser->User_id;
				$userdata = get_userdata($inv_user['userID']);

				$inv_user['email'] = $userdata->user_email;
				$inv_user['first_name'] = $iUser->First_name;
				$inv_user['last_name'] = $iUser->Last_name;
				$inv_user['role'] = $iUser->Role;

				$result_arr[$i++] = $inv_user;

			}

			echo json_encode($result_arr); 

	break;

	case "setIndexFlag": // УСТАНОВКА ФЛАГА, ЧТО ЧЕЛОВЕК БЫЛ НА ГОСТЕВОЙ ВСТРЕЧЕ

		$user_id = $_POST['user_id'];
		$index = $_POST['index'];

		$metakey_name = '';

		if($index=='gm'){

			$metakey_name = 'view_guest_meeting';

		}
		elseif($index == 'sb'){

			$metakey_name = 'start_biz_click';

		}

		$query = 	"SELECT * FROM wp_usermeta 
					WHERE user_id={$user_id} AND meta_key='{$metakey_name}'";

		$result = $wpdb->get_results($query);

		$num_rows = count($result);

		if($num_rows==0){

			$query = 	"INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
						VALUES({$user_id}, '{$metakey_name}', 1)";

			$result = $wpdb->query($query);
		}		

		echo 'success';

	break;


	case 'getRefID': // ПОЛУЧЕНИЕ РЕФЕРАЛА

		$login = $_POST['login'];

		$query = "SELECT * FROM wp_usermeta where meta_key = 'nickname' and meta_value = '{$login}'";
		$sponsor = $wpdb->get_row( $query );	
		$sponsorID = $sponsor->user_id;

		if(!$sponsorID){
			$sponsorID = 1;
		}

		echo $sponsorID;

	break;


	case 'getEvents': 

		$type_id = $_POST['type_id'];
		$product_id = (int)$_POST['product_id'];

		$query = 	"SELECT id, day, TIME_FORMAT(time, '%H:%i') time FROM wp_events
					WHERE product_id={$product_id} AND type_id={$type_id} AND active=1
					ORDER BY day, time";

		$event_rows = $wpdb->get_results($query, 'ARRAY_A');

		$result = array(
			'type_id' => $type_id,
			'product_id' => $product_id,
			'events' => $event_rows
		);

		echo json_encode($result);

	break;


	case 'editEvent': // обновление(удаление) и добавление мероприятий

		$type_id = $_POST['type_id'];
		$product_id = (int)$_POST['product_id'];
		$day = (int)$_POST['day'];
		$time = $_POST['time'];
		$event_id = (int)$_POST['event_id'];

		if( !empty($event_id) ){

			if( isset($_POST['remove']) ){
				$query = 	"UPDATE wp_events
							SET active=0
							WHERE id={$event_id}";
			}
			else{
				$query = 	"UPDATE wp_events
							SET day={$day}, time='{$time}'
							WHERE id={$event_id}";
			}			
		}
		else{
			$query = 	"INSERT INTO wp_events(product_id, type_id, day, time)
						VALUES( {$product_id}, {$type_id}, {$day}, '{$time}' )";
		}

		$result = $wpdb->query($query);

		echo $query;

	break;


	case 'activateUser': // АКТИВАЦИЯ ПОЛЬЗОВАТЕЛЯ (ПОЛЕ В БД active_date)

		$user_id = $_POST['user_id'];
		$date = $_POST['date'];

		$query = "SELECT meta_value FROM wp_usermeta WHERE user_id = {$user_id} and meta_key = 'active_date'";
		$active_date = $wpdb->get_var($query);

		if(!empty($active_date)){
			$query = 	"UPDATE wp_usermeta
						SET meta_value = '{$date}'
						WHERE meta_key='active_date' AND user_id={$user_id}";
		}
		else{
			$query = 	"INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
						VALUES({$user_id}, 'active_date', '{$date}')";
		}

		$res = $wpdb->query($query);

		echo $res;

	break;

}


// возвращает разницу времени от текущего до заданного (в минутах)

function getMinDiff($time){	

	$datetime1 = new DateTime("+3 hours");
	$datetime2 = new DateTime($time);
	$interval = $datetime1->diff($datetime2);	

	$hours = $interval->h;
	$mins = $interval->i;
	$k = $interval->invert==1 ? -1 : 1;	

	$minToStart = $k*($hours*60 + $mins);	

	return $minToStart;
}

// получение ссылки на комнату с вебинаров в зависимости от продукта и типа мероприятия
function getClickMeetingLink($product_id, $type_id){

	if( $product_id == 1 && $type_id == 1 ) return '/guestmeeting/';
	if( $product_id == 1 && $type_id == 2 ) return '/uds-business-traning/';
	if( $product_id == 2 && $type_id == 1 ) return '/yoke_guestmeeting/';
	//if( $product_id == 2 && $type_id == 2 ) return '/uds-business-traning/'; 
	if( $product_id == 2 && $type_id == 2 ) return '/yoke-business-traning/'; 

}

?>