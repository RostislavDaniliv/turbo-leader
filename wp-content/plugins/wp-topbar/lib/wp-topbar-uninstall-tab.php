<?php 

/*
Uninstall Option Tab

i18n Compatible

*/



//=========================================================================			
// TopBar Uninstall Option
//=========================================================================			

function wptb_uninstall_options() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_uninstall_options()</code>';


	if ( is_multisite() ) {
		$uninstall_buttons = '<input type="submit" name="uninstall_Network_wptbSettings"   class="button-primary" value="'.__('Network Uninstall','wp-topbar').'" />
							  <input type="submit" name="nouninstall_Network_wptbSettings" class="button-primary" value="'.__('Cancel','wp-topbar').'" />';
		$url=get_option('siteurl')."/wp-admin/network/?page=wp-topbar.php&amp;action=networkuninstall&amp;noheader=true";
	}
	else {
		$uninstall_buttons = '<input type="submit" name="uninstall_wptbSettings"   class="button-primary" value="'.__('Uninstall','wp-topbar').'" />
							  <input type="submit" name="nouninstall_wptbSettings" class="button-primary" value="'.__('Cancel','wp-topbar').'" />';
		$url=get_option('siteurl')."/wp-admin/?page=wp-topbar.php&amp;action=uninstall&amp;noheader=true";
	}
		
	if ( is_ssl() AND (substr($url, 0, 5) != "https" ) AND ( substr($url, 0, 4) == "http" ) ) {
		$url="https".substr($url,4);
	}
	

	?>
	
	<div class="wrap">
    <h2>Uninstall Options</h2>
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
<?php _e('This operation deletes ALL TopBar data. If you continue, You will not be able to retrieve or restore your TopBars.','wp-topbar'); ?></br>
<?php 
	if ( is_multisite() )
		echo '</br>'.__('Since you are on a Multi Site install, this will delete the data for <strong>ALL</strong> blogs.','wp-topbar').'</br>';	
	?>
<strong></br><?php _e('If you elect to uninstall, you will be redirected to the WordPress Plugin page so that you can de-activate and uninstall the Plugin.','wp-topbar'); ?></strong></br>
  			</br>	      
  	      
  	      </p> 
        </div>
		<div>
		   <form method="post" action="<?php echo $url;?>"></form>
		</div>
	    <form method="post"    action="<?php echo $url;?>">
	        <p class="submit">
	            <?php echo $uninstall_buttons; ?>
	        </p>
	    </form>
	</div>	
	
	
	
	<?php
}	// End of wptb_uninstall_options

function wptb_uninstall_wptbSettings() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	global $wpdb;

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_uninstall_wptbSettings()</code>';


	// Check if site is configured for network installation
	if ( is_multisite() ) {

		// Get blog list and cycle through all blogs
		$current_blog = $wpdb->blogid;

		$blog_list  = $wpdb->get_col( 'SELECT blog_id FROM '.$wpdb->blogs );

	  	foreach ( $blog_list as $blogrow  ) {
			switch_to_blog( $blogrow   );
			$wptb_table_name = $wpdb->get_blog_prefix() . "wp_topbar_data";	
			$sql 	= "DROP TABLE ".$wptb_table_name;
			$delete = $wpdb->query( $sql, ARRAY_A );
			delete_option( 'wptbAdminOptions');
			delete_option( 'wptb_db_version' );
			delete_option( "wptb_global_options"); 
	    }
		switch_to_blog( $current_blog );
	}
	
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	
	$sql 	= "DROP TABLE ".$wptb_table_name;
	$delete = $wpdb->query( $sql, ARRAY_A );
	delete_option( 'wptbAdminOptions');
	delete_option( 'wptb_db_version' );
	delete_option( "wptb_global_options"); 
	delete_site_option( 'wptb_network_global_options' );

}	// End of wptb_uninstall_wptbSettings



?>