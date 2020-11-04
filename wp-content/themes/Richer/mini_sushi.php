<?php 

	/*

	Template Name: Mini Sushi

	*/


$user_id = (isset($_GET['id'])) ? $_GET['id'] : false; 
$data_user = info_user_s($user_id);

 




		require_once(__DIR__.'/mini_sushi/index.php');

		?>




