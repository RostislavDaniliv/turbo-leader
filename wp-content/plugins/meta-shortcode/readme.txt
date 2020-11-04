=== Meta Shortcode ===
Contributors: RyanNutt
Donate link: http://www.nutt.net/donate/
Tags: meta, post, page, 
Requires at least: 2.5 
Tested up to: 3.4.2  
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily insert meta values, if they exist, into a post or page using a shortcode.

== Description ==

The Meta Shortcode plugin allows you to easily insert meta values into your posts or pages without having to edit a theme file.

Rather than having to use get_post_meta inside of your theme files or another plugin, you can just use the shortcode [ metafield ].

For more info, you can visit [my website](http://www.nutt.net/tag/meta-shortcode/).

== Installation ==

Upload the folder inside the zip to your /wp-content/plugins/ folder or, better, use the plugin pages inside WordPress.

**Usage**

Insert the shortcode [ metafield ] where you want your info to show up.

You can use the following options.

* `field` The meta field to display. This is the only required attribute.
* `sorted` If there are multiple values in the meta field, setting this to true will sort them alphabetically prior to output. If false, or left empty, then they will be output in the order entered in WordPress.
* `before` Any text or HTML to display before the meta field information. Defaults to blank if there is only one record and &lt;ul&gt; if there are multiple meta records.
* `after` Text or HTML to display after the meta field info. Same as `before` for defaults.
* `empty` Text or HTML to display if the meta field isn't found. Defaults to empty which means that nothing is displayed if the meta isn't available.

== Frequently Asked Questions ==

New plugin, no FAQs yet.

== Screenshots ==

Nothing here yet. 

== Changelog ==

= 0.1 =
* Initial release

== Upgrade Notice ==

= 0.1 =
* Initial release, nothing to upgrade