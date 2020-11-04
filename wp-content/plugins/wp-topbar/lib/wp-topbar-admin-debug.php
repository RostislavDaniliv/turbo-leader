<?php 

/*
Close Options Tab

i18n Compatible

*/


//=========================================================================			
// Close Button Options
//=========================================================================			


function wptb_admin_debug() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;   
			
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_globalsettings_options()</code>';
	
	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();
	
	?>
	
	<div class="postbox">
										
	<h3><a name="CloseButton"><?php _e('Admin Debug Page','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('This page contains various settings to help the author debug the Plugin.','wp-topbar'); ?></em>
		<br>
		</p>
		<div class="clear"></div>	
		</div>
	</div> <!-- end of Settings -->
						
<?php

	wptb_display_debug_info(__('Server/Install Info','wp-topbar'), true);


}	// End of wptb_admin_debug

function wptb_display_debug_info($wptb_title,$wptb_show_rotate) {


	global $wpdb;
	global $WPTB_VERSION;
	
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";
	$wptb_options_table_name = $wpdb->prefix . "options";

	$wpdb->hide_errors();	

	if( $wpdb->get_var("show tables like '".$wptb_table_name."'") != $wptb_table_name ) {
		$wptb_table_exists = false;
		$wptb_bar_text_encoding[0]="Unknown";
		$wptb_bar_link_text_encoding[0]="Unknown";
	}
	else {
		$wptb_table_exists = true;
		$wptb_rows = $wpdb->get_results( 'SELECT * FROM `'.$wptb_table_name.'`', ARRAY_A);
		$wptb_num_of_rows=$wpdb->num_rows; 
		$wptb_rows = $wpdb->get_results( 'SELECT * FROM `'.$wptb_table_name.'` WHERE `enable_topbar` = "true"', ARRAY_A);
		$wptb_enabled_rows=$wpdb->num_rows; 
	}

	$wptb_table_encoding=$wpdb->get_col(  
	"
		SELECT 
		  COLLATION_NAME
		  FROM information_schema.COLUMNS
		  where TABLE_NAME = '".$wptb_options_table_name."'
		  	"
	); 	
	
	$wptb_columns=$wpdb->get_col(  
	"
		SELECT 
		  COUNT(*)
		  FROM information_schema.COLUMNS
		  where TABLE_NAME = '".$wptb_table_name."'
		  	"
	); 
	
	$wpdb->show_errors();
	
	echo '<div class="postbox">';
	echo '<h3><a name="Debug">'.$wptb_title."</a></h3>";
	echo '<div class="inside">';
	echo "<ul>";


	echo "<li><strong>".__('Server Check','wp-topbar').':</strong></br>';				
   	echo 'Server Type: <strong>' . esc_html( $_SERVER['SERVER_SOFTWARE'] ) . '</strong><br>';
	echo 'Operating System: <strong>' . PHP_OS . '</strong><br>';  
	echo 'PHP Version: <strong>' . PHP_VERSION . '</strong><br>';  	
	if (ini_get('allow_url_fopen') == 1)
    	echo __('fopen setting is ').'<strong>'.__('ON').'</strong><br>';
	else 
	    echo __('fopen setting is').'<strong>'.__('OFF').'</strong><br>';
	if  ( get_magic_quotes_gpc() ) 
   		echo "PHP Magic Quotes is <strong>ON</strong><br>";
   	else
   		echo "PHP Magic Quotes is <strong>OFF</strong><br>";  			
	echo "</li>";		
	echo "</br>";
	
	echo "<li><strong>".'Wordpress Check'.":</strong></br>";	
	echo "Wordpress Version: <strong>".get_bloginfo( 'version' )."</strong></br>";
	echo "Plugin Version: <strong>".$WPTB_VERSION."</strong></br>";

	echo "URL: <strong>".home_url()."</strong></br>";
	echo "Charset <small><i>(get_bloginfo)</i></small>: <strong>".get_bloginfo( 'charset' )."</strong></br>";
	echo "</li>";		
	echo "</br>";

	echo "<li><strong>".__('Database/Column Check','wp-topbar').":</strong></br>";
	echo 'MySQL Database Server Version: <strong>'.$wpdb->get_var( $wpdb->prepare( "SELECT VERSION() AS %s", 'version' ) ).'</strong><br>';
	echo "Charset <small><i>(DB_CHARSET)</i></small>: <strong>".DB_CHARSET."</strong></br>";
	echo "Collation <small><i>(DB_COLLATE)</i></small>: <strong>".DB_COLLATE."</strong></br>";
	echo "Collation encoding: <strong>".$wptb_table_encoding[1]."</strong></br>";
		
	echo "</li>";		
	echo "</br>";
		
	echo "<li><strong>".__('Table Check','wp-topbar').":</strong></br>";
	echo '$wpdb->base_prefix: <strong>'.$wpdb->base_prefix."</strong></br>";
	echo '$wpdb->prefix: <strong>'.$wpdb->prefix."</strong></br>";
	echo "Table Name: <strong>".$wptb_table_name."</strong></br>";
	if ( get_option( 'wptb_db_version' ))
		echo "WP-TopBar internal db version: <strong>".get_option( 'wptb_db_version' )."</strong></br>";
	if ( $wptb_table_exists ) {
		echo "Number of rows in table: <strong>".$wptb_num_of_rows."</strong> <i>(<strong>".$wptb_enabled_rows."</strong> are enabled)</i></strong></br>";
		echo "Number of columns in table: <strong>".$wptb_columns[0]."</strong></br>";
	}
	else
		echo "<strong>Table does not exit in database!</strong></br>";

	echo "</br>";
	echo "</li>";		

	echo "<li><strong>".__('Options Check','wp-topbar').":</strong></br>";
	
	if ( get_option('wptbAdminOptions') )
		echo "Plugin is <strong>still</strong> using the original Options (wptbAdminOptions) </br>";
	else
		echo "Plugin is <strong>not</strong> using the original Options (wptbAdminOptions) </br>";
		
	if ( get_option( 'wptb_db_version' ))
		echo "Plugin is <strong>using</strong> the DB Options (wptb_db_version) </br>";
	else
		echo "Plugin is <strong>not</strong> using the DB Options (wptb_db_version) </br>";

	if  ( get_option( "wptb_global_options") )
		echo "Plugin is <strong>using</strong> the Global Options (wptb_global_options) </br>";
	else
		echo "Plugin is <strong>not</strong> using the Global Options (wptb_global_options) </br>";
		 
	if ( get_site_option( 'wptb_network_global_options' ) )
		echo "Plugin is <strong>using</strong> the <strong>Network</strong> Global Options (wptb_network_global_options) </br>";
	else
		echo "Plugin is <strong>not</strong> using the <strong>Network</strong> Options (wptb_network_global_options) </br>";
	
	echo "</br>";
	echo "</li>";

	if  ( $wptb_show_rotate && get_option( "wptb_global_options") ) {
	
		$wptbGlobalOptions = get_option( "wptb_global_options");
		echo "<li><strong>".__('Global Settings Check','wp-topbar').':</strong></br>';				
		echo __('Rotate TopBars','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_topbars' ].'</strong></br>';
		echo __('Rotation Display Time','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_display_time' ].'</strong></br>';
		echo __('Rotation Start Delay','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_start_delay' ].'</strong></br>';		
		echo __('Rotation Order','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_order' ].'</strong></br>';
		echo __('Rotation Count','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_count' ].'</strong></br>';
		echo __('Rotation Hide Last','wp-topbar').':&nbsp;<strong>'.$wptbGlobalOptions [ 'rotate_hide_last' ].'</strong></br>';
		echo __('Custom Samples Path','wp-topbar').':&nbsp;[<strong>'.$wptbGlobalOptions [ 'custom_samples_path' ].'</strong>]</br>';
		echo "</br>";
		echo "</li>";
	}
	
	echo "<li><strong>".__('Time Check','wp-topbar').":</strong></br>";
	
	$wptb_current_time_local  =current_time('timestamp', 0);
	$wptb_current_time_gmt=current_time('timestamp', 1);

	echo __('Server Timezone','wp-topbar').':&nbsp;<strong>',date_default_timezone_get(),'</strong></br>';
	echo __('Current Time','wp-topbar').':&nbsp;<strong>',date('m/d/Y H:i',$wptb_current_time_local),'</strong></br>';		
	echo __('Current Time (GMT)','wp-topbar').':&nbsp;<strong>',date('m/d/Y H:i',$wptb_current_time_gmt),'</strong></br>';		
	echo __('WordPress GMT Offset').':&nbsp;<strong>'.get_option( 'gmt_offset', 0 ).'</strong></br>';
	echo "</br>";
	echo "</li>";
	echo "<li><strong>".__('Multisite Check','wp-topbar').":</strong></br>";
	if ( is_multisite() ) {
		echo "Multisite: <strong>Yes</strong><br>"; 
		
		if ( defined( "SUBDOMAIN_INSTALL" ) && SUBDOMAIN_INSTALL )
			echo "wp-config.php - SUBDOMAIN_INSTALL: <strong>True</strong><br>"; 
		else
			echo "wp-config.php - SUBDOMAIN_INSTALL: <strong>False</strong><br>"; 

		if ( defined( "DOMAIN_CURRENT_SITE" ) )
			echo "wp-config.php - DOMAIN_CURRENT_SITE: <strong>".DOMAIN_CURRENT_SITE."</strong><br>";
			
		if ( defined( "PATH_CURRENT_SITE" ) )
			echo "wp-config.php - PATH_CURRENT_SITE: <strong>".PATH_CURRENT_SITE."</strong><br>";
			
		if ( defined( "SITE_ID_CURRENT_SITE" ) )
			echo "wp-config.php - SITE_ID_CURRENT_SITE: <strong>".SITE_ID_CURRENT_SITE."</strong><br>";
			
		if ( defined( "BLOG_ID_CURRENT_SITE" ) )
			echo "wp-config.php - BLOG_ID_CURRENT_SITE: <strong>".BLOG_ID_CURRENT_SITE."</strong><br>";		
			
		echo '$wpdb->blogid: <strong>'.$wpdb->blogid."</strong></br>";
		echo '$wpdb->siteid: <strong>'.$wpdb->siteid."</strong></br>";
		$wptbGSNetworkGlobalOptions=get_site_option( 'wptb_network_global_options' );
		if ( isset($wptbGSNetworkGlobalOptions [ 'multisite_super_admin_only' ] )) 
			echo "Super Admin Only: <strong>".$wptbGSNetworkGlobalOptions [ 'multisite_super_admin_only' ]."</strong></br>";
		else
			echo "Super Admin Only: <strong>[Option is not set]</strong></br>";			
		
		if ( current_user_can( 'manage_network_plugins' )  )  
			echo "Current user can <code>manage_network_plugins</code>: <strong>Yes</strong><br>"; 
		else
			echo "Current user can <code>manage_network_plugins</code>: <strong>No</strong><br>"; 
		$wptbGSNetworkGlobalOptions = get_site_option( 'wptb_network_global_options' );
	}
	else
		echo "Multisite:		<strong>No</strong><br>"; 
	echo "</ul>";
	echo "</div>";

}	// End of wptb_display_debug_info

?>