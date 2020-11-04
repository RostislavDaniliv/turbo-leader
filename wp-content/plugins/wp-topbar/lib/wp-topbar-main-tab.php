<?php 

/*
Main Options Tab

i18n Compatbile 

*/


//=========================================================================			
// Main Options
//=========================================================================			


		
function wptb_main_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_main_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';
			    
	?>

 	<div class="postbox">
	<h3><a name="MainOptions"><?php _e('Main Options','wp-topbar'); ?></a></h3>
	<div class="inside">
		<div class="table">
			<table class="form-table">
				<input name="wptb_update_setting_nonce" type="hidden" value="<?php wp_create_nonce('wptb_update_setting_nonce'); ?>" />			
				<tr valign="top">
					<td width="150" id="prioritytop"><?php _e('Priority','wp-topbar'); ?>:</td>
					<td width="300">
						<input type="text" name="wptbpriority" id="priority" size="4" value="<?php echo $wptbOptions['weighting_points']; ?>" >
						<div id="wptb-priority"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the relative priority (1 to 100) for the TopBar to show.  A higher number means this TopBar will be selected more frequently; a lower number means less frequently.  (See the FAQ for more details.) Default is <code>25</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>			
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150" id="location"><?php _e('TopBar Location','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio2" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbtopbarpos1" name="wptbtopbarpos" class="ui-helper-hidden-accessible" value="header" <?php if ($wptbOptions['topbar_pos'] == "header") { echo 'checked="checked"'; }?>><label for="wptbtopbarpos1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Above Header','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbtopbarpos2" name="wptbtopbarpos" class="ui-helper-hidden-accessible" value="footer" <?php if ($wptbOptions['topbar_pos'] == "footer") { echo 'checked="checked"'; }?>><label for="wptbtopbarpos2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Below Footer','wp-topbar'); ?></span></label>
				 	</p>
					</td>
					<td>
							<p class="sub"><em><?php _e('Select where you want to TopBar to be located. Default is <code>Above Header</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>	
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150" id="location"><?php _e('Force TopBar to Be Fixed On Top of Page','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio3" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbforcedfixed1" name="wptbforcedfixed" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['forced_fixed'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbforcedfixed1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbforcedfixed2" name="wptbforcedfixed" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['forced_fixed'] == "no") { echo 'checked="checked"'; }?>><label for="wptbforcedfixed2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
				 	</p>
					</td>
					<td>
							<p class="sub"><em><?php _e('This will force the TopBar to be fixed to the top of the page, regardless of what you put in the Custom CSS settings. For non-scrolling TopBars, this option will also push down your page to ensure the TopBar is always at the top of the page.  This option is ignored if you are Rotating TopBars.  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>					
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150" id="scrollaction"><?php _e('Scroll Action','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio4" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbscrollaction1" name="wptbscrollaction" class="ui-helper-hidden-accessible" value="on"  <?php if ($wptbOptions['scroll_action'] == "on") { echo 'checked="checked"'; }?>><label for="wptbscrollaction1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('On','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbscrollaction2" name="wptbscrollaction" class="ui-helper-hidden-accessible" value="off" <?php if ($wptbOptions['scroll_action'] != "on") { echo 'checked="checked"'; }?>><label for="wptbscrollaction2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Off','wp-topbar'); ?></span></label>
				 	</p>
					</td>
					<td>
							<p class="sub"><em><?php _e('Only show the TopBar when the user scrolls the page?  If the user scrolls back to the top of the page, the TopBar gracefully fades away.  Note, if this is to On, the TopBar ignores the Display Time value below.</br></br>Also, <strong>it works best</strong> when the Forced TopBar Option (above) is set to <code>yes</code> or the CSS has the <code>position</code> fixed: e.g. <code>position:fixed; top: 40; padding:0; margin:0; width: 100%; z-index: 99999;</code>.</br></br>Default is <code>Off</code>, this will show the scrollbar even if the user does not scroll the page.  See:','wp-topbar'); ?> <a <?php echo 'href="?page=wp-topbar.php&action=topbarcss&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'#divcss"'; ?>>TopBar CSS & HTML Tab - Option C</a></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Scroll Amount','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbscrollamount" id="scrollamount" size="30" value="<?php echo $wptbOptions['scroll_amount']; ?>" >
						<div id="wptb-scroll-amount"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('This option allows you to adjust how far the user has to scroll the page before the Scrollable TopBar appears.   Selecting 0 (zero) will display the TopBar immediately after the user scrolls the page.</br></br>Default is <code>0</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Start Delay','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbdelayintime" id="delayintime" size="30" value="<?php echo $wptbOptions['delay_time']; ?>" >
						<div id="wptb-delayintime"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to delay before appearing.  Enter 0 for no delay.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Slide Time','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbslidetime" id="slidetime" size="30" value="<?php echo $wptbOptions['slide_time']; ?>" >
						<div id="wptb-slidetime"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to take to slide down on the page.  Enter 0 for no delay.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Display Time','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbdisplaytime" id="displaytime" size="30" value="<?php echo $wptbOptions['display_time']; ?>" >
						<div id="wptb-displaytime"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to remain on the page.  <strong>This option is ignored if you set the TopBar to be Reopened</strong> Enter 0 for the TopBar to not disappear.','wp-topbar'); ?></em></p>
					</td>
				</tr>							
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Bottom border height (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbbottomborderheight" id="bottomborderheight" size="5" value="<?php echo $wptbOptions['bottom_border_height']; ?>" >
						<div id="wptb-bottomborderheight"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the height of the bottom of the border.  Default is <code>3px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Top padding (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbpaddingtop" id="paddingtop" size="5" value="<?php echo $wptbOptions['padding_top']; ?>" >
						<div id="wptb-paddingtop"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the top padding.  Default is <code>8px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>			
				<tr valign="top">
					<td width="150"><?php _e('Bottom padding (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbpaddingbottom" id="paddingbottom" size="5" value="<?php echo $wptbOptions['padding_bottom']; ?>" >
						<div id="wptb-paddingbottom"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the bottom padding.  Default is <code>8px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>		
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Top margin (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbmargintop" id="margintop" size="5" value="<?php echo $wptbOptions['margin_top']; ?>" >
						<div id="wptb-margintop"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the top margin.  Default is <code>0px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>			
				<tr valign="top">
					<td width="150"><?php _e('Bottom margin (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbmarginbottom" id="marginbottom" size="5" value="<?php echo $wptbOptions['margin_bottom']; ?>" >
						<div id="wptb-marginbottom"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the bottom margin.  Default is <code>0px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>	
				<tr valign="top">
					<td width="150"><?php _e('Left margin (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbmarginleft" id="marginleft" size="5" value="<?php echo $wptbOptions['margin_left']; ?>" >
						<div id="wptb-marginleft"></div>
					</td>
					<td>
							<p class="sub"><em><?php _e('Enter the left margin.  Default is <code>0px</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>	
				<tr valign="top">
					<td width="150"><?php _e('Right margin (px)','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbmarginright" id="marginright" size="5" value="<?php echo $wptbOptions['margin_right']; ?>" >
						<div id="wptb-marginright"></div>
					</td>
					<td>
							<p class="sub"><em>;<?php _e('Enter the right margin.  Default is <code>0px</code>;','wp-topbar'); ?></em></p>
					</td>
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
}	// End of wptb_main_options	



?>