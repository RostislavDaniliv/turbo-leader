<?php 

/*
Control Options Tab

i18n Compatible

*/



//=========================================================================			
// Main Options
//=========================================================================			

		
function wptb_control_options($wptbOptions) {

	global 	$wptb_common_style, $wptb_button_style, $wptb_clear_style, $wptb_cssgradient_style, 
			$wptb_submit_style, $wptb_special_button_style;    

	$wptb_debug=get_transient( 'wptb_debug' );	

	if($wptb_debug)
		echo '</br><code>WP-TopBar Debug Mode: wptb_control_options() for ID: '.$wptbOptions[ 'bar_id' ].'</code>';

	?>

 	<div class="postbox">
	<h3><a name="ControlOptions"><?php _e('Control Options','wp-topbar'); ?></a></h3>
	<div class="inside">
			<p class="sub"><strong><?php _e('These are the options that allow you to control whether your TopBar will be shown (based on time, category, logged in users, etc.).','wp-topbar'); ?></strong></p>
			<p class="sub"><em><?php _e('NOTE: The options are generally processed in the order show on the screen.   The first criteria that excludes a page/post from showing will cause the TopBar to stop checking other criteria.','wp-topbar'); ?></em></p>


		<div class="table">
			<table class="form-table">		
				<tr>
					<td colspan="3"><hr></td>
				</tr>				
				<tr valign="top">
					<td width="150"><?php _e('Start Time','wp-topbar'); ?>:</td>
					<td>
						<input class="ui-front" type="text" id="wptbstarttimebtn" name="wptbstarttime"  style="position: relative; z-index: 100000;" size="30" value="<?php if ($wptbOptions['start_time'] == 0) echo ""; else echo $wptbOptions['start_time']; ?>"></div><p class="button" style="<?php echo $wptb_special_button_style; ?>" id="wptbstarttimebtnClear"><?php _e('Set Start Time to Blank','wp-topbar'); ?></p>									   
						<div class="ui-front" id="wptb_start_time"></div>				    
					</td>
					<td>
							<p class="sub"><em><?php _e('Pick the date/time for the TopBar to start showing.  Default is <code>Blank</code>.','wp-topbar'); 
									echo "<br/>".__("You must use your WordPress Server Time when you set these options.")."<strong><br/>".__("When this page was rendered, the WordPress time was").': '.current_time('mysql', 0)."</strong>";
								
								
							?></em></p>
					</td>
				</tr>							
				<tr valign="top">
					<td width="150"><?php _e('End Time','wp-topbar'); ?>:</td>
					<td>
						<input class="ui-front" type="text" id="wptbendtimebtn" name="wptbendtime"  style="position: relative; z-index: 100000;" size="30" value="<?php if ($wptbOptions['end_time'] == 0) echo ""; else echo $wptbOptions['end_time']; ?>">	
						<p class="button" style="<?php echo $wptb_special_button_style; ?>" id="wptbtimebtnClear">&nbsp<?php _e('Set End Time to Blank','wp-topbar'); ?></p>							  
						<div class="ui-front" id="wptb_end_time"></div>				    
					</td>
					<td>
							<p class="sub"><em><?php _e('Pick the date/time for the TopBar to stop showing.  Of course, it must be after the start time. Select Blank for the TopBar to never disappear.  Default is <code>Blank</code>.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>				
				<tr valign="top">
					<td><?php _e('Show TopBar on<br>Home Page','wp-topbar'); ?>:</label><p></td>
					<td>
						<br>
						
					 	<p id="radio3" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowhomepage1" name="wptbshowhomepage" class="ui-helper-hidden-accessible" value="always" <?php if ($wptbOptions['show_homepage'] == "always") { echo 'checked="checked"'; }?>><label for="wptbshowhomepage1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('A','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowhomepage2" name="wptbshowhomepage" class="ui-helper-hidden-accessible" value="never" <?php if ($wptbOptions['show_homepage'] == "never") { echo 'checked="checked"'; }?>><label for="wptbshowhomepage2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('B','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowhomepage3" name="wptbshowhomepage" class="ui-helper-hidden-accessible" value="conditionally" <?php if ($wptbOptions['show_homepage'] == "conditionally") { echo 'checked="checked"'; }?>><label for="wptbshowhomepage3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('C','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowhomepage4" name="wptbshowhomepage" class="ui-helper-hidden-accessible" value="only" <?php if ($wptbOptions['show_homepage'] == "only") { echo 'checked="checked"'; }?>><label for="wptbshowhomepage4" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('D','wp-topbar'); ?></span></label>
					 	</p>	
					</td>
					<td>
						<p class="sub"><em><?php _e('Select how you want the TopBar to show on the Home page.  Default is to <code>conditionally</code> show the TopBar on the Home Page:','wp-topbar'); ?></em>
						<br><?php _e('A','wp-topbar'); ?>. <?php _e('<strong>Always</strong> shows the TopBar on the Home Page regardless of any other criteria entered below.','wp-topbar'); ?>
						<br><?php _e('B','wp-topbar'); ?>. <?php _e('<strong>Never</strong> shows the TopBar on the Home Page regardless of any other criteria entered below.','wp-topbar'); ?>
						<br><?php _e('C','wp-topbar'); ?>. <?php _e('<strong>Conditionally</strong> shows the TopBar on the Home Page if the page matches the Page ID and/or Category criteria entered below.','wp-topbar'); ?>
						<br><?php _e('D','wp-topbar'); ?>. <?php _e('<strong>Only</strong> shows the TopBar on the Home Page and not other pages.','wp-topbar'); ?>
						</p>
					</td>
				</tr>				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td><?php _e('Logged In Users','wp-topbar'); ?>:</td>
					<td>
						<br>
						
					 	<p id="radio1" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbonlyloggedin1" name="wptbonlyloggedin" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['only_logged_in'] == "no") { echo 'checked="checked"'; }?>><label for="wptbonlyloggedin1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('A','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbonlyloggedin2" name="wptbonlyloggedin" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['only_logged_in'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbonlyloggedin2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('B','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbonlyloggedin3" name="wptbonlyloggedin" class="ui-helper-hidden-accessible" value="all" <?php if ($wptbOptions['only_logged_in'] == "all") { echo 'checked="checked"'; }?>><label for="wptbonlyloggedin3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('C','wp-topbar'); ?></span></label>
					 	</p>						
						
					</td>
					<td>
						<p class="sub"><em><?php _e('Select how you want the TopBar to show for users.  Default is to <code>Always</code> show the TopBar, regardless if they are logged in:','wp-topbar'); ?></em>
						<br><?php _e('A','wp-topbar'); ?>. <?php _e('<strong>Not Logged In</strong> shows the TopBar only for users not logged in.','wp-topbar'); ?>
						<br><?php _e('B','wp-topbar'); ?>. <?php _e('<strong>Logged In</strong> shows the TopBar only for users logged in.','wp-topbar'); ?>
						<br><?php _e('C','wp-topbar'); ?>. <?php _e('<strong>Always</strong> shows the TopBar for all users, logged in or not.','wp-topbar'); ?>
						</p>
					</td>
				</tr>											
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td colspan=2><strong><?php _e('Post/Page Type Criteria','wp-topbar'); ?>:</strong></td>
				</tr>
				<tr valign="top">
					<td><?php _e('Sticky Posts','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio6" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowsticky1" name="wptbshowsticky" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_sticky'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshowsticky1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowsticky2" name="wptbshowsticky" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_sticky'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshowsticky2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on Sticky Posts.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on Sticky Posts<br><code>Exclude</code> will have the TopBar to not show up Sticky Posts.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Pages','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio4" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowpage1" name="wptbshowpages" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_pages'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshowpage1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowpage2" name="wptbshowpages" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_pages'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshowpage2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on Pages.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on Pages<br><code>Exclude</code> will have the TopBar to not show up Pages.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Posts','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio5" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowposts1" name="wptbshowsingle" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_single'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshowposts1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowposts2" name="wptbshowsingle" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_single'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshowposts2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on Posts.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on Posts<br><code>Exclude</code> will have the TopBar to not show up Posts.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Archives','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio7" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowarchives1" name="wptbshowarchives" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_archives'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshowarchives1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowarchives2" name="wptbshowarchives" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_archives'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshowarchives2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on Archives.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on Archives<br><code>Exclude</code> will have the TopBar to not show up Archives.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Search Results','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio8" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshowsearch1" name="wptbshowsearch" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_search'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshowsearch1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshowsearch2" name="wptbshowsearch" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_search'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshowsearch2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on search results.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on search results<br><code>Exclude</code> will have the TopBar to not show up search results page.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('404 Pages','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio9" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbshow4041" name="wptbshow404" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['show_type_404'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbshow4041" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbshow4042" name="wptbshow404" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['show_type_404'] == "no") { echo 'checked="checked"'; }?>><label for="wptbshow4042" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select if you want the TopBar to show on 404 page.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on 404 page<br><code>Exclude</code> will have the TopBar to not show up a 404 page.','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
					<tr valign="top">
					<td width="150"><?php _e('Page IDs','wp-topbar'); ?>:</label></td>
					<td>
						<input type="text" name="wptbincludepages" id="includepages" size="30" value="<?php echo $wptbOptions['include_pages']; ?>" >
					</td>
					<td>
						<p class="sub"><em><?php _e('Enter the IDs of the pages and posts that you want the TopBar to appear on, separated by commas. The TopBar will only be shown on those pages by using the <code>Page ID Criteria</code> option you select below. Leave blank or enter 0 to show the TopBar on all pages.  e.g. 1,9,39,10:','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Page ID Criteria','wp-topbar'); ?>:</td>
					<td>
				 	<p id="radio10" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbinvertinclude1" name="wptbinvertinclude" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['invert_include'] == "no") { echo 'checked="checked"'; }?>><label for="wptbinvertinclude1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbinvertinclude2" name="wptbinvertinclude" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['invert_include'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbinvertinclude2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>
					<td>
						<p class="sub"><em><?php _e('Select how you want to process the Page IDs entered above.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on those Page IDs<br><code>Exclude</code> will have the TopBar to not show up on those specific Page IDs:','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
					<tr valign="top">
					<td width="150">Category IDs:</label></td>
					<td>
						<input type="text" name="wptbincludecategories" id="includecategories" size="30" value="<?php echo $wptbOptions['include_categories']; ?>" >
					</td>
					<td>
						<p class="sub"><em><?php _e('Enter the IDs of the categories that you want the TopBar to test for, separated by commas. The TopBar will only be shown on those categories in the default "category" taxonomy by using the <code>Categegory ID Criteria</code> option you select below. Leave blank or enter 0 to show the TopBar on all categories.  e.g. 9,10,2,12:','wp-topbar'); ?></em></p>
					</td>
				</tr>
				<tr valign="top">
					<td><?php _e('Category ID Criteria','wp-topbar'); ?>:</label><p></td>
					<td>
					
				 	<p id="radio11" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbinvertcategories1" name="wptbinvertcategories" class="ui-helper-hidden-accessible" value="no" <?php if ($wptbOptions['invert_categories'] == "no") { echo 'checked="checked"'; }?>><label for="wptbinvertcategories1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Include','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbinvertcategories2" name="wptbinvertcategories" class="ui-helper-hidden-accessible" value="yes" <?php if ($wptbOptions['invert_categories'] == "yes") { echo 'checked="checked"'; }?>><label for="wptbinvertcategories2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('Exclude','wp-topbar'); ?></span></label>
					</p>					
					
					<td>
						<p class="sub"><em><?php _e('Select how you want to process the Category IDs entered above.  Default is <code>Include</code>:<br><code>Include</code> will have the TopBar show on those Category IDs<br><code>Exclude</code> will have the TopBar to not show up on those specific Category IDs.','wp-topbar'); ?></em></p>
					</td>
				</tr>			
				<tr>
					<td colspan="3"><hr></td>
				</tr>
					<tr valign="top">
					<td><?php _e('Selection Criteria Logic','wp-topbar'); ?>:</label><p></td>
					<td>
						</br>
					 	<p id="radio12" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbincludelogic1" name="wptbincludelogic" class="ui-helper-hidden-accessible" value="page_only" <?php if ($wptbOptions['include_logic'] == "page_only") { echo 'checked="checked"'; }?>><label for="wptbincludelogic1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('A','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbincludelogic2" name="wptbincludelogic" class="ui-helper-hidden-accessible" value="cat_only" <?php if ($wptbOptions['include_logic'] == "cat_only") { echo 'checked="checked"'; }?>><label for="wptbincludelogic2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('B','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbincludelogic3" name="wptbincludelogic" class="ui-helper-hidden-accessible" value="boolean_and" <?php if ($wptbOptions['include_logic'] == "boolean_and") { echo 'checked="checked"'; }?>><label for="wptbincludelogic3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('C','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbincludelogic4" name="wptbincludelogic" class="ui-helper-hidden-accessible" value="boolean_or" <?php if ($wptbOptions['include_logic'] == "boolean_or") { echo 'checked="checked"'; }?>><label for="wptbincludelogic4" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('D','wp-topbar'); ?></span></label>
					 	</p>						
					</td>
					<td>
						<p class="sub"><em><?php _e('Select how you want the TopBar to use the selection criteria you set above.  Default is to check only the <code>Page IDs</code>:','wp-topbar'); ?></em>
						<br><?php _e('A','wp-topbar'); ?>. <?php _e('Checks only Page IDs (ignore Category ID criteria)','wp-topbar'); ?>
						<br><?php _e('B','wp-topbar'); ?>. <?php _e('Checks only Category IDs (ignore Page ID criteria)','wp-topbar'); ?>
						<br><?php _e('C','wp-topbar'); ?>. <?php _e('<strong>BOTH</strong> Page ID <strong>and</strong> Category ID must match the criteria above for the TopBar to show','wp-topbar'); ?>
						<br><?php _e('D','wp-topbar'); ?>. <?php _e('<strong>EITHER</strong> Page ID <strong>or</strong> Category ID must match the criteria above for the TopBar to show','wp-topbar'); ?>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="3"><hr></td>
				</tr>
				<tr valign="top">
					<td><?php _e('Mobile Devices','wp-topbar'); ?>:</td>
					<td>
						<br>
					 	<p id="radio2" class="ui-button ui-button-wptbset">
						<input type="radio" id="wptbmobilecheck1" name="wptbmobilecheck" class="ui-helper-hidden-accessible" value="only_mobile" <?php if ($wptbOptions['mobile_check'] == "only_mobile") { echo 'checked="checked"'; }?>><label for="wptbmobilecheck1" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('A','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbmobilecheck2" name="wptbmobilecheck" class="ui-helper-hidden-accessible" value="not_mobile" <?php if ($wptbOptions['mobile_check'] == "not_mobile") { echo 'checked="checked"'; }?>><label for="wptbmobilecheck2" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('B','wp-topbar'); ?></span></label>
						<input type="radio" id="wptbmobilecheck3" name="wptbmobilecheck" class="ui-helper-hidden-accessible" value="all_devices" <?php if ($wptbOptions['mobile_check'] == "all_devices") { echo 'checked="checked"'; }?>><label for="wptbmobilecheck3" class="ui-button ui-button-wptb ui-widget ui-state-default ui-button ui-button-wptb-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button ui-button-wptb-text"><?php _e('C','wp-topbar'); ?></span></label>
					 	</p>						
						
					</td>
					<td>
						<p class="sub"><em><?php _e('Select how you want the TopBar to show for mobile users.  Default is to <code>Always</code> show the TopBar, regardless if they are logged in:','wp-topbar'); ?></em>
						<br><?php _e('A','wp-topbar'); ?>. <?php _e('<strong>Mobile Devices</strong> shows the TopBar only for mobile devices.','wp-topbar'); ?>
						<br><?php _e('B','wp-topbar'); ?>. <?php _e('<strong>non-Mobile Devices</strong> shows the TopBar only for other devices.','wp-topbar'); ?>
						<br><?php _e('C','wp-topbar'); ?>. <?php _e('<strong>Always</strong> shows the TopBar for all devices.','wp-topbar'); ?>
						</p>
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
}	// End of wptb_control_options


?>