<?php 

	/*

	Template Name: Video_reg

	*/


$user_id = (isset($_GET['id'])) ? $_GET['id'] : false; 
$data_user = info_user_s($user_id);

 




		require_once(__DIR__.'/video_reg/index.php');

		?>




