<?php 

/*
CSS & HTML Options Tab

i18n Compatible

*/



//=========================================================================			
// TopBar CSS & HTML Options
//=========================================================================			

function wptb_topbarcss_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_topbarcss_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>
	
	<div class="postbox">
	<h3><a name="topbarcss"><?php _e('TopBar CSS & HTML','wp-topbar'); ?></a></h3>
	<div class="inside">
		<em><p class="sub"><?php _e("Enter any custom CSS and HTML for the TopBar.  This allows you to add padding, font styles & more.  Be really careful here -- this could break your website!  Test this with multiple browsers to make sure it works across them all. Double-quotes are automatically replaced with single quotes.<p><strong>Don't forget the trailing semi-colon.</strong>",'wp-topbar'); ?></p>
		<?php _e('Create a custom CSS gradient at colorzilla.com','wp-topbar'); ?>:
		<a class="button" style="<?php echo $wptb_cssgradient_style; ?>" href="http://www.colorzilla.com/gradient-editor/" target="_blank">http://www.colorzilla.com/gradient-editor/</a>	
		</p>
		</em>
		<em><p><strong><?php _e('How these options work','wp-topbar'); ?>:</strong>
		</br>
		<?php _e("The TopBar is displayed within it's own <em>div</em> containers",'wp-topbar'); ?>:
		</br>
		<p style="padding-left:5em">
		&lt;div id="topbar" style="<strong><?php _e('CSS Option C','wp-topbar'); ?></strong>"&nbsp;&nbsp;&nbsp;<strong><?php _e('HTML Option C','wp-topbar'); ?></strong>&gt;</br>
		&nbsp;&nbsp;&nbsp;&lt;div id="wptbheadline1" style="<strong><?php _e('CSS Option A','wp-topbar'); ?></strong>"&nbsp;&nbsp;&nbsp;<strong><?php _e('HTML Option A','wp-topbar'); ?></strong>&gt;Your TopBar Text Goes Here</br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a style="<strong><?php _e('CSS Option B','wp-topbar'); ?></strong>"&nbsp;&nbsp;&nbsp;<strong><?php _e('HTML Option B','wp-topbar'); ?></strong>&lt;/a&gt;</br>
		&nbsp;&nbsp;&nbsp;&lt;/div&gt;</br>
		&lt;/div&gt;</br></p>
		</em>	
		</br><?php _e('You have separate fields to enter your custom CSS and HTML below','wp-topbar'); ?>:
	</div>
	</div>
	<div class="postbox">
	<div class="inside">
		<p class="sub">
		<div class="table">
			<table class="form-table">		
				<tr valign="top">
					<td width="150"><strong><?php _e('CSS Option A','wp-topbar'); ?></strong></br><?php _e('For the Bar/Background Image:</br>(i.e. for the second &lt;DIV&gt; Tag for the TopBar)','wp-topbar'); ?></td>
					<td>
						<strong><?php _e('Examples','wp-topbar'); ?>:</strong></br>
						1. <?php _e('To make all text lowercase','wp-topbar'); ?>:&nbsp;&nbsp;&nbsp;<textarea rows="1" cols="50" style="background-color:lightyellow;">text-transform:lowercase;</textarea></br></br>
						2. <?php _e('To make all text uppercase using the Georgia Font','wp-topbar'); ?>:&nbsp;&nbsp;&nbsp;<textarea rows="2" cols="50" style="background-color:lightyellow;">text-transform:uppercase;font-family:georgia;padding-right:10px;</textarea></br></br>
						3. <?php _e('To add a gradient bar','wp-topbar'); ?>:&nbsp;&nbsp;&nbsp;<textarea rows="9" cols="140" style="background-color:lightyellow;">background: rgb(109,179,242);
background: -moz-linear-gradient(top,  rgba(109,179,242,1) 0%, rgba(84,163,238,1) 50%, rgba(54,144,240,1) 51%, rgba(30,105,222,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(109,179,242,1)), color-stop(50%,rgba(84,163,238,1)), color-stop(51%,rgba(54,144,240,1)), color-stop(100%,rgba(30,105,222,1)));
background: -webkit-linear-gradient(top,  rgba(109,179,242,1) 0%,rgba(84,163,238,1) 50%,rgba(54,144,240,1) 51%,rgba(30,105,222,1) 100%);
background: -o-linear-gradient(top,  rgba(109,179,242,1) 0%,rgba(84,163,238,1) 50%,rgba(54,144,240,1) 51%,rgba(30,105,222,1) 100%);
background: -ms-linear-gradient(top,  rgba(109,179,242,1) 0%,rgba(84,163,238,1) 50%,rgba(54,144,240,1) 51%,rgba(30,105,222,1) 100%);
background: linear-gradient(top,  rgba(109,179,242,1) 0%,rgba(84,163,238,1) 50%,rgba(54,144,240,1) 51%,rgba(30,105,222,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6db3f2', endColorstr='#1e69de',GradientType=0 );</textarea></br></br>
						4. <?php _e('To made the TopBar partially opaque','wp-topbar'); ?>:&nbsp;&nbsp;&nbsp;<textarea rows="1" cols="60" style="background-color:lightyellow;">background: transparent filter: alpha(opacity=90); opacity: 0.9;</textarea></br></br>
						5. <?php _e('To not repeat Background Image, make the TopBar 100px high & vertically center the text in the TopBar','wp-topbar'); ?>:&nbsp;&nbsp;&nbsp;<textarea rows="2" cols="60" style="background-color:lightyellow;">background-repeat:no-repeat; height:100px; line-height:100px; vertical-align:middle;</textarea></br></br>
						<strong><?php _e('Enter CSS Option A Here','wp-topbar'); ?>:</strong></br>
						<textarea name="wptbcustomcssbar" id="customcssbar" rows="10" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['custom_css_bar']); ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><strong><?php _e('CSS Option B','wp-topbar'); ?></strong></br><?php _e('For the Text Message:</br>(i.e. for the &lt;a&gt; Tag on the TopBar)','wp-topbar'); ?></td>
					<td>
						<strong><?php _e('Enter CSS Option B Here','wp-topbar'); ?>:</strong></br>
						<textarea name="wptbcustomcsstext" id="customcsstext" rows="10" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['custom_css_text']); ?></textarea>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><strong><?php _e('CSS Option C','wp-topbar'); ?></strong></br><?php _e("For the entire TopBar:</br>(i.e. at the TopBar's &lt;DIV&gt;)",'wp-topbar'); ?></td>
					<td><p><?php _e('Use this CSS to fix the TopBar to the top of the page and <strong>OVERLAY</strong> the contents of the page','wp-topbar'); ?>:<p>				
					<textarea rows="1" cols="80" style="background-color:lightyellow;">position:fixed; top: 40; padding:0; margin:0; width: 100%; z-index: 99999;</textarea>
					<p><?php _e('Or this CSS to fix the TopBar to the top of the page and <strong>PUSH</strong> the contents down','wp-topbar'); ?>:<p>				
					<textarea rows="1" cols="80" style="background-color:lightyellow;">top: 40; padding:0; margin:0; width: 100%; z-index: 99999;</textarea>
					<p><?php _e('Or this to fix the TopBar to the bottom of the page','wp-topbar'); ?>:<p>
					<textarea rows="1" cols="80" style="background-color:lightyellow;">position:fixed; bottom: 0; padding:0; margin:0; width: 100%; z-index: 99999;</textarea>
	
					<p><?php _e('Note that by putting your TopBar in a Fixed position, you will overlay the content of your website by the TopBar.','wp-topbar'); ?></p>			
					<p><strong><?php echo __('Want the push the page down AND have the TopBar fixed to the top of the page?  Then set the Forced Fixed option (on the Main Tab) to <code>on</code> See:','wp-topbar').' <a href="?page=wp-topbar.php&action=main&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'">Main Options</a></strong></p></br>';?>
					
					
					<strong><?php _e('Enter CSS Option C Here','wp-topbar'); ?>:</strong></br>
					<textarea name="wptbdivcss" id="divcss" rows="10" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['div_css']); ?></textarea>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td colspan="2">
					    <br/><?php _e("Enter your custom HTML below.  Note you <strong>MUST</strong> use only double quotes (&quot;); do <strong>NOT</strong> use single quotes (') for they will break the TopBar",'wp-topbar'); ?>:<br/>
						<em><p><strong><?php _e('How these options work','wp-topbar'); ?>:</strong>
						</br>
						<?php _e("The TopBar is displayed within it's own <em>div</em> containers",'wp-topbar'); ?>:
						</br>
						<p style="padding-left:5em">
						&lt;div id="topbar" style="<strong>CSS Option C</strong>"&nbsp;&nbsp;&nbsp;<strong>HTML Option C</strong>&gt;</br>
						&nbsp;&nbsp;&nbsp;&lt;div id="wptbheadline1" style="<strong>CSS Option A</strong>"&nbsp;&nbsp;&nbsp;<strong>HTML Option A</strong>&gt;Your TopBar Text Goes Here</br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a style="<strong>CSS Option B</strong>"&nbsp;&nbsp;&nbsp;<strong>HTML Option B</strong>&lt;/a&gt;</br>
						&nbsp;&nbsp;&nbsp;&lt;/div&gt;</br>
						&lt;/div&gt;</br></p>
						</em>	
				</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><strong><?php _e('HTML Option A','wp-topbar'); ?></strong></br><?php _e('For the Bar/Background Image:</br>(i.e. for the second &lt;DIV&gt; Tag on the TopBar)','wp-topbar'); ?></td>
					<td><p><?php _e('Use this add custom HTML to the second DIV tag for the TopBar','wp-topbar'); ?>:
					<p><strong><?php _e('Example','wp-topbar'); ?>:</strong></p><p>			
					<textarea rows="1" cols="80" style="background-color:lightyellow;">name="mytopbarname"</textarea>
					</p>
					<strong><?php _e('Enter HTML Option A Here','wp-topbar'); ?>:</strong></br>
					<textarea name="wptbbarcustomhtml" id="htmla" rows="5" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['bar_custom_html']); ?></textarea>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><strong><?php _e('HTML Option B','wp-topbar'); ?></strong></br><?php _e('For the Link:</br>(i.e. for the &lt;a&gt; Tag on the TopBar)','wp-topbar'); ?></td>
					<td><p><?php _e('Use this add custom HTML to the link tag (&lt;a&gt;)','wp-topbar'); ?>:
					<p><strong><?php _e('Example','wp-topbar'); ?>:</strong></p><p>	
					<textarea rows="1" cols="80" style="background-color:lightyellow;">rel="lightbox"</textarea>
					</p>
					<strong><?php _e('Enter HTML Option B Here','wp-topbar'); ?>:</strong></br>
					<textarea name="wptblinkcustomhtml" id="htmlb" rows="5" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['bar_link_custom_html']); ?></textarea>
					</td>
				</tr>	
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr valign="top">
					<td width="150"><strong><?php _e('HTML Option C','wp-topbar'); ?></strong></br>For the entire TopBar:</br>(i.e. at the TopBar's &lt;DIV&gt;)</td>
					<td><p><?php _e('Use this add custom HTML to the main DIV tag for the TopBar','wp-topbar'); ?>:
					<p><strong><?php _e('Example','wp-topbar'); ?>:</strong></p><p>
					<?php _e('This will trigger the <em>onmouseover</em> DOM event and execute custom JavaScript code.  That code needs to be loaded by your theme or another method.','wp-topbar'); ?></p><p>			
					<textarea rows="1" cols="80" style="background-color:lightyellow;">onmouseover="YourCustomJavaScriptCode"</textarea>
					</p>
					<strong><?php _e('Enter HTML Option C Here','wp-topbar');?>:</strong></br>
					<textarea name="wptbdivcustomhtml" id="htmlc" rows="5" cols="100"><?php echo wptb::wptb_stripslashes($wptbOptions['div_custom_html']); ?></textarea>
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

		</table
		
		<div class="clear"></div>	
		</div>
	</div> <!-- end of CSS Settings -->
	
	<?php
}	// End of wptb_topbarcss_options





?>