<link rel="stylesheet" type="text/css" href="/wp-content/themes/Richer/css/lp.css">

<?php

$url = $_SERVER['REQUEST_URI'];



// получаем логин
//echo $_GET['id'];
$page_id = get_the_ID(); 


if( isset($_GET['id']) ){
	$ref_value = $_GET['id'];
	setcookie('ref_name', $ref_value, time()+60*60*24*30, '/'); // ЗАПИСЫВАЕМ КУКИ
 	
	// Обрезаем рефералку и перезагружаем страницу
	/*$urlParts = explode('?', $url);
	header("Location: ".$urlParts[0]);*/
}

if( isset($_COOKIE['ref_name']) ){
	$login = $_COOKIE['ref_name'];
}

if( !isset($login) ){
	$login = $_GET['id'];
}

//echo $page_id;


// получаем id юзера по логину

global $wpdb;

$query = "SELECT * FROM wp_usermeta where meta_key = 'nickname' and meta_value = '{$login}'";
$sponsor = $wpdb->get_row( $query );	

$sponsorID = $sponsor->user_id;

/*
SELECT * FROM wp_usermeta wp_main 
LEFT JOIN  wp_usermeta AS wp_date 
ON wp_date.user_id=wp_main.user_id
where (wp_main.meta_key = 'nickname' and wp_main.meta_value = 'artembw') AND
(wp_date.meta_key='active_date' or wp_date.meta_key='test_active_date')



*/


// ЗАПИСЬ В ЛОГ
/*$s_id = session_id();

$w_data = array(
	'ref_id' => $sponsorID,
	'session_id' => $s_id,
	'ref_name' => $login,
	'query' => $query,
	'reg_site_url' => $url,
	'reg_site_id' => $page_id
);

file_put_contents('errors/error_log_'.$s_id.'_fir_'.time().'.txt', print_r($w_data,true) .PHP_EOL, FILE_APPEND );*/
// --- ЗАПИСЬ В ЛОГ



if(!$sponsorID){
	$sponsorID = 1;
}


setcookie('ref_id', $sponsorID, time()+60*60*24*30, '/'); // ЗАПИСЫВАЕМ КУКИ ID пользователя
$_SESSION['ref_id'] = $sponsorID; // ЗАПИСЫВАЕМ СЕССИЮ
setcookie('reg_site_id', $page_id, time()+60*60*24*30, '/'); // ЗАПИСЫВАЕМ КУКИ ID страницы реги
$_SESSION['reg_site_id'] = $page_id; // записаываем страницу реги
setcookie('reg_site_url', $url, time()+60*2, '/'); // ЗАПИСЫВАЕМ КУКИ ID страницы реги
$_SESSION['reg_site_url'] = $url; // записаываем страницу реги



$fields = array('first_name', 'last_name', 'city_user');
$user_fields = array();


for($i=0; $i<count($fields); $i++){
	$query = $wpdb->get_row( "SELECT * FROM wp_usermeta where meta_key = '{$fields[$i]}' and user_id = '{$sponsorID}'");	
	$user_fields[$fields[$i]] = $query->meta_value;
}


?>


<script type="text/javascript">

var $ = jQuery.noConflict();

$(document).ready(function(){

	// подставляем ID спонсора
	$('.um-field-referer_id input').val('<?php echo $sponsorID; ?>');
	$('.um-field-referer_id input').attr('readonly','readonly');

	// подставляем ID страницы
	$('.um-field-reg_site_id input').val('<?php echo $page_id; ?>');
	$('.um-field-reg_site_id input').attr('readonly','readonly');

	// подставляем URL страницы
	$('.um-field-reg_site_url input').val('<?php echo $url; ?>');
	$('.um-field-reg_site_ulr input').attr('readonly','readonly');

	if(window.location.hash=="#registration"){

		$("#regpanel").addClass("active");

	}

	/*$(".um-button-vk").each(function(){
		var href = $(this).attr("href");
		var new_href = href+"&id="+<?=$sponsorID?>;
		$(this).attr("href", new_href);

		console.log(href+"&id="+<?=$sponsorID?>);
	});*/


	$('#regbutton, .regbutton').click(function(e){
		e.preventDefault();
		window.location.hash="#registration";
		$("#regpanel").addClass('active');
	});



	$('.closeform').click(function(e){

		e.preventDefault();
		window.location.hash="";
		$("#regpanel").removeClass('active');

	});


	//скрываем поля Логина и почты, если заполнены

	var input_keys = ['user_login', 'user_email'];


	for(var i=0; i<input_keys.length; i++){
		var key = input_keys[i];
		var inputCont = $(".um-field-text[data-key='"+key+"']");
		var inputVal = inputCont.find('input').val();

		if(typeof inputVal!='undefined' && inputVal.length==0){
			inputCont.addClass("active");
		}

	}


	//ПОДСТАНОВКА ПОЛЬЗОВАТЕЛЯ

	$("#polosa .vc_col-sm-9 .wpb_wrapper").html("<div class='wpb_text_column wpb_content_element vc_custom_1463591497863'>Вас приглашает <span><?=$user_fields['first_name']?> <?=$user_fields['last_name']?> (<?=$user_fields['city_user']?>)</span></div>");

}






);



</script>