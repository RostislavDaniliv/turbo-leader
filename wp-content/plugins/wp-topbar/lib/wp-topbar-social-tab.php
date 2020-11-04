<?php 

/*
Social Tab

i18n Compatible
 
*/



//=========================================================================			
// Social Button Options
//=========================================================================			


function wptb_socialbutton_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_socialbutton_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>

	<div class="postbox">
										
	<h3><a name="SocialButtons"><?php _e('Social Button Settings','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('These are the settings for settings the Social Buttons.','wp-topbar'); ?>
		<br><br><?php _e('You have 10 buttons that you can add to the TopBar.  Each allows you to set the image, link and CSS.  The CSS is applied to the <code>&lt img &gt</code> tag.','wp-topbar'); ?>
		<br>
		<br><em><?php _e('Link Target Options','wp-topbar'); ?>:
		<p class="sub"><em><?php _e('Select how you want the link to open','wp-topbar'); ?>:</em></</p>
		<p><?php echo '&nbsp;&nbsp;&nbsp;_blank - '.__('Opens the linked document in a new window or tab (this is default)', 'wp-topbar') ?></p>
		<p><?php echo '&nbsp;&nbsp;&nbsp;_self - '.__('Opens the linked document in the same frame as it was clicked', 'wp-topbar') ?></p>
		<p><?php echo '&nbsp;&nbsp;&nbsp;_parent -	'.__('Opens the linked document in the parent frame', 'wp-topbar') ?></p>
		<p><?php echo '&nbsp;&nbsp;&nbsp;_top - '.__('Opens the linked document in the full body of the windowtext to align.', 'wp-topbar') ?></p>
		<br>
		
		<div class="table">
			<table class="form-table">	
				<tr valign="top">
					<th scope="row"><?php _e('Social Icons','wp-topbar'); ?>:</th>
				</tr>

				<?php
				
			for ($i=1; $i<=10; $i++)  {
			
				if (! isset($wptbOptions['social_icon'.$i.'_position']) ) {
					$wptbOptions['social_icon'.$i.'_position'] = "right";
				}
				
				
				echo '
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr>
				<td valign="top">
				&nbsp;&nbsp;&nbsp;&nbsp;'.__('Social Icon','wp-topbar').' '.$i.':<br>';
					
				if ( ! ($wptbOptions['social_icon'.$i.'_image'] == "") )  echo '<img style="float:right; margin: 0 0 15px 15px;" src="'.$wptbOptions['social_icon'.$i.'_image'].'"/>';

				
				echo '
				</td>
				<td valign="top" >
					<label for="wptb_social_icon'.$i.'"><input type="checkbox" id="wptb_social_icon'.$i.'" name="wptbsocialicon'.$i.'" value="on"';
					
				if ($wptbOptions['social_icon'.$i] == "on") { echo 'checked="checked"'; }
				echo '/> '.__('Enable','wp-topbar').'</label>
				';
						
				echo '<br>'.__('Social Icon','wp-topbar').' '.$i.' '.__('URL','wp-topbar').':&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="wptbupload_social_icon'.$i.'" type="text" size="85" name="wptbsocialicon'.$i.'image" value="'.$wptbOptions['social_icon'.$i.'_image'].'" />
					<input class="browse_upload button" id="wptbupload_social_icon'.$i.'_button" type="button" style="'.$wptb_special_button_style.'" value="Upload Image" />
					';
					
//link
				echo '	
				<br>'.__('Social Icon','wp-topbar').' '.$i.' '.__('Link','wp-topbar').':&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="wptbsocialicon'.$i.'link" id="link" size="100" value="'.wptb::wptb_stripslashes($wptbOptions['social_icon'.$i.'_link']).'" >';
//link target				
				echo '	
				<br>'.__('Social Icon','wp-topbar').' '.$i.' '.__('Link Target','wp-topbar').':&nbsp;&nbsp;&nbsp;&nbsp;
					 	<p id="radio'.$i.'" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbicon'.$i.'linktarget1" name="wptbicon'.$i.'linktarget" class="ui-helper-hidden-accessible" value="blank"';
						
				if ($wptbOptions['social_icon'.$i.'_link_target'] == "blank") { echo 'checked="checked"'; }
				echo '><label for="wptbicon'.$i.'linktarget1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_blank</span></label>
						<input type="radio" id="wptbicon'.$i.'linktarget2" name="wptbicon'.$i.'linktarget" class="ui-helper-hidden-accessible" value="self"';
				if ($wptbOptions['social_icon'.$i.'_link_target'] == "self") { echo 'checked="checked"'; };
				echo '><label for="wptbicon'.$i.'linktarget2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_self</span></label>
						<input type="radio" id="wptbicon'.$i.'linktarget3" name="wptbicon'.$i.'linktarget" class="ui-helper-hidden-accessible" value="parent"';
				if ($wptbOptions['social_icon'.$i.'_link_target'] == "parent") { echo 'checked="checked"'; };
				echo '><label for="wptbicon'.$i.'linktarget3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_parent</span></label>
						<input type="radio" id="wptbicon'.$i.'linktarget4" name="wptbicon'.$i.'linktarget" class="ui-helper-hidden-accessible" value="top"';
				if ($wptbOptions['social_icon'.$i.'_link_target'] == "top") { echo 'checked="checked"'; };
				echo '><label for="wptbicon'.$i.'linktarget4" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">_top</span></label>
					 	</p>			
				<br>';

//css					
				echo '
				<br>'.__('Social Icon','wp-topbar').' '.$i.' '.__('CSS','wp-topbar').':&nbsp;&nbsp;&nbsp;&nbsp;
					<textarea name="wptbsocialicon'.$i.'css" id="wptb_socialicon'.$i.'_css" rows="2" cols="100">'.wptb::wptb_stripslashes($wptbOptions['social_icon'.$i.'_css']).'</textarea>';
					
// position 

				echo '	
				<br>'.__('Social Icon','wp-topbar').' '.$i.' '.__('Position','wp-topbar').':&nbsp;&nbsp;&nbsp;&nbsp;
					 	<p id="radio1'.$i.'" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbicon'.$i.'position1" name="wptbicon'.$i.'position" class="ui-helper-hidden-accessible" value="left"';
						
				if ($wptbOptions['social_icon'.$i.'_position'] == "left") { echo 'checked="checked"'; }
				echo '><label for="wptbicon'.$i.'position1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">'.__('Left','wp-topbar').'</span></label>
						<input type="radio" id="wptbicon'.$i.'position2" name="wptbicon'.$i.'position" class="ui-helper-hidden-accessible" value="right"';
				if ($wptbOptions['social_icon'.$i.'_position'] == "right") { echo 'checked="checked"'; };
				echo '><label for="wptbicon'.$i.'position2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text">'.__('Right','wp-topbar').'</span></label>
					 	</p>			
				<br>';				
				
				if ( ! ($wptbOptions['social_icon'.$i.'_image'] == "") ) {
						if ( ini_get("allow_url_fopen") ) {
							list($width, $height, $type, $attr) = getimagesize($wptbOptions['social_icon'.$i.'_image']);
							if ($width != '')
								echo __('Image size','wp-topbar').': '.$width.' px (w) x '.$height.' px (h).';
						}
					}
				
				echo '
					</td>
				</tr>';


			}	
				
			?>
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
	</div> <!-- end of Social Button Settings -->
	
	<?php 	
}	// End of wptb_socialbutton_options


?>