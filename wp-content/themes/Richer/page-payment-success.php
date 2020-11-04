<?php 

	/*

	Template Name: Page Payment Success

	*/

?>

<?php

$pay_id = $_GET['MERCHANT_ORDER_ID'];
$id_parts = explode('_', $pay_id);
$pay_month = $id_parts[1];
$pay_type = $id_parts[0];

// echo $pay_date;
// echo $pay_type;

require_once(__DIR__.'/php/help_functions.php');

$user_id = get_current_user_id();
$old_user_role = $ultimatemember->user->get_role(); 

if( $user_id > 1){

	$guest_roles = array( 'guest-game', 'guest-yoke' ); 
	$is_guest_role = in_array( $old_user_role, $guest_roles);

	$changing_role = false;

	if( $pay_month == 'TEST' ){

		if( $is_guest_role ){

			$query = "SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'test_active_date' AND user_id = {$user_id}";
			$test_was = $wpdb->get_var( $query );

			// если не было тестового периода
			if( empty($test_was) ){

				$query = "SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'active_date' AND user_id = {$user_id}";
				$active_was = $wpdb->get_var( $query );

				if( empty($active_was) ){

					$pay_date = date('Y-m-d', strtotime('+10 day'));
					$res = setCustomField( $user_id, 'test_active_date', $pay_date );
// 					echo ' test '.$pay_date;
					$changing_role = true;
				}				
			}			
		}
		
	}
	else{
		$pay_date = date('Y-m-d', strtotime('+'.$pay_month.' month'));
		$res = setCustomField( $user_id, 'active_date', $pay_date );
		$changing_role = true;
// 		echo 'pay '.$pay_date;
	}

	
	if( $changing_role ){

		print_r($res);

		$old_u_parts = explode( '-', $old_user_role );
		$old_user_role_type = $old_u_parts[1];

		$s_roles = array( 'speaker-game', 'speaker-yoke', 'speaker-gy' );

		$is_speaker = in_array( $old_user_role, $s_roles);
		$same_type = strtolower( $pay_type ) == $old_user_role_type ? 1 : 0;

// 		echo $same_type;
// 		echo $is_speaker;

		if( $is_speaker && $same_type){
			$user_role = $old_user_role;
		}

		else{

			switch ($pay_type) {

				case 'UDS': $user_role = 'partner-game';
					break;

				case 'YOKE': $user_role = 'partner-yoke';
					break;

				case 'GY': $user_role = 'partner-gy';
					break;

				default: $user_role = 'partner-game';
					break;

			}

		}

// 		echo '<br/>set role = '.$user_role;
		$ultimatemember->user->set_role( $user_role );
	}


}




?>



<?php get_header('blank'); ?>

<div id="page-wrap">

	<div id="content" <?php post_class(); ?>>



	<?php if( !$res ):?>



		<div class="alert-message custom" style="color:#e43c3c;border:1px dashed #e43c3c;">

			<i class="icon fa fa-minus-circle standard simple" style=""></i>

			ОШИБКА: Ваша оплата прошла, но профиль не активировался из-за технического сбоя. <br/>

			Пожалуйста, свяжитесь с тех.поддержкой и сообщите о проблеме. <br/>

			Для обращения понадобится Ваш идентификатор в системе. Запишите его: <?php echo $user_id ?>
			 
			 ---> <?php echo $pay_month?>

			<span class="close fa fa-times" href="#"></span>

			<div class="clear"></div>

		</div>



	<?php endif;?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; endif; ?>

	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer('blank'); ?>

