<?php

global $wpdb;

$query = 'SELECT 	wMain.user_id as User_id, 
					wPhoto.meta_value as Profile_photo, 
					wFName.meta_value as First_name,
					wRole.meta_value as Role_arr

		FROM wp_usermeta wMain 
		LEFT JOIN wp_usermeta wPhoto 
			ON wPhoto.user_id=wMain.user_id and wPhoto.meta_key="profile_photo" 
		LEFT JOIN wp_usermeta wFName 
			ON wFName.user_id=wMain.user_id and wFName.meta_key="first_name"
		LEFT JOIN wp_usermeta wRole
			ON wRole.user_id=wMain.user_id and wRole.meta_key="wp_capabilities"

		WHERE wMain.user_id='.$user_id.' 
		LIMIT 1';

$res = $wpdb->get_results($query);
$user_data = $res[0];

$url = $user_data->Profile_photo ? 
	"/wp-content/uploads/ultimatemember/{$user_id}/{$user_data->Profile_photo}" : 
	"/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg";



$role = $wpdb->get_var("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'wp_capabilities' AND user_id = {$user_id}");

if(!$role) return 'non-user';
$rarr = unserialize($role);
$roles = is_array($rarr) ? array_keys($rarr) : array('non-user');
$role = $roles[0];

if($role=='guest'){
	$query = "SELECT meta_value FROM wp_usermeta WHERE meta_key='start_biz_click' and user_id='{$user_id}'";
	$guest_click_sb = $wpdb->get_var($query);
}


?>

<div id="menu-block">

	<div class="container">

		<div class="span12" style="padding: 0;">

			

			<div id="top-menu-container">



				<div id="site-header">

					<div class="site-logo"></div>

					<div class="site-title">UDSONLINE.RU</div>

				</div>



				<div id="user-profile-block">
					<div class="user-name"><?=$user_data->First_name?></div>
					<div class="user-ava" style="background:url(<?=$url?>) 0 0 no-repeat; background-size: contain;"></div>
					<div class="user-dd"><i class="fa fa-angle-down"></i></div>
				</div>

				<?php // КНОПКА "НАЧАТЬ БИЗНЕС" ДЛЯ ГОСТЯ
				if($guest_click_sb==1):
				?>

					<a class="button red medium three_d align" href="/start-biz/" target="_blank" style="float:right; margin:6px 15px 0 0">НАЧАТЬ БИЗНЕС</a>

				<?php endif;?>


				<div id="main-menu-block">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'top_bar_navigation', 
							'container' => false, 
							'depth' => 2, 
							'items_wrap'=>'%3$s', 
							'menu_id' => 'topnav', 
							'fallback_cb' => false));  
					?>
				</div>



			</div>





			<div id="nav-sub-menu">

				<?php

				wp_nav_menu(

						array(

							'theme_location' => 'aside_navigation', 

							'container_class'=>'navbar-menu', 

							'menu_id' => 'side-nav-toggle', 

							'menu_class'=>'menu', 

							'fallback_cb' => false

						));



				?>

			</div>



		</div>

	</div>



</div>

