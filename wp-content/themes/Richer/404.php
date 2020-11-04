<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="container">

	<div id="content" class="sixteen columns">
			
		<article class="post">

			<div class="entry" id="error-404">
				
				<h2 class="error-404">404</h2>
				<?php _e("Извините, но мы не смогли найти страницу, которую вы искали. Пожалуйста, убедитесь, что вы правильно набрали адрес.", 'richer') ?>
				<br /><br />
			
				<span align="center"><a href="<?php echo esc_url(home_url()); ?>" target="_self" class="button"><?php _e("Назад", 'richer') ?></a></span>

			</div>

		</article>
		
	</div> <!-- end content -->

</div> <!-- end page-wrap -->
	
<?php get_footer(); ?>
