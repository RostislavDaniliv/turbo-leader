<?php
	/*
	Template Name: Guest Meeting Yoke
	*/
?>
<?php get_header('blank'); ?>

<style>
	.vc_custom_1467074457130 a{
		background: #4d535d !important;
	}
	.vc_custom_1467074457130 a.active{
		background: #FF675B !important;
	}
	#event_alert_sb{
	    position: fixed;
	    z-index: 9999999;
	    width: 103%;
	    top: 0px;
	    display: none;
	}

	#guest-meeting-bar{
		background: #292d38 !important;
	    position: fixed;
	    top: 0;
	    width: 100%;
        height: 56px;
	    z-index: 60;
	    box-sizing: border-box;
        padding: 7px 10px !important;
        width: 100%;
        margin: 0 !important;
	}
	#startbz-btn.disable{
	    background: #292d38;
    	color: #686c73;
	}
	#pagetitle_container{
	    display: flex;
	    height: 100%;
	    flex-direction: column;
	    justify-content: center;
	    text-align: center;
	}
	#sb-page-title{
	    color: white;
	    font-size: 26px;
	    font-weight: 100;
	    font-family: Roboto;
	}
	.btn-mobile{
		height: 41px;
	}
	@media screen and (max-width: 1000px) {
		.btn-mobile{
		    padding: 10px 22px !important;
		}
		.btn-mobile>span{
			display: none;
		}
	}
</style>

<div id="event_alert_sb" class="vc_row wpb_row vc_row_fullwidth vc_row-fluid eventalertguest vc_custom_1464232322720" >
	<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="alert-message custom" style="color:#ffffff;background-color:#dd3333;">
					Внимательно дослушайте информацию до конца. Кнопка станет активной ближе к концу трансляции. Не отвлекайтесь :)
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

global $current_user;

require_once(__DIR__.'/php/cw_pages.php'); 
$room_url = cw_integrateRoom( 'yoke-on-air', $current_user );

$user_role = $ultimatemember->user->get_role();	

?>



<iframe src="<?php echo $room_url?>" 
	style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:50;"></iframe>
<div id="page-wrap">
	<div id="content" <?php post_class(); ?>>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="guest-meeting-bar" class="vc_row wpb_row vc_row_fullwidth vc_row-fluid vc_custom_1473931214611" >
		    <div class="wpb_column vc_column_container vc_col-sm-4">
		        <div class="vc_column-inner ">
		            <div class="wpb_wrapper">
		                <div class="vc_btn3-container vc_btn3-left" style="float: left; margin-right: 20px;">
		                	<a class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-square vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-white btn-mobile" 
		                	href="https://play.google.com/store/apps/details?id=com.dtlbox.yoperformer" title="Скачать из PlayMarket" target="_blank">
		                	<i class="vc_btn3-icon fa fa-android"></i> <span>Скачать на Android</span></a>
	                	</div>
	                	<div class="vc_btn3-container vc_btn3-left">
		                	<a class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-square vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-white btn-mobile" 
		                	href="https://itunes.apple.com/kz/app/yoke.mobi-ispolnitel/id1140446856?mt=8" title="Скачать из PlayMarket" target="_blank">
		                	<i class="vc_btn3-icon fa fa-apple"></i> <span>Скачать на iPhone</span></a>
	                	</div>
		            </div>
		        </div>
		    </div>
		    <div id="pagetitle_container" class="wpb_column vc_column_container vc_col-sm-4">
		        <div class="vc_column-inner ">
		            <div class="wpb_wrapper">
		            	<div id="sb-page-title">Turbo Leader</div>
		            </div>
		        </div>
		    </div>
		    <div class="wpb_column vc_column_container vc_col-sm-4">
		        <div class="vc_column-inner ">
		            <div class="wpb_wrapper">
						<div class="vc_btn3-container vc_btn3-center vc_custom_1473938292425" style="float:right;" >
						<a class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-square vc_btn3-style-flat vc_btn3-icon-left vc_btn3-color-sandy-brown btn-mobile" href="http://turbo-leader.com/manager/" title="Контакты" target="_blank"><i class="vc_btn3-icon fa fa-comment"></i> <span>Контакты</span></a></div>

						<div class="vc_btn3-container vc_btn3-center vc_custom_1473938366356" style="float:right; margin-right:20px;">
							<a id="startbz-btn" class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-square vc_btn3-style-flat vc_btn3-icon-left vc_btn3-color-danger disable" href="http://turbo-leader.com/start-biz/" title="Начать бизнес" target="_blank"><i class="vc_btn3-icon fa fa-rocket"></i> 
							<span>Начать бизнес</span></a>
						</div>
		            </div>
		        </div>
		    </div>
		</div>


		<?php the_content(); ?>
	<?php endwhile; endif; ?>
	</div> <!-- end content -->
</div> <!-- end page-wrap -->
<?php get_footer('blank'); ?>

<script>

$(document).ready(function(){

	workSButton();

	// отмечаем, что пользователь посмотрел вебинар
	setTimeout(function(){
		sendViewGuestMeeting();
	},
	1000*60*1);


	// Обновляем активность кнопки "Начать бизнес"
	updateStartBizButton();

	setInterval(function(){
		updateStartBizButton();
	}, 1000*30);

});


function sendAjax(data, resFunc){

	$.ajax({
		type: "POST",
		url: "/wp-content/themes/Richer/php/ajax.php",
		data: data,
		success: function(res){

			//console.log(res);

			if(resFunc!= null){
				resFunc(res);
			}

		}
	});
}

function updateStartBizButton(){

	var data={
		action: 'updateEventButton',
		event_type: 'start_biz',
		role: '<?php echo $user_role ?>'
	}

	sendAjax(data, resStartBizButton);

}

function resStartBizButton(data){

	var res = JSON.parse(data);

	if(res.enable){
		$("#startbz-btn").removeClass('disable').attr("href", res.href);
	}
	else{
		$("#startbz-btn").addClass('disable').attr("href", "#");
	}

	console.log(res);

}

function sendViewGuestMeeting(){

	var data = {
		action: "setIndexFlag",
		user_id: <?=get_current_user_id()?>,
		index: "gm"
	}

	sendAjax(data);

}

function sendClickBZ(){

	var data = {
		action: "setIndexFlag",
		user_id: <?=get_current_user_id()?>,
		index: "sb"
	}

	//console.log('send click start biz', data);

	sendAjax(data, resSendClickBZ);

}

function resSendClickBZ(res){
	console.log(res);
}

// обработка нажатия кнопки "Начать бизнес"
function workSButton(){

	$("#startbz-btn").click(function(e){

		if($(this).attr("href")=="#"){
			e.preventDefault();

			$("#event_alert_sb").show(500);
			setTimeout(function(){
				$("#event_alert_sb").hide(500);
			},
			10000);

		}
		else{

			sendClickBZ();

		}
	})

}

</script>