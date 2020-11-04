<?php

	/*

	Template Name: Bussines School

	*/

?>

<?php get_header('blank'); ?>

<?php

global $current_user;

require_once(__DIR__.'/php/cw_pages.php'); 
$room_url = cw_integrateRoom( 'business-school', $current_user );

?>



<iframe src="<?php echo $room_url?>" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:50;"></iframe>



<div id="page-wrap">

	<div id="content" <?php post_class(); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; endif; ?>

	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer('blank'); ?>