<?php
/*
Template Name: Page Full-Width
*/

global $wpdb;
$user_id = get_current_user_id();			
$user_role = $ultimatemember->user->get_role();		

$sponsor = $wpdb->get_row( "SELECT * FROM wp_usermeta where meta_key = 'submitted' and user_id = {$user_id}");
$submitData = unserialize($sponsor->meta_value);
$sponsor = $submitData['referer_id'];

if (!$sponsor){
	$sponsor = 1;						
}

?>


<?php get_header(); ?>

<?php

// ПРОВЕРКА РОЛИ И АКТИВНОСТИ ПОЛЬЗОВАТЕЛЯ
require_once(__DIR__.'/php/check_active_date.php');

?>

<div id="refferer-id-field" style="display:none"><?=$sponsor?></div>
<div id="sb-user-role" style="display:none"><?=$user_role?></div>

	<?php
		$post_id = get_the_ID(); // ID СТРАНИЦЫ

		//$pay_pages = array( 12097, 12204, 12205, 12261, 12273 );
		$pay_pages = array( 12273 );
	?>


	<?php  if( in_array($post_id, $pay_pages) ):?>

		<script type="text/javascript">
			$(document).ready(function(){

				var user_id = "<?php echo $user_id ?>";

				if(user_id.length){

					/*var pay3link = 'http://www.free-kassa.ru/merchant/cash.php?oa=29&o=GAME_3_'+user_id+'&us_desc='+user_id+'&s=75e535b43e9e797194a43fe4b8963036&m=40348';

					$(".plan .signup a").eq(0).attr('href', pay3link);


					var pay12link = 'http://www.free-kassa.ru/merchant/cash.php?oa=99&o=GAME_12_'+user_id+'&us_desc='+user_id+'&s=75e535b43e9e797194a43fe4b8963036&m=40348';

					$(".plan .signup a").eq(1).attr('href', pay12link);


					var pay6link = 'http://www.free-kassa.ru/merchant/cash.php?oa=54&o=GAME_6_'+user_id+'&us_desc='+user_id+'&s=75e535b43e9e797194a43fe4b8963036&m=40348';

					$(".plan .signup a").eq(3).attr('href', pay6link);*/

				}

				

				if(user_id.length){
					console.log('change',user_id);

					$('.interkassa-btn input[name="ik_pm_no"]').each(function(){
						var val = $(this).val();
						$(this).val( val + '_' + user_id );
					});
 

				}
				

				console.log();

				$(".plan .signup a").click(function(e){
					e.preventDefault();
					var href = $(this).attr("href");

					$(href).click();

					console.log(btn_id);
				});	

			})
		</script>

	<?php endif;  ?>


	<?php

		if ($post_id == 12451 && $user_role == 'admin'){
			require_once(__DIR__.'/php/page_config.php');
		}

		// НАЧАТЬ БИЗНЕС UDS

		if ($post_id == 6694 || $post_id == 10704){
			require_once(__DIR__.'/php/page_price.php');
		}


		if( $post_id == 12093) {
			require_once(__DIR__.'/php/page_yoke_startbiz.php');
		}


	?>



	<?php get_template_part( 'framework/inc/titlebar' ); ?>



	<div id="page-wrap">



		<div id="content" <?php post_class(); ?>>









		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

				<?php

					$sponsor_id = get_current_user_id();

					//server

					if ($post_id == 7082): // СПИСКО КОНТАКТОВ
				?>

				<?php
					require_once(__DIR__.'/php/page_copybook.php'); 
				?>

				<?php elseif ($post_id == 12443): // СПИСОК САЙТОВ?>

				<?php
					require_once(__DIR__.'/php/page_regsites.php'); 
				?>

				<?php elseif ($post_id == 7237):?>



				<?php


					// СТРАНИЦА "КОНТАКТЫ"
					$user_id = get_current_user_id();

					if ($user_id <= 0){

						$user_id = 1;

					}



					global $wpdb;


					$sponsor = $wpdb->get_row( "SELECT * FROM wp_usermeta where meta_key = 'submitted' and user_id = {$user_id}");

					$submitData = unserialize($sponsor->meta_value);

					$sponsor = $submitData['referer_id'];					



					if (!$sponsor){



						$sponsor = 1;



					}











					$metakeys = $wpdb->get_results( "SELECT * FROM wp_usermeta where user_id = {$sponsor}");



					$userinfo = get_userdata($sponsor);



					$userdata = array();



					foreach ($metakeys as $value){



						$userdata[$value->meta_key] = $value->meta_value;

					}

				?>

				<script type="text/javascript">


					jqc = jQuery.noConflict();

					jqc(function(){

						jqc('.um-followers-bar .um-followers-btn .um-message-btn').attr('data-message_to','<?php echo $sponsor; ?>');

					});

				</script>

				<div class="vc_row wpb_row vc_row-fluid vc_custom_1451704636789"><div class="container"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="wpb_wrapper">

					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
							<div class="um um-profile um-viewing um-7343 uimob960" style="opacity: 1;">
					<div class="um-form">							
				



							<div data-ratio="2.7:1" data-user_id="1" class="um-cover has-cover" style="height: 356px;display:none;">



							



												



								<div style="display: none !important;"><div data-key="cover_photo" class="um-field um-field-cover_photo"><input type="hidden" value="" id="cover_photo" name="cover_photo"><div class="um-field-label"><label for="cover_photo">Сменить фото Вашей подложки</label><div class="um-clear"></div></div><div style="text-align: center" class="um-field-area"><div data-key="cover_photo" data-crop="cover" class="um-single-image-preview crop">



												<a class="cancel" href="#"><i class="um-icon-close"></i></a>



												<img alt="" src="">



											</div><a class="um-button um-btn-auto-width" data-modal-copy="1" data-modal-size="large" data-modal="um_upload_single" href="#">Загрузить</a></div><div class="um-modal-hidden-content"><div class="um-modal-header"> Сменить фото Вашей подложки</div><div class="um-modal-body"><div data-coord="" data-min_height="" data-min_width="1000" data-ratio="2.7" data-crop="cover" class="um-single-image-preview crop"><a class="cancel" href="#"><i class="um-icon-close"></i></a><img alt="" src=""></div><div data-upload_help_text="" data-max_files_error="You can only upload one image" data-upload_text="Загрузите фото подложки сюда" data-allowed_types="gif,jpg,jpeg,png" data-extension_error="Sorry this is not a valid image." data-min_size_error="This image is too small!" data-max_size_error="This image is too large!" data-max_size="999999999" data-key="cover_photo" data-type="image" data-set_mode="" data-set_id="0" data-icon="um-faicon-picture-o" class="um-single-image-upload">Загрузить</div><div class="um-modal-footer">



													<div class="um-modal-right">



														<a data-processing="Обработка..." data-change="Сменить фото" data-key="cover_photo" class="um-modal-btn um-finish-upload image disabled" href="#"> Применить</a>



														<a data-action="um_remove_modal" class="um-modal-btn alt" href="#"> Отмена</a>



													</div>



													<div class="um-clear"></div>



												</div></div></div></div></div>				



								<span class="um-cover-overlay">



								<span class="um-cover-overlay-s">



									<ins>



										<i class="um-faicon-picture-o"></i>



										<span class="um-cover-overlay-t">Сменить фото Вашей подложки</span>



									</ins>



								</span>



							</span>				



								<div class="um-cover-e">



									<?php



									if (array_key_exists('cover_photo',$userdata)){



										$cover = "/wp-content/uploads/ultimatemember/{$sponsor}/".$userdata['cover_photo'];	



									}



									else{



										$cover = '/wp-content/uploads/ultimatemember/1/cover_photo.jpg?1451785950';//http://udsonline.ru/wp-content/uploads/ultimatemember/1/cover_photo.jpg?1451785950



									}



									?>					



									<img alt="" src="<?php echo $cover; ?>">						



														



								</div>



								



							</div>



							



										



									



							<div class="um-header">







<div class="um-followers-bar">







				<div class="um-followers-btn">



					<a href="#" class="um-message-btn um-button active" data-message_to="26"><span>Написать сообщение</span></a>				</div><div class="um-clear"></div>



				



			</div>







							



										



						<div class="um-profile-edit um-profile-headericon um-trigger-menu-on-click">



						



							<a class="um-profile-edit-a" href="#"><i class="um-faicon-cog"></i></a>



						



									



						<div data-trigger="click" data-position="lc" data-element="div.um-profile-edit" class="um-dropdown" style="top: 0px; width: 200px; left: auto; right: 17px; text-align: center;">



							<div class="um-dropdown-b">



								<div class="um-dropdown-arr" style="top: 4px; left: auto; right: -17px;"><i class="um-icon-arrow-right-b"></i></div>



								<ul>



														



									<li><a class="real_url" href="http://udsonline.ru/lp/alexgm/?profiletab=main&amp;um_action=edit">Редактировать профиль</a></li>



									



														



									<li><a class="real_url" href="/myuds/?um_action=um_switch_user&amp;uid=1">Войти как этот пользователь</a></li>



									



														



									<li><a class="um-dropdown-hide" href="#">Отмена</a></li>



									



													</ul>



							</div>



						</div>



									



								



						</div>



						



										



								<div data-user_id="1" class="um-profile-photo">



									<?php



										if (array_key_exists('first_name',$userdata)){



											$first_name = $userdata['first_name'];	



										}



										else{



											$first_name = 'Это';



										}



										if (array_key_exists('last_name',$userdata)){



											$last_name = $userdata['last_name'];



										}



										else{



											$last_name = 'Пользователь';



										}



										if (array_key_exists('city_user',$userdata)){



											$city_user = $userdata['city_user'];



										}



										else{



											$city_user = '(город не указан)';



										}



										if (array_key_exists('profile_photo',$userdata)){



											$profile_photo = "/wp-content/uploads/ultimatemember/{$sponsor}/".$userdata['profile_photo'];



										}



										else{



											$profile_photo = '/no-avatar.png';//http://udsonline.ru/wp-content/uploads/ultimatemember/1/cover_photo.jpg?1451785950



										}



									?>	



									<a title="<?php echo "{$first_name} {$last_name} {$city_user}";?>" class="um-profile-photo-img" href="#"><span class="um-profile-photo-overlay">



							<span class="um-profile-photo-overlay-s">



								<ins>



									<i class="um-faicon-camera"></i>



								</ins>



							</span>



						</span><img width="150" height="150" alt="" class="gravatar avatar avatar-150 um-avatar" src="<?php echo $profile_photo; ?>"></a>



									



									<div style="display: none !important;"><div data-key="profile_photo" class="um-field um-field-profile_photo"><input type="hidden" value="" id="profile_photo" name="profile_photo"><div class="um-field-label"><label for="profile_photo">Сменить фото профиля</label><div class="um-clear"></div></div><div style="text-align: center" class="um-field-area"><div data-key="profile_photo" data-crop="square" class="um-single-image-preview crop">



												<a class="cancel" href="#"><i class="um-icon-close"></i></a>



												<img alt="" src="">



											</div><a class="um-button um-btn-auto-width" data-modal-copy="1" data-modal-size="normal" data-modal="um_upload_single" href="#">Загрузить</a></div><div class="um-modal-hidden-content"><div class="um-modal-header"> Сменить фото профиля</div><div class="um-modal-body"><div data-coord="" data-min_height="150" data-min_width="150" data-ratio="1" data-crop="square" class="um-single-image-preview crop"><a class="cancel" href="#"><i class="um-icon-close"></i></a><img alt="" src=""></div><div data-upload_help_text="" data-max_files_error="You can only upload one image" data-upload_text="Загрузите Ваше фото сюда" data-allowed_types="gif,jpg,jpeg,png" data-extension_error="Sorry this is not a valid image." data-min_size_error="This image is too small!" data-max_size_error="This image is too large!" data-max_size="999999999" data-key="profile_photo" data-type="image" data-set_mode="" data-set_id="0" data-icon="um-faicon-camera" class="um-single-image-upload">Загрузить</div><div class="um-modal-footer">



													<div class="um-modal-right">



														<a data-processing="Обработка..." data-change="Сменить фото" data-key="profile_photo" class="um-modal-btn um-finish-upload image disabled" href="#"> Применить</a>



														<a data-action="um_remove_modal" class="um-modal-btn alt" href="#"> Отмена</a>



													</div>



													<div class="um-clear"></div>



												</div></div></div></div></div>					



								</div>



								



								<div class="um-profile-meta">



								



									<div class="um-main-meta">



									



																<div class="um-name">



											



											<a title="<?php echo "{$first_name} {$last_name} {$city_user}";?>" href="#"><?php echo "{$first_name} {$last_name} {$city_user}";?> </a>



											<?php



												global $um_online;



												$user_online_status = 'offline';



												$user_online_status = ($um_online->is_online($sponsor)) ? 'online' : 'offline';



											?>



											<span title="<?php echo $user_online_status;?>" class="um-online-status <?php echo $user_online_status;?> um-tip-n"><i class="um-faicon-circle"></i></span>						



										</div>



																



										<div class="um-clear"></div>



										



																						



									</div>



									



														<div class="um-meta">



										



																	



									</div>



									



									<?php



										if (array_key_exists('description',$userdata)){



											$description = $userdata['description'];



										}



										else{



											$description = 'нет инфомации';



										} 



									?>			



									<div class="um-meta-text"><?php echo $description; ?></div>



									



														



									<div class="um-profile-status approved">



										<span>Статус этой учетной записи - Принято</span>



									</div>



									



														



								</div><div class="um-clear"></div>



								



												



							</div>



							



									



										



							<div class="um-profile-body main main-default">



								<div class="um-row _um_row_1 ">



									<div class="um-col-121">



										<div data-key="phone_number" class="um-field um-field-phone_number">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-phone"></i>



												</div>



												<label for="phone_number-7343">Телефон</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<?php



													if (array_key_exists('mobile_number',$userdata)){



														$mobile_number = $userdata['mobile_number'];



													}



													else{



														$mobile_number = 'отсутствует';



													} 



												?>



												<div class="um-field-value"><?php echo $mobile_number; ?></div>



											</div>



										</div>



										<div data-key="skype" class="um-field um-field-skype">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-skype"></i>



												</div>



												<label for="skype-7343">Skype</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<?php



													if (array_key_exists('skype',$userdata)){



														$skype = $userdata['skype'];



													}



													else{



														$skype = 'отсутствует';



													} 



												?>



												<div class="um-field-value"><?php echo $skype; ?></div>



											</div>



										</div>



										<div data-key="user_email" class="um-field um-field-user_email">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-icon-at"></i>



												</div><label for="user_email-7343">Email</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<div class="um-field-value">



													<a title="<?php echo $userinfo->user_email; ?>" href="mailto:<?php echo $userinfo->user_email; ?>"><?php echo $userinfo->user_email; ?></a>

												</div>

											</div>

										</div>

									</div>



									<div class="um-col-122">



										<div data-key="facebook" class="um-field um-field-facebook">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-facebook"></i>



												</div>



												<label for="facebook-7343">Facebook</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<div class="um-field-value">



												<?php



													if (array_key_exists('facebook',$userdata)){



														$subf = $facebook = $userdata['facebook'];



														if (strlen($facebook) > 47){



															$subf = substr($facebook, 0, 43);



															$subf = $subf.'...';



														}



													}



													else{



														$facebook = 'отсутствует';



													}



												?>



													<a rel="nofollow" target="_blank" title="Facebook" href="<?php echo $facebook?>"><?php echo $subf; ?></a>



												</div>



											</div>



										</div>



										<div data-key="vkontakte" class="um-field um-field-vkontakte">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-vk"></i>



												</div>



												<label for="vkontakte-7343">Вконтакте</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<div class="um-field-value">



													<?php



														if (array_key_exists('vkontakte',$userdata)){



															$subgp = $vkontakte = $userdata['vkontakte'];



															if (strlen($vkontakte) > 47){



																$subgp = substr($vkontakte, 0, 43);



																$subgp = $subgp.'...';



															}



														}



														else{



															$vkontakte = 'отсутствует';



														}



													?>



													<a rel="nofollow" target="_blank" title="Вконтакте" href="<?php echo $vkontakte; ?>"><?php echo $subgp; ?></a>



												</div>



											</div>



										</div>



										<div data-key="instagram" class="um-field um-field-instagram">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-instagram"></i>



												</div>



												<label for="instagram-7343">Instagram</label>



												<div class="um-clear"></div>



											</div>



											<div class="um-field-area">



												<div class="um-field-value">



													<?php



														if (array_key_exists('instagram',$userdata)){



															$instagram = $userdata['instagram'];



														}



														else{



															$instagram = 'отсутствует';



														}



													?>



													<a rel="nofollow" target="_blank" title="Instagram" href="<?php echo $instagram; ?>"><?php echo $instagram; ?></a>



												</div>



											</div>



										</div>



										<div data-key="youtube" class="um-field um-field-youtube">



											<div class="um-field-label">



												<div class="um-field-label-icon">



													<i class="um-faicon-youtube"></i>



												</div>



												<label for="youtube-7343">YouTube</label>



												<div class="um-clear"></div>



											</div>



										<div class="um-field-area">



											<div class="um-field-value">



												<?php



													if (array_key_exists('youtube',$userdata)){



														$youtube = $userdata['youtube'];



													}



													else{



														$youtube = 'отсутствует';



													}



												?>



												<a rel="nofollow" target="_blank" title="YouTube" href="<?php echo $youtube; ?>"><?php echo $youtube; ?></a>



											</div>



										</div>



									</div>



								</div>



								<div class="um-clear"></div>



							</div>	



						<input type="hidden" value="7343" id="form_id" name="form_id">



				



						<input type="hidden" value="1451785950" id="timestamp" name="timestamp">		



						<p class="request_name">



							<label for="request">Only fill in if you are not human</label>



							<input type="text" autocomplete="off" size="25" value="" class="input" id="request" name="request">



						</p>



						



						</div>		



							



					</div>



					



				</div><style type="text/css">



				.um-7343.um {



					max-width: 1196px;



				}



				



				.um-7343.um .um-tip:hover,



				.um-7343.um .um-field-radio.active i,



				.um-7343.um .um-field-checkbox.active i,



				.um-7343.um .um-member-name a:hover,



				.um-7343.um .um-member-more a:hover,



				.um-7343.um .um-member-less a:hover,



				.um-7343.um .um-members-pagi a:hover,



				.um-7343.um .um-cover-add:hover,



				.um-7343.um .um-profile-subnav a.active,



				.um-7343.um .um-item-meta a,



				.um-account-name a:hover,



				.um-account-nav a.current,



				.um-account-side li a.current span.um-account-icon,



				.um-account-side li a.current:hover span.um-account-icon,



				.um-dropdown li a:hover,



				i.um-active-color,



				span.um-active-color



				{



					color: #009fdd;



				}



				



				.um-7343.um .um-field-group-head,



				.picker__box,



				.picker__nav--prev:hover,



				.picker__nav--next:hover,



				.um-7343.um .um-members-pagi span.current,



				.um-7343.um .um-members-pagi span.current:hover,



				.um-7343.um .um-profile-nav-item.active a,



				.um-7343.um .um-profile-nav-item.active a:hover,



				.upload,



				.um-modal-header,



				.um-modal-btn,



				.um-modal-btn.disabled,



				.um-modal-btn.disabled:hover,



				div.uimob800 .um-account-side li a.current,div.uimob800 .um-account-side li a.current:hover



				{



					background: #009fdd;



				}



				



				



				



				.um-7343.um .um-field-group-head:hover,



				.picker__footer,



				.picker__header,



				.picker__day--infocus:hover,



				.picker__day--outfocus:hover,



				.picker__day--highlighted:hover,



				.picker--focused .picker__day--highlighted,



				.picker__list-item:hover,



				.picker__list-item--highlighted:hover,



				.picker--focused .picker__list-item--highlighted,



				.picker__list-item--selected,



				.picker__list-item--selected:hover,



				.picker--focused .picker__list-item--selected {



					background: #44b0ec;



				}



				



				.um-7343.um {



					margin-left: auto!important;



					margin-right: auto!important;



				}.um-7343.um input[type=submit]:disabled:hover {



					background: #009fdd;



				}.um-7343.um input[type=submit].um-button,



				.um-7343.um input[type=submit].um-button:focus,



				.um-7343.um a.um-button,



				.um-7343.um a.um-button.um-disabled:hover,



				.um-7343.um a.um-button.um-disabled:focus,



				.um-7343.um a.um-button.um-disabled:active {



					background: #009fdd;



				}.um-7343.um a.um-link {



					color: #3ba1da;



				}.um-7343.um input[type=submit].um-button:hover,



				.um-7343.um a.um-button:hover {



					background-color: #44b0ec;



				}.um-7343.um a.um-link:hover, .um-7343.um a.um-link-hvr:hover {



					color: #44b0ec;



				}.um-7343.um .um-button {



					color: #ffffff;



				}.um-7343.um .um-button.um-alt,



				.um-7343.um input[type=submit].um-button.um-alt {



					background: #eeeeee;



				}.um-7343.um .um-button.um-alt:hover,



				.um-7343.um input[type=submit].um-button.um-alt:hover{



					background: #e5e5e5;



				}.um-7343.um .um-button.um-alt,



				.um-7343.um input[type=submit].um-button.um-alt {



					color: #666666;



				}



				.um-7343.um .um-form input[type=text],



				.um-7343.um .um-form input[type=password],



				.um-7343.um .um-form textarea,



				.um-7343.um .upload-progress,



				.select2-container .select2-choice,



				.select2-drop,



				.select2-container-multi .select2-choices,



				.select2-drop-active,



				.select2-drop.select2-drop-above



				{



					border: 1px solid #ddd !important;



				}



				



				.um-7343.um .um-form .select2-container-multi .select2-choices .select2-search-field input[type=text] {border: none !important}



				



				



				.um-7343.um .um-form input[type=text]:focus,



				.um-7343.um .um-form input[type=password]:focus,



				.um-7343.um .um-form textarea:focus {



					border: 1px solid #bbb !important;



				}



				



				.um-7343.um .um-form input[type=text],



				.um-7343.um .um-form input[type=password],



				.um-7343.um .um-form textarea,



				.select2-container .select2-choice,



				.select2-container-multi .select2-choices



				{



					background-color: #ffffff;



				}



				



				.um-7343.um .um-form input[type=text]:focus,



				.um-7343.um .um-form input[type=password]:focus,



				.um-7343.um .um-form textarea:focus {



					background-color: #ffffff;



				}



				



				



				.um-7343.um .um-form ::-webkit-input-placeholder



				{



					color:  #d1d1d1;



					opacity: 1 !important;



				}



				



				.um-7343.um .um-form ::-moz-placeholder



				{



					color:  #d1d1d1;



					opacity: 1 !important;



				}



				



				.um-7343.um .um-form ::-moz-placeholder



				{



					color:  #d1d1d1;



					opacity: 1 !important;



				}



				



				.um-7343.um .um-form ::-ms-input-placeholder



				{



					color:  #d1d1d1;



					opacity: 1 !important;



				}



				



				.select2-default,



				.select2-default *,



				.select2-container-multi .select2-choices .select2-search-field input



				{



					color:  #d1d1d1;



				}



				



				



				.um-7343.um .um-field-icon i,



				.select2-container .select2-choice .select2-arrow:before,



				.select2-search:before,



				.select2-search-choice-close:before



				{



					color: #aaaaaa;



				}



				



				.um-7343.um span.um-req



				{



					color: #dd3333;



				}



				



				.um-7343.um .um-field-label {



					color: #555555;



				}



				



				



				.um-7343.um .um-form input[type=text],



				.um-7343.um .um-form input[type=password],



				.um-7343.um .um-form textarea



				{



					color: #666666;



				}



				



				.um-7343.um .um-form input:-webkit-autofill {



				    -webkit-box-shadow:0 0 0 50px white inset; /* Change the color to your own background color */



				    -webkit-text-fill-color: #666666;



				}



				



				.um-7343.um .um-form input:-webkit-autofill:focus {



				    -webkit-box-shadow: none,0 0 0 50px white inset;



				    -webkit-text-fill-color: #666666;



				}



				



				



				.um-7343.um .um-tip {



					color: #cccccc;



				}



				</style>
				<!-- ULTIMATE MEMBER FORM INLINE CSS BEGIN -->
				<style type="text/css">.um-field-value{text-align:left;font-size:18px!important;background:#fefefe;border:1px solid #dddddd;padding-left:15px;padding-top:5px;padding-bottom:5px}.um-field-label label{text-align:left}.um-profile.um-viewing .um-field-label{   display:block;   margin:0 0 1px;   border-bottom:solid 0px #5AA1E3}.um-meta-text{text-align:left}.um-profile-body main main-default{margin-top:15px}</style><!-- ULTIMATE MEMBER FORM INLINE CSS END -->







		</div>



	</div>



</div></div></div></div>



			<?php



				//var_dump($userdata);



				endif; 



			?>



			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>



			<?php if(!$options_data['check_disablecomments']) { ?>



				<?php comments_template(); ?>



			<?php } ?>



	



			<?php endwhile; endif; ?>



		</div> <!-- end content -->



	</div> <!-- end page-wrap -->


<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 109282240, {});
</script>






<?php get_footer(); ?>