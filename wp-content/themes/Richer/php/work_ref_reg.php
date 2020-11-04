<?php // ВСТАВЛЯЕМ РЕФЕРАЛКУ В ПОЛЕ

$page_id = get_the_ID(); 

//echo $page_id;

if( $page_id == 11322){ // 2я СТРАНИЦА РЕГИ ЧЕРЕЗ СОЦ СЕТЬ, ГДЕ НУЖНО ВВЕСТИ ПОЧТУ(ВК) ИЛИ ЛОГИН(ФБ)


	$ref_id = $_COOKIE['ref_id'];
	$reg_site_id = $_COOKIE['reg_site_id'];
	$reg_site_url = $_COOKIE['reg_site_url'];

	//echo $ref_id;
	//echo $reg_page_id;

	

	if( !isset( $ref_id ) ){ // если нет рефералки, то регаем под админа
		$ref_id = 1;
	}

	if( !isset( $reg_site_id) ){
		$reg_site_id = $_SESSION['reg_site_id'];
	}

	if( !isset( $reg_site_url) ){
		$reg_site_url = $_SESSION['reg_site_url'];
	}

	//echo $ref_id;
	// -----------------------------------

	// ЗАПИСЬ В ЛОГ
	/*$page_id = get_the_ID(); 
	$s_id = session_id();

	$w_data = array(
		'ref_id' => $ref_id,
		'session_id' => $s_id,
		'page_id' => $page_id,
		'reg_site_id' => $reg_site_id,
		'reg_site_url' => $reg_site_url
	);

	file_put_contents('errors/error_log_'.$s_id.'_sec_'.time().'.txt', print_r($w_data,true) .PHP_EOL, FILE_APPEND );*/
	// --- ЗАПИСЬ В ЛОГ

	?>
	<script>

	$(document).ready(function(){

		var reg_site_id = "<?php echo $reg_site_id ?>";
		var ref_id = "<?php echo $ref_id ?>";

		if(ref_id == "1" || reg_site_id.length ==0){

			$('.um-register').remove();
			var cancel_html = '<div id="cancel-block">Упсс...<br/>Что-то пошло не так. Перезагрузите страницу приглашения и попробуйте еще раз</div>';
			$('.um-social-login-wrap').append(cancel_html);
			//console.log('запрет');
		}

		console.log(reg_site_id, ref_id);
	});

	</script>

	<?php

}


?>

	<div id="refferer-id" style="display:none"><?php echo $ref_id ?></div>
	<div id="reg-site-id" style="display:none"><?php echo $reg_site_id ?></div>
	<div id="reg-site-url" style="display:none"><?php echo $reg_site_url ?></div>


