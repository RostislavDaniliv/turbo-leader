<?php 

/*
FAQ Functions
*/


//=========================================================================			
// FAQ
//=========================================================================			

function wptb_faq_page($wptbOptions,$wptbShowLinks) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    
	
   	$wptb_barid_prefix=get_transient( 'wptb_barid_prefix' );	
   	if (!$wptb_barid_prefix) $wptb_barid_prefix=rand(100000,899999);
   	set_transient( 'wptb_barid_prefix', $wptb_barid_prefix, 60*60*24 );

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_faq_page() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>
					
	<div class="postbox">
	<h3><a name="FAQ">WP-TopBar FAQ</a></h3>
	<div class="inside">		
	
	
	<ol type="square">

<li><strong>My TopBar is not working.  What should I do?</strong></li>
Use the <a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=debug&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'"'; ?>>Debug tab</a> to see how the TopBar is being generated.
</br>Check for any messages under the Live Preview heading on the Admin Page.  It will tell you if you have cookies or time settings that will prevent the TopBar from loading.
</br>You may have custom CSS or HTML settings that prevent the TopBar from loading.  If you entered any setting that are not valid, the TopBar will not load. Try deleting the settings and then re-entering your CSS or HTML until you find the one that is causing the issue.  Again, the <a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=debug&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'"'; ?>>Debug tab</a> can help you discover any issues.
</br>
</br>Finally, your Page IDs or Category selection may be preventing the TopBar from loading.  See how your settings are configured on the <a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=control&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'"'; ?>>Control tab</a>.
</br>
</br>
<li><strong>HELP!  I am using custom PHP, CSS or HTML and now my website is broken</strong></li>
Don't <strong>Panic</strong>!
</br>
You have two options to fix this:</br>
1. Append <code>&nopreview</code> to the url when you are trying to edit a TopBar.<?php if ( $wptbShowLinks )echo '  E.g. <a href="?page=wp-topbar.php&action=phptexttab&barid='.($wptbOptions['bar_id']+$wptb_barid_prefix).'&nopreview"><code>?page=wp-topbar.php&action=phptexttab&barid='.($wptbOptions['bar_id']+$wptb_barid_prefix).'&nopreview</code></a>';?>  Then reload the page. You should now be able to edit the custom php.</br>
2. Go into your database tool (usually using phpMyAdmin), find the wp-topbar table and delete the offending row.
</br>
</br>
<li><strong>There are so many options.  What order are the rendered in?</strong></li>
Here is the general order:</br><code>
&nbsp;&nbsp;&nbsp;&lt;div&gt; with CSS Option C</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div&gt; with CSS Option A</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Before</strong> Custom PHP</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Left</strong> Social Buttons</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TopBar Text</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TopBar Link with CSS Option B</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Right</strong> Social Buttons</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>After</strong> Custom PHP</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;</br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;</code>
</br>
</br>
<li><strong>How can I have my own custom TopBars show on the Samples tab?</strong></li>
First create all the TopBars you want as custom Samples.   
</br>Then export the TopBars in the JSON format.   
</br>Now, create a location on your server to store the files.   For example <code>../wp/wp-content/plugins/wp-topbar-samples</code>.
</br>Next rename the export file to <code>custom_topbars.json</code>.
</br>Now move that file, plus any images you need into the directory you created.  
</br>Finally, go to the General Settings Tab and enter the URL for the directory in the "Custom Samples URL" field.  Make sure you have "allow_url_fopen" turned on in your php.ini (otherwise, we cannot read the file.)
</br>Now, the TopBar will first display the Standard samples then the TopBars from your <code>custom_topbars.json file</code>.  
</br>You can then copy these new TopBars just like the Standard samples.
</br>
</br>
<li><strong>How does the Rotate Toolbars Global Setting work?</strong></li>
This new settings will select all the valid TopBars that can be shown on a pageview (e.g. those that match all the control, date/time criteria.)  Then it will rotate through the TopBars in priority order - with the TopBars with the highest priority shown first.   This option will override the use of Close Buttons or Re-open Buttons.  It will also ignore the Scroll Action option.   You can set the delay between TopBars on in the <a <?php if ( $wptbShowLinks ) echo "href='?page=wp-topbar.php&action=globalsettings'"; ?>>Global Settings tab</a>.
</br>
</br>
<li><strong>How do the cookies work behind the scenes?</strong></li>
If you allow the user to close the TopBar, then the plugin checks to see if you have enabled cookies.   If they are not enabled, it deletes any existing cookies.   If they are enabled, it looks to see if a cookie has been created.  A cookie is only created if the TopBar has been previously closed by the user.  If it finds a cookie and the cookie value matches the Cookie Value setting, it prevents the TopBar from showing.
</br>
If you change the Cookie Value to something new (<a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=closebutton&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'"'; ?>">on the Close Button tab</a>), the TopBar will show up again.  This is useful if you want to force the TopBar to show on new content.  Make sure to select something you haven't used before.  A good idea is to increment the value by one every time you want to force the TopBar to show.  If you use a caching plugin, make sure to clear the cache after you change the value.
</br>With Version 4.28+, <strong>all</strong> TopBars can have their out cookie value.  You can also set the TopBars to be the same by using the   <a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=bulkclosebutton"'; ?>>Close Button tab</a> on the main page
</br>
</br>
<li><strong>How does the Priority field work?</strong></li>
The Plugin randomly selects a valid TopBar to show using this field to skew how they are selected.  The TopBar multiplies a random number (between 0 and 1) with the TopBar's Priority value (which is a number between 1 to 100).  A higher number means this TopBar will be selected more frequently; a lower number means less frequently. 
</br>
</br>
<li><strong>How are TopBars selected to show?</strong></li>
See the Priority question above to see how they are selected.  The TopBar will select only those TopBars that are valid per the date/time criteria.  Once a TopBar is selected to show, it then goes through the Control Options.  That checks to see if the TopBar should be shown on the Home Page (or not) and which Page IDs or Category IDs the TopBar should show (or not).
</br>
The Final check is to see if the TopBar has cookie controls (see above).  If the user is allowed to close the TopBar and cookies are enabled, then we look for a cookie.  If one is found, and it matches the cookie value, then the TopBar is not shown.
</br>
</br>
<li><strong>What TimeZone should I use when I enter Start/Stop Times?</strong></li>
You should enter the time in the same timezone that WordPress is setup to use.  (See the WordPress|Settings|General tab).</br>  
</br>
The TopBar also prints the current WordPress time on the Control Tab right next to the Start option field.  Use that to guide how you should enter the time in.
</br>
</br>
<li><strong>What Social Button Icons are provided?</strong></li>
Look in this directory (<code><?PHP echo str_ireplace( 'https://','http://',plugins_url('/icon/', __FILE__) ) ?></code>) and you'll find two folders,  one with PNG files and one with a selection of PSD files.  Thanks to <a href="http://ElegantThemes.com" target="_blank">ElegantThemes.com</a> for providing the icon files!
</br>
</br>
<li><strong>What CSS ID's are available?</strong></li>
Use <code>#topbar</code>
</br>  
</br>
<li><strong>What if I want to have the TopBar stationary at the top of the page?</strong></li>
Use the Force TopBar to Be Fixed On Top of Page (on the <a <?php if ( $wptbShowLinks ) echo 'href="?page=wp-topbar.php&action=main&barid='.($wptb_barid_prefix+$wptbOptions['bar_id']).'"'; ?>>Main Options tab</a>).
</br>
</br>
<li><strong>What if I want to create my own Default TopBar?</strong></li>
See the file at <code><?PHP echo str_ireplace( 'https://','http://',plugins_url('/SAMPLE_wptb_custom_default_values.php', __FILE__) ) ?></code> for instructions on how to do that.
</br>
</br>
<li><strong>How do I add a Menu to the TopBar</strong></li>
Create a new menu via the standard WordPress Appearance | Menu and name it something unique, say "Translation".
</br>Now you can use that to create a menu use the PHP Option ("Before" or "After" - your choice)... using this code:</br>
<code>
$defaults = array(</br>
&nbsp;&nbsp;&nbsp;'menu' => 'Translation',</br>
&nbsp;&nbsp;&nbsp;'menu_class'  => 'wptb-menu-class',</br>
&nbsp;&nbsp;&nbsp;'container_class' => 'wptb-container-class',</br>
&nbsp;&nbsp;&nbsp;'echo' => 0</br>
);</br>
$menu = wp_nav_menu( $defaults);</br>
echo preg_replace("/\r\n|\r|\n/",'',$menu);</code>
</br></br>
You can style it using <code>.wptb-menu-class</code> or <code>.wptb-container-class</code> (whichever you prefer.)</br></br>
To make the Menu fancy, you might need to create a custom walker (see <a href="http://codex.wordpress.org/Function_Reference/wp_nav_menu">http://codex.wordpress.org/Function_Reference/wp_nav_menu</a>) on all the gory details on this WordPress function.
</br>
</br>
<li><strong>My TopBar does not support my local language</strong></li>
The problem is with your table collation. You need to change the collation to utf8_general_ci.</br>
Run this query from your phpMyAdmin to change the collation.</br>
</br>
<code>ALTER TABLE 'DATABASEPREFIX'_topbar_data CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci</code></br>
</br>
Of course, make a backup of your table first!</br>
</br>
(Thanks to samhat for help on this one!)
</br>
</br>
<li><strong>How do I find the Page ID</strong></li>
You can find the Page ID in the Edit Post or Edit Page URL. For example, the page ID for the following example is “1234.”
</br>
<code>http://example.wordpress.com/wp-admin/page.php?action=edit&post=1234</code>
</br>
</br>
<li><strong>How do I test the TopBar?</strong></li>
To test the TopBar on your site, you can set the Page IDs (in Main Options) to a single page (and not your home page) and select Include/Exclude Logic to be "Page IDs". Then go to that Page to see how the TopBar is working.
</br>
</br>
<li><strong>Why does my TopBar look odd on Internet Explorer?</strong></li> 
IE does not (yet) implement gradients like other browsers.  So, make sure you test your TopBar on all the major browswers.
</br>
</br>
<li><strong>How dow I uninstall?</strong></li> 
Go to the Uninstall tab (or if are on a Multi Site install, you first need to login as a Super Admin then select the Uninstall from the TopBar Menu List) and then click the Uninstall button at the bottom of the page.</br>
You'll be sent to the WordPress Plugins page. Now deactivate and uninstall the Plugin.</br>
</br>
	</ol>

<div class="clear"></div>	
	</div> 
	</div> <!-- end of FAQ -->
   </form>
 </div>	 
 
 <?php
 
}	// End of wptb_faq_page

?>
