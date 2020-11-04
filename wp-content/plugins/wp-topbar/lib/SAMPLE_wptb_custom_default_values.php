// How to create your own Custom Default TopBar
// 
// When the plugin is asked to create a new default TopBar, it first loads the array wptbOptions[]
// with all of the default values. Then, it looks to see if this function 'wptb_custom_default_values'
// exists.  If it does, it will call that function.  That function should ONLY update values in the 
// wptbOptions[] array.  
//
// You can copy this sample function into your theme's function.php or
// some other file that is loaded on your admin pages.
//
// There are two sample functions listed below.  One reads a json file; the other sets the options directly.
// See intstructions above each. ONLY USE ONE or write your own.
//
// WARNINGS!
//
// 1) if you have invalid PHP, you could break your website
// 2) if a new option is added in a future version, you'll need to update your custom functions
// 3) no support is given for this option.
//


// OPTION 1
//
// Change $file_path to be a directory on your server
// Change $file_name to be the name of the file
//
//

function wptb_custom_default_values($wptbOptions) {
	
	$file_path = 'http://URL.org/wp/wp-content/plugins/wp-topbar-samples/';
	$file_name ='default_toolbar.json';
	
	$file_data = file_get_contents( $file_path.$file_name );
	if ( is_array(json_decode($file_data, true)) ) {
	    $wptbOptions = wptb_fix_all_rows(json_decode($file_data2, true), $file_path , count($raw_data));
	}
		
	return $wptbOptions;
	
}

// OPTION 2
//
// Change any options below to match what you want in your own custom default TopBar.
//  
// To see how to set the options, you can create a TopBar via the user interface, then export it.  
// The export file will show you how to set each of the options below.
//

function wptb_custom_default_values_($wptbOptions) {

 	$wptbOptions[ 'weighting_points' ] = 25;				 	
	$wptbOptions[ 'enable_topbar' ] = 'false';
	$wptbOptions[ 'include_pages' ] = '0';
	$wptbOptions[ 'invert_include' ] = 'no';
	$wptbOptions[ 'include_categories' ] = '0';
	$wptbOptions[ 'invert_categories' ] = 'no';
	$wptbOptions[ 'include_logic' ] = 'page_only';
	$wptbOptions[ 'show_homepage' ] = 'conditionally';
	$wptbOptions[ 'only_logged_in' ] = 'all';
	$wptbOptions[ 'mobile_check' ] = 'all_devices';
	$wptbOptions[ 'php_text_prefix' ] = '';
	$wptbOptions[ 'php_text_suffix' ] = '';
	$wptbOptions[ 'delay_time' ] = '5000';
	$wptbOptions[ 'slide_time' ] = '200';
	$wptbOptions[ 'display_time' ] = '0';
	$wptbOptions[ 'start_time' ] = '0';
	$wptbOptions[ 'end_time' ] = '0';
	$wptbOptions[ 'start_time_utc' ] = '0';
	$wptbOptions[ 'end_time_utc' ] = '0';
	$wptbOptions[ 'respect_cookie' ] = 'ignore';
	$wptbOptions[ 'cookie_value' ] = '1';
	$wptbOptions[ 'past_cookie_values' ] = '1';
	$wptbOptions[ 'allow_close' ] = 'no';
	$wptbOptions[ 'allow_reopen' ] = 'no';
	$wptbOptions[ 'reopen_position' ] = 'open';
	$wptbOptions[ 'topbar_pos' ] = 'header';
	$wptbOptions[ 'forced_fixed' ] = 'no';
	$wptbOptions[ 'scroll_action' ] = 'off';
	$wptbOptions[ 'scroll_amount' ] = '0'; 
	$wptbOptions[ 'text_color' ] = '#000000';
	$wptbOptions[ 'bar_color' ] = '#848484';
	$wptbOptions[ 'bottom_color' ] = '#f90000';
	$wptbOptions[ 'link_color' ] = '#c00000';
	$wptbOptions[ 'bottom_border_height' ] = '3'; 
	$wptbOptions[ 'font_size' ] = '14';
	$wptbOptions[ 'padding_top' ] = '8';
	$wptbOptions[ 'padding_bottom' ] = '8';
	$wptbOptions[ 'margin_top' ] = '0';
	$wptbOptions[ 'margin_bottom' ] = '0';
	$wptbOptions[ 'margin_left' ] = '0';
	$wptbOptions[ 'margin_right' ] = '0';
	$wptbOptions[ 'close_button_image' ] = str_ireplace( 'https://','http://',plugins_url('/images/close.png', __FILE__) );
	$wptbOptions[ 'close_button_css' ] = 'vertical-align:text-bottom;float:right;padding-right:20px;';
	$wptbOptions[ 'reopen_button_image' ] = str_ireplace( 'https://','http://',plugins_url('/images/open.png', __FILE__) );
	$wptbOptions[ 'reopen_button_css' ] = 'display:none; float:right; left: 0px; width:100%; height: 17px; z-index:9999999; padding-right:10px; margin-right: 10px;color:#fff; width: 35px; height: 33px; text-decoration: none; cursor:pointer;';
	$wptbOptions[ 'link_target' ] = 'blank';
	$wptbOptions[ 'bar_link' ] = 'http://wordpress.org/extend/plugins/wp-topbar/';
	$wptbOptions['bar_text'] = 'Get your own TopBar ';
	$wptbOptions[ 'bar_link_text' ] = 'from the Wordpress plugin repository';
	$wptbOptions[ 'text_align' ] = 'center';
	$wptbOptions[ 'bar_image' ] = str_ireplace( 'https://','http://',plugins_url('/samples/wp-topbar_sample_image_2.jpg', __FILE__) );
	$wptbOptions[ 'enable_image' ] = 'true';
	$wptbOptions[ 'custom_css_bar' ] = 'background-repeat: no-repeat;';
	$wptbOptions[ 'custom_css_text' ] = '';
	$wptbOptions[ 'div_css' ] = 'position:fixed; top: 40; padding:0; margin:0; width: 100%; z-index: 99999;';
	$wptbOptions[ 'bar_custom_html' ] = '';
	$wptbOptions[ 'bar_link_custom_html' ] = '';
	$wptbOptions[ 'div_custom_html' ] = '';
	$wptbOptions[ 'social_icon1' ] = 'off';
	$wptbOptions[ 'social_icon2' ] = 'off'; 
	$wptbOptions[ 'social_icon3' ] = 'off';
	$wptbOptions[ 'social_icon4' ] = 'off';
	$wptbOptions[ 'social_icon5' ] = 'off';
	$wptbOptions[ 'social_icon6' ] = 'off';
	$wptbOptions[ 'social_icon7' ] = 'off';
	$wptbOptions[ 'social_icon8' ] = 'off';
	$wptbOptions[ 'social_icon9' ] = 'off';
	$wptbOptions[ 'social_icon10' ] = 'off';
	$wptbOptions[ 'social_icon1_image' ] = str_ireplace( 'https://','http://',plugins_url('/icons/PNG/twitter.png', __FILE__) );
	$wptbOptions[ 'social_icon2_image' ] = str_ireplace( 'https://','http://',plugins_url('/icons/PNG/facebook.png', __FILE__) );
	$wptbOptions[ 'social_icon3_image' ] = str_ireplace( 'https://','http://',plugins_url('/icons/PNG/google.png', __FILE__) );
	$wptbOptions[ 'social_icon4_image' ] = '';
	$wptbOptions[ 'social_icon5_image' ] = '';
	$wptbOptions[ 'social_icon6_image' ] = '';
	$wptbOptions[ 'social_icon7_image' ] = '';
	$wptbOptions[ 'social_icon8_image' ] = '';
	$wptbOptions[ 'social_icon9_image' ] = '';
	$wptbOptions[ 'social_icon10_image' ] = '';
	$wptbOptions[ 'social_icon1_link' ] = 'http://twitter.com/#!/wordpress';
	$wptbOptions[ 'social_icon2_link' ] = 'http://www.facebook.com/WordPress'; 
	$wptbOptions[ 'social_icon3_link' ] = 'http://plus.google.com/s/wordpress';
	$wptbOptions[ 'social_icon4_link' ] = '';
	$wptbOptions[ 'social_icon5_link' ] = '';
	$wptbOptions[ 'social_icon6_link' ] = '';
	$wptbOptions[ 'social_icon7_link' ] = '';
	$wptbOptions[ 'social_icon8_link' ] = '';
	$wptbOptions[ 'social_icon9_link' ] = '';
	$wptbOptions[ 'social_icon10_link' ] = '';
	$wptbOptions[ 'social_icon1_css' ] = 'height:23px; vertical-align:text-bottom;';
	$wptbOptions[ 'social_icon2_css' ] = 'height:23px; vertical-align:text-bottom;';
	$wptbOptions[ 'social_icon3_css' ] = 'height:23px; vertical-align:text-bottom;';
	$wptbOptions[ 'social_icon4_css' ] = '';
	$wptbOptions[ 'social_icon5_css' ] = '';
	$wptbOptions[ 'social_icon6_css' ] = '';
	$wptbOptions[ 'social_icon7_css' ] = '';
	$wptbOptions[ 'social_icon8_css' ] = '';
	$wptbOptions[ 'social_icon9_css' ] = '';
	$wptbOptions[ 'social_icon10_css' ] = '';
	$wptbOptions[ 'social_icon1_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon2_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon3_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon4_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon5_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon6_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon7_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon8_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon9_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon10_link_target' ] = 'blank';
	$wptbOptions[ 'social_icon1_position' ] = 'right';
	$wptbOptions[ 'social_icon2_position' ] = 'right';
	$wptbOptions[ 'social_icon3_position' ] = 'right';
	$wptbOptions[ 'social_icon4_position' ] = 'right';
	$wptbOptions[ 'social_icon5_position' ] = 'right';
	$wptbOptions[ 'social_icon6_position' ] = 'right';
	$wptbOptions[ 'social_icon7_position' ] = 'right';
	$wptbOptions[ 'social_icon8_position' ] = 'right';
	$wptbOptions[ 'social_icon9_position' ] = 'right';
	$wptbOptions[ 'social_icon10_position' ] = 'right';		
		
	return $wptbOptions;			

}	// End of wptb_custom_default_values