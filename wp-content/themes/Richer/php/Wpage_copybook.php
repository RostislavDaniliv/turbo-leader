<?php 
	wp_enqueue_style('copybook.css', '/wp-content/themes/Richer/css/copybook.css');
 	wp_enqueue_script( 'copybook.js', '/wp-content/themes/Richer/js/copybook.js'); 
 	wp_enqueue_script( 'excellentexport.min.js', '/wp-content/themes/Richer/js/libs/excellentexport.min.js'); 
?>


<?php

	$sponsor_id = get_current_user_id();
	$sponsor_role = $ultimatemember->user->get_role(); 

	$game_roles = array( 'speaker-game', 'partner-game', 'speaker-gy', 'partner-gy', 'admin' );
	$yoke_roles = array( 'speaker-yoke', 'partner-yoke', 'speaker-gy', 'partner-gy', 'admin' );

	$is_game_role = in_array($sponsor_role, $game_roles);
	$is_yoke_role = in_array($sponsor_role, $yoke_roles);
	$is_gy_role = in_array($sponsor_role, array( 'speaker-gy', 'partner-gy', 'admin' ) );

	if( $is_gy_role ){
		$filter_postfix_game = ' (uds)';
		$filter_postfix_yoke = ' (yoke)';
	}

	if (! $sponsor_id || $sponsor_id <=0){
		$sponsor_id = 1;
	}

	$login_name = strtolower( um_user('user_login') );


	global $wpdb;
	global $um_online;


	$allusers = $wpdb->get_results( "SELECT * FROM wp_users");
	$alluserscount = count($allusers);

	$idLen=strlen($sponsor_id);
	$cond = 'POSITION("\"referer_id\";s:'.$idLen.':\"'.$sponsor_id.'\"" IN meta_value)>0';
	$all_users = $wpdb->get_results( 'SELECT * FROM wp_usermeta where meta_key = "submitted" and '.$cond.' order by user_id DESC ');	

	$records = count($all_users);

	$all_users_online = 0;

	foreach ($all_users as $user) {

		if($um_online->is_online($user->user_id)){

			$all_users_online++;

		}	

	}	

?>

<script type="text/javascript">
			$ = jQuery.noConflict();
			$(document).ready(function(){			

				$('#register-company-form div[data-key="referer_id"] input').val('<?=$sponsor_id?>');

			});
		</script>

<div class="container">
	<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">


			<div class="row">

				<div class="span12" style="padding-left:0;">

					<div class="callout right">
						<div class="callout-content" >
							<h4 style="font-weight: 500;">Найдено контактов: <?php echo $records; ?></h4>
						</div>

						<div class="callout-button right"><span id="is-online-button" class="button medium default simple" style="margin:0">
							<i class="fa fa-lightbulb-o " title="Оффлайн"></i>
							Сейчас на сайте: <?php echo $all_users_online; ?></span></div>
					</div>

					<div class="tabset horizontal">
						<ul class="tabs">
							<li class="tab"><a href="#panel1" class="selected"><h6><i class="fa fa-users"></i>Контакты</h6></a></li>
							<li class="tab"><a href="#panel2" class=""><h6><i class="fa fa-search"></i>Поиск</h6></a></li>
							<li class="tab"><a href="#panel3"><h6><i class="fa fa-shopping-cart"></i>Корзина</h6></a></li>
						</ul>

						<div class="panel" id="panel1" style="display: block;">
							<div class="wrapper">
								<div class="row">
									<div class="span4">
										<select id="role-filter">
											<option value="">Все</option>
											
											<?php if($is_game_role && $is_yoke_role):?>
											<option value="partner-gy">UDS+YOKE партнеры</option>
											<?php endif;?>

											<?php if( $is_game_role ):?>
											<option value="guest-game">Гости<?php echo $filter_postfix_game ?></option>
											<option value="partner-game speaker-game">Партнеры<?php echo $filter_postfix_game ?></option>
											<option value="company-game">Юр.лица<?php echo $filter_postfix_game ?></option>
											<?php endif;?>
											<?php if( $is_yoke_role ):?>
											<option value="guest-yoke">Гости<?php echo $filter_postfix_yoke ?></option>
											<option value="partner-yoke speaker-yoke">Партнеры<?php echo $filter_postfix_yoke ?></option>
											<?php endif;?>

											<option value="fl_was_online">Посетил(а) онлайн</option>
											<option value="fl_click_sb">Нажал(а) кнопку</option>
											<option value="fl_set_phone">Телефон указан</option>
											<option value="fl_set_skype">Скайп указан</option>
										</select>
									</div>
									<span class="span8">
										<button id-panel="panel1" class="button  turquoise medium three_d align refresh-cart" title="Обновить"><i class="fa fa-refresh" style="margin-right:0"></i></button>
										<button class="button  yellow  medium three_d align cart-button" id-panel="panel1" title="В корзину"><i class="fa fa-shopping-cart" style="margin-right:0"></i></button>
										
										<?php if( $is_game_role ):?>
										<button id="reg-company-btn" class="button  black   medium three_d align"><i class="fa fa-briefcase"></i>ДОБАВИТЬ КОМПАНИЮ</button>
										<?php endif;?>
	
										<button id="export-contacts-btn" class="button  lightgreen medium three_d align active"><i class="fa fa-angle-double-up"></i><i class="spinner"></i>ЭКСПОРТ</button>
										<table style="display:none" id="copybook_export"></table>
										<a id="cp-link-export" class="button green medium three_d align" download="copybook.csv" href="#" onclick="return ExcellentExport.csv(this, 'copybook_export');">
											<i class="fa fa-download"></i>СКАЧАТЬ .CSV
										</a> 
									</span>
								</div>								

								<div id="copybook_usersContainer" class="accordion style4" rel="1">		
								</div>

								<div class="big-loader-down">
									<div class="progressbar active " data-perc="100" style="background-color:#efefef">
										<div class="bar-percentage " style="width: 85%; background-color: rgb(70, 77, 94)" data-original-title="100%">
										</div>
									</div>
									<div class="loader-bar">
										<div class="loader"></div>
										<div class="text">ЗАГРУЗКА</div>
									</div>
									<div class="load-button active" offset="0">
										<div class="text">Загрузить</div>
										<i class="icon fa fa-angle-down standard circle"></i>
									</div>
								</div>

							</div>
						</div>

						<div class="panel" id="panel2" style="display: none;">
							<div class="wrapper">
								<div class="row">
									<div class="span3">
										<select id="search-type">
											<option value="lastname">По фамилии</option>
											<option value="email">По Email/Skype/Тел.</option>
										</select>
									</div>
									<div class="span4">
										<input type="text" id="value-sf" placeholder="Фамилия" />
									</div>
									<div class="span5">
										<button class="button  yellow  medium three_d align cart-button" id-panel="panel2" ><i class="fa fa-shopping-cart"></i>В КОРЗИНУ</button>
										<button id="search-user-button" class="button  blue medium three_d align"><i class="fa fa-search"></i></i>ПОИСК</button>
									</div>	
								</div>

								<div id="copybook_sf_usersContainer" class="accordion style4" rel="1">		
								</div>

								<div class="big-loader-down">
									<div class="progressbar active " data-perc="100" style="background-color:#efefef">
										<div class="bar-percentage " style="width: 85%; background-color: rgb(70, 77, 94);" data-original-title="100%">
										</div>
									</div>
									<div class="loader-bar">
										<div class="loader"></div>
										<div class="text">ЗАГРУЗКА</div>
									</div>
									<div class="load-button active" offset="0">
										<div class="text">Поиск</div>
										<i class="icon fa fa-angle-down standard circle"></i>
									</div>
								</div>

							</div>
						</div>

						<div class="panel" id="panel3" style="display: none;">
							<div class="wrapper">

								<div class="row" style="padding-bottom: 16px;">
									<div class="span6">
										<button id="remove-from-cart" class="button  blue medium three_d align"><i class="fa fa-mail-reply"></i>УБРАТЬ ИЗ КОРЗИНЫ</button>
										<button id-panel="panel3" class="button  turquoise medium three_d align refresh-cart"><i class="fa fa-refresh"></i>ОБНОВИТЬ</button>
									</div>
								</div>

								<div id="copybook_cart_usersContainer" class="accordion style4" rel="1">		
								</div>

								<div class="big-loader-down">
									<div class="progressbar active " data-perc="100" style="background-color:#efefef">
										<div class="bar-percentage " style="width: 85%; background-color: rgb(70, 77, 94);" data-original-title="100%">
										</div>
									</div>
									<div class="loader-bar">
										<div class="loader"></div>
										<div class="text">ЗАГРУЗКА</div>
									</div>
									<div class="load-button active" offset="0">
										<div class="text">Загрузить</div>
										<i class="icon fa fa-angle-down standard circle"></i>
									</div>
								</div>

							</div>	
							</div>
						</div>

				</div>
			</div>
		</div>

	</div>

</div>



