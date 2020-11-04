<?php 

	/*

	Template Name: Sushimaster (bot)

	*/

?>


<?php get_header('blank'); ?>


<?php $user_id = (isset($_GET['id'])) ? $_GET['id'] : false; ?>
<?php $data_user = info_user_s($user_id); ?>



<style>
	.btn_tg {
    z-index: 5;
    white-space: nowrap;
    font-size: 9px;
    line-height: 9px;
    font-weight: 500;
    color: rgb(255, 255, 255);
    font-family: Roboto;
    background-color: rgb(70, 130, 180);
    padding: 11px 33px;
    border-color: rgb(70, 130, 180);
    border-radius: 50px;
    outline: none;
    box-shadow: none;
    box-sizing: border-box;
    visibility: inherit;
    transition: none 0s ease 0s;
    font-style: normal;
    border-width: 0px;
    border-style: solid;
    margin: 0px;
    letter-spacing: 0px;
    min-height: 0px;
    min-width: 0px;
    max-height: none;
    max-width: none;
    opacity: 1;
    transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
    transform-origin: 50% 50% 0px;
    cursor: pointer;
}	

.btn_tg2 {
 
  text-decoration: none;
  outline: none;
  display: block;
  color: white;
  padding: 20px 30px;
  margin: 10px 20px;
  border-radius: 10px;
  font-family: 'Montserrat', sans-serif;
  text-transform: uppercase;
  letter-spacing: 2px;
  background-image: linear-gradient(to right, #0892ff 0%, #260394 41%, #0892ff 100%);
  background-size: 200% auto;
  box-shadow: 0 0 20px rgba(0,0,0,.1);
  transition: .5s;
  width: 250px;
  margin: 0 auto;
  text-align: center;
	}
.btn_tg2:hover {background-position: right center;}

	.text_under_btn {
		text-align: center;	
		font-weight: normal;
		font-size: 10px;

	}
	
	.fotter_img{
		display: block;
		padding:center;
  		 margin: 0 auto;
  		 text-align: center;
	}
	
.btn_s {
  display: flex;
  justify-content: space-between;
  width: 340px;
	 margin-left: auto;
    margin-right: auto;
}


.btn__item_s {
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding: 10px;
  color: #fff;
  width: 100%;
  text-align: center;
  text-decoration: none;
}

.btn__item_s:first-child:hover{
	background: linear-gradient(180deg, #8b7e92 -177%, #7990a9 100%);
}

.btn__item_s:first-child {
  background: linear-gradient(180deg, #C4C4C4 -177%, #6300A0 100%);
  border-bottom-left-radius: 10px;
  border-top-left-radius: 10px;
}

.btn__item_s:nth-child(2):hover {
  background: linear-gradient(180deg, #d5f2fb -177%, #7990a9 100%);
}

.btn__item_s:nth-child(2) {
  background: linear-gradient(180deg, #C4C4C4 -177%, #00ade2 100%);
}

.btn__item_s:nth-child(3):hover {
  background: linear-gradient(180deg, #a8c0ff -177%, #7990a9 100%);
}

.btn__item_s:nth-child(3) {
  background: linear-gradient(180deg, #C4C4C4 -177%, #0345EE 100%);
}

.btn__item_s:last-child:hover {
  background: linear-gradient(180deg, #6296ce -9%, #7990a9 100%);
}

.btn__item_s:last-child {
  background: linear-gradient(180deg, #6296ce -9%, #4d76a1 100%);
  border-bottom-right-radius: 10px;
  border-top-right-radius: 10px;
}
</style>
<div id="page-wrap">

	<div id="content" <?php post_class(); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



		<?php

		require_once(__DIR__.'/php/lp.php');

		?>



		<?php the_content(); ?>

	<?php endwhile; endif; ?>
		
		<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<script src="https://kit.fontawesome.com/deca4abfb8.js" crossorigin="anonymous"></script>
</head>
<body>
		<br>
	<div class="btn_s">
		<a class="btn__item_s" href="viber://pa?chatURI=turboleader&context=<?=$user_id?>0sushimaster">
		<img src="/wp-content/themes/Richer/long_sushi/img/viber.svg" alt="viber">Viber</a> 
	 
    <a class="btn__item_s" href="https://tx.me/turboleader_bot?start=<?=$user_id?>0sushimaster" >
	<img src="/wp-content/themes/Richer/long_sushi/img/telegram.svg" alt="telegram">Telegram</a>

    <a class="btn__item_s" href="https://m.me/113756900274542/?ref=<?=$user_id?>0sushimaster">
      <img src="/wp-content/themes/Richer/long_sushi/img/messenger.svg" alt="facebook">Facebook</a>   
	  
	  <a class="btn__item_s" href="https://vk.me/public109282240?ref=<?=$user_id?>0sushimaster">
	<img src="/wp-content/themes/Richer/long_sushi/img/vk.svg" alt="instagram">VKontakte</a>
	</div>
	
	
		<p class="text_under_btn">
			Не забудьте нажать кнопку "Начать" (Start) после открытия бота.
		</p>
		<img class="fotter_img" src="http://turbo-leader.com/wp-content/uploads/2016/10/bg-9_1.jpg" alt="Футер">
	</div> <!-- end content -->
	
	
	
</div> <!-- end page-wrap -->

<?php get_footer(); ?>

