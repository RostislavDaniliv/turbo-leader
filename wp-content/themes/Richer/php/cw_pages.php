<?php

function cw_integrateRoom( $roomName, $current_user ){

	$api_key = 'eu4439aa936567882244e7bade9b2e2a382eaf5d2b'; 

	switch ( $roomName ) {
		case 'guest-meeting':
			$room_id = '813535'; 
			$room_url =  'https://smartbzpro.clickmeeting.com/gostevaya-vstrecha'; 
			break;

		case 'business-school':
			$room_id = '813531'; 
			$room_url =  'https://smartbzpro.clickmeeting.com/biznes-shkola'; 
			break;

		case 'training':
			$room_id = '813538'; 
			$room_url =  'https://smartbzpro.clickmeeting.com/trening-dlya-partnerov'; 
			break;

		case 'yoke-on-air':
			$room_id = '815751'; 
			$room_url =  'https://smartbzpro.clickmeeting.com/yoke-on-air'; 
			break;

		case 'yoke-online-trening':
			$room_id = '815747'; 
			$room_url =  'https://smartbzpro.clickmeeting.com/online-trening-yoke'; 
			break;
		
		default:
			break;
	}

	try {

		require_once(__DIR__.'/clickmeeting_api/ClickMeetingRestClient.php'); 
		$client = new ClickMeetingRestClient(array('api_key' => $api_key));

		$nickname = ($current_user->user_firstname ? $current_user->user_firstname . ' ' . $current_user->user_lastname : $current_user->user_login);
		$city = trim(um_user('city_user'));

		if ($city) {
		    $nickname .= ' (' . $city . ')';
		}

		//echo '<pre>';
		//print_r($client->conferences());
		//echo '</pre>';

		$autologin = $client->conferenceAutologinHash($room_id, array(
	        'email' => $current_user->user_email,
	        'nickname' => $nickname,
	        'role' => 'listener'
	    ));

	    $autologin_hash = $autologin->autologin_hash;
	    //echo $autologin_hash;
	}
	catch (Exception $e)
	{
	    //print_r(json_decode($e->getMessage()));
	    echo 'Ошибка подключения к вебинарной комнате';
	}

	if( strlen($autologin_hash)>10 ){
		$room_url .= '?l=' . $autologin_hash;
	}

	return $room_url;

}

?>