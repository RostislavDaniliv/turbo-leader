<?php 

/*
DB IO Functions

i18n Compatible

*/



//=========================================================================		
//Returns a random TopBar options,  sets enable_topbar to false if none are found
//=========================================================================		

function wptb_get_Random_TopBar() {

	global $WPTB_VERSION;

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '<br><code>WP-TopBar Debug Mode: wptb_get_Random_TopBar()</code>';

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$sql="SELECT * FROM `".$wptb_table_name."` 
			WHERE  `enable_topbar` =  'true'
				AND COALESCE(TIMESTAMPDIFF( MINUTE, 	COALESCE(STR_TO_DATE(  '".current_time('mysql', 0)."',  '%Y-%m-%d %H:%i' ), 0), 
											COALESCE(STR_TO_DATE( `start_time_utc`,  '%m/%d/%Y %H:%i'     ), 0)),0) <= 0 
				AND	COALESCE(TIMESTAMPDIFF( MINUTE, 	COALESCE(STR_TO_DATE(  `end_time_utc` ,  '%m/%d/%Y %H:%i'       ), 0), 					
											COALESCE(STR_TO_DATE(  '".current_time('mysql', 0)."',  '%Y-%m-%d %H:%i' ), 0)),0) <=0
			ORDER BY ( `weighting_points` * RAND() ) DESC LIMIT 1
			";		

	$myrows = $wpdb->get_results( $sql, ARRAY_A );
	if ( $wpdb->num_rows != 0 ) {
		foreach ($myrows[0] as $key => $option)
			$wptbOptions[$key] = $option;
		echo '<!-- WP-TopBar Version="'.$wptbOptions['wptb_version'].'" | Showing Bar #="'.$wptbOptions['bar_id'].'" | Priority="'.$wptbOptions['weighting_points'].'" | Start Time (UTC)="'.$wptbOptions['start_time_utc'].'" | End Time (UTC)="'.$wptbOptions['end_time_utc'].'"-->
';
		echo '<!-- WP-TopBar Show homepage="'.$wptbOptions['show_homepage'].'" | Control logic="'.$wptbOptions['include_logic'].'" | Include pages="'.$wptbOptions['include_pages'].'" (invert="'.$wptbOptions['invert_include'].'") | Include categories="'.$wptbOptions['include_categories'].'" (invert="'.$wptbOptions['invert_categories'].'") -->
';
	}
	else {
		echo '<!-- WP-TopBar_'.$WPTB_VERSION.' :: not using options nor database -->
';
		$wptbOptions=array();
		$wptbOptions['enable_topbar'] = 'false';
	}
	
	if($wptb_debug) wptb_debug_display_TopBar_Options($wptbOptions);
	
	return $wptbOptions;
	
}	// End of wptb_get_Random_TopBar





//=========================================================================		
//Returns an array of TopBar options, sets default values if none are loaded.
//
//
// $wptb_barid tells what bar to get -- 
// if == 0 then, get the first row in the table
// return empty array is nothing is found
//=========================================================================		

function wptb_get_Specific_TopBar($wptb_barid) {

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_get_Specific_TopBar('.$wptb_barid.')</code>';

	global $WPTB_DB_VERSION;
	
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";

	if($wptb_debug)
		if ( $wptb_barid != 0)
			echo '<br><code>WP-TopBar Debug Mode: Getting TopBar #: '.$wptb_barid.' From Table: '.$wptb_table_name.'</code>';
		else
			echo '<br><code>WP-TopBar Debug Mode: Getting First TopBar In Table: '.$wptb_table_name.'</code>';

	// always check to see if table has been created .. if not then create it and insert default row.
	if( $wpdb->get_var("show tables like '".$wptb_table_name."'") != $wptb_table_name ) {
		if($wptb_debug)
			echo '<br><code>WP-TopBar Debug Mode: Table '.$wptb_table_name.' does not exist - creating it</code>';

		wptb_create_table($WPTB_DB_VERSION);				
		$wptbOptions=wptb_insert_default_row($WPTB_DB_VERSION);
	}
	else {
		if ( $wptb_barid == 0)
			$myrows = $wpdb->get_results( 'SELECT * FROM '.$wptb_table_name.' ORDER BY bar_id LIMIT 1', ARRAY_A );
		else
			$myrows = $wpdb->get_results( 'SELECT * FROM '.$wptb_table_name.' WHERE bar_id = '.$wptb_barid, ARRAY_A );
		
		if ( $wpdb->num_rows == 0 ) {
			if($wptb_debug)
				echo '<br><code>WP-TopBar Debug Mode: Now rows found in Table: '.$wptb_table_name.' - using defaults</code>';
			$wptbOptions=wptb_insert_default_row($WPTB_DB_VERSION);
		}
		else
			foreach ($myrows[0] as $key => $option)
				$wptbOptions[$key] = $option;		
	}
		
//	if($wptb_debug) wptb_debug_display_TopBar_Options($wptbOptions);
	
	return $wptbOptions;
	
}	// End of wptb_get_Specific_TopBar

	
//=========================================================================			
//	Check start/end times to see if TopBar should load: 
//     Returns 1 = yes, 0 = no
//  Args:  current time, start time, end time
//=========================================================================			
	
function wptb_check_time($wptb_barid) {
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$sql="	SELECT 	1
				FROM ".$wptb_table_name."	

				WHERE `bar_id` = ".$wptb_barid."
				AND COALESCE(TIMESTAMPDIFF( MINUTE, 	COALESCE(STR_TO_DATE(  '".current_time('mysql', 0)."',  '%Y-%m-%d %H:%i' ), 0), 
											COALESCE(STR_TO_DATE( `start_time_utc`,  '%m/%d/%Y %H:%i'     ), 0)),0) <= 0 
				AND	COALESCE(TIMESTAMPDIFF( MINUTE, 	COALESCE(STR_TO_DATE(  `end_time_utc` ,  '%m/%d/%Y %H:%i'       ), 0), 					
											COALESCE(STR_TO_DATE(  '".current_time('mysql', 0)."',  '%Y-%m-%d %H:%i' ), 0)),0) <=0
		";
				

	$myrows = $wpdb->get_results( $sql, ARRAY_A );
	
//	echo "<pre>"; print_r($myrows); echo "</pre>";
//	echo "</div><br>".$sql."<br>";
//	echo "<br>rows found=".$wpdb->num_rows."<br>";
		
		
	if  ( $wpdb->num_rows == 0 )
		return false;
	else
		return true;

} // End of function wptb_check_time



//=========================================================================			
// Creates Table
//=========================================================================			
	
function wptb_create_table($WPTB_DB_VERSION) { 

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_create_table()</code>';


	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	if($wptb_debug)
		echo '<br><code>WP-TopBar Debug Mode: Creating Table:'.$wptb_table_name.' at DB Version'.$WPTB_DB_VERSION.'</code>';
		
	$sql = "CREATE TABLE ". $wptb_table_name. " ( 
		bar_id BIGINT(20) NOT NULL AUTO_INCREMENT,
		wptb_version VARCHAR(20),	
		weighting_points SMALLINT,
		enable_topbar VARCHAR(20), 
		include_pages TEXT,  
		invert_include VARCHAR(20), 
		include_categories TEXT, 
		invert_categories TEXT,
		include_logic TEXT,
		show_homepage VARCHAR(20),
		only_logged_in VARCHAR(20),
		mobile_check VARCHAR(20),
		php_text_prefix  TEXT,
		php_text_suffix  TEXT,
		php_text_control TEXT,
		delay_time INT,
		slide_time INT,  
		display_time INT,
		start_time VARCHAR(20), 
		end_time VARCHAR(20),
		start_time_utc VARCHAR(20), 
		end_time_utc VARCHAR(20), 
		respect_cookie VARCHAR(20),
		cookie_value VARCHAR(20),
		past_cookie_values  VARCHAR(20),
		allow_close VARCHAR(20),
		allow_reopen VARCHAR(20),
		reopen_position VARCHAR(20),
		topbar_pos VARCHAR (20),
		forced_fixed VARCHAR (20),
		scroll_action VARCHAR (20),
		scroll_amount INT,
		text_color VARCHAR(20),
		bar_color  VARCHAR(20),
		bottom_color VARCHAR(20),
		link_color VARCHAR(20),
		bottom_border_height SMALLINT,
		font_size SMALLINT,
		padding_top SMALLINT,
		padding_bottom SMALLINT,
		margin_top SMALLINT,
		margin_bottom SMALLINT,
		margin_left SMALLINT,
		margin_right SMALLINT,		
		close_button_image TEXT,
		close_button_css TEXT,
		reopen_button_image TEXT,
		reopen_button_css TEXT,
		link_target VARCHAR(20),
		bar_link TEXT,
		bar_text TEXT,
		bar_link_text TEXT,
		text_align VARCHAR(20),
		bar_image TEXT,
		enable_image VARCHAR(20),
		custom_css_bar TEXT,
		custom_css_text TEXT,
		div_css TEXT,
		div_custom_html TEXT,
		bar_custom_html TEXT,
		bar_link_custom_html TEXT,
		show_type_sticky   VARCHAR(20),
		show_type_pages    VARCHAR(20), 
		show_type_archives VARCHAR(20),
		show_type_search   VARCHAR(20),
		show_type_404      VARCHAR(20), 
		show_type_single   VARCHAR(20),
		social_icon1 VARCHAR(20),
		social_icon2 VARCHAR(20),
		social_icon3 VARCHAR(20),
		social_icon4 VARCHAR(20),
		social_icon5 VARCHAR(20),
		social_icon6 VARCHAR(20),
		social_icon7 VARCHAR(20),
		social_icon8 VARCHAR(20),
		social_icon9 VARCHAR(20),
		social_icon10 VARCHAR(20),
		social_icon1_image TEXT,
		social_icon2_image TEXT,
		social_icon3_image TEXT,
		social_icon4_image TEXT,
		social_icon5_image TEXT,
		social_icon6_image TEXT,
		social_icon7_image TEXT,
		social_icon8_image TEXT,
		social_icon9_image TEXT,
		social_icon10_image TEXT,
		social_icon1_link TEXT,
		social_icon2_link TEXT,
		social_icon3_link TEXT,
		social_icon4_link TEXT,
		social_icon5_link TEXT,
		social_icon6_link TEXT,
		social_icon7_link TEXT,
		social_icon8_link TEXT,
		social_icon9_link TEXT,
		social_icon10_link TEXT,
		social_icon1_css TEXT,
		social_icon2_css TEXT,
		social_icon3_css TEXT,
		social_icon4_css TEXT,
		social_icon5_css TEXT,
		social_icon6_css TEXT,
		social_icon7_css TEXT,
		social_icon8_css TEXT,
		social_icon9_css TEXT,
		social_icon10_css TEXT,
		social_icon1_link_target VARCHAR(20),
		social_icon2_link_target VARCHAR(20),
		social_icon3_link_target VARCHAR(20),
		social_icon4_link_target VARCHAR(20),	
		social_icon5_link_target VARCHAR(20),	
		social_icon6_link_target VARCHAR(20),	
		social_icon7_link_target VARCHAR(20),	
		social_icon8_link_target VARCHAR(20),	
		social_icon9_link_target VARCHAR(20),	
		social_icon10_link_target VARCHAR(20),	
		social_icon1_position VARCHAR(20),
		social_icon2_position VARCHAR(20),
		social_icon3_position VARCHAR(20),
		social_icon4_position VARCHAR(20),	
		social_icon5_position VARCHAR(20),	
		social_icon6_position VARCHAR(20),	
		social_icon7_position VARCHAR(20),	
		social_icon8_position VARCHAR(20),	
		social_icon9_position VARCHAR(20),	
		social_icon10_position VARCHAR(20),	
		PRIMARY KEY  id (bar_id)
		) ;";
	
	dbDelta($sql);	
	
	update_option( 'wptb_db_version', $WPTB_DB_VERSION );



}	// End of wptb_create_table

//=========================================================================		
//
//Returns the default values for every TopBar
//
//=========================================================================		

function wptb_set_default_settings($WPTB_DB_VERSION) {

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_set_default_settings()</code>';

	$wptbOptions = array(
	 	'weighting_points'=> 25,				 	
		'wptb_version' => $WPTB_DB_VERSION,
		'enable_topbar' => 'false',
		'include_pages' => '0',
		'invert_include' => 'no',
		'include_categories' => '0',
		'invert_categories' => 'no',
		'include_logic' => 'page_only',
		'show_homepage' => 'conditionally',
		'only_logged_in' => 'all',
		'mobile_check' => 'all_devices',
		'php_text_prefix'  => '',
		'php_text_suffix'  => '',
		'php_text_control' => '',
		'delay_time' => '5000',
		'slide_time' => '200',
		'display_time' => '0',
		'start_time' => '0',
		'end_time' => '0',
		'start_time_utc' => '0',
		'end_time_utc' => '0',
		'respect_cookie' => 'ignore',
		'cookie_value' => '1',
		'past_cookie_values' => '1',
		'allow_close' => 'no',
		'allow_reopen' => 'no',
		'reopen_position' => 'open',
		'topbar_pos' => 'header',
		'forced_fixed' => 'no',
		'scroll_action' => 'off',
		'scroll_amount' => '0', 
		'text_color' => '#000000',
		'bar_color' => '#ffffff',
		'bottom_color' => '#f90000',
		'link_color' => '#c00000',
		'bottom_border_height' => '3', 
		'font_size' => '14',
		'padding_top' => '8',
		'padding_bottom' => '8',
		'margin_top' => '0',
		'margin_bottom' => '0',
		'margin_left' => '0',
		'margin_right' => '0',
		'close_button_image' => str_ireplace( 'https://','http://',plugins_url('/images/close.png', __FILE__) ),
		'close_button_css' => 'vertical-align:text-bottom;float:right;padding-right:20px;',
		'reopen_button_image' => str_ireplace( 'https://','http://',plugins_url('/images/open.png', __FILE__) ),
		'reopen_button_css' => 'display:none; float:right; left: 0px; width:100%; height: 17px; z-index:9999999; padding-right:10px; margin-right: 10px;color:#fff; width: 35px; height: 33px; text-decoration: none; cursor:pointer;',
		'link_target' => 'blank',
		'bar_link' => 'http://wordpress.org/extend/plugins/wp-topbar/',
		'bar_text' => 'Get your own TopBar ',
		'bar_link_text' => 'from the Wordpress plugin repository',
		'text_align' => 'center',
		'bar_image' => str_ireplace( 'https://','http://',plugins_url('/samples/wp-topbar_sample_image_2.jpg', __FILE__) ),
		'enable_image' => 'true',
		'custom_css_bar' => 'background-repeat: no-repeat;',
		'custom_css_text' => '',
		'div_css' => 'position:fixed; top: 40; padding:0; margin:0; width: 100%; z-index: 99999;',
		'bar_custom_html' => '',
		'bar_link_custom_html' => '',
		'div_custom_html' => '',
		'show_type_sticky'   => 'yes',
		'show_type_pages'    => 'yes',
		'show_type_archives' => 'yes',
		'show_type_search'   => 'yes',
		'show_type_404'      => 'yes',
		'show_type_single'   => 'yes',
		'social_icon1'  => 'off',
		'social_icon2'  => 'off', 
		'social_icon3'  => 'off',
		'social_icon4'  => 'off',
		'social_icon5'  => 'off',
		'social_icon6'  => 'off',
		'social_icon7'  => 'off',
		'social_icon8'  => 'off',
		'social_icon9'  => 'off',
		'social_icon10' => 'off',
		'social_icon1_image'  => str_ireplace( 'https://','http://',plugins_url('/icons/PNG/twitter.png', __FILE__) ),
		'social_icon2_image'  => str_ireplace( 'https://','http://',plugins_url('/icons/PNG/facebook.png', __FILE__) ),
		'social_icon3_image'  => str_ireplace( 'https://','http://',plugins_url('/icons/PNG/google.png', __FILE__) ),
		'social_icon4_image'  => '',
		'social_icon5_image'  => '',
		'social_icon6_image'  => '',
		'social_icon7_image'  => '',
		'social_icon8_image'  => '',
		'social_icon9_image'  => '',
		'social_icon10_image' => '',
		'social_icon1_link'  => 'http://twitter.com/#!/wordpress',
		'social_icon2_link'  => 'http://www.facebook.com/WordPress', 
		'social_icon3_link'  => 'http://plus.google.com/s/wordpress',
		'social_icon4_link'  => '',
		'social_icon5_link'  => '',
		'social_icon6_link'  => '',
		'social_icon7_link'  => '',
		'social_icon8_link'  => '',
		'social_icon9_link'  => '',
		'social_icon10_link' => '',
		'social_icon1_css'  => 'height:23px; vertical-align:text-bottom;',
		'social_icon2_css'  => 'height:23px; vertical-align:text-bottom;',
		'social_icon3_css'  => 'height:23px; vertical-align:text-bottom;',
		'social_icon4_css'  => '',
		'social_icon5_css'  => '',
		'social_icon6_css'  => '',
		'social_icon7_css'  => '',
		'social_icon8_css'  => '',
		'social_icon9_css'  => '',
		'social_icon10_css' => '',
		'social_icon1_link_target'  => 'blank',
		'social_icon2_link_target'  => 'blank',
		'social_icon3_link_target'  => 'blank',
		'social_icon4_link_target'  => 'blank',
		'social_icon5_link_target'  => 'blank',
		'social_icon6_link_target'  => 'blank',
		'social_icon7_link_target'  => 'blank',
		'social_icon8_link_target'  => 'blank',
		'social_icon9_link_target'  => 'blank',
		'social_icon10_link_target' => 'blank',
		'social_icon1_position'  => 'right',
		'social_icon2_position'  => 'right',
		'social_icon3_position'  => 'right',
		'social_icon4_position'  => 'right',
		'social_icon5_position'  => 'right',
		'social_icon6_position'  => 'right',
		'social_icon7_position'  => 'right',
		'social_icon8_position'  => 'right',
		'social_icon9_position'  => 'right',
		'social_icon10_position' => 'right'
		);
		
	if ( function_exists( 'wptb_custom_default_values'))
		$wptbOptions = wptb_custom_default_values($wptbOptions);
			
	return $wptbOptions;			

}	// End of wptb_set_default_settings

//=========================================================================		
//
//Inserts a row in the database with the default values
//
//=========================================================================		

function wptb_insert_default_row($WPTB_DB_VERSION) {

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_insert_default_row() in table: '.$wptb_table_name.'</code>';

	$rows_affected = $wpdb->insert( $wptb_table_name, wptb_set_default_settings($WPTB_DB_VERSION) );
	
	return wptb_set_default_settings($WPTB_DB_VERSION);

}	// End of wptb_insert_default_row

//=========================================================================		
//
//Inserts a new row into the database
//
//=========================================================================		

function wptb_insert_row($wptbOptions) {

	global $WPTB_DB_VERSION;
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_insert_row() in table: '.$wptb_table_name.'</code>';
	
	// set any missing default values (this may occur if user using an old version of wp-topbar)
	
	$wptbDefaultValues=wptb_set_default_settings($WPTB_DB_VERSION);
	
	foreach ( $wptbDefaultValues as $option_name => $value ) {
		if (! isset( $wptbOptions[$option_name] ))  $wptbOptions[$option_name] = $value;
	}

		
	$rows_affected = $wpdb->insert( $wptb_table_name, array(
	 	'weighting_points'=> $wptbOptions[ 'weighting_points' ],				 	
		'wptb_version' => $wptbOptions[ 'wptb_version' ],
		'enable_topbar' => $wptbOptions[ 'enable_topbar' ],
		'include_pages' => $wptbOptions[ 'include_pages' ],
		'invert_include' => $wptbOptions[ 'invert_include' ],
		'include_categories' => $wptbOptions[ 'include_categories' ],
		'invert_categories' => $wptbOptions[ 'invert_categories' ],
		'include_logic' => $wptbOptions[ 'include_logic' ],
		'show_homepage' => $wptbOptions[ 'show_homepage' ],
		'only_logged_in' => $wptbOptions[ 'only_logged_in' ],
		'mobile_check' => $wptbOptions[ 'mobile_check' ],
		'php_text_prefix'  => $wptbOptions[ 'php_text_prefix' ],
		'php_text_suffix'  => $wptbOptions[ 'php_text_suffix' ],
		'php_text_control' => $wptbOptions[ 'php_text_control' ],
		'delay_time' => $wptbOptions[ 'delay_time' ],
		'slide_time' => $wptbOptions[ 'slide_time' ],
		'display_time' => $wptbOptions[ 'display_time' ],
		'start_time' => $wptbOptions[ 'start_time' ],
		'end_time' => $wptbOptions[ 'end_time' ],
		'start_time_utc' => $wptbOptions[ 'start_time_utc' ],
		'end_time_utc' => $wptbOptions[ 'end_time_utc' ],
		'respect_cookie' => $wptbOptions[ 'respect_cookie' ],
		'cookie_value' => $wptbOptions[ 'cookie_value' ],
		'past_cookie_values' => $wptbOptions[ 'past_cookie_values' ],
		'allow_close' => $wptbOptions[ 'allow_close' ],
		'allow_reopen' => $wptbOptions[ 'allow_reopen' ],
		'reopen_position' => $wptbOptions[ 'reopen_position' ],
		'topbar_pos' => $wptbOptions[ 'topbar_pos' ],
		'forced_fixed' => $wptbOptions[ 'forced_fixed' ], 
		'scroll_action' => $wptbOptions[ 'scroll_action' ], 
		'scroll_amount' => $wptbOptions[ 'scroll_amount' ],
		'text_color' => $wptbOptions[ 'text_color' ],
		'bar_color' => $wptbOptions[ 'bar_color' ],
		'bottom_color' => $wptbOptions[ 'bottom_color' ],
		'link_color' => $wptbOptions[ 'link_color' ],
		'bottom_border_height' => $wptbOptions[ 'bottom_border_height' ], 
		'font_size' => $wptbOptions[ 'font_size' ],
		'padding_top' => $wptbOptions[ 'padding_top' ],
		'padding_bottom' => $wptbOptions[ 'padding_bottom' ],
		'margin_top' => $wptbOptions[ 'margin_top' ],
		'margin_bottom' => $wptbOptions[ 'margin_bottom' ],
		'margin_left' => $wptbOptions[ 'margin_left' ],
		'margin_right' => $wptbOptions[ 'margin_right' ],
		'close_button_image' => $wptbOptions[ 'close_button_image' ],
		'close_button_css' => $wptbOptions[ 'close_button_css' ],
		'reopen_button_image' => $wptbOptions[ 'reopen_button_image' ],
		'reopen_button_css' => $wptbOptions[ 'reopen_button_css' ],
		'link_target' => $wptbOptions[ 'link_target' ],
		'bar_link' => $wptbOptions[ 'bar_link' ],
		'bar_text' => $wptbOptions[ 'bar_text' ],
		'bar_link_text' => $wptbOptions[ 'bar_link_text' ],
		'text_align' => $wptbOptions[ 'text_align' ],
		'bar_image' => $wptbOptions[ 'bar_image' ],
		'enable_image' => $wptbOptions[ 'enable_image' ],
		'custom_css_bar' => $wptbOptions[ 'custom_css_bar' ],
		'custom_css_text' => $wptbOptions[ 'custom_css_text' ],
		'div_css' => $wptbOptions[ 'div_css' ],
		'bar_custom_html' => $wptbOptions [ 'bar_custom_html' ],
		'bar_link_custom_html' => $wptbOptions [ 'bar_link_custom_html' ],
		'div_custom_html' => $wptbOptions [ 'div_custom_html' ],
		'show_type_sticky'   => $wptbOptions['show_type_sticky'],
		'show_type_pages'    => $wptbOptions['show_type_pages'],
		'show_type_archives' => $wptbOptions['show_type_archives'],
		'show_type_search'   => $wptbOptions['show_type_search'],
		'show_type_404'      => $wptbOptions['show_type_404'],
		'show_type_single'   => $wptbOptions['show_type_single'],
		'social_icon1' => $wptbOptions[ 'social_icon1' ],
		'social_icon2' => $wptbOptions[ 'social_icon2' ], 
		'social_icon3' => $wptbOptions[ 'social_icon3' ],
		'social_icon4' => $wptbOptions[ 'social_icon4' ],
		'social_icon5' => $wptbOptions[ 'social_icon5' ],
		'social_icon6' => $wptbOptions[ 'social_icon6' ],
		'social_icon7' => $wptbOptions[ 'social_icon7' ],
		'social_icon8' => $wptbOptions[ 'social_icon8' ],
		'social_icon9' => $wptbOptions[ 'social_icon9' ],
		'social_icon10' => $wptbOptions[ 'social_icon10' ],
		'social_icon1_image' => $wptbOptions[ 'social_icon1_image' ],
		'social_icon2_image' => $wptbOptions[ 'social_icon2_image' ],
		'social_icon3_image' => $wptbOptions[ 'social_icon3_image' ],
		'social_icon4_image' => $wptbOptions[ 'social_icon4_image' ],
		'social_icon5_image' => $wptbOptions[ 'social_icon5_image' ],
		'social_icon6_image' => $wptbOptions[ 'social_icon6_image' ],
		'social_icon7_image' => $wptbOptions[ 'social_icon7_image' ],
		'social_icon8_image' => $wptbOptions[ 'social_icon8_image' ],
		'social_icon9_image' => $wptbOptions[ 'social_icon9_image' ],
		'social_icon10_image' => $wptbOptions[ 'social_icon10_image' ],
		'social_icon1_link' => $wptbOptions[ 'social_icon1_link' ],
		'social_icon2_link' => $wptbOptions[ 'social_icon2_link' ], 
		'social_icon3_link' => $wptbOptions[ 'social_icon3_link' ],
		'social_icon4_link' => $wptbOptions[ 'social_icon4_link' ],
		'social_icon5_link' => $wptbOptions[ 'social_icon5_link' ],
		'social_icon6_link' => $wptbOptions[ 'social_icon6_link' ],
		'social_icon7_link' => $wptbOptions[ 'social_icon7_link' ],
		'social_icon8_link' => $wptbOptions[ 'social_icon8_link' ],
		'social_icon9_link' => $wptbOptions[ 'social_icon9_link' ],
		'social_icon10_link' => $wptbOptions[ 'social_icon10_link' ],
		'social_icon1_css' => $wptbOptions[ 'social_icon1_css' ],
		'social_icon2_css' => $wptbOptions[ 'social_icon2_css' ],
		'social_icon3_css' => $wptbOptions[ 'social_icon3_css' ],
		'social_icon4_css' => $wptbOptions[ 'social_icon4_css' ],
		'social_icon5_css' => $wptbOptions[ 'social_icon5_css' ],
		'social_icon6_css' => $wptbOptions[ 'social_icon6_css' ],
		'social_icon7_css' => $wptbOptions[ 'social_icon7_css' ],
		'social_icon8_css' => $wptbOptions[ 'social_icon8_css' ],
		'social_icon9_css' => $wptbOptions[ 'social_icon9_css' ],
		'social_icon10_css' => $wptbOptions[ 'social_icon10_css' ],
		'social_icon1_link_target' => $wptbOptions[ 'social_icon1_link_target' ],
		'social_icon2_link_target' => $wptbOptions[ 'social_icon2_link_target' ],
		'social_icon3_link_target' => $wptbOptions[ 'social_icon3_link_target' ],
		'social_icon4_link_target' => $wptbOptions[ 'social_icon4_link_target' ],
		'social_icon5_link_target' => $wptbOptions[ 'social_icon5_link_target' ],
		'social_icon6_link_target' => $wptbOptions[ 'social_icon6_link_target' ],
		'social_icon7_link_target' => $wptbOptions[ 'social_icon7_link_target' ],
		'social_icon8_link_target' => $wptbOptions[ 'social_icon8_link_target' ],
		'social_icon9_link_target' => $wptbOptions[ 'social_icon9_link_target' ],
		'social_icon10_link_target' => $wptbOptions[ 'social_icon10_link_target' ],
		'social_icon1_position' => $wptbOptions[ 'social_icon1_position' ],
		'social_icon2_position' => $wptbOptions[ 'social_icon2_position' ],
		'social_icon3_position' => $wptbOptions[ 'social_icon3_position' ],
		'social_icon4_position' => $wptbOptions[ 'social_icon4_position' ],
		'social_icon5_position' => $wptbOptions[ 'social_icon5_position' ],
		'social_icon6_position' => $wptbOptions[ 'social_icon6_position' ],
		'social_icon7_position' => $wptbOptions[ 'social_icon7_position' ],
		'social_icon8_position' => $wptbOptions[ 'social_icon8_position' ],
		'social_icon9_position' => $wptbOptions[ 'social_icon9_position' ],
		'social_icon10_position' => $wptbOptions[ 'social_icon10_position' ]		
		) );


}	// End of wptb_insert_row

//=========================================================================		
//
//Updates a row in the table with new values
//
//=========================================================================		


function wptb_update_row($wptbOptions) {

	global $WPTB_DB_VERSION;
	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$wptb_debug=get_transient( 'wptb_debug' );	
	
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_update_row() #:'. $wptbOptions[ 'bar_id' ].' in table: '.$wptb_table_name.'</code>';

	// set any missing default values (this may occur if user using an old version of wp-topbar)
	
	$wptbDefaultValues=wptb_set_default_settings($WPTB_DB_VERSION);
	foreach ( $wptbDefaultValues as $option_name => $value ) {
		if (! isset( $wptbOptions[$option_name] ))  $wptbOptions[$option_name] = $value;
	}
		
	$rows_affected = $wpdb->update( $wptb_table_name, array(
	 	'weighting_points'=> $wptbOptions[ 'weighting_points' ],				 	
		'wptb_version' => $wptbOptions[ 'wptb_version' ],
		'enable_topbar' => $wptbOptions[ 'enable_topbar' ],
		'include_pages' => $wptbOptions[ 'include_pages' ],
		'invert_include' => $wptbOptions[ 'invert_include' ],
		'include_categories' => $wptbOptions[ 'include_categories' ],
		'invert_categories' => $wptbOptions[ 'invert_categories' ],
		'include_logic' => $wptbOptions[ 'include_logic' ],
		'show_homepage' => $wptbOptions[ 'show_homepage' ],
		'only_logged_in' => $wptbOptions[ 'only_logged_in' ],
		'mobile_check' => $wptbOptions[ 'mobile_check' ],
		'php_text_prefix'  => $wptbOptions[ 'php_text_prefix' ],
		'php_text_suffix'  => $wptbOptions[ 'php_text_suffix' ],
		'php_text_control' => $wptbOptions[ 'php_text_control' ],
		'delay_time' => $wptbOptions[ 'delay_time' ],
		'slide_time' => $wptbOptions[ 'slide_time' ],
		'display_time' => $wptbOptions[ 'display_time' ],
		'start_time' => $wptbOptions[ 'start_time' ],
		'end_time' => $wptbOptions[ 'end_time' ],
		'start_time_utc' => $wptbOptions[ 'start_time_utc' ],
		'end_time_utc' => $wptbOptions[ 'end_time_utc' ],
		'respect_cookie' => $wptbOptions[ 'respect_cookie' ],
		'cookie_value' => $wptbOptions[ 'cookie_value' ],
		'past_cookie_values' => $wptbOptions[ 'past_cookie_values' ],
		'allow_close' => $wptbOptions[ 'allow_close' ],
		'allow_reopen' => $wptbOptions[ 'allow_reopen' ],
		'reopen_position' => $wptbOptions[ 'reopen_position' ],
		'topbar_pos' => $wptbOptions[ 'topbar_pos' ],
		'forced_fixed' => $wptbOptions[ 'forced_fixed' ], 
		'scroll_action' => $wptbOptions[ 'scroll_action' ], 
		'scroll_amount' => $wptbOptions[ 'scroll_amount' ],
		'text_color' => $wptbOptions[ 'text_color' ],
		'bar_color' => $wptbOptions[ 'bar_color' ],
		'bottom_color' => $wptbOptions[ 'bottom_color' ],
		'link_color' => $wptbOptions[ 'link_color' ],
		'bottom_border_height' => $wptbOptions[ 'bottom_border_height' ], 
		'font_size' => $wptbOptions[ 'font_size' ],
		'padding_top' => $wptbOptions[ 'padding_top' ],
		'padding_bottom' => $wptbOptions[ 'padding_bottom' ],
		'margin_top' => $wptbOptions[ 'margin_top' ],
		'margin_bottom' => $wptbOptions[ 'margin_bottom' ],
		'margin_left' => $wptbOptions[ 'margin_left' ],
		'margin_right' => $wptbOptions[ 'margin_right' ],
		'close_button_image' => $wptbOptions[ 'close_button_image' ],
		'close_button_css' =>    preg_replace("/\n|\r/", " ",trim($wptbOptions[ 'close_button_css' ])),
		'reopen_button_image' => $wptbOptions[ 'reopen_button_image' ],
		'reopen_button_css' => preg_replace("/\n|\r/", " ",trim($wptbOptions[ 'reopen_button_css' ])),
		'link_target' => $wptbOptions[ 'link_target' ],
		'bar_link' => $wptbOptions[ 'bar_link' ],
		'bar_text' => $wptbOptions[ 'bar_text' ],
		'bar_link_text' => $wptbOptions[ 'bar_link_text' ],
		'text_align' => $wptbOptions[ 'text_align' ],
		'bar_image' => $wptbOptions[ 'bar_image' ],
		'enable_image' => $wptbOptions[ 'enable_image' ],
		'custom_css_bar' =>       preg_replace("/\n|\r/", " ",trim($wptbOptions[ 'custom_css_bar' ])),
		'custom_css_text' =>      preg_replace("/\n|\r/", " ",trim($wptbOptions[ 'custom_css_text' ])),
		'div_css' =>              preg_replace("/\n|\r/", " ",trim($wptbOptions[ 'div_css' ])),
		'bar_custom_html' =>      preg_replace("/\n|\r/", " ",trim($wptbOptions [ 'bar_custom_html' ])),
		'bar_link_custom_html' => preg_replace("/\n|\r/", " ",trim($wptbOptions [ 'bar_link_custom_html' ])),
		'div_custom_html' =>      preg_replace("/\n|\r/", " ",trim($wptbOptions [ 'div_custom_html' ])),
		'show_type_sticky'   => $wptbOptions['show_type_sticky'],
		'show_type_pages'    => $wptbOptions['show_type_pages'],
		'show_type_archives' => $wptbOptions['show_type_archives'],
		'show_type_search'   => $wptbOptions['show_type_search'],
		'show_type_404'      => $wptbOptions['show_type_404'],
		'show_type_single'   => $wptbOptions['show_type_single'],
		'social_icon1' => $wptbOptions[ 'social_icon1' ],
		'social_icon2' => $wptbOptions[ 'social_icon2' ], 
		'social_icon3' => $wptbOptions[ 'social_icon3' ],
		'social_icon4' => $wptbOptions[ 'social_icon4' ],
		'social_icon5' => $wptbOptions[ 'social_icon5' ],
		'social_icon6' => $wptbOptions[ 'social_icon6' ],
		'social_icon7' => $wptbOptions[ 'social_icon7' ],
		'social_icon8' => $wptbOptions[ 'social_icon8' ],
		'social_icon9' => $wptbOptions[ 'social_icon9' ],
		'social_icon10' => $wptbOptions[ 'social_icon10' ],
		'social_icon1_image' => $wptbOptions[ 'social_icon1_image' ],
		'social_icon2_image' => $wptbOptions[ 'social_icon2_image' ],
		'social_icon3_image' => $wptbOptions[ 'social_icon3_image' ],
		'social_icon4_image' => $wptbOptions[ 'social_icon4_image' ],
		'social_icon5_image' => $wptbOptions[ 'social_icon5_image' ],
		'social_icon6_image' => $wptbOptions[ 'social_icon6_image' ],
		'social_icon7_image' => $wptbOptions[ 'social_icon7_image' ],
		'social_icon8_image' => $wptbOptions[ 'social_icon8_image' ],
		'social_icon9_image' => $wptbOptions[ 'social_icon9_image' ],
		'social_icon10_image' => $wptbOptions[ 'social_icon10_image' ],
		'social_icon1_link' => $wptbOptions[ 'social_icon1_link' ],
		'social_icon2_link' => $wptbOptions[ 'social_icon2_link' ], 
		'social_icon3_link' => $wptbOptions[ 'social_icon3_link' ],
		'social_icon4_link' => $wptbOptions[ 'social_icon4_link' ],
		'social_icon5_link' => $wptbOptions[ 'social_icon5_link' ],
		'social_icon6_link' => $wptbOptions[ 'social_icon6_link' ],
		'social_icon7_link' => $wptbOptions[ 'social_icon7_link' ],
		'social_icon8_link' => $wptbOptions[ 'social_icon8_link' ],
		'social_icon9_link' => $wptbOptions[ 'social_icon9_link' ],
		'social_icon10_link' => $wptbOptions[ 'social_icon10_link' ],
		'social_icon1_css' => $wptbOptions[ 'social_icon1_css' ],
		'social_icon2_css' => $wptbOptions[ 'social_icon2_css' ],
		'social_icon3_css' => $wptbOptions[ 'social_icon3_css' ],
		'social_icon4_css' => $wptbOptions[ 'social_icon4_css' ],
		'social_icon5_css' => $wptbOptions[ 'social_icon5_css' ],
		'social_icon6_css' => $wptbOptions[ 'social_icon6_css' ],
		'social_icon7_css' => $wptbOptions[ 'social_icon7_css' ],
		'social_icon8_css' => $wptbOptions[ 'social_icon8_css' ],
		'social_icon9_css' => $wptbOptions[ 'social_icon9_css' ],
		'social_icon10_css' => $wptbOptions[ 'social_icon10_css' ],
		'social_icon1_link_target' => $wptbOptions[ 'social_icon1_link_target' ],
		'social_icon2_link_target' => $wptbOptions[ 'social_icon2_link_target' ],
		'social_icon3_link_target' => $wptbOptions[ 'social_icon3_link_target' ],
		'social_icon4_link_target' => $wptbOptions[ 'social_icon4_link_target' ],
		'social_icon5_link_target' => $wptbOptions[ 'social_icon5_link_target' ],
		'social_icon6_link_target' => $wptbOptions[ 'social_icon6_link_target' ],
		'social_icon7_link_target' => $wptbOptions[ 'social_icon7_link_target' ],
		'social_icon8_link_target' => $wptbOptions[ 'social_icon8_link_target' ],
		'social_icon9_link_target' => $wptbOptions[ 'social_icon9_link_target' ],
		'social_icon10_link_target' => $wptbOptions[ 'social_icon10_link_target' ],
		'social_icon1_position' => $wptbOptions[ 'social_icon1_position' ],
		'social_icon2_position' => $wptbOptions[ 'social_icon2_position' ],
		'social_icon3_position' => $wptbOptions[ 'social_icon3_position' ],
		'social_icon4_position' => $wptbOptions[ 'social_icon4_position' ],
		'social_icon5_position' => $wptbOptions[ 'social_icon5_position' ],
		'social_icon6_position' => $wptbOptions[ 'social_icon6_position' ],
		'social_icon7_position' => $wptbOptions[ 'social_icon7_position' ],
		'social_icon8_position' => $wptbOptions[ 'social_icon8_position' ],
		'social_icon9_position' => $wptbOptions[ 'social_icon9_position' ],
		'social_icon10_position' => $wptbOptions[ 'social_icon10_position' ]
		),
		array('bar_id' => $wptbOptions[ 'bar_id' ] )
		);


}	// End of wptb_update_row

//=========================================================================			
// Toggles Enable/Disable of a Row
//=========================================================================			

function wptb_toggle_enabled($tab,$wptb_barid,$wptbOptions) {

	$wptb_debug=get_transient( 'wptb_debug' );	
		
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_toggle_enabled() for Bar #: '.$wptb_barid.' - '.$tab.'</code>';

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";
	
	if ( $tab == 'enable' )	
		$wptbOptions['enable_topbar'] ='true';
	else
		$wptbOptions['enable_topbar'] ='false';
		
	$wpdb->query( 
		$wpdb->prepare( 
			"
             UPDATE ".$wptb_table_name." SET `enable_topbar` = '".$wptbOptions['enable_topbar'] ."' WHERE bar_id = %d
            ",
		        $wptb_barid 
	        )
	);
	$wptbOptions=array();
//	echo '<div class="updated"><p><strong>Settings Updated for TopBar #'.$wptb_barid.'.</strong></p></div>';
	return $wptbOptions;

}	// End of wptb_toggle_enabled


//=========================================================================			
// Update Global Settings 
//=========================================================================			


function wptb_update_GlobalSettings() {

	$wptb_debug=get_transient( 'wptb_debug' );	
		
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_update_GlobalSettings()</code>';

	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();
	
	if (isset($_POST['wptbrotatetopbars'])) {
		$wptbGlobalOptions [ 'rotate_topbars' ] = $_POST['wptbrotatetopbars'];
	}
	if (isset($_POST['wptbrotatedisplaytime'])) {
		if (!is_numeric($_POST['wptbrotatedisplaytime'])) {
			echo '<div class="error"><strong>'.__('Rotation Display Time is not numeric. Resetting to 9000.','wp-topbar').'</strong></div>';
			$wptbGlobalOptions [ 'rotate_display_time' ] = 9000;
		} 
		else
			$wptbGlobalOptions [ 'rotate_display_time' ] = $_POST['wptbrotatedisplaytime']+0;
	}
	if (isset($_POST['wptbrotatestartdelay'])) {
		if (!is_numeric($_POST['wptbrotatestartdelay'])) {
			echo '<div class="error"><strong>'.__('Rotation Start Delay is not numeric. Resetting to 1000.','wp-topbar').'</strong></div>';
			$wptbGlobalOptions [ 'rotate_start_delay' ] = 1000;
		} 
		else 	
			$wptbGlobalOptions [ 'rotate_start_delay' ] = $_POST['wptbrotatestartdelay']+0;
	}
	
	if ( isset($_POST [ 'wptbrotateorder' ]) ) {
		$wptbGlobalOptions [ 'rotate_order' ]  = $_POST [ 'wptbrotateorder' ] ;
	}
	
	if ( isset($_POST [ 'wptbrotatecount' ]) ) {
		if (!is_numeric($_POST['wptbrotatecount'])) {
			echo '<div class="error"><strong>'.__('Rotation Count is not numeric. Resetting to 0.','wp-topbar').'</strong></div>';
			$wptbGlobalOptions [ 'rotate_count' ] = 0;
		} 
		else 
			$wptbGlobalOptions [ 'rotate_count' ] = $_POST [ 'wptbrotatecount' ]+0;
	}
	if ( isset($_POST [ 'wptbrotatehidelast' ]) ) {
		$wptbGlobalOptions [ 'rotate_hide_last' ] = $_POST [ 'wptbrotatehidelast' ];
	}
	if ( isset($_POST [ 'wptbshowoverview' ]) ) {
		$wptbGlobalOptions [ 'show_overview' ] = $_POST [ 'wptbshowoverview' ];
	}	
	if ( isset($_POST [ 'wptbcustompath' ]) ) {
		$wptbGlobalOptions [ 'custom_samples_path' ] = trim( $_POST [ 'wptbcustompath' ] );	
	
	if ( $wptbGlobalOptions [ 'custom_samples_path' ] != "" && substr($wptbGlobalOptions [ 'custom_samples_path' ],-1) != "/" )
			$wptbGlobalOptions [ 'custom_samples_path' ] .= "/";
	}
	
	if ( $wptbGlobalOptions [ 'custom_samples_path' ] == "/" )
		$wptbGlobalOptions [ 'custom_samples_path' ] = "";
	
	update_option( "wptb_global_options", $wptbGlobalOptions ); 

	
}	// End of wptb_update_GlobalSettings


//=========================================================================			
// Bulk Update CloseButton Settings 
//=========================================================================			

function wptb_bulkupdate_CloseButtonSettings() {

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";

	$wptb_debug=get_transient( 'wptb_debug' );	
		
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_bulkupdate_CloseButtonSettings()</code>';
	
	$sql="  ";

	if (isset($_POST['wptballowclose'])) {
		$sql .= "`allow_close` = '".$_POST['wptballowclose']."', ";
	}
	if (isset($_POST['wptballowreopen'])) {
		$sql .= "`allow_reopen` = '".$_POST['wptballowreopen']."', ";
	}
	if (isset($_POST['wptbreopenposition'])) {
		$sql .= "`reopen_position` = '".$_POST['wptbreopenposition']."', ";
	}
	if (isset($_POST['wptbrespectcookie'])) {
		$sql .= "`respect_cookie` = '".$_POST['wptbrespectcookie']."', ";
	}
	if (isset($_POST['wptbcookievalue'])) {
		$sql .= "`cookie_value` = '".$_POST['wptbcookievalue']."', ";
		$sql .= "`past_cookie_values` = '', ";	
	}
	if (isset($_POST['wptbcloseimage'])) {
		$sql .= "`close_button_image` = '".esc_url($_POST['wptbcloseimage'])."', ";
	}	
	if (isset($_POST['wptbclosecss'])) {
		$sql .= "`close_button_css` = '".$_POST['wptbclosecss']."', ";
	}
	if (isset($_POST['wptbreopenimage'])) {
		$sql .= "`reopen_button_image` = '".esc_url($_POST['wptbreopenimage'])."', ";
	}	
	if (isset($_POST['wptbreopencss'])) {
		$sql .= "`reopen_button_css` = '".$_POST['wptbreopencss']."', ";
	}
	
	$sql=substr($sql,0,-2);

	if ( $sql != "" ) {
		$wpdb->query( 
			"
	         UPDATE ".$wptb_table_name." SET ".$sql
	        
		);
	}


}	// End of wptb_bulkupdate_CloseButtonsettings

//=========================================================================			
// Update Settings 
//=========================================================================			

function wptb_update_TopBarSettings($wptb_barid) {	
	
	$wptb_debug=get_transient( 'wptb_debug' );	
		
	if($wptb_debug) 
		echo '<br><code>WP-TopBar Debug Mode: wptb_update_TopBarSettings() for ID: '.$wptb_barid.'</code>';
		
	$wptbOptions = wptb_get_Specific_TopBar($wptb_barid,true);

	if($wptb_debug)
		echo '<br><code>WP-TopBar Debug Mode: Checking for Changes in Settings via POST</code>';

	if (isset($_POST['wptbenabletopbar'])) {
		$wptbOptions['enable_topbar'] = $_POST['wptbenabletopbar'];
	}
	if (isset($_POST['wptbpriority'])) {
	
		if (!is_numeric($_POST['wptbpriority'])) {
			echo '<div class="error"><strong>'.__('Priority is not numeric. Resetting to 25.','wp-topbar').'</strong></div>';
			$wptbOptions['weighting_points'] = 25;
		} 
		else 	
			$wptbOptions['weighting_points'] = $_POST['wptbpriority']+0;
			if ( $wptbOptions['weighting_points'] > 100 ) {
				echo '<div class="error"><strong>'.__('Priority is greater than 100. Resetting to 100.','wp-topbar').'</strong></div>';
				$wptbOptions['weighting_points'] = 100;				
			}
			else if ( $wptbOptions['weighting_points'] < 0 ) {
				echo '<div class="error"><strong>'.__('Priority is less than 1. Resetting to 1.','wp-topbar').'</strong></div>';
				$wptbOptions['weighting_points'] = 1;				
			}
	}
	if (isset($_POST['wptbtextcolor'])) {
		$wptbOptions['text_color'] = $_POST['wptbtextcolor'];
	}	
	if (isset($_POST['wptbbarcolor'])) {
		$wptbOptions['bar_color'] = $_POST['wptbbarcolor'];
	}
	if (isset($_POST['wptbbottomcolor'])) {
		$wptbOptions['bottom_color'] = $_POST['wptbbottomcolor'];
	}	
	if (isset($_POST['wptblinkcolor'])) {
		$wptbOptions['link_color'] = $_POST['wptblinkcolor'];
	}
	if (isset($_POST['wptbincludepages'])) {
		$wptbOptions['include_pages'] = $_POST['wptbincludepages'];
	}
	if (isset($_POST['wptbinvertinclude'])) {
		$wptbOptions['invert_include'] = $_POST['wptbinvertinclude'];
	}
	if (isset($_POST['wptbincludecategories'])) {
		$wptbOptions['include_categories'] = $_POST['wptbincludecategories'];
	}
	if (isset($_POST['wptbinvertcategories'])) {
		$wptbOptions['invert_categories'] = $_POST['wptbinvertcategories'];
	}
	if (isset($_POST['wptbincludelogic'])) {
		$wptbOptions['include_logic'] = $_POST['wptbincludelogic'];
	}		
	if (isset($_POST['wptbshowhomepage'])) {
		$wptbOptions['show_homepage'] = $_POST['wptbshowhomepage'];
	}	
	if (isset($_POST['wptbonlyloggedin'])) {
		$wptbOptions['only_logged_in'] = $_POST['wptbonlyloggedin'];
	}	
	if (isset($_POST['wptbmobilecheck'])) {
		$wptbOptions['mobile_check'] = $_POST['wptbmobilecheck'];
	}	
	if (isset($_POST['wptbphptextprefix'])) {
		$wptbOptions['php_text_prefix'] = $_POST['wptbphptextprefix'];
	}		
	if (isset($_POST['wptbphptextsuffix'])) {
		$wptbOptions['php_text_suffix'] = $_POST['wptbphptextsuffix'];
	}	
	if (isset($_POST['wptbphptextcontrol'])) {
		$wptbOptions['php_text_control'] = $_POST['wptbphptextcontrol'];
	}	
	if (isset($_POST['wptbbottomborderheight'])) {
	
		if (!is_numeric($_POST['wptbbottomborderheight'])) {
			echo '<div class="error"><strong>'.__('Bottom border height is not numeric. Resetting to 3px.','wp-topbar').'</strong></div>';
				$wptbOptions['bottom_border_height'] = 3;
		} 
		else 	
			$wptbOptions['bottom_border_height'] = $_POST['wptbbottomborderheight']+0;
	}
	if (isset($_POST['wptbdelayintime'])) {
	
		if (!is_numeric($_POST['wptbdelayintime'])) {
			echo '<div class="error"><strong>'.__('Delay time is not numeric. Resetting to zero.','wp-topbar').'</strong></div>';
				$wptbOptions['delay_time'] = 0;
		} 
		else 	
			$wptbOptions['delay_time'] = $_POST['wptbdelayintime']+0;
	}
	if (isset($_POST['wptbslidetime'])) {
	
		if (!is_numeric($_POST['wptbslidetime'])) {
			echo '<div class="error"><strong>'.__('Slide time is not numeric. Resetting to zero.','wp-topbar').'</strong></div>';
			$wptbOptions['slide_time'] = 0;
		} 
		else 	
			$wptbOptions['slide_time'] = $_POST['wptbslidetime']+0;
	}
	if (isset($_POST['wptbdisplaytime'])) {
	
		if (!is_numeric($_POST['wptbdisplaytime'])) {
			echo '<div class="error"><strong>'.__('Display time is not numeric. Resetting to zero.','wp-topbar').'</strong></div>';
			$wptbOptions['display_time'] = 0;
		} 
		else 	
			$wptbOptions['display_time'] = $_POST['wptbdisplaytime']+0;
	}			
	if (isset($_POST['wptbscrollamount'])) {
	
		if (!is_numeric($_POST['wptbscrollamount'])) {
			echo '<div class="error"><strong>'.__('Scroll Amount is not numeric. Resetting to zero.','wp-topbar').'</strong></div>';
			$wptbOptions['scroll_amount'] = 0;
		} 
		else 	
			$wptbOptions['scroll_amount'] = $_POST['wptbscrollamount']+0;
	}			
	if (isset($_POST['wptbstarttime'])) {
								
		$wptbOptions['start_time'] = $_POST['wptbstarttime'];
		$wptbOptions['start_time_utc'] = $_POST['wptbstarttime'];
//		$wptbOptions['start_time_utc'] = get_gmt_from_date(date('Y-m-d H:i:s (z)',strtotime($_POST['wptbstarttime'])));;
	}
	if (isset($_POST['wptbendtime'])) {

		$wptbOptions['end_time'] = $_POST['wptbendtime'];
		$wptbOptions['end_time_utc'] = $_POST['wptbendtime'];
//		$wptbOptions['end_time_utc'] = get_gmt_from_date(date('Y-m-d H:i:s (z)',strtotime($_POST['wptbendtime'])));;
	}
	if (isset($_POST['wptbfontsize'])) {
	
		if (!is_numeric($_POST['wptbfontsize'])) {
			echo '<div class="error"><strong>'.__('Font size is not numeric. Resetting to 8px.','wp-topbar').'</strong></div>';
			$wptbOptions['font_size'] = 8;
		} 
		else 	
			$wptbOptions['font_size'] = $_POST['wptbfontsize']+0;
	}						
	if (isset($_POST['wptbpaddingtop'])) {
	
		if (!is_numeric($_POST['wptbpaddingtop'])) {
			echo '<div class="error"><strong>'.__('Top padding is not numeric. Resetting to 8px.','wp-topbar').'</strong></div>';
			$wptbOptions['padding_top'] = 8;
		} 
		else 	
			$wptbOptions['padding_top'] = $_POST['wptbpaddingtop']+0;
	}
	if (isset($_POST['wptbpaddingbottom'])) {
	
		if (!is_numeric($_POST['wptbpaddingbottom'])) {
			echo '<div class="error"><strong>'.__('Bottom padding is not numeric. Resetting to 8px.','wp-topbar').'</strong></div>';
			$wptbOptions['padding_bottom'] = 8;
		} 
		else 	
			$wptbOptions['padding_bottom'] = $_POST['wptbpaddingbottom']+0;
	}						
	if (isset($_POST['wptbmargintop'])) {
	
		if (!is_numeric($_POST['wptbmargintop'])) {
			echo '<div class="error"><strong>'.__('Top margin is not numeric. Resetting to 0px.','wp-topbar').'</strong></div>';
			$wptbOptions['margin_top'] = 0;
		} 
		else 	
			$wptbOptions['margin_top'] = $_POST['wptbmargintop']+0;
	}
	if (isset($_POST['wptbmarginbottom'])) {
	
		if (!is_numeric($_POST['wptbmarginbottom'])) {
			echo '<div class="error"><strong>'.__('Bottom margin is not numeric. Resetting to 0px.','wp-topbar').'</strong></div>';
			$wptbOptions['margin_bottom'] = 0;
		} 
		else 	
			$wptbOptions['margin_bottom'] = $_POST['wptbmarginbottom']+0;
	}
	if (isset($_POST['wptbmarginleft'])) {
	
		if (!is_numeric($_POST['wptbmarginleft'])) {
			echo '<div class="error"><strong>'.__('Left margin is not numeric. Resetting to 0px.','wp-topbar').'</strong></div>';
			$wptbOptions['margin_left'] = 0;
		} 
		else 	
			$wptbOptions['margin_left'] = $_POST['wptbmarginleft']+0;
	}
	if (isset($_POST['wptbmarginright'])) {
	
		if (!is_numeric($_POST['wptbmarginright'])) {
			echo '<div class="error"><strong>'.__('Right margin is not numeric. Resetting to 0px.','wp-topbar').'</strong></div>';
			$wptbOptions['margin_right'] = 0;
		} 
		else 	
			$wptbOptions['margin_right'] = $_POST['wptbmarginright']+0;
	}								
	if (isset($_POST['wptblinkurl'])) {
		$wptbOptions['bar_link'] = $_POST['wptblinkurl'];
	}			
	if (isset($_POST['wptbbartext'])) {
		$wptbOptions['bar_text'] = $_POST['wptbbartext'];
	}
	if (isset($_POST['wptblinktext'])) {
		$wptbOptions['bar_link_text'] = $_POST['wptblinktext'];
	}
	if (isset($_POST['wptbbarcustomhtml'])) {
		$wptbOptions['bar_custom_html'] = $_POST['wptbbarcustomhtml'];
	}
	if (isset($_POST['wptblinkcustomhtml'])) {
		$wptbOptions['bar_link_custom_html'] = $_POST['wptblinkcustomhtml'];
	}
	if (isset($_POST['wptbdivcustomhtml'])) {
		$wptbOptions['div_custom_html'] = $_POST['wptbdivcustomhtml'];
	}	
	if (isset($_POST['wptbtextalign'])) {
		$wptbOptions['text_align'] = $_POST['wptbtextalign'];
	}
	if (isset($_POST['wptbbarimage'])) {
		$wptbOptions['bar_image'] = $_POST['wptbbarimage'];
	}
	if (isset($_POST['wptbenableimage'])) {
		$wptbOptions['enable_image'] = $_POST['wptbenableimage'];
	}
	if (isset($_POST['wptbcustomcssbar'])) {
		$wptbOptions['custom_css_bar']  = $_POST['wptbcustomcssbar'];
	}
	if (isset($_POST['wptbcustomcsstext'])) {
		$wptbOptions['custom_css_text'] = $_POST['wptbcustomcsstext'];
	}
	if (isset($_POST['wptbdivcss'])) {
		$wptbOptions['div_css'] = $_POST['wptbdivcss'];
	}
	if (isset($_POST['wptballowclose'])) {
		$wptbOptions['allow_close'] = $_POST['wptballowclose'];
	}
	if (isset($_POST['wptballowreopen'])) {
		$wptbOptions['allow_reopen'] = $_POST['wptballowreopen'];
	}	
	if (isset($_POST['wptbreopenposition'])) {
		$wptbOptions['reopen_position'] = $_POST['wptbreopenposition'];
	}	
	if (isset($_POST['wptbrespectcookie'])) {
		$wptbOptions['respect_cookie'] = $_POST['wptbrespectcookie'];
	}
	if (isset($_POST['wptbcookievalue'])) {
	
		$wptbOldCookieValue = $wptbOptions['cookie_value'];
		
		$wptbOptions['cookie_value'] = $_POST['wptbcookievalue'];
		
		$wptbNewCookieValue = $wptbOptions['cookie_value'];

		$wptbPastValues = $wptbOptions['past_cookie_values'];

		if ( $wptbNewCookieValue != $wptbOldCookieValue ) 
			$wptbOptions['past_cookie_values']=	$wptbOldCookieValue;	

	}
	if (isset($_POST['wptbcloseimage'])) {
		$wptbOptions['close_button_image'] = esc_url($_POST['wptbcloseimage']);
	}	
	if (isset($_POST['wptbclosecss'])) {
		$wptbOptions['close_button_css']  = $_POST['wptbclosecss'];
	}
	if (isset($_POST['wptbreopenimage'])) {
		$wptbOptions['reopen_button_image'] = esc_url($_POST['wptbreopenimage']);
	}	
	if (isset($_POST['wptbreopencss'])) {
		$wptbOptions['reopen_button_css']  = $_POST['wptbreopencss'];
	}
	if (isset($_POST['wptblinktarget'])) {
		$wptbOptions['link_target'] = $_POST['wptblinktarget'];
	}
	if (isset($_POST['wptbtopbarpos'])) {
		$wptbOptions['topbar_pos'] = $_POST['wptbtopbarpos'];
	}
	if (isset($_POST['wptbforcedfixed'])) {
		$wptbOptions['forced_fixed'] = $_POST['wptbforcedfixed'];
	}
	if (isset($_POST['wptbscrollaction'])) {
		$wptbOptions['scroll_action'] = $_POST['wptbscrollaction'];
	}
	if (isset($_POST['wptbshowsticky'])) {
		$wptbOptions['show_type_sticky'] = $_POST['wptbshowsticky'];
	}
	if (isset($_POST['wptbshowpages'])) {
		$wptbOptions['show_type_pages'] = $_POST['wptbshowpages'];
	}
	if (isset($_POST['wptbshowarchives'])) {
		$wptbOptions['show_type_archives'] = $_POST['wptbshowarchives'];
	}
	if (isset($_POST['wptbshowsearch'])) {
		$wptbOptions['show_type_search'] = $_POST['wptbshowsearch'];
	}
	if (isset($_POST['wptbshow404'])) {
		$wptbOptions['show_type_404'] = $_POST['wptbshow404'];
	}
	if (isset($_POST['wptbshowsingle'])) {
		$wptbOptions['show_type_single'] = $_POST['wptbshowsingle'];
	}
		
	// need to check the make sure we are the right tab to correctly handle the toggle buttons on the Social Buttons Tab
	
	if ( $_GET['action'] == 'socialbuttons') {

		for ($i=1; $i<=10; $i++)  {
			if (isset($_POST['wptbsocialicon'.$i])) 
				$wptbOptions['social_icon'.$i] = 'on';
			else
				$wptbOptions['social_icon'.$i] = 'off';
			if (isset($_POST['wptbsocialicon'.$i.'image'])) 
				$wptbOptions['social_icon'.$i.'_image'] = $_POST['wptbsocialicon'.$i.'image'];
			if (isset($_POST['wptbsocialicon'.$i.'link'])) 
				$wptbOptions['social_icon'.$i.'_link'] = $_POST['wptbsocialicon'.$i.'link'];
			if (isset($_POST['wptbsocialicon'.$i.'css']))
				$wptbOptions['social_icon'.$i.'_css'] = $_POST['wptbsocialicon'.$i.'css'];
			if (isset($_POST['wptbicon'.$i.'linktarget'])) 
				$wptbOptions['social_icon'.$i.'_link_target'] = $_POST['wptbicon'.$i.'linktarget'];
			if (isset($_POST['wptbicon'.$i.'position'])) 
				$wptbOptions['social_icon'.$i.'_position'] = $_POST['wptbicon'.$i.'position'];
		}			
	}	

// Handle magic quotes -- consolidate all of the handling here for easier debugging and changing of settings

	if ( (get_magic_quotes_gpc() ) &&  ( $wptb_debug ) )
		echo '<br><code>WP-TopBar Debug Mode: Magic Quotes is on</code>';

	$wptbtextfields = array( '1' => 'custom_css_bar',  '2' => 'bar_text',  '3' => 'custom_css_text', '4' => 'bar_link_text', '5' => 'close_button_css', '6' => 'reopen_button_css' , '7' => 'div_css');

  	foreach( $wptbtextfields as $number => $field ) {
		if (get_magic_quotes_gpc())
			$wptbOptions[$field] 	 = (str_replace('"',"'",wptb::wptb_stripslashes($wptbOptions[$field])));
		else
			$wptbOptions[$field] 	 = (str_replace('"',"'",$wptbOptions[$field]));

    }

// for these -- need to make sure the user is not using single quotes - -that breaks the plugin.
    
    $wptbtextfields = array('1' => 'div_custom_html' , '2' => 'bar_custom_html' , '3' => 'bar_link_custom_html');
  	foreach( $wptbtextfields as $number => $field ) {
		if (get_magic_quotes_gpc())
			$wptbOptions[$field] 	 = (str_replace("'",'"',wptb::wptb_stripslashes($wptbOptions[$field])));
		else
			$wptbOptions[$field] 	 = (str_replace("'",'"',$wptbOptions[$field]));
    }
    
    
    
     
    
	for ($i=1; $i<=10; $i++)  {
		if (get_magic_quotes_gpc())
			$wptbOptions['social_icon'.$i.'_css'] 	 = (str_replace('"',"'",wptb::wptb_stripslashes($wptbOptions['social_icon'.$i.'_css'])));
		else
			$wptbOptions['social_icon'.$i.'_css'] 	 = (str_replace('"',"'",$wptbOptions['social_icon'.$i.'_css']));
	
	}
    
	if ($wptbOptions['start_time'] == '') {
		$wptbOptions['start_time'] = 0;	
		$wptbOptions['start_time_utc'] = 0;	
	} 
	if ($wptbOptions['end_time'] == '') {
		$wptbOptions['end_time'] = 0;	
		$wptbOptions['end_time_utc'] = 0;				
	}

	wptb_update_row($wptbOptions);
	if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Settings Updated</code>';
	echo '<div class="updated"><p><strong>Settings Updated.</strong></p></div>';
		
	return $wptbOptions;
	
}	// End of wptb_update_TopBarSettings



//=========================================================================			
// Run this from options page to check
// if upgrade functions need to run.
// Parameter $wptb_display_errors is used for debugging:  
//		1=use echo function, 0=use error_log function
//
// DB Versions Listing:
// 4.17 - added scroll_action field
// 5.0 - added 6 more Social Buttons and ability to place them (left or right), added reopen options
// 5.02 - added scroll_amount field
// 5.03 - added reopen_position field
// 5.04 - added custom HTML field
// 5.05 - added mobile_check field
// 5.06 - added margin_left, margin_right fields
// 5.07 - added forced_fixed
// 5.08 - added php_text_control & show_type_sticky, posts, archive, pages, 404, search
// 5.09 - no change, just force an update to overcome an issue with WordPress 4.2.3
//=========================================================================			
	
function wptb_check_for_plugin_upgrade($wptb_display_errors, $WPTB_DB_VERSION) { 
		
	global $wpdb;
	
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";

	$wpdb->hide_errors();	

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug) 
			echo '<br><code>WP-TopBar Debug Mode: wptb_check_for_plugin_upgrade()</code>';


	$wptbOptions = get_option('wptbAdminOptions');
				
	// if options are set, then convert to using a database else check to see if database is in use
	if ( isset( $wptbOptions['enable_topbar'] ) ) {
		if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Found wptbAdminOptions - Converting to Table</code>';
		wptb_create_table($WPTB_DB_VERSION);			
		if (! isset($wptbOptions['enable_image']) )
			$wptbOptions['enable_image'] = "false";    // default row has this turned on, so turn off since older version may not have this field
								
		wptb_insert_row($wptbOptions);	
		delete_option('wptbAdminOptions');
	}
	else {
			if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: No wptbAdminOptions - Looking for Table:'.$wptb_table_name.'</code>';
			if( $wpdb->get_var("show tables like '".$wptb_table_name."'") != $wptb_table_name ) {
				if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: No Table - Creating and adding default row.</code>';
				wptb_create_table($WPTB_DB_VERSION);				
				wptb_insert_default_row($WPTB_DB_VERSION);
			}
			else {
				// OK, they are using a DB, now check to see if needs to be updated				
				$installed_ver = get_option( 'wptb_db_version' );
				if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Found Table:'.$wptb_table_name.'</code>';
				if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Installed DB: '.$installed_ver.'</code>';
				if( ! isset($installed_ver) || $installed_ver != $WPTB_DB_VERSION ) {
					if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Upgrading DB to '.$WPTB_DB_VERSION.'</code>';
					wptb_create_table($WPTB_DB_VERSION);
				}
			}
	}
	

	// force this check to make sure all values are set to default values
	wptb_check_table_for_default_values($wptb_display_errors, $WPTB_DB_VERSION);

			
	if($wptb_debug) {
		if($wptb_display_errors) {
			echo '<br><code>WP-TopBar Debug Mode: in wptb_check_for_plugin_upgrade</code>' ;
			echo '<br><code>WP-TopBar Debug Mode: DB Version: ',$WPTB_DB_VERSION,'</code>';
		}
		else {
			error_log( 'WP-TopBar Debug Mode: in wptb_check_for_plugin_upgrade' );
			error_Log( 'WP-TopBar Debug Mode: DB Version: '.$WPTB_DB_VERSION);
		}
	}
	
	$wpdb->show_errors();
		
	
} // End of function wptb_check_for_plugin_upgrade 	
	
function wptb_check_table_for_default_values($wptb_display_errors, $WPTB_DB_VERSION) { 

	global $wpdb;

	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";

	$wpdb->hide_errors();	

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug) 
			echo '<br><code>WP-TopBar Debug Mode: wptb_check_table_for_default_values()</code>';

	$wptb_verson_in_db=$wpdb->get_col(  
	"
	SELECT      min(wptb_version)
	FROM        ".$wptb_table_name."
	"
	); 

	if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: MIN DB Version in Table: ',$wptb_verson_in_db[0],'</code>';
	
	$wptb_do_update=false;
	
	if ( $wptb_verson_in_db[0] != $WPTB_DB_VERSION ) {
		$wptb_do_update=true;
		if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Version Upgrade Needed to '.$WPTB_DB_VERSION.'</code>';
		$myrows = $wpdb->get_results( 'SELECT * FROM '.$wptb_table_name, ARRAY_A);
		if ( $wpdb->num_rows == 0 )
			$wptbOptions=wptb_insert_default_row($WPTB_DB_VERSION);
		else {
			$wptbDefaultValues=wptb_set_default_settings($WPTB_DB_VERSION);
			$wptbDefaultValues[ 'enable_image' ] = false;  // default row has this turned on, so turn off since older version may not have this field
			if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Checking Rows</code>';

			foreach ( $myrows as $wptbOptions ) 
			{	
				if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Checking Row: '.$wptbOptions[ 'bar_id' ].'</code>';
				foreach ( $wptbDefaultValues as $option_name => $value ) {
						if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Checking Option: '.$option_name.'</code>';
					if (! isset( $wptbOptions[$option_name] ))  {
						$wptbOptions[$option_name] = $value;
						if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Row:'.$wptbOptions[ 'bar_id' ].' Set default for '.$option_name.' to "'.$value.'"</code>';

					}
				}
			
				if($wptb_debug) echo '<br><code>WP-TopBar Debug Mode: Updating Row</code>';
				$wptbOptions[ 'wptb_version' ] = $WPTB_DB_VERSION;
				wptb_update_row($wptbOptions);
			}
		}

	}
		
	$wpdb->show_errors();
	
	if ($wptb_do_update) {
		
		update_option( 'wptb_db_version', $WPTB_DB_VERSION );
	
		if($wptb_debug) {
			if($wptb_display_errors) 
				echo '<br><code>WP-TopBar Debug Mode: version is now set to: '.	get_option( 'wptb_db_version' ).'</code>' ;
			else
				error_log( 'WP-TopBar Debug Mode: version is now set to: '.	get_option( 'wptb_db_version' ) );
		}
	}
		
	if($wptb_debug) {
		if($wptb_display_errors) 
			echo '<br><code>WP-TopBar Debug Mode: end of wptb_check_table_for_default_values</code>' ;
		else
			error_log( 'WP-TopBar Debug Mode: end of wptb_check_table_for_default_values' );
	}
	
} // End of function wptb_check_table_for_default_values 	




?>
