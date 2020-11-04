<?php 

/*
Admin Page

i18n Compatible

*/

//=========================================================================		
//
//  Future Enhancements:
//   
//
//
//
//
//=========================================================================		


//=========================================================================			
// Options Page
//=========================================================================			


function wptb_admin_notice() {
		$wptbOptions = get_option('wptbAdminOptions');

		if ( isset( $wptbOptions['enable_topbar'] ) )
			echo '<div class="error"><p><strong>'.sprintf( __('WP TopBar settings need to be updated.  Please go to the <a href="%s">plugin admin page</a> to update the settings.', 'wp-topbar'), admin_url( '?page=wp-topbar.php' ) ). '</strong></p></div>';


}


function wptb_options_page() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	global $WPTB_VERSION;
	global $WPTB_DB_VERSION;
	
	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();

	require_once( dirname(__FILE__).'/wp-topbar-db-io.php');  				//database and I-O functions php
	require_once( dirname(__FILE__).'/wp-topbar-export.php');  				//export functions
	require_once( dirname(__FILE__).'/wp-topbar-main-tab.php');  			//load main options php
	require_once( dirname(__FILE__).'/wp-topbar-debug-tab.php');  			//load debug pages php
	require_once( dirname(__FILE__).'/wp-topbar-close-tab.php');  			//load close pages php
	require_once( dirname(__FILE__).'/wp-topbar-color-tab.php'); 			//load color selection pages php
	require_once( dirname(__FILE__).'/wp-topbar-css-tab.php');  			//load CSS pages php
	require_once( dirname(__FILE__).'/wp-topbar-control-tab.php');  		//load control logic pages php
	require_once( dirname(__FILE__).'/wp-topbar-social-tab.php');  			//load social button pages php
	require_once( dirname(__FILE__).'/wp-topbar-textbar-tab.php');  		//load textbar edit pages php
	require_once( dirname(__FILE__).'/wp-topbar-sample-tab.php');  			//load sample pages php
	require_once( dirname(__FILE__).'/wp-topbar-display-functions.php');  	//load admin pages php
	require_once( dirname(__FILE__).'/wp-topbar-faq-tab.php');  			//load faq page php	
	require_once( dirname(__FILE__).'/wp-topbar-settings-tab.php');  		//load global settings pages php
	require_once( dirname(__FILE__).'/wp-topbar-php-tab.php');  			//load php pages php
	require_once( dirname(__FILE__).'/wp-topbar-uninstall-tab.php');  		//load uninstall pages php
	require_once( dirname(__FILE__).'/wp-topbar-admin-debug.php');  		//load admin debug pages php
	require_once( dirname(__FILE__).'/wp-topbar-all-tab.php');  			//load all options pages php
	
	// $wptb_common_style is used by all buttons except the Copy & Special buttons
		
	$wptb_common_style = "padding:2px 15px;
		-webkit-border-radius:23px;
		-moz-border-radius:23px;
		border-radius:23px;
		-webkit-box-shadow:rgba(0,0,0,1) 0 1px 0;
		-moz-box-shadow:rgba(0,0,0,1) 0 1px 0;
		box-shadow:rgba(0,0,0,1) 0 1px 0;
		text-shadow:rgba(0,0,0,.4) 0 1px 0;
		font-size:16px;
		font-family:'Lucida Grande', Helvetica, Arial, Sans-Serif;
		text-decoration:none;
		vertical-align:middle;";
			
	$wptb_button_style = 'border-top:1px solid #96d1f8;
		background:#65a9d7;
		background:-webkit-gradient(linear, left top, left bottom, from(#215375), to(#65a9d7));
		background:-webkit-linear-gradient(top, #215375, #65a9d7);
		background:-moz-linear-gradient(top, #215375, #65a9d7);
		background:-ms-linear-gradient(top, #215375, #65a9d7);
		background:-o-linear-gradient(top, #215375, #65a9d7);
		color:white;'.$wptb_common_style; 
	
	$wptb_clear_style = 'border-top:1px solid #96d1f8;
		background:#FFFF90;
		color:black;'.$wptb_common_style; 
		
	$wptb_cssgradient_style='border-top: 1px solid #c5f797;
	   background: #92d665;
	   background: -webkit-gradient(linear, left top, left bottom, from(#699c3e), to(#92d665));
	   background: -webkit-linear-gradient(top, #699c3e, #92d665);
	   background: -moz-linear-gradient(top, #699c3e, #92d665);
	   background: -ms-linear-gradient(top, #699c3e, #92d665);
	   background: -o-linear-gradient(top, #699c3e, #92d665);
	   color: white;'.$wptb_common_style.'font-size:12px;'; 
	
	$wptb_submit_style = 'border-top:1px solid #97f7c1;
		background:#65d67f;
		background:-webkit-gradient(linear, left top, left bottom, from(#217342), to(#65d67f));
		background:-webkit-linear-gradient(top, #217342, #65d67f);
		background:-moz-linear-gradient(top, #217342, #65d67f);
		background:-ms-linear-gradient(top, #217342, #65d67f);
		background:-o-linear-gradient(top, #217342, #65d67f);
		color: white;'.$wptb_common_style;  
	
	$wptb_special_button_style = "border-top: 1px solid #d7ddcb;
		   background: #ebf3df;
		   color: black;
		   margin-left:auto;
		   margin-right:auto;
		   width:230px;
		   font-size: 10px;
		   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
		   text-decoration: none;
		   vertical-align: middle;";


// check action options, deaault = 'table'

	$wptb_debug=get_transient( 'wptb_debug' );	

    if ( isset ( $_GET['action'] ) )
        $action = $_GET['action'];
    else {
        $action = 'table';    
		if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: WP-TopBar Debug Mode: Re-setting action to: ',$action,'</code>';
	}

	if($wptb_debug) {
		echo '</br><code>WP-TopBar Debug Mode: wptb_options_page() - Action: '.$action.'</code>';
		echo '</br><code>WP-TopBar Debug Mode: Debug Until:', date('D, d M Y H:i:s (e)',get_transient( 'wptb_debug' )),'</code>';	
		echo '</br><code>WP-TopBar Debug Mode: Rotate TopBars Setting:', $wptbGlobalOptions [ 'rotate_topbars' ] ,'</code>';	
	}
// check page we are displaying, if > that max possible pages, then reset to max_pages

    if ( isset ( $_GET['paged'] ) ) {
        $current_page = $_GET['paged'];
		global $wpdb;
		$wptb_table_name = $wpdb->prefix . "wp_topbar_data";
		$query = "SELECT * FROM `".$wptb_table_name."`";
		$wpdb->get_results($query, ARRAY_A);   
		$max_pages = intval( ( $wpdb->num_rows ) / 10) + 1;
		if ($current_page > $max_pages) $current_page = $max_pages;
		$current_page = "&amp;paged=".$current_page;
     }
     else
        $current_page = '';    
 
// process items that require a Bar_ID
	if ( isset ( $_GET['barid'] ) ) {
		$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
		if (!$wptb_barid_prefix) {				// there is a problem, bar_id is set, but no transient.  So force table reload action
			$wptb_barid_prefix=rand(100000,899999);
			set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );
			$action = 'table';
		}
		else {
		        $wptb_barid = ($_GET['barid'] - $wptb_barid_prefix);
		        
		        if (isset($_POST['update_wptbSettings'])) {
					if (check_admin_referer('wptb_update_setting_nonce','wptbupdatesettingnonce'))	
						$wptbOptions=wptb_update_TopBarSettings($wptb_barid);
				}				
		}
	}
	
	if ( isset (  $_POST['update_wptbGlobalSettings'] ) ) {			
		wptb_update_GlobalSettings();
	}
	else if ( isset (  $_POST['update_wptbCloseButton'] ) ) {			
		wptb_bulkupdate_CloseButtonSettings();
		$action = 'table';
	}
	else if ( isset (  $_POST['uninstall_wptbSettings'] ) ) {			
		wptb_uninstall_wptbSettings();
		wp_redirect(get_option('siteurl').'/wp-admin/plugins.php');
		exit;				
	}
	else if ( isset (  $_POST['nouninstall_wptbSettings'] ) ) {			
		wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table');
		exit;
	}
	else if ( isset (  $_POST['wptbExportJSON'] ) ) {	
		wptb_export_options_json();
//		wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table');   // fix for 3.9
	}
	else if ( isset (  $_POST['wptbExportCSV'] ) ) {
		wptb_export_options_csv();
//		wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table');	// fix for 3.9				
	}
	else if ( isset (  $_POST['wptbExportSQL'] ) ) {
		wptb_export_options_sql();
//		wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table');	// fix for 3.9	
	}
	else if ( isset($_POST['wptbInsertBar']) )  {
		$wptbOptions=wptb_insert_default_row($WPTB_DB_VERSION);
		$action = 'insertdefault';
	}			
	else if ( $action == 'admindebug' ) {
		$wptbOptions = array();	
	}
	else if ( $action == 'copysample' ) {
		$wptbOptions = array();	
	}
	else 
	{
		wptb_check_for_plugin_upgrade($wptb_debug, $WPTB_DB_VERSION);
		if ( isset( $wptb_barid ) )
			$wptbOptions = wptb_get_Specific_TopBar($wptb_barid);
		else
			$wptbOptions = array();
	}

	
	if($wptb_debug && isset($wptbOptions['wptb_version'])) echo '<br><code>WP-TopBar Debug Mode: Version ',$WPTB_VERSION,'</code>';
	if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: WP-TopBar Debug Mode: Action: ',$action,'</code>';
	if($wptb_debug && isset($wptb_barid)) echo '<br><code>WP-TopBar Debug Mode: BarID: ',$wptb_barid,'</code>';
	if($wptb_debug && isset($wptb_barid_prefix)) echo '<br><code>WP-TopBar Debug Mode: BarID Prefix: ',$wptb_barid_prefix,'</code>';

    switch ( $action ) :
        case 'admindebug' :
			wptb_display_admin_header();
        	wptb_options_tabs($action);
        	wptb_admin_debug();
        	break;
		case 'all' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);        	
        	wptb_all_options($wptbOptions);
        	break;
        case 'enable' :
        case 'disable' :
	        wptb_toggle_enabled($action,$wptb_barid,$wptbOptions);
            wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table'.$current_page);				
            break;
            
        case 'copysample' :
			$data = wptb_get_sample_data();			
		  	$wptbOptions = $data [$wptb_barid - 1];			
		  	$wptbOptions['enable_topbar'] = 'false';
  			wptb_insert_row($wptbOptions);
	        wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table'.$current_page);			
        	break;
        	
        case 'duplicate' :
  			// make sure “&noheader=true” is added to the page that called this to make WP wait before the it outputs any of the HTML.
  			// then the redirect will work!  Also, debug is forced off to ensure no output occurs before redirect
  			$wptbOptions=wptb_get_Specific_TopBar($wptb_barid);
  			$wptbOptions['enable_topbar']='false';
  			wptb_insert_row($wptbOptions);
			global $wpdb;
			// store number of rows affected for 5 minutes to display on next refresh
			set_transient( 'wptb_inserted_rows', $wpdb->rows_affected, 5*60 );
			wp_redirect(get_option('siteurl').'/wp-admin/?page=wp-topbar.php&action=table'.$current_page);					
        	break;
        	             
        case 'export' :
			wptb_display_admin_header();
        	wptb_options_tabs($action);
        	wptb_display_export_options();
        	break;

        case 'bulkclosebutton' :
			wptb_display_admin_header();
            wptb_options_tabs($action);
			wptb_closebutton_bulk_options();
			break;
        case 'globalsettings' :
			wptb_display_admin_header();
            wptb_options_tabs($action);
			wptb_globalsettings_options();
			break;
        case 'uninstall' :
			wptb_display_admin_header();
            wptb_options_tabs($action);
			wptb_uninstall_options();
			break;
        case 'testpriority' :
			wptb_display_admin_header();
            wptb_options_tabs($action);
			wptb_test_topbar(10);
			break;
        case 'main' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_main_options($wptbOptions);
            break;
        case 'control' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_control_options($wptbOptions);
            break;
        case 'topbarcss' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_topbarcss_options($wptbOptions);
            break;
        case 'colorselection' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_colorselection_options($wptbOptions);
            break;
        case 'topbartext' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_topbartext_options($wptbOptions);
            break;
        case 'closebutton' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_closebutton_options($wptbOptions);
            break;
        case 'phptexttab' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_php_options($wptbOptions);
            break;
        case 'faq' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_faq_page($wptbOptions,true);
            break;        
        case 'mainfaq' :
			wptb_display_admin_header();
        	wptb_options_tabs($action);
            wptb_faq_page($wptbOptions,false);
            break;
        case 'socialbuttons' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
        	wptb_display_common_info($wptbOptions);
            wptb_socialbutton_options($wptbOptions);
            break;
        case 'debug' :
			wptb_display_admin_header();
			wptb_bar_edit_options_tabs($action,$wptb_barid, $wptbOptions);
			wptb_display_common_info($wptbOptions);
            wptb_debug_options($wptbOptions);
            break;
        case 'insertdefault' :
			wptb_display_admin_header();
        	wptb_options_tabs('table');
    		echo '<div class="updated"><p><strong>'.__('Inserted default row.','wp-topbar').'</strong></p></div>';
        	wptb_display_all_TopBars();
            break;        
        case 'samples' :
			wptb_display_admin_header();
        	wptb_options_tabs('samples');
        	wptb_display_Sample_TopBars();
            break;
		case 'copysampletopbar' :		
			wptb_display_admin_header();
        	wptb_options_tabs('table');
        	wptb_display_all_TopBars();
			break;
		case 'bulkdelete':
		case 'bulkduplicate':	
		case 'bulkenable':	
		case 'bulkdisable':	
		case 'bulkincrease':	
		case 'bulkdecrease':
			wptb_process_FOO_bulk_action();	
	        $action = 'table';    
			wptb_display_admin_header();
        	wptb_options_tabs('table');
        	wptb_display_all_TopBars();
    		break;
    	case 'bulkcopy':
    		wptb_process_Sample_bulk_action();
	        $action = 'table';    
			wptb_display_admin_header();
        	wptb_options_tabs('table');
        	wptb_display_all_TopBars();
    		break;    		
        default :
			wptb_display_admin_header();
        	wptb_options_tabs('table');
			$wptb_message=get_transient( 'wptb_message' );
        	if ( $wptb_message ) {
	        	echo $wptb_message;
	        	delete_transient( 'wptb_message' );	        	
        	}		
        	
        	
        	wptb_display_all_TopBars();
            break;
        endswitch;

}  // end function wptb_options_page



?>