<?php global $post;

$post_slug=$post->post_name;

/*if($post_slug == 'events-guest' && get_user_role()=='guest') {

$guest_hints = "guest_hints"; $v_val = "yes"; setcookie($guest_hints, $v_val, time() + (84600 * 365), "/");}*/

if($post_slug == 'events' && get_user_role() !== 'partner') {


}?><!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>



<!-- Basic Page Needs 

========================================================= -->

<?php global $options_data; global $post; ?>

<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>

<meta charset="<?php bloginfo('charset'); ?>">



<?php do_action('asw_header_meta'); ?>



<!--[if lt IE 9]>

	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->



<!-- Mobile Specific Metas & Favicons

========================================================= -->

<?php if($options_data['check_mobilezoom'] == 1) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><?php } ?>



<link rel="shortcut icon" href="<?php if($options_data['media_favicon'] != "") { echo $options_data['media_favicon']; } else {echo get_template_directory_uri().'/favicon.ico';} ?>">


<!-- WordPress Stuff

========================================================= -->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenMax.min.js"></script>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?130"></script>


                                        

<?php wp_head(); ?>





	<link rel="stylesheet" href="/wp-content/themes/Richer/css/main.style.css" type="text/css">

	<!-- <link rel="stylesheet" href="/wp-content/themes/Richer/css/menu.style.css" type="text/css">

	<script type="text/javascript" src="/wp-content/themes/Richer/js/menu.js"></script> -->
	<script src="/wp-content/themes/Richer/js/main.fn.js"></script>

	<?php

		global $wpdb;
		$user_id = get_current_user_id();

		$role = $wpdb->get_var("SELECT meta_value FROM wp_usermeta WHERE meta_key='role' AND user_id={$user_id}");

		$game_roles = array( 'speaker-game', 'partner-game', 'speaker-gy', 'partner-gy', 'admin', 'guest-game' );
		$is_game_role = in_array($role, $game_roles);
		

		if( $is_game_role  ){
			echo '<script charset="UTF-8" src="//cdn.sendpulse.com/js/push/037ef6c0a16d7dfc1e7443b305793e99_0.js" async></script>';
		}

	?>

		
</head>



<?php


$sponsor = $wpdb->get_row( "SELECT * FROM wp_usermeta where meta_key = 'submitted' and user_id = {$user_id}");
$submitData = unserialize($sponsor->meta_value);
$sponsor = $submitData['referer_id'];



if (!$sponsor){
	$sponsor = 1;
}

//require_once(__DIR__.'/php/menu.php'); 



$sidenav_position = (isset($options_data['sidenav_position']) && $options_data['sidenav_position'] == 'right') ? 'sidenav-right' : 'sidenav-left';  

$extra_sidenav_class = '';

if(isset($options_data['select_sidenav'])) {

	switch ($options_data['select_sidenav']) {

		case 'static':

			$extra_sidenav_class = 'side-navigation-enabled sidenav-static';

			break;

		case 'toggle':

			$extra_sidenav_class = 'side-navigation-enabled sidenav-toggle';

			break;

		case 'hover':

			$extra_sidenav_class = 'side-navigation-enabled sidenav-hover';

			break;

		default:

			$extra_sidenav_class = '';

			break;

	}

}

$extra_sidenav_class .= ' '.$sidenav_position;

?>

<body <?php body_class($extra_sidenav_class); ?>>

<?php // ВСТАВЛЯЕМ РЕФЕРАЛКУ В ПОЛЕ

	require_once(__DIR__.'/php/work_ref_reg.php');
// -----------------------------------
?>


<?php if(isset($options_data['select_sidenav']) && $options_data['select_sidenav'] != 'hide') get_template_part('framework/headers/sidebar-navigation'); ?>	

<?php if ( $options_data['check_styleswitcher'] == 1 ) {get_template_part('framework/inc/switcher/switcher');} ?>		

<div id="main <?=$ref?>" class="<?php echo $options_data['select_layoutstyle'];?>">

<?php 

if(isset($options_data['disable_header']) && $options_data['disable_header'] != 1 || (isset($options_data['select_sidenav']) && $options_data['select_sidenav'] == 'hide' )){

	if($options_data['check_toparea'] != 0 ):?>

		<div class="toparea-sliding-area">

			<div class="toparea-content container">

				<div class="span12">

				<div class="row-fluid">

					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Topbar Widgets')); ?>

				</div>

				</div>

			</div>

			<a href="javascript:void(0);" class="toparea-sb"><i class="fa fa-plus"></i></a>

		</div>

	<?php endif; ?>

	<?php 

	if(isset($options_data['header_layout'])){

		$header_version = $options_data['header_layout'];

	} else {

		$header_version = 'version1';

	}

	if($options_data['check_topbar'] == 1 ) {

		get_template_part('framework/headers/topbar');

	}

	if($options_data['check_fixed_header'] == 1 ) {

		get_template_part('framework/headers/header-fixed');

	}

	get_template_part('framework/headers/header-'.$header_version.'');

}	 



?>

			



