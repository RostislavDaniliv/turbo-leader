=== Plugin Name ===
Contributors: rfgoetz
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YQQURY7VW2B2J
Tags: topbar, header bar,beforesite, heads up, fixed bar, link, heads up bar,attention, quick notice, bar, notification bar, popup, self promotion, toolbar, top of the page, plugin, important, message, php
Requires at least: 3.6
Tested up to: 4.4.2
Stable tag: 5.34

Create MULTIPLE, ROTATABLE TopBars that will be shown at the top of your website.  TopBars are selected by a variety of options - includes scheduler! 

== Description ==

What is a TopBar?  It is a special message/image that you can show at the top (or bottom) of your website.  WP-TopBar allows you to create an **unlimited** number of TopBars.   They are cacheable and randomly selected based on the criteria you select, including start time, stop time and more.  You can provide a weighting to skew selected TopBars to show up more often.  It is super-duper customizable, even easy to add your own PHP and CSS. 

Version 5.28 refactored how the TopBar handles cookies to be more compatible with caching plugins.

Version 5.25 adds more options to control which TopBars are shown. You can now have the TopBar excluded from sticky posts, pages, archives, and more.  There is also a new PHP option to give you more granular control around which TopBars are selected to show — of course, use at your own risk.

Version 5.24 has some minor fixes.  While 5.23 adds a new option to force to the TopBar to stay fixed on the top of the page when it is scrolled.  For non-scrollable TopBars, it will push the page down and not overlay the top of your webpage.

Version 5.21 changed how the HTML is generated to make it quicker to startup and also easier to use more complicated custom PHP... all behind the scenes.  Now you can enter in custom PHP like this and it works! (of course, You'll need to style it with CSS to make it pretty!):  echo do_shortcode('[gallery id="123"]');  

Version 5.17+ is now i18n compatible -- now I just need your help adding new translations. (I did include a French translation -- but only about ~10% is actually translated.) You can also now have your own custom TopBars added to the Samples tab (see FAQ for details).

Version 5.14 gives you more Rotation options, makes it easier to enable/disable a TopBar and gives you more control with Network installs.

Version 5.13 adds a new Global Settings page.  You can now select to **rotate** through all valid TopBars on each pageview.

You can create an unlimited number of TopBars that:
<ul>
	<li>Have their own color, CSS styling, and buttons (for Facebook, LinkedIn, Google+, etc.)</li>
	<li>Have a background image</li>
	<li>Have a close button</li>
	<li>Have a re-open button that shows after a TopBar is closed</li>
	<li>Have custom CSS or PHP that is executed with each TopBar.  Of course, that can be super dangerous if you enter PHP code that is invalid -- you could break your website.  That option should only be used by Advanced Swimmers only.</li>
</ul>

You can have the Plugin show only **one*TopBar*** or display ***every*** valid TopBar that you've create (they are rotated in and out).

TopBars can be:
<ul>
	<li>Scheduled based on time</li>
	<li>Shown only for mobile, non-mobile or all users</li>
	<li>Shown only on the home page -- or not shown on the home page</li>
	<li>Shown only for certain categories -- or excluded from certain categories</li>
	<li>Shown only on certain Pages -- or excluded from certain Pages</li>
	<li>Shown only when the user scrolls the page down </li>
	<li>Given a Priority -- to ensure that more important messages are shown more frequently</li>
</ul>
More details on the selection logic can be found on [here.](http://zwebify.com/wp-topbar/wp-topbar-selection-logic/)


The TopBars are always statically created to take advantage of caching plugins.

Want to create a lot of TopBars -- you can copy the existing ones with just a few clicks.   Know SQL?  You can even export the TopBars in three different formats (JSON, CSV or SQL).    Sorry, **no support** is given if you import directly to the database.

With so many option pages, I only included a few screen images.  More images can be found on [zWebify.com](http://zwebify.com/wp-topbar/)

Here is a crazy-long list of options you have for each TopBar -- and this is not even complete!

<ol>
	<li>Enable/disable the TopBar without disabling the plugin.</li>
	<li>Place the TopBar Above the Header or Below the Footer</li>
	<li>Amount of time (in milliseconds) for the TopBar to appear. Enter 0 for no delay.</li>
	<li>Amount of time (in milliseconds) for the TopBar to take to slide down on the page. Enter 0 for no delay.</li>
	<li>Amount of time (in milliseconds) for the TopBar to stay on the page.  Enter 0 for the TopBar to not disappear.</li>
	<li>Pick the date/time for the TopBar to start showing.</li>
	<li>Pick the date/time for the TopBar to stop showing. Of course, it must be after the start time. Select 0 for the TopBar to never disappear.</li>
	<li>Whether to show the TopBar for logged in users, not logged in users or all users.
	<li>A lot of CSS options -- and even a way to enter your own CSS in</li>
	<li>Retrict the Topbar to show on only certain pages (or to not show on those pages)</li>
	<li>Retrict the Topbar to show on only certain categories (or to not show on those categories)</li>
	<li>Add social buttons to the TopBar</li>
	<li>Add a Close Button</li>
	<li>Option to execute your own PHP or CSS code before (or after) the TopBar is created</li>
	<li>Has explicit support for qTranslate -- translates the top bar text fields and link field.</li>
	<li>You can have unlimited number of TopBars -- the plugin randomly selects one (based on individual weightings) to show </li>
	<li>The TopBars are generated in such a way to support cacheing (e.g. W3 Total Cache, WP Super Cache)</li>
</ol>

Translations provided by:
Spanish (Latin American) - Andrew Kurtis - http://www.webhostinghub.com/



== Installation ==

This section describes how to install the plugin and get it working.

1. Upload all files in `wp-topbar.zip` to the `/wp-content/plugins/wp-topbar` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the options
4. Make sure to set "Enable" to yes to see the plugin on your website.

I've included a sample image for you to try on your website:  wp-topbar_sample_image.jpg.

== Frequently Asked Questions ==

= I have a new translation  =

Contact me to help with a translation: http://zwebify.com/contact/  I will install at the next update.

Current translations are provided by:
Spanish (Latin American) - Andrew Kurtis - http://www.webhostinghub.com/

= My TopBar is not working. What should I do? =
Are you upgrading from an old version?   I do my best to allow for clean upgrades.  Just in case, try creating a default TopBar.  If that works, you may have CSS or other incompatabilities on the older TopBar that does not work with the latest version.  

Also, check for any messages under the Live Preview heading on the Admin Page. It will tell you if you have cookies or time settings that will prevent the TopBar from loading.  

You may have custom CSS or HTML settings that prevent the TopBar from loading. If you entered any setting that are not valid, the TopBar will not load. Try deleting the settings and then re-entering your custom CSS or HTML until you find the one that is causing the issue.

You can also use the Debug page to see if you can see an error.

= HELP! I am using custom PHP, CSS or HTML and now my website is broken =
Don't Panic! 
You have two options to fix this:
1. Append &nopreview to the url when you are trying to edit a TopBar. E.g. https://www.dummy.org/wp/wp-admin/?page=wp-topbar.php&action=phptexttab&barid=422116&nopreview.    Hit ENTER to reload the page. You should now be able to edit the custom php.
2. Go into your database tool (usually using phpMyAdmin), find the wp-topbar table and delete the offending row. 

= My TopBar does not support my local language = 

The problem is with your table collation. You need to change the collation to utf8_general_ci.

Run this query from your phpMyAdmin to change the collation.  
Make sure to change the word DATABASEPREFIX below with your database prefix from your wp-config.php file.

ALTER TABLE 'DATABASEPREFIX'_topbar_data CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci

Of course, make a backup of your table first!

(Thanks to samhat for help on this one!)

= How can I have my own custom TopBars show on the Samples tab? = 

First create all the TopBars you want as custom Samples.   Then export the TopBars in the JSON format.   Now, create a location on your server to store the files.   For example ../wp/wp-content/plugins/wp-topbar-samples.   Next rename the export file to custom_topbars.json. Now move that file, plus any images you need into the directory you created.  Finally, go to the General Settings Tab and enter the URL for the directory in the "Custom Samples URL" field.  Make sure you have <code>allow_url_fopen</code> turned on in your php.ini (otherwise, we cannot read the file.)  Now, the TopBar will first display the Standard samples then the TopBars from your custom_topbars.json file.  You can then copy these new TopBars just like the Standard samples.   

= How do the Rotate Toolbars Global Setting work? = 

This new settings will select all the valid TopBars that can be shown on a pageview (e.g. those that match all the control, date/time criteria.)  Then it will rotate through the TopBars in priority order - with the TopBars with the highest priority shown first.   This option will override the use of Close Buttons or Re-open Buttons.  It will also ignore the Scroll Action option.   You can set the delay between TopBars on in the Global Settings tab.

= How does the Include/Exclude logic work behind the scenes? = 

You have four choices to handle include (or exclude) the TopBar from showing:
 Page ID - this only checks the current page's ID against the list you entered.
 Category ID - this only checks the current category IDs against the list you entered.  The criteria is satisfied if any of the page's category IDs match what you entered.  We only check the default "category" taxonomy.
 Both - both the Page ID and Category criteria must match for the TopBar to show
 Either - either the Page ID or Category criteria need to match for the TopBar to show
 
The default is to check by PageId.

= How do the cookies work behind the scenes? = 

If you allow the user to close the TopBar, then the plugin checks to see if you have enabled cookies.   If they are not enabled, it deletes any existing cookies.   If they are enabled, it looks to see if a cookie has been created.  A cookie is only created if the TopBar has been previously closed by the user.  If it finds a cookie, it prevents the TopBar from showing.

If you change the Cookie Value to something new, the TopBar will show up again.  This is useful if you want to force the TopBar to show on new content.  Make sure to select something you haven't used before.  A good idea is to increment the value by one every time you want to force the TopBar to show.  If you use a caching plugin, make sure to clear the cache after you change the value.

With Version 4.28+, all TopBars can have their out cookie value.  You can also set the TopBars to be the same by using the Close Button tab on the main page

= How does the Priority field work? =

The Plugin randomly selects a valid TopBar to show using this field to skew how they are selected. The TopBar multiplies a random number (between 0 and 1) with the TopBar's Priority value (which is a number between 1 to 100). A higher number means this TopBar will be selected more frequently; a lower number means less frequently. 

= How so I delete a TopBar? =

On the All Tables view, select the TopBars via the Check Box and selete the "Delete" function from the Bulk Actions drop down list.

= How are TopBars selected to show? =

See the Priority question above to see how they are selected. The TopBar will select only those TopBars that are valid per the date/time criteria. Once a TopBar is selected to show, it then goes through the Control Options. That checks to see if the TopBar should be shown on the Home Page (or not) and which Page IDs or Category IDs the TopBar should show (or not).

The Final check is to see if the TopBar has cookie controls (see above). If the user is allowed to close the TopBar and cookies are enabled, then we look for a cookie. If one is found, and it matches the cookie value, then the TopBar is not shown.

= What TimeZone should I use when I enter Start/Stop Times =

You should enter the time in the same timezone that WordPress is setup to use.  (See the WordPress|Settings|General tab).  

We also print the current WordPress time on the Control Tab right next to the Start option field.  Use that to guide how you should enter the time in.

= What CSS ID's are available? =

Use "#topbar"

= What if I want to fix the TopBar to the top of the page? = 

Use the Force TopBar to Be Fixed On Top of Page (on the Main Options Tab).

= What if I want to create my own Default TopBar? =

See the file SAMPLE_wptb_custom_default_values.php for instructions on how to do that.

= How to Find the Page ID = 

You can find the Page ID in the Edit Post or Edit Page URL. For example, the page ID for the following example is “1234.”

http://example.WordPress.com/wp-admin/page.php?action=edit&post=1234

= How do I test the TopBar? = 

To test the TopBar on your site, you can set the Page IDs (in Main Options) to a single page (and not your home page) and select Include/Exclude Logic to be "Page IDs". Then go to that Page to see how the TopBar is working.

= Why does my TopBar look odd on Internet Explorer? = 

IE does not (yet) implement gradients like other browsers.  So, make sure you test your TopBar on all the major browsers.

= How dow I uninstall? = 

Go to the Uninstall tab (or if are on a Multi Site install, you first need to login as a Super Admin then select the Uninstall from the TopBar Menu List) and then click the Uninstall button at the bottom of the page.   You'll be sent to the WordPress Plugins page. Now deactivate and uninstall the Plugin

== Upgrade Notice ==

= 5.34 = 

Fix to how plugin handles archive pages when using Category control options.


== Screenshots ==

1. This is how it will look on your website
2. All TopBars Screen
3. Sample TopBar Screen
4. Export Options Screen
5. Main Options Screen for a single TopBar


== Changelog ==

= 5.34 - 3/1/2016 =

1. FIXED: How plugin handles archive pages when using Category control options. (thanks to iamjatinkumar for reporting this!)
2. UPDATED: timepicker.js updated to version 1.6.1 - http://trentrichardson.com/examples/timepicker/
3. VALIDATED: Version 5.34 supports WordPress 4.4.2

= 5.33 - 12/08/2015 =

1. FIXED: Removed debug code (thanks to novored for reporting this!)

= 5.32 - 11/21/2015 =

1. UPDATED: Minor fixes to UI for WordPress 4.4
2. UPDATED: jQuery UI CSS to version 1.11.4
3. VALIDATED: Version 5.32 supports WordPress 4.4

= 5.31 - 9/25/2015 =

1. UPDATED: Updated the French & Dutch translations - from https://www.transifex.com/wp-translations/wp-topbar
2. VALIDATED: Version 5.31 supports WordPress 4.3.1


= 5.30 - 9/4/2015 =

1. UPDATED: Re-factored how the delay functions when using the Rotate TopBar function (thanks to pppusl).
2. UPDATED: Updated the French translation & added Brazilian & Dutch translations - from https://www.transifex.com/wp-translations/wp-topbar
3. VALIDATED: Version 5.30 supports WordPress 4.3


= 5.29 - 7/24/2015 =

1. FIXED: force a check on the wp-topbar tables to overcome an issue with WordPress 4.2.3

= 5.28 - 6/13/2015 =

1. CHANGED: Refactored how the plugin handles cookies to be more compatible with Caching plugin (thanks to Eric W.) 
2. CHANGED: How cookies are created to account for differences between Chrome and Safari
3. UPDATED: timepicker.js updated to version 1.5.3 - http://trentrichardson.com/examples/timepicker/

= 5.27 - 4/20/2015 =

1. VALIDATED: Version 5.26 supports WordPress 4.2
2. FIXED: How the plugin handles internal database changes

= 5.26 - 3/31/2015 =

1. FIXED: Made some changes to better account for multisite installations (thanks AWOL!)
2. ADDED: Added more detail on the debug pages to show more information about multisite installations


= 5.25 - 10/03/2014 =

1. ADDED: New options to control what kinds of pages/posts (sticky posts, posts, pages, archives, and more)
2. ADDED: New PHP option to give more granular control of what TopBars are selected to show. Use at your own risk.
3. UPDATED: timepicker.js updated to version 1.5.0 - http://trentrichardson.com/examples/timepicker/

= 5.24 - 8/31/2014 =

1. VALIDATED: Version 5.24 supports WordPress 4.0
2. FIXED: instructions on how to change font on the TopBar
3. UPDATED: timepicker.js updated to version 1.4.6 - http://trentrichardson.com/examples/timepicker/
4. FIXED: Defect in reopenable TopBars
5. ADDED: Translation for Spanish (Latin American) - thanks to Andrew Kurtis - http://www.webhostinghub.com/

= 5.23 - 3/28/2014 =

1. CHANGED: Refactored how the plugin handles slashes when the PHP option for Magic Quotes is turned off.
2. ADDED: New option on the Main Options tab to force the TopBar to stay on the top of the page when the page is scrolled. Make sure to remove "position:fixed" for the smoothest animation. (thanks to markob17 for the idea!)
3. ADDED: More status icons (for close, reopen, scroll, Force Fixed, and if the TopBars are shown in rotation.
4. ADDED: The ability to have your own custom default topbar.  See the file SAMPLE_wptb_custom_default_values.php for instructions on how to do that.
5. UPDATED: timepicker.js updated to version 1.4.4 - http://trentrichardson.com/examples/timepicker/
6. FIXED: Various fixes for 3.9 

= 5.22 - 1/25/2014 =

1. VALIDATED: Version 5.22 supports WordPress 3.8.1
2. UPDATED: Changed the All Tables & Sample Tabs to use Foo Tables for a better experience - http://fooplugins.com/plugins/footable-jquery/
3. ADDED: Global option to turn off the Overview section to save screen space on the Admin pages.

= 5.21 - 1/17/2014 =

1. ADDED: Added sliderAccess.js to allow Date/Time to be picked via a TouchScreen - http://trentrichardson.com/examples/jQuery-SliderAccess/
2. CHANGED:	How the prepend() function works to insert the HTML. Instead of prepending the HTML, we just move the HTML to the "body" div.  This should fix all errors with custom PHP that needs a new line or carriage return.  Now you can enter in custom PHP like this and it works! (of course, You'll need to style it with CSS to make it pretty!):  echo do_shortcode('[gallery id="123"]');  
3. CHANGED:	The priority of when the HTML is generated from very late to a default add_action() priority.
4. FIXED: Minor defect with cookie processing.

= 5.20 - 1/09/2014 =

1. FIXED: Fixes defect related to start/stop time (thanks to mommysplurge for helping find and test that one!)
2. UPDATED: timepicker.js updated to version 1.43 - http://trentrichardson.com/examples/timepicker/
3. ADDED: Added Time Check indicator to the top of every Options tab to help you know if Time will stop the TopBar from displaying.
4. ADDED: Now prints out the current WordPress time on the Control Tab to help you know what timezone we use when checking time.
5. UPDATED: Added FAQ entry related to TimeZone processing
 
= 5.19 - 1/02/2014 =

1. FIXED: Fixes defect for those TopBars that had a Close Button and had a Display Time of greater than zero. 
2. FIXED: Fixed display issue on Global Settings screen where Rotation Count was not being displayed.

= 5.18 - 12/30/2013 =

1. FIXED: Activation logic now fully works to update the plugin tables/options when needed.
2. CHANGED: Renamed some PHP functions and variables to assist in debugging.
3. CHANGED: Refactored the jQuery functions to make the code cleaner, animations work a bit smoother and eliminate unnecessary calls.
4. ADDED: Added new &action=admindebug option to help me debug Plugin issues

= 5.17 - 12/25/2013 =

1. CHANGED: Re-wrote all the admin pages to add localization (i18n) support. (I did inlcude a Fench translation -- but only about ~10% is actually translated. There is also a machine translated Spanish/Mexican version that needs double checking: DRAFT-wp-topbar-es_MX.po). Contact me to help with a translation: http://zwebify.com/contact/
2. ADDED: Ability to add your own TopBars to the Samples tab.  See FAQ for details.
3. FIXED: Fixed a few defects throughout the various admin pages.
4. UPDATED: Updated the sample_toolbars.json file to account for new options introduced in earlier versions.

= 5.16 - 12/12/2013 =

1. VALIDATED: Version 5.16 supports WordPress 3.8
2. FIXED: How the Mobile_User selection logic (thanks to faderdesign!)
3. FIXED: &debug now works again
4. FIXED: Fixed the date/time check error message (thanks to tandy22!)

= 5.15 - 12/09/2013 =

1. FIXED: Defect in new code for Network Plugin control.  (thanks again to Itookmyprozac!)

= 5.14 - 12/08/2013 =

1. ADDED: More rotate options: limit the number of rotations, hide/show last TopBar and add random order (thanks to orensbruli & traemccombs)
2. ADDED: Control settings for Network installations (thanks to Itookmyprozac for the idea!)
3. FIXED: Uninstall options are refactored to insure all data is deleted in a Network installation
4. CHANGED: Removed work-around for WordPress core defect (#23684 - fixed in 3.8) see http://core.trac.wordpress.org/ticket/23684
5. CHANGED: Moved Enable option to be at the top of most of the TopBar tabs - makes it easier to enable/disable a TopBar	.

= 5.13 - 12/02/2013 =

1. FIXED: Plugin changed to use the to built-in jQueryUI libraries.
2. FIXED: Removed one last Strict Standards (PHP) error messages
3. ADDED: Ability to adjust left/right margins on the TopBar (thanks to tobywallis for the idea!)
4. ADDED: Ability to Rotate through your TopBars on one pageview (thanks to traemccombs for the idea!)

= 5.12 - 11/02/2013 =

1. VALIDATED: Version 5.12 supports WordPress 3.7.1
2. FIXED: Removes Strict Standards (PHP) error messages (thanks to BackuPs for your help!)
3. FIXED: Added logic to deal with slashes for the new HTML fields
4. ADDED: Added Pointers to show new features in 5.10 / 5.11 
5. FIXED: Defect on Test Priority Tab that did not allow you to edit the TopBar correctly

= 5.11 - 10/25/2013 =

1. VALIDATED: Version 5.11 supports WordPress 3.7
2. ADDED: New control option to check for Mobie devices using wp_is_mobile() 
3. FIXED: Defect related to how the plugin handles upgrades to the next version

= 5.10 - 10/20/2013 =

1. ADDED: Three new custom HTML fields and Renamed CSS tab to 'CSS & HTML' tab. 
2. FIXED: Minor defect fixes to the debug code

= 5.06 - 09/25/2013 =

1. FIXED: JavaScript fix for toolbars that use the Re-openable option (thanks to joelkarunungan for helping me find this)

= 5.05 - 09/13/2013 =

1. VALIDATED: Version 5.05 supports WordPress 3.6.1
2. CHANGED: Moved Start/Stop time to Control Tab to have all the attributes that can effect when a TopBar is shown all on one Tab.

= 5.04 - 08/30/2013 =

1. ADDED: Added option to only show the TopBar on the Home Page.  Thanks to Liltiger for the idea.
2. UPDATED: timepicker.js and CSS updated to version 1.4 - http://trentrichardson.com/examples/timepicker/
3. FIXED: Fixed a Social Button target defect - thanks to leslie.
3. CHANGED: On social tab, do not display image size if PHP is not setup to allow remote URL fopens.  Thanks to ericd for discovering this.

= 5.03 - 08/01/2013 =

1. VALIDATED: Version 5.03 supports WordPress 3.6
2. ADDED: Added code to set default values for existing TopBars (useful when adding new user defined fields)
3. ADDED: Added Reopen Position field.  Thanks to Lisa L. for the idea.
4. FIXED: Fixed Custom CSS for the link defect. Thanks to carolemagouirk for finding it!

= 5.02 - 07/21/2013 =

1. FIXED: Defect related to checking CSS of social buttons
2. FIXED: Defects related bulk duplication of rows
3. FIXED: CSS issue that caused the browser to jump to the top of the screen when a button was selected
4. ADDED: New Sample TopBars
5. ADDED: Added Scroll Amount field to fine tune the Srcoll Action option.  Thanks to ellefrost for the idea.

= 5.01 - 06/22/2013 =

1. VALIDATED: Version 5.01 supports WordPress 3.5.2
2. FIXED: Defects related to re-open button options, added more warning messages for using re-open options
3. UPDATED: Updated FAQ to describe how to create your own menus.

= 5.0 - 06/19/2013 =

1. ADDED: Added ability to reopen a TopBar.
2. CHANGED: Now the TopBar uses the Bar Color even if you have an image set.  Double check how TopBars now render if you use an image!!
3. FIXED: Change the TopBar to use a real container (div instead of p) to fix custom PHP issues. Please double check how TopBars now render.
4. CHANGED: Updated jQuery Theme to make buttons/sliders easier to see
5. UPDATED: Finished adding slider bars to the Main Options tab to select numbers
6. ADDED: Added a way to suppress live preview (see FAQ for "&nopreview" option) to help find broken custom PHP
7. UPDATED: Default TopBar uses a new sample image and "position fixed"
8. CHANGED: Changed CSS Option A to add "background-repeat: no-repeat;"
9. ADDED: Added more warning messages for possible incompatible options selected by the user
10. ADDED: Added six more Social Buttons - and the ability to place them before/after the TopBar
11. ADDED: Added Uninstall Option
12. FIXED: Fixed how the plugin handled conversion from pre-database versions
13. UPDATED: Updated the FAQ with more current information
14. CHANGED: Moved Font & Text Alignment options to the TextBar Tab
15. FIXED: How the Close Button works to be more reliable

= 4.17 - 06/01/2013 = 

1. UPDATED: timepicker.js updated to version 1.3 - http://trentrichardson.com/examples/timepicker/
2. FIXED: More fixes to the SQL/CSV Export functions
3. UPDATED: Jazzed up the UI a bit
4. CHANGED: Updated to JQueryUI to 1.10.3
5. ADDED: Option to display only when user scrolls the page
6. ADDED: Included WordPress Pointers to highlight new functionality, which can be permanently dismissed once read
7. CHANGED: Changed the DEFAULT TopBar to not be "fixed" to the top of the page.  This will push the page down instead of overlaying it.
8. CHANGED: Cleaned up the plugin's folder structure


= 4.16 - 05/16/2013 = 

1. FIXED: SQL/CSV Export Function adjusted to account for new fields.


= 4.15 - 05/03/2013 = 

1. ADDED: Added PHP options that can be added to the TopBar.  USE AT OWN RISK
2. ADDED: Added ability to select TopBars based on whether the user is logged in
3. CHANGED: Now loads own version of JQueryUI (1.10.2) since the DatePicker was not consistently being loaded correctly


= 4.14 - 03/08/2013 = 

1. FIXED: Fixed issue where sometimes the html link would sometimes not display correctly
2. CHANGED: Added display of database charset/collation to help debug multi-lingual issues
3. CHANGED: To use embedded version of jQuery DatePicker

= 4.13 - 02/9/2013 =

1. CHANGED: Changed to use WordPress' embedded jQueryUI
2. CHANGED: Updated Color Picker from farbtastic to the new WordPress 3.5 Color Picker if using WordPress 3.5+
3. UPDATED: timepicker.js updated to version 1.2 (future proof for jQueryUI 1.10 compatability) - http://trentrichardson.com/examples/timepicker/
4. CHANGED: CSS Options page changed to try to make it clearer how the various CSS options work
5. CHANGED: Removed URL check on the TopBar link so that qtranslate will process the link correctly
6. FIXED: Minor display of error messages that check the div_css field

= 4.12 - 01/28/2013 =

1. FIXED: Issue that sometimes causes the plugin to not activate correctly.  Finally found it by using the Bitnami WordPress Stack - http://bitnami.org/stack/WordPress
2. FIXED: Plugin deletion messages
3. CHANGED: Removed the option to delete a TopBar from Options pages. Use the All Tables view and Delete using the Bulk Actions drop down list

= 4.11 - 01/26/2013 =

1. VALIDATED: Version 4.11 supports WordPress 3.5.1
2. UPDATED: jQuery UI to version 1.9.2
3. FIXED: Streamlined JavaScript when only one TopBar is selected
4. FIXED: Logic when no TopBars are selected

= 4.10 - 12/10/2012 =

1. VALIDATED: Version 4.10 supports WordPress 3.5
2. FIXED: Several defects found in 3.5 testing
3. NEW: Now supports caching plugins by generating HTML for all possible TopBars and using JavaScript to randomly select a TopBar

= 4.03 - 9/10/2012 =

1. VALIDATED: Version 4.04 supports WordPress 3.4.2
2. NEW: Adds security features (nonces) to the admin pages (Thanks to Blake Entrekin)
3. FIXED: How the CSS for the link is rendered
4. FIXED: Enable/disable social buttons work again

= 4.02 - 8/31/2012 =

1. NEW: Adds warning to update settings after upgrade
2. FIXED:  missing php closing tags

= 4.01 - 7/04/2012 =

1. NEW: Adds explicit support for the qtranslate plugin
2. FIX: No longer calls exception when the user has not set a default topbar
3. ADDED: Tab on main page to allow you to bulk set the Close Button settings
4. FIX: WordPress Export Functions -- workaround for core defect?

= 4.00 - 7/01/2012 = 

1. NEW: Version 4.0 Converted to using database to store MULTIPLE (yahoo!) TopBars.  Refactored to be leaner, faster, and smarter.  Your old TopBar will be imported into the new database.

= 3.10 - 6/05/2012 = 

1. VALIDATED: Version 3.10 supports WordPress 3.4
2. FIXED: Removed PSD icons files to make plugin smaller to install
3. NEW: Adds the capability to restrict the TopBar from showing by category
4. NEW: You can also explicitly manage how it shows up on the Home Page
5. NEW: Moved Page ID and new Category ID/Home Page control logic to its own options page
6. CHANGED: The labels and descriptions on the options page for selecting the Page ID include/exclude logic. 
 
= 3.09 - 4/26/2012 = 

1. NEW: Added submenus to the Admin bar.
2. FIXED: Code to support multisite (network) installs.

= 3.08 - 4/18/2012 = 

1. FIXED: Added more discrete handling of special characters if Magic Quotes is turned on in PHP.  So now can handle quote marks.

= 3.07 - 4/05/2012 = 

1. FIXED: Version 3.07 changes how jQuery is enqueued to better support more themes.

= 3.06 - 4/04/2012 = 

1. NEW: Version 3.06 adds the ability to add Social Icons to the TopBar.  
2. NEW: Added Debug page

= 3.05 - 3/31/2012 = 

1. FIXED: javascript error if "footer" is chosen as placement of TopBar
2. NEW: Redesigned admin page

= 3.04 - 3/30/2012 = 

1. FIXED: Corrupt SVN files.

= 3.03 - 3/29/2012 = 

1. NEW: Allow users to close the TopBar
2. FIXED: Moved HTML out of HEAD tags and into the BODY tags

= 3.02 - 3/22/2012 = 

1. FIXED: Changed date/time picker to a GPL version to conform to WordPress licensing

= 3.01 - 3/18/2012 = 

1. FIXED: Bug that caused WordPress post/pages not to load correctly

= 3.0 - 3/17/2012 = 

1. NEW: Added start/end times to limit when the TopBar shows.
2. FIXED: Updated deprecated functions
3. FIXED: Tightened code and made the code smaller 
4. FIXED: Enqueues javascript, if necessary

= 2.1 - 12/30/2011 = 

1. FIXED: TopBar excludes PageIDs now work when TopBar is on footer pages.

= 2.0 - 12/26/2011 = 

1. NEW: Added option to make the TopBar disappear after a set amount of time.
2. NEW: Added copy buttons to copy code samples.
3. NEW: Added option to invert the Include Pages list to make it actually exclude pages.
4. FIXED: Cleaned up code to make it tighter.

= 1.5 - 12/23/2011 = 

1. FIXED: Moved TopBar to the Body instead of the Header and fixed missing close DIV.  That MAY break your site -- test carefully.
2. NEW: Adds additional Link option (target) which allows you to change how the link opens.
3. NEW: Added option to put TopBar at the footer. (Thanks, candace88, for the idea!)
4. NEW: Added and new DIV-level CSS. 

= 1.4 - 12/10/2011 = 

1. NEW: Added options to change the margin of the TopBar.
2. FIXED: Cleaned up the code.
3. VALIDATED: Version 1.4 supports WordPress 3.3

= 1.3 - 12/05/2011 = 

1. NEW: Added easier navigation buttons.  Added more space to the CSS section.
2. NEW: Added code to allow you to use quotes in your text.
3. NEW: Added id="topbar" to the output.

= 1.2.1 - 10/08/2011 =

1. FIXED: Minor fix to allow settings page to display correctly.

= 1.2 - 10/08/2011 =

1. NEW: Add image background, custom css, and text alignment.

= 1.1 - 10/07/2011 =

1. FIXED: Cleaned up the code to make the TopBar be invisible upon first load.

= 1.0 - 9/25/2011 =

Initial version

