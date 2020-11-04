<?php 

/*
PHP Options Tab

i18n Compatible

*/


//=========================================================================			
// PHP Options
//=========================================================================			



function wptb_php_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_php_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>
		
	<div class="postbox">
										
	<h3><a name="phptexttab"><?php _e('PHP Text','wp-topbar'); ?></a></h3>
										
	<div class="inside">
		<p class="sub"><em><?php _e('These are the settings to allow you to have custom PHP to be executed when the TopBar is created.'.
		'</br></br><strong>THIS CAN BE SUPER DANGEROUS.  READ THIS CAREFULLY</strong>'.
		'</br></br>How does this work?  The code entered in the fields below are evaluated (using the php <code>eval()</code> function).'.
		'</br></br>The plugin works by generating each TopBar in a single <code>&lt;div&gt;....&lt;/div&gt;</code> container.'.
		'</br>The "BEFORE" code you enter below is evaluated <strong>after</strong> the starting <code>&lt;div&gt;</code> tag.'.
		'</br>While the "AFTER" code you enter below is evaluated <strong>before</strong> the closing <code>&lt;/div&gt;</code> tag'); ?>
		
		</br>
		<p class="sub"><em><?php _e('The new "CONTROL" code is used to select which TopBars are selected to be shown. It gives you even more control on which TopBars are chosen to be displayed.  Follow the instructions below on how to use it.'); ?>
	
		</br>
		
		<p class="sub"><em><?php _e('Enter any invalid PHP code, and you can BREAK your website.  Do not enter the code in PHP tags, i.e. <code>&lt;?php  echo "Hi!";  ?&gt;</code>.'.
		'</br>You just enter any valid PHP, for example: <code>echo "Hello World!";</code>.'.
		'</br>Do you want to enter HTML instead of PHP?  Just exit and and reenter PHP mode though using the appropriate PHP tags, e.g. <code>echo "In PHP mode!"; ?&gt; <strong>enter HTML here</strong> &lt?php echo "Back in PHP mode!";</code>.'.
		'</br></br><strong>Make sure to always end in PHP mode!</strong>'.
		'</br></br>The passed code must be valid PHP. This includes terminating all statements using a semicolon. <code>echo "Hi!"</code> for example will cause a parse error, whereas <code>echo "Hi!";</code> will work.'.
		'</br>A return statement will immediately terminate the evaluation of the code.'.
		'</br></br>The code will be executed in the scope of the code calling eval(). Thus any variables defined or changed in the eval() call will remain visible after it terminates.  Here is a list of the main variables that are used to display the TopBar that can be modified by the <strong>"BEFORE"</strong> PHP','wp-topbar'); ?>:
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['bar_text']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['link_color']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['custom_css_text']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['bar_link']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['link_target']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['bar_link_text']	
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['social_icon1'] and $wptbOptions['social_icon1_image'] 
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['social_icon2'] and $wptbOptions['social_icon2_image'] 
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['social_icon3'] and $wptbOptions['social_icon3_image'] 
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['social_icon4'] and $wptbOptions['social_icon4_image'] 
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['close_button_image']
		</br>&nbsp;&nbsp;&nbsp;&nbsp;$wptbOptions['close_button_css']
		</br>
		</br><?php _e('You can use the <strong>Live Preview</strong> (found above) to see your results (of course, you must update the settings to see any changes.)','wp-topbar'); ?>
		</br></br><?php _e('Note:  If you have multiple TopBars, this PHP code is ALWAYS executed when the HTML is generated for each TopBar (even if that TopBar is not randomly selected to be shown on your website.)','wp-topbar'); ?></em>
		</br></br>
		
		<div class="table">
			<table class="form-table">
				<tr>
					<td colspan="2">
					<hr>
					<h3><strong><?php _e('USE AT YOUR OWN RISK','wp-topbar'); ?></strong></h3>
					</td>
				</tr>	
				<tr>
					<td colspan="2">
					<?php _e('Sample PHP code to use in the "BEFORE" code: Check if a user is logged in, if so then customize the TopBar text -- otherwise add a second topbar','wp-topbar'); ?>:
					</br>
					<textarea rows="10" cols="150" style="background:lightyellow">
if ( is_user_logged_in() ) {
  global $current_user;
  get_currentuserinfo();
  $wptbOptions['bar_text'] = $current_user->display_name.", ".  $wptbOptions['bar_text'];
}
else echo 'Generate a second link with this code and get your own TopBar <a style="color:#c00000; " href="http://wordpress.org/extend/plugins/wp-topbar/" target="_blank">from the Wordpress plugin repository</br></a>';		
</textarea>
					</td>
				</tr>
				<tr valign="top">
					<td width="150" colspan="2"><strong><?php _e('Enter any PHP to use BEFORE the TopBar is generated','wp-topbar'); ?>:</strong></label></td>
				</tr>
				<tr valign="top" >
					<td colspan="2">
					<textarea name="wptbphptextprefix" id="phptextprefix" rows="10" cols="150"><?php echo wptb::wptb_stripslashes($wptbOptions['php_text_prefix']); ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<hr>
					</td>
				</tr>					
				<tr valign="top">
					<td width="150" colspan="2"><strong><?php _e('Enter any PHP to use AFTER the TopBar is generated','wp-topbar'); ?>:</strong></label></td>
				</tr>
				<tr valign="top" >
					<td colspan="2">
					<textarea name="wptbphptextsuffix" id="phptextsuffix" rows="10" cols="150"><?php echo wptb::wptb_stripslashes($wptbOptions['php_text_suffix']); ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<hr>
					</td>
				</tr>					
				<tr valign="top">
					<td width="150" colspan="2"><strong><?php _e('Enter any PHP function to Control if the the TopBar is selected to be shown. Have your function set <code>$wptbControlExit = true;</code> if you want the TopBar to not be selected.  This OVERRIDES every other control option available on the Control tab.','wp-topbar'); ?></strong></label></td>
				</tr>
				<tr>
					<td colspan="2">
					<?php _e('Sample PHP code to use for the "CONTROL" code: Use this to only display this TopBar only between 7PM and 10PM, use this code','wp-topbar'); ?>:
					</br>
					<textarea rows="7" cols="150" style="background:lightyellow">
//$hour = date("H", current_time('timestamp', 1));     // use GMT time
$hour = date("H", current_time('timestamp', 0));       // use local time
					
if  ( ( ($hour >= 19) && ($hour < 22) ) )
	$wptbControlExit = false;
else
	$wptbControlExit = true;</textarea>
					</td>
				</tr>
				<tr valign="top" >
					<td colspan="2">
					<textarea name="wptbphptextcontrol" id="phptextcontrol" rows="10" cols="150"><?php echo wptb::wptb_stripslashes($wptbOptions['php_text_control']); ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<hr>
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
	</div> <!-- end of PHP Button Settings -->
	
	<?php 
}	// End of wptb_php_options 



?>