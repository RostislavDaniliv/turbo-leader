<?php

/*
  Plugin Name: Easy 404 Redirect
  Plugin URI: http://www.ninjapress.net/easy-404-redirect/
  Description: 404 redirect made easy.
  Version: 1.1
  Author: Ninja Press
  Author URI: http://www.ninjapress.net
  License: GPL2
 * 
 */

if (!class_exists('Easy_404_Redirect')) {

   class Easy_404_Redirect {

      /**
       * Construct the plugin object
       */
      public function __construct() {
         // register actions
         add_action('admin_menu', array(&$this, 'add_menu'));
         add_action('admin_init', array(&$this, 'admin_init'));

         add_action('get_header', array(&$this, 'easy_404_redirect_init'));
      }

      /**
       * Activate the plugin
       */
      public static function activate() {
         add_option('easy_404_redirect_map', array());
      }

      /**
       * Deactivate the plugin
       */
      public static function deactivate() {
         // Do nothing
      }

      /**
       * hook into WP's admin_init action hook
       */
      public function admin_init() {
         // Set up the settings for this plugin
         // register the settings for this plugin
         register_setting('easy_404_redirect_option', 'easy_404_redirect_enable');
         register_setting('easy_404_redirect_option', 'easy_404_redirect_home');
         register_setting('easy_404_redirect_option', 'easy_404_redirect_page');

         if (isset($_POST['option_page']) and $_POST['option_page'] == 'easy_404_redirect_option') {
            update_option('easy_404_redirect_enable', (isset($_POST['easy_404_redirect_enable']) and ( $_POST['easy_404_redirect_enable'] == 'on')) ? 'on' : 'off');
            update_option('easy_404_redirect_home', (isset($_POST['easy_404_redirect_home']) and ( $_POST['easy_404_redirect_home'] == 'home')) ? 'home' : 'page');
            update_option('easy_404_redirect_page', (isset($_POST['easy_404_redirect_page'])) ? $_POST['easy_404_redirect_page'] : 0);
            }
      }

      /**
       * add a menu
       */
      public function add_menu() {
         add_options_page("Easy 404 Redirect", "Easy 404 Redirect", "manage_categories", 'wp_easy_404_redirect', array(&$this, 'easy_404_redirect_settings_page'));
      }

      public function easy_404_redirect_settings_page() {
         if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
         }
         
         wp_enqueue_script('', plugins_url('js/admin.js', __FILE__), array('jquery', 'jquery-ui-core', 'wp-color-picker'), time(), true);

         // Render the settings template
         include(sprintf("%s/templates/options.php", dirname(__FILE__)));
      }

      function easy_404_redirect_init() {
         if (is_404() and get_option('easy_404_redirect_enable', 'off') != 'off') {
            if ( get_option('easy_404_redirect_home', 'home') == 'home') {
               $url = get_home_url();
            } else {
               $url = get_page_link(get_option('easy_404_redirect_page'));
            }
            wp_redirect($url);
         }
      }

   }

}

if (class_exists('Easy_404_Redirect')) {
   // Installation and uninstallation hooks
   register_activation_hook(__FILE__, array('Easy_404_Redirect', 'activate'));
   register_deactivation_hook(__FILE__, array('Easy_404_Redirect', 'deactivate'));

   // instantiate the plugin class
   $wp_footer_pop_up_banner = new Easy_404_Redirect();

   if (isset($wp_footer_pop_up_banner)) {

      // Add the settings link to the plugins page
      function easy_404_redirect_settings_link($links) {
         $settings_link = '<a href="options-general.php?page=wp_easy_404_redirect">Settings</a>';
         array_unshift($links, $settings_link);
         return $links;
      }

      $plugin = plugin_basename(__FILE__);
      add_filter("plugin_action_links_$plugin", 'easy_404_redirect_settings_link');
   }
}   