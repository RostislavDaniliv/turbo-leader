<?php 

/*
Color Options Tab

i18n Compatible

*/



//=========================================================================			
// Color Selection Options
//=========================================================================			

function wptb_colorselection_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_colorselection_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';
		
	global $wp_version;
    if ( version_compare( $wp_version, "3.5", '>=' ) ) 
    	wptb_ColorPicker($wptbOptions);    
	else
		wptb_farbtastic($wptbOptions);

}	// End of wptb_colorselection_options



//=========================================================================			
// new Color Picker
//=========================================================================			

function wptb_ColorPicker($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

 	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_ColorPicker() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';
               
	?>
	
	<script type='text/javascript'>
		jQuery(document).ready(function() {
	
			jQuery('.wptb_colorpicker_bar').wpColorPicker();
			jQuery('.wptb_colorpicker_text').wpColorPicker();
			jQuery('.wptb_colorpicker_bottom').wpColorPicker();
			jQuery('.wptb_link_color').wpColorPicker();
		
		});
	</script>
	
	<div class="postbox">
										
	<h3><a name="ColorSelection"><?php _e('Color Selection','wp-topbar'); ?></a></h3>
	
	<div class="inside">
		<p class="sub"><em><?php _e('Click the color box to select the color to use.','wp-topbar'); ?></em></p>
		<div class="table">
			<table class="form-table">	
				<tr valign="top">
					<td width="200"><?php _e('Color of the Bar','wp-topbar'); ?>:</label></td>
					<td>
				      <input type="text" class="wptb_colorpicker_bar" id="barcolor" name="wptbbarcolor" value="<?php echo $wptbOptions['bar_color']; ?>">
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the bottom border of the Bar','wp-topbar'); ?>:</label></td>
					<td>
				      <input type="text" class="wptb_colorpicker_bottom" id="bottomcolor" name="wptbbottomcolor" value="<?php echo $wptbOptions['bottom_color']; ?>">
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the Message','wp-topbar'); ?>:</label></td>
					<td>
					    <input type="text" class="wptb_colorpicker_text" id="textcolor" name="wptbtextcolor" value="<?php echo $wptbOptions['text_color']; ?>">
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the Link','wp-topbar'); ?>:</label></td>
					<td>
					    <input type="text" class="wptb_link_color" id="linkcolor" name="wptblinkcolor" value="<?php echo $wptbOptions['link_color']; ?>">
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
		</table>
		<div class="clear"></div>	
		</div>
	</div> <!-- end of ColorSelection Settings -->
	
	<?php

}	// End of wptb_ColorPicker


//=========================================================================			
// Old Color Picker
//=========================================================================			

function wptb_farbtastic($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_farbtastic() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';
                
	?>
	
	<script type='text/javascript'>
	jQuery(document).ready(function() {

		jQuery('.wptb_colorpicker_bar').hide();
		jQuery('.wptb_colorpicker_bar').farbtastic('#barcolor');
		jQuery('#barcolor').click(function(){jQuery('.wptb_colorpicker_bar').slideDown()});
		jQuery('#barcolor').blur(function(){jQuery('.wptb_colorpicker_bar').slideUp()});
	
		jQuery('.wptb_colorpicker_text').hide();
		jQuery('.wptb_colorpicker_text').farbtastic('#textcolor');
		jQuery('#textcolor').click(function(){jQuery('.wptb_colorpicker_text').slideDown()});
		jQuery('#textcolor').blur(function(){jQuery('.wptb_colorpicker_text').slideUp()});
	
		jQuery('.wptb_colorpicker_bottom').hide();
		jQuery('.wptb_colorpicker_bottom').farbtastic('#bottomcolor');
		jQuery('#bottomcolor').click(function(){jQuery('.wptb_colorpicker_bottom').slideDown()});
		jQuery('#bottomcolor').blur(function(){jQuery('.wptb_colorpicker_bottom').slideUp()});
		
		jQuery('.wptb_link_color').hide();
		jQuery('.wptb_link_color').farbtastic('#linkcolor');
		jQuery('#linkcolor').click(function(){jQuery('.wptb_link_color').slideDown()});
		jQuery('#linkcolor').blur(function(){jQuery('.wptb_link_color').slideUp()});	
	
	});
	</script>	
	
	<div class="postbox">
										
	<h3><a name="ColorSelection"><?php _e('Color Selection','wp-topbar'); ?></a></h3>
	
	<div class="inside">
		<p class="sub"><em><?php _e('Click the color box to select the color to use.','wp-topbar'); ?></em></p>
		<div class="table">
			<table class="form-table">	
				<tr valign="top">
					<td width="200"><?php _e('Color of the Bar','wp-topbar'); ?>:</label></td>
					<td>
				      <input type="text" id="barcolor" name="wptbbarcolor" value="<?php echo $wptbOptions['bar_color']; ?>">
				      <div class="wptb_colorpicker_bar"></div>		
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the bottom border of the Bar','wp-topbar'); ?>:</label></td>
					<td>
				      <input type="text" id="bottomcolor" name="wptbbottomcolor" value="<?php echo $wptbOptions['bottom_color']; ?>">
				      <div class="wptb_colorpicker_bottom"></div>			
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the Message','wp-topbar'); ?>:</label></td>
					<td>
					    <input type="text" id="textcolor" name="wptbtextcolor" value="<?php echo $wptbOptions['text_color']; ?>">
					    <div class="wptb_colorpicker_text"></div>				    
					</td>
				</tr>
				<tr valign="top">
					<td width="200"><?php _e('Color of the Link','wp-topbar'); ?>:</label></td>
					<td>
					    <input type="text" id="linkcolor" name="wptblinkcolor" value="<?php echo $wptbOptions['link_color']; ?>">
					    <div class="wptb_link_color"></div>
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
		</table>
		<div class="clear"></div>	
		</div>
	</div> <!-- end of ColorSelection Settings -->
	
	<?php

}	// End of wptb_farbtastic




?>