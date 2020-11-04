<?php 

/*
Close Options Tab

i18n Compatible

*/


//=========================================================================			
// Close Button Options
//=========================================================================			


function wptb_closebutton_bulk_options() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	global $wpdb;
	$wptb_table_name = $wpdb->prefix . "wp_topbar_data";	

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_closebutton_bulk_options()</code>';


	$allow_close = "no";
	$allow_reopen = "off";
	$reopen_position = "open";
	$respect_cookie = "ignore";
	$cookie_value = "1";
	$close_button_image = str_ireplace( 'https://','http://',plugins_url('/images/close.png', __FILE__) );
	$close_button_css = 'vertical-align:text-bottom;float:right;padding-right:20px;'; 
	$reopen_button_image = str_ireplace( 'https://','http://',plugins_url('/images/open.png', __FILE__) );
	$reopen_button_css = 'display:none; float:right; left: 0px; width:100%; height: 17px; z-index:9999999; padding-right:10px; margin-right: 10px;color:#fff; width: 35px; height: 33px; text-decoration: none; cursor:pointer;'; 

	$row_count = $wpdb->get_var(  'SELECT COUNT(*) FROM '.$wptb_table_name );

	$allow_close_max   = $wpdb->get_var( ( 'SELECT MAX(`allow_close`) FROM '.$wptb_table_name ) );
	$allow_close_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `allow_close` = "'.$allow_close_max.'"' ) );
	if ( $allow_close_count == $row_count) $allow_close = $allow_close_max;

	$allow_reopen_max   = $wpdb->get_var( ( 'SELECT MAX(`allow_reopen`) FROM '.$wptb_table_name ) );
	$allow_reopen_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `allow_reopen` = "'.$allow_reopen_max.'"' ) );
	if ( $allow_reopen_count == $row_count) $allow_reopen = $allow_reopen_max;

	$reopen_position_max   = $wpdb->get_var( ( 'SELECT MAX(`reopen_position`) FROM '.$wptb_table_name ) );
	$reopen_position_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `reopen_position` = "'.$reopen_position_max.'"' ) );
	if ( $reopen_position_count == $row_count) $reopen_position = $reopen_position_max;

	$respect_cookie_max   = $wpdb->get_var( ( 'SELECT MAX(`respect_cookie`) FROM '.$wptb_table_name ) );
	$respect_cookie_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `respect_cookie` = "'.$respect_cookie_max.'"' ) );
	if ( $respect_cookie_count == $row_count) $respect_cookie = $respect_cookie_max;

	$cookie_value_max   = $wpdb->get_var( ( 'SELECT MAX(`cookie_value`) FROM '.$wptb_table_name ) );
	$cookie_value_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `cookie_value` = "'.$cookie_value_max.'"' ) );
	if ( $cookie_value_count == $row_count) $cookie_value = $cookie_value_max;

	$close_button_image_max   = $wpdb->get_var( ( 'SELECT MAX(`close_button_image`) FROM '.$wptb_table_name ) );
	$close_button_image_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `close_button_image` = "'.$close_button_image_max.'"' ) );
	if ( $close_button_image_count == $row_count) $close_button_image = $close_button_image_max;

	$close_button_css_max   = $wpdb->get_var( ( 'SELECT MAX(`close_button_css`) FROM '.$wptb_table_name ) );
	$close_button_css_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `close_button_css` = "'.$close_button_css_max.'"' ) );
	if ( $close_button_css_count == $row_count) $close_button_css = $close_button_css_max;

	$reopen_button_image_max   = $wpdb->get_var( ( 'SELECT MAX(`reopen_button_image`) FROM '.$wptb_table_name ) );
	$reopen_button_image_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `reopen_button_image` = "'.$reopen_button_image_max.'"' ) );
	if ( $reopen_button_image_count == $row_count) $reopen_button_image = $reopen_button_image_max;

	$reopen_button_css_max   = $wpdb->get_var( ( 'SELECT MAX(`reopen_button_css`) FROM '.$wptb_table_name ) );
	$reopen_button_css_count = $wpdb->get_var( ( 'SELECT COUNT(*) FROM '.$wptb_table_name.' WHERE `reopen_button_css` = "'.$reopen_button_css_max.'"' ) );
	if ( $reopen_button_css_count == $row_count) $reopen_button_css = $reopen_button_css_max;


	if($wptb_debug)
		echo '<br><code>WP-TopBar Debug Mode: Allow Close=['.$allow_close.'] / Respect Cookie=['.$respect_cookie.']</code>';



	?>
	
	<div class="postbox">
										
	<h3><a name="CloseButton"><?php _e('Close Button','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('These are the settings to allow the user to close the TopBar.'.
		'<br><br>This plugin can use a cookie to remember if the user closed the TopBar.   If you enable cookies, then a cookie is created if the user closes the TopBar.  If the value stored in the cookie matches the Cookie Value (below), then the TopBar will not be shown on subsequent page views.  If you disable the use of cookies, then the plugin will delete the users cookies the next time the page is loaded.'.
		'<br><br>To have a consistent user experience, <strong>ALL</strong> TopBars need to use the same settings.','wp-topbar'); ?></em></p>
		
		<div class="table">
			<table class="form-table">	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
						<td width="150" id="allowclose"><?php _e('Allow TopBar to be closed by user','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio1" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptballowcloseb1" name="wptballowclose" class="ui-helper-hidden-accessible" value="yes" <?php if ($allow_close == "yes") { echo 'checked="checked"'; }?>><label for="wptballowcloseb1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptballowcloseb2" name="wptballowclose" class="ui-helper-hidden-accessible" value="no" <?php if ($allow_close == "no") { echo 'checked="checked"'; }?>><label for="wptballowcloseb2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>						
					</br>
						<p class="sub"><em><?php _e('Allows the user to close the TopBar.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150" id="allowreopen"><?php _e('Allow the TopBar to be reopened','wp-topbar'); ?>:</td>
					<td>
					 	<p id="radio2" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptballowreopenb1" name="wptballowreopen" class="ui-helper-hidden-accessible" value="yes" <?php if ($allow_reopen == "yes") { echo 'checked="checked"'; }?>><label for="wptballowreopenb1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptballowreopenb2" name="wptballowreopen" class="ui-helper-hidden-accessible" value="no" <?php if ($allow_reopen != "yes") { echo 'checked="checked"'; }?>><label for="wptballowreopenb2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>						
					</br>
						<p class="sub"><em><?php _e('This allows the user to close and reopen the TopBar.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>					
				<tr valign="top">
					<td width="150"><?php _e('Re-openable TopBar should start Open or Closed','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio3" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbreopenpositionb1" name="wptbreopenposition" class="ui-helper-hidden-accessible" value="open" <?php if ($reopen_position != "closed") { echo 'checked="checked"'; }?>><label for="wptbreopenpositionb1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Open','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbreopenpositionb2" name="wptbreopenposition" class="ui-helper-hidden-accessible" value="closed" <?php if ($reopen_position == "closed") { echo 'checked="checked"'; }?>><label for="wptbreopenpositionb2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Closed','wp-topbar'); ?></span></label>
						</p>						
					</br>
					<p class="sub"><em><?php _e('Sets how the Re-openable TopBar is displayed to the user -- as opened or closed.  Default is <code>Open</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>					
				<tr>
					<td colspan="2"><hr></td>
				</tr>
					<tr valign="top">
					<td width="150"><?php _e('Enable Cookies','wp-topbar'); ?>:</label></td>
					<td>						
					 	<p id="radio4" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbrespectcookieb1" name="wptbrespectcookie" class="ui-helper-hidden-accessible" value="always" <?php if ($respect_cookie == "always") { echo 'checked="checked"'; }?>><label for="wptbrespectcookieb1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbrespectcookieb2" name="wptbrespectcookie" class="ui-helper-hidden-accessible" value="ignore" <?php if ($respect_cookie == "ignore") { echo 'checked="checked"'; }?>><label for="wptbrespectcookieb2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>					
					
					</br>
					<p class="sub"><em><?php _e('Enable use of cookies to control TopBar behavior. This is not used if the TopBar can be re=opened. Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Cookie Value','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbcookievalue" id="cookievalue" size="10" value="<?php echo wptb::wptb_stripslashes($cookie_value); ?>" >
					</br>
					<p class="sub"><em><?php _e('Change this value to force the cookie to reshow - if you are using a Caching Plugin, you might need to flush your Cache.  Default is <code>1</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Enter the CSS for the Close Button','wp-topbar'); ?>:</label></td>
					<td>
					<textarea name="wptbclosecss" id="closecss" rows="2" cols="100"><?php echo wptb::wptb_stripslashes($close_button_css); ?></textarea>
					</br>
					<p class="sub"><em><?php _e('Default is','wp-topbar'); ?> <code>vertical-align:text-bottom;float:right;padding-right:20px;</code></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>		
				<tr valign="top">
					<td><?php _e('Close Button Image URL','wp-topbar'); ?>:
					</td>
					<td><label for="wptbupload_closebutton">
					<input id="wptbupload_closebutton" type="text" size="85" name="wptbcloseimage" value="<?php echo $close_button_image; ?>" />
					<input class="browse_upload button" name="wptbcloseimage" id="wptbupload_closebutton_button" type="button" style="<?php _e( $wptb_special_button_style , 'wp-topbar' ); ?>" value="Upload Image" />
					
					</br>
					<p class="sub"><em><?php _e('Enter a URL or upload an image for the close button on the TopBar.','wp-topbar'); ?></em></p>
					</label></td>
				</tr>				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Enter the CSS for the Reopen Button','wp-topbar'); ?>:</label></td>
					<td>
					<textarea name="wptbreopencss" id="reopencss" rows="2" cols="100"><?php echo wptb::wptb_stripslashes($reopen_button_css); ?></textarea>
					</br>
					<p class="sub"><em><?php _e('Default is','wp-topbar'); ?> <code>display:none; float:right; left: 0px; width:100%; height: 17px; z-index:9999999; padding-right:10px; margin-right: 10px;color:#fff; width: 35px; height: 33px; text-decoration: none; cursor:pointer;</code></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>		
				<tr valign="top">
					<td><?php _e('Reopen Button Image URL','wp-topbar'); ?>:
					</td>
					<td><label for="wptbupload_reopenbutton">
					<input id="wptbupload_reopenbutton" type="text" size="85" name="wptbreopenimage" value="<?php echo $reopen_button_image; ?>" />
					<input class="browse_upload button" name="wptbreopenimage" id="wptbupload_reopenbutton_button" type="button" style="<?php _e( $wptb_special_button_style , 'wp-topbar' ); ?>" value="Upload Image" />
					
					</br>
					<p class="sub"><em><?php _e('Enter a URL or upload an image for the re-open button on the TopBar.','wp-topbar'); ?></em></p>
					</label></td>
				</tr>					
			</table>
		</div>
		<table>
		<tr>
			<td style="valign:top; width:500px;"><p class="submit">
				<input type="submit" style="<?php echo $wptb_submit_style; ?>" name="update_wptbCloseButton" value="<?php _e('Replace ALL Close Button Settings', 'wp-topbar') ?>" />
			</td>
			<td style="valign:top;">
				<input type="button" class="button" style="<?php echo $wptb_button_style; ?>" value="<?php _e('Back to Top', 'wp-topbar') ?>" onClick="parent.location='#Top'">
			</td>
		</tr>
		</table>
		
		<div class="clear"></div>	
		</div>
	</div> <!-- end of Close Button Settings -->
	
	<?php 
}	// End of wptb_closebutton_bulk_options


function wptb_closebutton_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_closebutton_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>
	
	<div class="postbox">
										
	<h3><a name="CloseButton"><?php _e('Close Button','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('These are the settings to allow the user to close the TopBar.'.
		'<br><br>This plugin can use a cookie to remember if the user closed the TopBar.   If you enable cookies, then a cookie is created if the user closes the TopBar.  If the value stored in the cookie matches the Cookie Value (below), then the TopBar will not be shown on subsequent page views.  If you disable the use of cookies, then the plugin will delete the users cookies the next time the page is loaded.'.
		'<br><br>To be used effectively, <strong>ALL</strong> TopBars must use the same settings. Use this batch option to set all TopBars to the same settings:','wp-topbar'); ?> <a href="?page=wp-topbar.php&action=bulkclosebutton"><?php _e('Close Button tab','wp-topbar'); ?></a> </em></p>
		
		<div class="table">
			<table class="form-table">	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
						<td width="150" id="allowclose"><?php _e('Allow TopBar to be closed by user','wp-topbar'); ?>:</label></td>
						<td>
						 	<p id="radio3" class="ui-button ui-button-wptbset">
								<input type="radio" id="wptballowclose1" name="wptballowclose" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['allow_close'] == "yes") { echo 'checked="checked"'; }?>><label for="wptballowclose1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
								<input type="radio" id="wptballowclose2" name="wptballowclose" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['allow_close'] == "no") { echo 'checked="checked"'; }?>><label for="wptballowclose2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
							</p>						
						</br>
						<p class="sub"><em><?php _e('Allows the user to close the TopBar.  Default is <code>No</code>','wp-topbar'); ?></em></p>
						</td>
				</tr>					
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150" id="allowreopen"><?php _e('Allow the TopBar to be reopened','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio4" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptballowreopen1" name="wptballowreopen" class="ui-helper-hidden-accessible" value="yes"  <?php if ($wptbOptions['allow_reopen'] == "yes") { echo 'checked="checked"'; }?>><label for="wptballowreopen1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptballowreopen2" name="wptballowreopen" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['allow_reopen'] == "no") { echo 'checked="checked"'; }?>><label for="wptballowreopen2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
				 	</p>
					</br>
						<p class="sub"><em><?php _e('This allows the user to close and reopen the TopBar.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Re-openable TopBar should start Open or Closed','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio5" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbreopenposition1" name="wptbreopenposition" class="ui-helper-hidden-accessible" value="open"  <?php if ($wptbOptions['reopen_position'] == "open") { echo 'checked="checked"'; }?>><label for="wptbreopenposition1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Open','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbreopenposition2" name="wptbreopenposition" class="ui-helper-hidden-accessible" value="closed" <?php if ($wptbOptions['reopen_position'] == "closed") { echo 'checked="checked"'; }?>><label for="wptbreopenposition2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Closed','wp-topbar'); ?></span></label>
						</p>						
					</br>
					<p class="sub"><em><?php _e('Sets how the Re-openable TopBar is displayed to the user -- as opened or closed.  Default is <code>Open</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>						<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Enable Cookies','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio6" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbrespectcookie1" name="wptbrespectcookie" class="ui-helper-hidden-accessible" value="always" <?php if ($wptbOptions['respect_cookie'] == "always") { echo 'checked="checked"'; }?>><label for="wptbrespectcookie1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbrespectcookie2" name="wptbrespectcookie" class="ui-helper-hidden-accessible" value="ignore" <?php if ($wptbOptions['respect_cookie'] == "ignore") { echo 'checked="checked"'; }?>><label for="wptbrespectcookie2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>											
					</br>
					<p class="sub"><em><?php _e('Enable use of cookies to control TopBar behavior. This is not used if the TopBar can be re=opened. Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Cookie Value','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbcookievalue" id="cookievalue" size="10" value="<?php echo wptb::wptb_stripslashes($wptbOptions['cookie_value']); ?>" >
					<?php	
						if ( $wptbOptions['past_cookie_values'] != "" ) {
							echo '<p>'.__('Your previous cookie value was','wp-topbar').': '.$wptbOptions['past_cookie_values'];
						}
					?>
					</br>
					<p class="sub"><em><?php _e('Change this value to force the cookie to reshow - if you are using a Caching Plugin, you might need to flush your Cache.  Default is <code>1</code>','wp-topbar'); ?></em></p>
					<p class="sub"><em><?php _e('See the:','wp-topbar'); ?><a href='?page=wp-topbar.php&action=faq&barid=<?php echo ($wptb_barid_prefix+$wptbOptions['bar_id']); ?>'><?php _e('FAQ','wp-topbar'); ?></a>.</em></p>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Enter the CSS for the Close Button','wp-topbar'); ?>:</label></td>
					<td>
					<textarea name="wptbclosecss" id="closecss" rows="2" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['close_button_css']); ?></textarea>
					</br>
					<p class="sub"><em><?php _e('Default is','wp-topbar'); ?> <code>vertical-align:text-bottom;float:right;padding-right:20px;</code></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>		
				<tr valign="top">
					<td><?php _e('Close Button Image URL','wp-topbar'); ?>:</br>
					<?php if ( ! ($wptbOptions['close_button_image'] == "") )  echo '<img style="float:right; margin: 0 0 15px 15px;" src="'.$wptbOptions['close_button_image'].'"/>';	?>
					</td>
					<td><label for="wptbupload_closebutton">
					<input id="wptbupload_closebutton" type="text" size="85" name="wptbcloseimage" value="<?php echo $wptbOptions['close_button_image']; ?>" />
					<input class="browse_upload button" name="wptbcloseimage" id="wptbupload_closebutton_button" type="button" style="<?php echo $wptb_special_button_style; ?>" value="<?php _e('Upload Image','wp-topbar'); ?>" />
					
					</br>
					<p class="sub"><em><?php _e('Enter a URL or upload an image for the close button on the TopBar.','wp-topbar'); ?></em></p>
					</label></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Enter the CSS for the Reopen Button','wp-topbar'); ?>:</label></td>
					<td>
					<textarea name="wptbreopencss" id="reopencss" rows="2" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['reopen_button_css']); ?></textarea>
					</br>
					<p class="sub"><em><?php _e('Default is','wp-topbar'); ?> <code>display:none; float:right; left: 0px; width:100%; height: 17px; z-index:9999999; padding-right:10px; margin-right: 10px;color:#fff; width: 35px; height: 33px; text-decoration: none; cursor:pointer;</code></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>		
				<tr valign="top">
					<td><?php _e('Reopen Button Image URL','wp-topbar'); ?>:</br>
					<?php if ( ! ($wptbOptions['reopen_button_image'] == "") )  echo '<img style="float:right; margin: 0 0 15px 15px;" src="'.$wptbOptions['reopen_button_image'].'"/>';	?>
					</td>
					<td><label for="wptbupload_reopenbutton">
					<input id="wptbupload_reopenbutton" type="text" size="85" name="wptbreopenimage" value="<?php echo $wptbOptions['reopen_button_image']; ?>" />
					<input class="browse_upload button" name="wptbreopenimage" id="wptbupload_reopenbutton_button" type="button" style="<?php echo $wptb_special_button_style; ?>" value="<?php _e('Upload Image','wp-topbar'); ?>" />
					
					</br>
					<p class="sub"><em><?php _e('Enter a URL or upload an image for the re-open button on the TopBar.','wp-topbar'); ?></em></p>
					</label></td>
				</tr>
			</table>
		</div>
		<table>
		<tr>
			<td style="valign:top; width:500px;"><p class="submit">
				<input type="submit" style="<?php echo $wptb_submit_style; ?>" name="update_wptbSettings" value="<?php _e('Update Settings', 'wp-topbar') ?>" />
			</td>
			<td style="valign:top;">
				<input type="button" class="button" style="<?php echo $wptb_button_style; ?>" value="<?php _e('Back to Top', 'wp-topbar') ?>" onClick="parent.location='#Top'">
			</td>
		</tr>
		</table>
		
		<div class="clear"></div>	
		</div>
	</div> <!-- end of Close Button Settings -->
	
	<?php 
}	// End of wptb_closebutton_options



?>