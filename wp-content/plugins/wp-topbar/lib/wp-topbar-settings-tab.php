<?php 

/*
Close Options Tab

i18n Compatible

*/


//=========================================================================			
// Close Button Options
//=========================================================================			


function wptb_globalsettings_options() {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;   
			
	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_globalsettings_options()</code>';
	
	$wptbGlobalOptions = wptb::wptb_get_GlobalSettings();
	
	?>
	
	<div class="postbox">
										
	<h3><a name="CloseButton"><?php _e('Global Settings','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('This page contains the Global Settings that effect all TopBars.','wp-topbar'); ?></em>
		<br>
		</p>
		
		<div class="table">
			<table class="form-table">	
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Rotate TopBars','wp-topbar'); ?>:</label></td>
					<td width="300">
					 	<p id="radio1" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbrotatetopbars1" name="wptbrotatetopbars" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbGlobalOptions [ 'rotate_topbars' ] == "yes") { echo 'checked="checked"'; }?>><label for="wptbrotatetopbars1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbrotatetopbars2" name="wptbrotatetopbars" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbGlobalOptions [ 'rotate_topbars' ] == "no") { echo 'checked="checked"'; }?>><label for="wptbrotatetopbars2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>						
					</td>
					<td>
						<p class="sub"><em><?php _e('TopBars will rotate, after a user set delay.  Note that the Scrollable Option, Close Button and Re-Open options on each TopBar are ignored.  That is, the TopBars that are displayed will not be Scrollable nor can they be Closed (or Reopened).  Default is <code>No</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Rotation Start Delay','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbrotatestartdelay" id="rotatestartdelay" size="30" value="<?php echo $wptbGlobalOptions [ 'rotate_start_delay' ]; ?>" >
						<div id="wptb-rotatestartdelay"></div>
					</td>
					<td>
						<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to delay before displaying each TopBar.  No TopBar will be displayed during this time.  Enter 0 for no delay. Default is <code>1000</code>','wp-topbar'); ?>.</em></p>
					</td>
				</tr>					
				<tr valign="top">
					<td width="150"><?php _e('Rotation Display Time','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbrotatedisplaytime" id="rotatedisplaytime" size="30" value="<?php echo $wptbGlobalOptions [ 'rotate_display_time' ]; ?>" >
						<div id="wptb-rotatedisplaytime"></div>
					</td>
					<td>
						<p class="sub"><em><?php _e('Enter the amount of time (in milliseconds) for the TopBar to display before rotating for the next TopBar.  Enter 0 for no delay (not recommended!)  Default is <code>9000</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>	
				<tr valign="top">
					<td width="150"><?php _e('Rotation Count','wp-topbar'); ?>:</td>
					<td>
						<input type="text" name="wptbrotatecount" id="rotatecount" size="30" value="<?php echo $wptbGlobalOptions [ 'rotate_count' ]; ?>" >
						<div id="wptb-rotatecount"></div>
					</td>
					<td>
						<p class="sub"><em><?php _e('Enter the number of times the TopBar should be shown.  Enter 0 to continuously rotate.  Default is <code>0</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>					
				<tr valign="top">
					<td width="150"><?php _e('Hide Last TopBar on Rotation','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio2" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbrotatehidelast1" name="wptbrotatehidelast" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbGlobalOptions [ 'rotate_hide_last' ] == "yes") { echo 'checked="checked"'; }?>><label for="wptbrotatehidelast1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbrotatehidelast2" name="wptbrotatehidelast" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbGlobalOptions [ 'rotate_hide_last' ] == "no") { echo 'checked="checked"'; }?>><label for="wptbrotatehidelast2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
						</p>						
					</td>
					<td>
						<p class="sub"><em><?php _e('If you have selected to limit the number of TopBars that are shown in rotation, this option determines whether the last TopBar is hidden or stays on the the page.  Default is <code>Yes</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>						
				<tr valign="top">
					<td width="150"><?php _e('Rotate Order','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio3" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbrotateorder1" name="wptbrotateorder" class="ui-helper-hidden-accessible" value="random" <?php if ($wptbGlobalOptions [ 'rotate_order' ] == "random") { echo 'checked="checked"'; }?>><label for="wptbrotateorder1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Random Order','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbrotateorder2" name="wptbrotateorder" class="ui-helper-hidden-accessible" value="priority" <?php if ($wptbGlobalOptions [ 'rotate_order' ] == "priority") { echo 'checked="checked"'; }?>><label for="wptbrotateorder2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('By Priority','wp-topbar'); ?></span></label>
						</p>						
					</td>
					<td>
						<p class="sub"><em><?php _e('This selects the order that the TopBars will be shown:</br>&nbsp;&nbsp;<strong>Random Order</strong> selects them in a random order. Then rotates through them in that order (and thus, is not cacheable.).</br>&nbsp;&nbsp;<strong>Priority Order</strong> selects them in descending order of priority.</br>&nbsp;Default is <code>Priority Order</code>','wp-topbar'); ?></em></p>
					</td>
				</tr>				
				<tr>
					<td colspan="3"><hr></td>
				</tr>		
				<tr valign="top">
					<th scope="row"><?php _e('Custom Samples URL','wp-topbar'); ?>:</th>
					<td colspan="3">
					<input name="wptbcustompath" type="text" size="85" id="custompath" value="<?php echo $wptbGlobalOptions [ 'custom_samples_path' ]; ?>" />
					<br /><em><?php _e('Enter the URL of a directory where a JSON file and related images are stored. These will be included in the Samples Tab.  You must name the JSON file <code>custom_topbars.json</code>','wp-topbar'); ?>.</em>
					<br><br><?php _e('For example, the Directory could be named'); ?>: <code><?php echo str_ireplace( 'wp-topbar','wp-topbar-samples',str_ireplace( 'https://','http://',plugins_url('/', dirname(__FILE__)) )); ?></code>					
					<br>
					<br><?php _e('To create your own Samples, export your existing TopBars in JSON format. Then rename that file to <code>custom_topbars.json</code>. Now move that file, plus any images you need into the directory you entered above.'); 
					
					if ($wptbGlobalOptions [ 'custom_samples_path' ] != "")	{
						$file_data2 = file_get_contents( $wptbGlobalOptions [ 'custom_samples_path' ].'custom_topbars.json' );
						if (! is_array(json_decode($file_data2,2) ) )
							echo "<br /><strong>".__('Your <code>custom_topbars.json</code> file does not appear to be formatted correctly or is missing.  It does not appear to be a JSON formatted file.'); 
					}
					?>
					</label></td>
				</tr>				
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Show TopBar Overview on Admin Pages','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio4" class="ui-button ui-button-wptbset">
							<input type="radio" id="wptbshowoverview1" name="wptbshowoverview" class="ui-helper-hidden-accessible" value="on" <?php if ($wptbGlobalOptions [ 'show_overview' ] == "on") { echo 'checked="checked"'; }?>><label for="wptbshowoverview1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('On','wp-topbar'); ?></span></label>
							<input type="radio" id="wptbshowoverview2" name="wptbshowoverview" class="ui-helper-hidden-accessible" value="off" <?php if ($wptbGlobalOptions [ 'show_overview' ] == "off") { echo 'checked="checked"'; }?>><label for="wptbshowoverview2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Off','wp-topbar'); ?></span></label>
						</p>						
					</td>
					<td>
						<p class="sub"><em><?php _e("If you don't need the Overview shown, you can turn off the Overview section on the Admin pages.  Default is <code>on</code>",'wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>	
		</table>
		</div>
		<table>
		<tr>
			<td colspan="3" style="valign:top;"><p class="submit">
				<input type="submit" style="<?php echo $wptb_submit_style; ?>" name="update_wptbGlobalSettings" value="<?php _e('Update Settings', 'wp-topbar') ?>" />
				<input type="button" class="button" style="<?php echo $wptb_button_style; ?>" value="<?php _e('Back to Top', 'wp-topbar') ?>" onClick="parent.location='#Top'">
			</td>
		</tr>
		</table>
		
		<div class="clear"></div>	
		</div>
	</div> <!-- end of Settings -->
						
<?php

	wptb_display_debug_info(__('Server/Install Info','wp-topbar'), false);

}	// End of wptb_globalsettings_options



?>