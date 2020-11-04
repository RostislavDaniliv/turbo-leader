<?php

	$non_guest_roles = array( 'partner-gy', 'speaker-gy', 'partner-game', 'speaker-game', 'partner-yoke', 'speaker-yoke' );
	$is_non_guest_role = in_array( $user_role, $non_guest_roles );

	if( $is_non_guest_role ) {

		$query = "SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'active_date' AND user_id = {$user_id}";
		$date_active_ends = $wpdb->get_var( $query );
		
		// ЕСЛИ НЕТ АКТИВАЦИИ, ТО СМОТРИМ ТЕСТОВЫЙ ПЕРИОД
		if( empty($date_active_ends) ){

			$query = "SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'test_active_date' AND user_id = {$user_id}";
			$date_active_ends = $wpdb->get_var( $query );

		}


		if( isset($date_active_ends) ) {


			$date_active_ends = new DateTime( $date_active_ends );
			$today = new DateTime( date('Y-m-d') ); 

			$interval = $date_active_ends->diff($today);
			//print_r($date_active_ends->format("d.m.Y"));
			
			$days = $today >= $date_active_ends ? (-1) * $interval->days : $interval->days;
			//echo $days;

			$is_active_profile = $date_active_ends >= $today ? 1 : 0;

			if($days <= 14 && $days >=1){
				$btn_link = '';
				$print_date = $date_active_ends->format('d.m.Y');

				if( $user_role == 'partner-gy' || $user_role == 'speaker-gy') 	$btn_link = '/gy-pay/';
				if( $user_role == 'partner-game' || $user_role == 'speaker-game') 	$btn_link = '/uds-pay/';
				if( $user_role == 'partner-yoke' || $user_role == 'speaker-yoke') 	$btn_link = '/yoke-pay/';
			?>
				<script type="text/javascript">
					var $ = jQuery.noConflict();
					$(document).ready(function(){
						$("#active-profile-alert .active_date").html("<?php echo $print_date ?>");
						$("#active-profile-alert .callout-button a").attr("href", <?php echo $btn_link ?>);
						$("#active-profile-alert").show();
					});
				</script>
			<?php
			}
			elseif( $days <= 0 ){

				dropRole($ultimatemember, $user_role);

			}

		}
		else{

			dropRole($ultimatemember, $user_role);
			
		}

	}
	else{ // РОЛЬ ГОСТЯ

		$query = "SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'submitted' AND user_id = {$user_id}";
		$res = $wpdb->get_var( $query );


		$res_arr = unserialize($res);
		$reg_site_id = $res_arr['reg_site_id'];

		//echo $res_arr['form_id'];

		// 12187 - йоки  

		if( isset($res_arr['reg_site_id']) ){

			$query = "SELECT site_id, type FROM wp_regsites";
			$res_sites = $wpdb->get_results($query);

			//print_r($res_sites)

			foreach ($res_sites as $site_row) {
				if( $site_row->site_id == $reg_site_id ){ // нашли сайт регистрации пользователя

					switch ($user_role) {
						case 'guest-game':
							if( $site_row->type == 2 ) { // 2 - тип сайта йоки
								//echo 'сбрасываем роль на йоки';
								$ultimatemember->user->set_role( 'guest-yoke' );
								header('Location: /');
							}
							break;
						
						case 'guest-yoke':
							if( $site_row->type == 1 ) { // 1 - тип сайта гейма
								//echo 'сбрасываем роль на гейм';
								$ultimatemember->user->set_role( 'guest-game' );
								header('Location: /');
							}
						break;
					}
					break;

				}
			}

			$game_sites = array();
			$yoke_sites = array( 12081 );

			

		}

	}

// 11883 12066 12072
	// 12081 12304


	function dropRole($ultimatemember, $user_role){

			$g_role = 'guest-game';
			if( $user_role == 'partner-yoke' || $user_role == 'speaker-yoke' ) $g_role = 'guest-yoke';		
			
			//echo 'меняем роль '.$g_role;		
			$ultimatemember->user->set_role( $g_role );

	}









?>