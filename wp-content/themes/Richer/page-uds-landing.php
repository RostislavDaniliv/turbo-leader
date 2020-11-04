<?php 

	/*

	Template Name: Page UDS Landing

	*/

	$page_id = get_the_ID(); // ID СТРАНИЦЫ

?>

<?php get_header('blank'); ?>

<div id="page-wrap">

	<div id="content" <?php post_class(); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		
		<?php

		if( $page_id == 12531 ){
			require_once(__DIR__.'/uds_lands/lucid/index.php');
		}		

		require_once(__DIR__.'/php/lp.php');

		?>



		<?php the_content(); ?>

	<?php endwhile; endif; ?>

	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer(); ?>

