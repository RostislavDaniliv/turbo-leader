<?php 

/*
All Options Tab

i18n Compatbile 

*/


//=========================================================================			
// All Options
//=========================================================================			


		
function wptb_all_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_all_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';
			    
	?>

 	<div class="postbox">
	<h3><a name="MainOptions"><?php _e('All Options','wp-topbar'); ?></a></h3>
	<div class="inside">
		<div class="table">
			<table class="form-table">
				<input name="wptb_update_setting_nonce" type="hidden" value="<?php wp_create_nonce('wptb_update_setting_nonce'); ?>" />			
				<tr valign="top">
					<td id="prioritytop"><?php _e('Priority','wp-topbar'); ?>:
					</td>
					<td >
						<input type="text" name="wptbpriority" id="priority" size="4" value="<?php echo $wptbOptions['weighting_points']; ?>" >
						<div id="wptb-priority"></div>

							<p class="sub"><em><?php _e('Enter the relative priority (1 to 100) for the TopBar to show.  A higher number means this TopBar will be selected more frequently; a lower number means less frequently.  (See the FAQ for more details.) Default is <code>25</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>			
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td  id="location"><?php _e('TopBar Location','wp-topbar'); ?>:
					</td>
					<td>
				 	<p id="radio1" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbtopbarpos1" name="wptbtopbarpos" class="ui-helper-hidden-accessible" value="header" <?php if ($wptbOptions['topbar_pos'] == "header") { echo 'checked="checked"'; }?>><label for="wptbtopbarpos1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Above Header','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbtopbarpos2" name="wptbtopbarpos" class="ui-helper-hidden-accessible" value="footer" <?php if ($wptbOptions['topbar_pos'] == "footer") { echo 'checked="checked"'; }?>><label for="wptbtopbarpos2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Below Footer','wp-topbar'); ?></span></label>
				 	</p>

							<p class="sub"><em><?php _e('Select where you want to TopBar to be located. Default is <code>Above Header</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>	
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td  id="location"><?php _e('Force TopBar to Be Fixed On Top of Page','wp-topbar'); ?>:
					</td>
					<td>
				 	<p id="radio2" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbforcedfixed1" name="wptbforcedfixed" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['forced_fixed'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbforcedfixed1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbforcedfixed2" name="wptbforcedfixed" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['forced_fixed'] == "no") { echo 'checked="checked"'; }?>><label for="wptbforcedfixed2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
				 	</p>
							<p class="sub"><em><?php _e('This will force the TopBar to be fixed to the top of the page, regardless of what you put in the Custom CSS settings. For non-scrolling TopBars, this option will also push down your page to ensure the TopBar is always at the top of the page.  This option is ignored if you are Rotating TopBars.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>					
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td  id="scrollaction"><?php _e('Scroll Action','wp-topbar'); ?>:
					</td>
					<td>
				 	<p id="radio3" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbscrollaction1" name="wptbscrollaction" class="ui-helper-hidden-accessible" value="on"  <?php if ($wptbOptions['scroll_action'] == "on") { echo 'checked="checked"'; }?>><label for="wptbscrollaction1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('On','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbscrollaction2" name="wptbscrollaction" class="ui-helper-hidden-accessible" value="off" <?php if ($wptbOptions['scroll_action'] != "on") { echo 'checked="checked"'; }?>><label for="wptbscrollaction2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Off','wp-topbar'); ?></span></label>
				 	</p>
							<p class="sub"><em><?php _e('Only show the TopBar when the user scrolls the page?  If the user scrolls back to the top of the page, the TopBar gracefully fades away.  Note, if this is to On, the TopBar ignores the Display Time value below.</br></br>Also, <strong>it works best</strong> when the Forced Fixed Option (above) is turned <code>On</code> or the CSS has the <code>position</code> fixed: e.g. <code>position:fixed; top: 40; padding:0; margin:0; width: 100%; z-index: 99999;</code>.</br></br>Default is <code>Off</code>, this will show the scrollbar even if the user does not scroll the page.  See:','wp-topbar'); ?> <a <?php echo 'href="?page=wp-topbar.php&action=topbarcss&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'#divcss"'; ?>>TopBar CSS & HTML Tab - Option C</a></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Scroll Amount','wp-topbar'); ?>:
					</td>
					<td>
						<input type="text" name="wptbscrollamount" id="scrollamount" size="30" value="<?php echo $wptbOptions['scroll_amount']; ?>" >
						<div id="wptb-scroll-amount"></div>
							<p class="sub"><em><?php _e('This option allows you to adjust how far the user has to scroll the page before the Scrollable TopBar appears.   Selecting 0 (zero) will display the TopBar immediately after the user scrolls the page.</br></br>Default is <code>0</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Start Delay','wp-topbar'); ?>:
					</td>
					<td>
						<input type="text" name="wptbdelayintime" id="delayintime" size="30" value="<?php echo $wptbOptions['delay_time']; ?>" >
						<div id="wptb-delayintime"></div>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to delay before appearing.  Enter 0 for no delay.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Slide Time','wp-topbar'); ?>:
					</td>
					<td>
						<input type="text" name="wptbslidetime" id="slidetime" size="30" value="<?php echo $wptbOptions['slide_time']; ?>" >
						<div id="wptb-slidetime"></div>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to take to slide down on the page.  Enter 0 for no delay.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Display Time','wp-topbar'); ?>:
					</td>
					<td>
						<input type="text" name="wptbdisplaytime" id="displaytime" size="30" value="<?php echo $wptbOptions['display_time']; ?>" >
						<div id="wptb-displaytime"></div>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to remain on the page.  Enter 0 for the TopBar to not disappear.','wp-topbar'); ?></em></p>
					</td>
				</tr>							
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Message','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbbartext" id="bbartext" size="85" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_text']); ?>" >
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Link Text','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptblinktext" id="linktext" size="85" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_link_text']); ?>" >
					</td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Link','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptblinkurl" id="link" size="100" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_link']); ?>" >
					</td>
				</tr>
				<tr valign="top">
					<td width="50"><?php _e('Link Target','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio4" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptblinktarget1" name="wptblinktarget" class="ui-helper-hidden-accessible" value="blank" <?php if ($wptbOptions['link_target'] == "blank") { echo 'checked="checked"'; }?>><label for="wptblinktarget1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_blank</span></label>
						<input type="radio" id="wptblinktarget2" name="wptblinktarget" class="ui-helper-hidden-accessible" value="self" <?php if ($wptbOptions['link_target'] == "self") { echo 'checked="checked"'; }?>><label for="wptblinktarget2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_self</span></label>
						<input type="radio" id="wptblinktarget3" name="wptblinktarget" class="ui-helper-hidden-accessible" value="parent" <?php if ($wptbOptions['link_target'] == "parent") { echo 'checked="checked"'; }?>><label for="wptblinktarget3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_parent</span></label>
						<input type="radio" id="wptblinktarget4" name="wptblinktarget" class="ui-helper-hidden-accessible" value="top" <?php if ($wptbOptions['link_target'] == "top") { echo 'checked="checked"'; }?>><label for="wptblinktarget4" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_top</span></label>
					 	</p>						
					
							<p class="sub"><em><?php _e('Select how you want the link to open','wp-topbar'); ?>:</</p>
							<p><?php echo '&nbsp;&nbsp;&nbsp;_blank - '.__('Opens the linked document in a new window or tab (this is default)', 'wp-topbar') ?></p>
							<p><?php echo '&nbsp;&nbsp;&nbsp;_self - '.__('Opens the linked document in the same frame as it was clicked', 'wp-topbar') ?></p>
							<p><?php echo '&nbsp;&nbsp;&nbsp;_parent -	'.__('Opens the linked document in the parent frame', 'wp-topbar') ?></p>
							<p><?php echo '&nbsp;&nbsp;&nbsp;_top - '.__('Opens the linked document in the full body of the windowtext to align.', 'wp-topbar') ?></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="50"><?php _e('Enable image','wp-topbar'); ?>:</label></td>
					<td width="50">
				 	<p id="radio5" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbenableimage1" name="wptbenableimage" class="ui-helper-hidden-accessible" value="true" <?php if ($wptbOptions['enable_image'] == "true") { echo 'checked="checked"'; }?>><label for="wptbenableimage1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbenableimage2" name="wptbenableimage" class="ui-helper-hidden-accessible" value="false" <?php if ($wptbOptions['enable_image'] == "false") { echo 'checked="checked"'; }?>><label for="wptbenableimage2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
					</p>					
					</td>
				</tr>
				<tr valign="top">
					<td scope="row"><?php _e('Image URL','wp-topbar'); ?>:</td>
					<td><label for="wptbupload_image">
					<input id="wptbupload_image" type="text" size="85" name="wptbbarimage" value="<?php echo $wptbOptions['bar_image']; ?>" />
					<input class="browse_upload button" id="wptbupload_image_button" type="button" style="<?php echo $wptb_special_button_style; ?>" value="<?php _e('Upload Image','wp-topbar'); ?>" />
					<br /><em><?php _e('Enter an URL or upload an image for the TopBar','wp-topbar'); ?>.</em)
					</label></td>
				</tr>

				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td><strong><?php _e('Enter CSS Option C Here','wp-topbar'); ?>:</strong></br></td>
					<td>
					<textarea name="wptbdivcss" id="divcss" rows="10" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['div_css']); ?></textarea>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
						<td  id="allowclose"><?php _e('Allow TopBar to be closed by user','wp-topbar'); ?>:</label></td>
						<td>
						 	<p id="radio6" class="ui-button ui-button-wptbset">
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
					<td  id="allowreopen"><?php _e('Allow the TopBar to be reopened','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio7" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptballowreopen1" name="wptballowreopen" class="ui-helper-hidden-accessible" value="yes"  <?php if ($wptbOptions['allow_reopen'] == "yes") { echo 'checked="checked"'; }?>><label for="wptballowreopen1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptballowreopen2" name="wptballowreopen" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['allow_reopen'] == "no") { echo 'checked="checked"'; }?>><label for="wptballowreopen2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
				 	</p>
					</br>
						<p class="sub"><em><?php _e('This allows the user to close and reopen the TopBar.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Re-openable TopBar should start Open or Closed','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio8" class="ui-button ui-button-wptbset">
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
					<td ><?php _e('Enable Cookies','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio9" class="ui-button ui-button-wptbset">
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
					<td ><?php _e('Cookie Value','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbcookievalue" id="cookievalue" size="10" value="<?php echo wptb::wptb_stripslashes($wptbOptions['cookie_value']); ?>" >
					<?php	
						if ( $wptbOptions['past_cookie_values'] != "" ) {
							echo '<p>'.__('Your previous cookie value was','wp-topbar').': '.$wptbOptions['past_cookie_values'];
						}
					?>
					</br>
					<p class="sub"><em><?php _e('Change this value to force the cookie to reshow.  Default is <code>1</code>','wp-topbar'); ?></em></p>
					<p class="sub"><em><?php _e('See the:','wp-topbar'); ?><a href='?page=wp-topbar.php&action=faq&barid=<?php echo ($wptb_barid_prefix+$wptbOptions['bar_id']); ?>'><?php _e('FAQ','wp-topbar'); ?></a>.</em></p>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td ><?php _e('Enter the CSS for the Close Button','wp-topbar'); ?>:</label></td>
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
					<td ><?php _e('Enter the CSS for the Reopen Button','wp-topbar'); ?>:</label></td>
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
		</table>	<div class="clear"></div>	
		</div>
	</div> <!-- end of Main Options -->
	
	<?php
}	// End of wptb_all_options	



?>