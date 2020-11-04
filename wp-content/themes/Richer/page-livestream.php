<?php 

	/*

	Template Name: Page Live Stream

	*/

?>

<style type="text/css">
	
	#live-stream-container{
		width: 640px;
    	margin: auto;
	}
	#sb-header{
		padding: 15px 0;
		margin-bottom: 15px;
		text-align:center; 
		background: url(http://turbo-leader.com/wp-content/uploads/2016/09/e6b849a373634b30b8d6eb275df60f45.png) center center no-repeat;
	}
	#sb-header h1,
	#sb-header h4,
	#sb-header h5,
	#sb-header h3{
		color: white;
	}
	#s-themes{
		width: 950px;
		margin: auto;
		border-top: 1px solid white;
		border-bottom: 1px solid white;
	    padding-top: 10px;
	}
	#speaker{
		margin-top: 15px;
	}

</style>

<?php get_header('blank'); ?>

<div id="page-wrap">

	<div id="sb-header" style="">
		<h1 style="color: #f89c41">Брифинг "Все о продукте UDS Game"</h1>
		<h5 style="color:#f2b13b">Темы обучения:</h5>
		<div id="s-themes">
			<h3>"Почему клиенты остаются?"</h3>
			<h3>BIG DATA или "Неочевидные возможности аналитики Game Admin"</h3>
		</div>
		
		<div id="speaker">
			<h4>Вадим Хасанов</h4>
			<h5>Руководитель отдела внедрения и маркетинга GIS KZ</h5>
		</div>
	</div>

	<div id="content" <?php post_class(); ?>>

		<div style="text-align:center; font-size:18px">
			Начало 25.11.16<br/>16:00 Астаны | 13:00 МСК
		</div>
		<div id="live-stream-container">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>

			<div id="sb-button" style="text-align:center">

				<a href="http://turbo-leader.com/lp5/?id=khasanov" target="_blank" class="button  red large simple align">ПОЛУЧИТЬ</a>
				<div>профессиональную систему для продвиженя бизнеса UDS Game через Интернет <br> (Тестовый период 10 дней БЕСПЛАТНО)</div>

			</div>


			<div id="vk-comments" style="margin-top: 40px;">

				<!-- Put this script tag to the <head> of your page -->
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

				<script type="text/javascript">
				  VK.init({apiId: 5629056, onlyWidgets: true});
				</script>

				<!-- Put this div tag to the place, where the Comments block will be -->
				<div id="vk_comments"></div>
				<script type="text/javascript">
				VK.Widgets.Comments("vk_comments", {limit: 20, width: "640", autoPublish: "0", attach: "*"});
				</script>

			</div>

		</div>

		




	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer(); ?>

