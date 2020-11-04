<?php 

	/*

	Template Name: Page YOKE Landing

	*/

?>

<?php get_header('blank'); ?>

<div id="page-wrap">

	<div id="content" <?php post_class(); ?>>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		
		<?php

		require_once(__DIR__.'/yoke_lands/AppStation/index.php');

		require_once(__DIR__.'/php/lp.php');

		?>



		<?php the_content(); ?>

	<?php endwhile; endif; ?>

	</div> <!-- end content -->

</div> <!-- end page-wrap -->

<?php get_footer(); ?>

