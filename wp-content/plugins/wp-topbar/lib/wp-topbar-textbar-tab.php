<?php 

/*
Textbar Options Tab

i18n Compatible

*/


//=========================================================================			
// TopBar Text Options
//=========================================================================			


function wptb_topbartext_options($wptbOptions) {
	
	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_topbartext_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>

	<div class="postbox">
										
	<h3><a name="TopBarText"><?php _e('TopBar Text, Image and Link','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><strong><?php _e('These are the text, image and links to be used in the TopBar. The image is placed first (if any), then the text (if any) is overlaid on it.  Scale the image to fix your website.  If you enable the image (by selecting "Yes"), then the image will be used and the bar color will be ignored.','wp-topbar'); ?></strong></p>
		
		<div class="table">
			<table class="form-table">	
				<tr>
					<td colspan="3"><hr></td>
				</tr>				
				<tr valign="top">
					<td width="150"><?php _e('Font size','wp-topbar'); ?> (px):</td>
					<td>
						<input type="text" name="wptbfontsize" id="fontsize" size="5" value="<?php echo $wptbOptions['font_size']; ?>" >
						<div id="wptb-fontsize"></div>
						</br>
						<p class="sub"><em><?php _e('Enter the font size.  Default is','wp-topbar'); ?><code> 14px</code></em></p>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Text alignment','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio1" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbtextalign1" name="wptbtextalign" class="ui-helper-hidden-accessible" value="left" <?php if ($wptbOptions['text_align'] == "left") { echo 'checked="checked"'; }?>><label for="wptbtextalign1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Left','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbtextalign2" name="wptbtextalign" class="ui-helper-hidden-accessible" value="center" <?php if ($wptbOptions['text_align'] == "center") { echo 'checked="checked"'; }?>><label for="wptbtextalign2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Center','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbtextalign3" name="wptbtextalign" class="ui-helper-hidden-accessible" value="right" <?php if ($wptbOptions['text_align'] == "right") { echo 'checked="checked"'; }?>><label for="wptbtextalign3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Right','wp-topbar'); ?></span></label>
				 	</p>					
					</br>
				 	<p class="sub"><em><?php echo __('Select how you want the text to align. Default is <code>center</code> When using right -- try adding padding [e.g. <code>padding-right:10px;</code>] via the','wp-topbar')." <a href='?page=wp-topbar.php&action=topbarcss&barid=".($wptb_barid_prefix+$wptbOptions['bar_id'])."'>".__('TopBar CSS & HTML tab', 'wp-topbar'); ?></a></em></br></p>
					</td>
				</tr>				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Message','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbbartext" id="bbartext" size="85" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_text']); ?>" >
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Link Text','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptblinktext" id="linktext" size="85" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_link_text']); ?>" >
					</td>
				</tr>
				<tr valign="top">
					<td width="150"><?php _e('Link','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptblinkurl" id="link" size="100" value="<?php echo wptb::wptb_stripslashes($wptbOptions['bar_link']); ?>" >
					</td>
				</tr>
				<tr valign="top">
					<td width="50"><?php _e('Link Target','wp-topbar'); ?>:</label></td>
					<td>
					 	<p id="radio2" class="ui-button ui-button-wptbset">
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
				 	<p id="radio3" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbenableimage1" name="wptbenableimage" class="ui-helper-hidden-accessible" value="true" <?php if ($wptbOptions['enable_image'] == "true") { echo 'checked="checked"'; }?>><label for="wptbenableimage1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Yes','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbenableimage2" name="wptbenableimage" class="ui-helper-hidden-accessible" value="false" <?php if ($wptbOptions['enable_image'] == "false") { echo 'checked="checked"'; }?>><label for="wptbenableimage2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('No','wp-topbar'); ?></span></label>
					</p>					
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Image URL','wp-topbar'); ?>:</th>
					<td><label for="wptbupload_image">
					<input id="wptbupload_image" type="text" size="85" name="wptbbarimage" value="<?php echo $wptbOptions['bar_image']; ?>" />
					<input class="browse_upload button" id="wptbupload_image_button" type="button" style="<?php echo $wptb_special_button_style; ?>" value="<?php _e('Upload Image','wp-topbar'); ?>" />
					<br /><em><?php _e('Enter an URL or upload an image for the TopBar','wp-topbar'); ?>.</em)
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
	</div> <!-- end of TopBarText Settings -->
	
	<?php 	
}	// End of wptb_topbartext_options




?>