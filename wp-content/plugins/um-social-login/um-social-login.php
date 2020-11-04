<?php
/*
Plugin Name: Ultimate Member - Social Login
Plugin URI: http://ultimatemember.com/
Description: Social registration and login for Ultimate Member plugin.
Version: 1.4.5
Author: Ultimate Member
Author URI: http://ultimatemember.com/
*/

	require_once(ABSPATH.'wp-admin/includes/plugin.php');
	
	$plugin_data = get_plugin_data( __FILE__ );

	define('um_social_login_url',plugin_dir_url(__FILE__ ));
	define('um_social_login_path',plugin_dir_path(__FILE__ ));
	define('um_social_login_plugin', plugin_basename( __FILE__ ) );
	define('um_social_login_extension', $plugin_data['Name'] );
	define('um_social_login_version', $plugin_data['Version'] );
	
	define('um_social_login_requires', '1.3.59');
	
	$plugin = um_social_login_plugin;

	/***
	***	@Init
	***/
	require_once um_social_login_path . 'core/um-social-login-init.php';
	
	function um_social_login_login_plugins_loaded() {
		load_plugin_textdomain( 'um-social-login', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'plugins_loaded', 'um_social_login_login_plugins_loaded', 0 );
	
	/* Licensing */

	if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
		include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
	}

	$um_social_login_licensing_config = array(
		'product' 		=>	'Social Login',
		'key' 			=>	'um_social_login_license_key',
		'status_key'	=>	'um_social_login_license_status',
		'version'		=>  '1.4.5',
	);

	add_action( 'wp_loaded', 'um_social_login_plugin_updater', 0 );
	function um_social_login_plugin_updater() {
		
		if ( !function_exists( 'um_get_option' ) ) return;
		
		global $um_social_login_licensing_config, $um_licenses;
		
		$item_key 		= $um_social_login_licensing_config['key'];
		$item_status 	= $um_social_login_licensing_config['status_key'];
		$product 		= $um_social_login_licensing_config['product'];
		$version 		= $um_social_login_licensing_config['version'];
		$license_key 	= trim( um_get_option( $item_key ) );
		
		if( empty( $license_key ) ) return;

		$um_licenses['um-social-login'] = array(
			'slug'		=> basename( __FILE__, '.php' ),
			'version' 	=> $version,
			'license' 	=> $license_key,
			'item_name' => $product,
		);

	}
	
	if( ! function_exists('um_plugin_updater') ){
		add_action('admin_init','um_plugin_updater',0);
		function um_plugin_updater(){
			global $um_licenses;

			if( isset( $um_licenses ) && count( $um_licenses ) > 0 ){
				foreach( $um_licenses as $license ){
					$edd_updater = new EDD_SL_Plugin_Updater( 'https://ultimatemember.com/', __FILE__, array( 
							'version' 	=> $license['version'],
							'license' 	=> $license['license'],
							'item_name' => $license['item_name'],
							'slug'		=> $license['slug'],
							'author' 	=> 'Ultimate Member',
						)
					);
				}
			}
		}
	}

	add_filter('um_licensed_products_settings', 'um_social_login_license_key');
	function um_social_login_license_key( $array ) {
		if ( !function_exists( 'um_get_option' ) ) return;

		global $um_social_login_licensing_config;
		
		$item_key 		 = $um_social_login_licensing_config['key'];
		$item_status_key = $um_social_login_licensing_config['status_key'];
		$product 		 = $um_social_login_licensing_config['product'];
		$version 		 = $um_social_login_licensing_config['version'];
		$license_key  	 = trim( um_get_option( $item_key ) );
		$item_status 	 = get_option( $item_status_key );
		
		$array[] = array(
				'id'       		=> $item_key,
				'type'     		=> 'text',
				'title'   		=> $product . ' License Key',
				'compiler' 		=> true,
				'validate_callback' => 'um_social_login_validate_license_key',
				'class'			=> 'field-warning',
		);
		
		return $array;

	}

	function um_social_login_validate_license_key( $field, $value, $changed_value ){

			global $um_social_login_licensing_config;

			$item_key 		 = $um_social_login_licensing_config['key'];
			$item_status_key = $um_social_login_licensing_config['status_key'];
			$product 		 = $um_social_login_licensing_config['product'];
			$license_key  	 = trim( um_get_option( $item_key ) );
			
			if ( $license_key !== $value ) {
				
					if ( $license_key == '' ) {
						
						$license = trim( $value );
						$api_params = array( 
							'edd_action'=> 'deactivate_license', 
							'license' 	=> $license, 
							'item_name' => urlencode( $product ), // the name of our product in EDD
							'url'       => home_url()
						);

						$response = wp_remote_get( add_query_arg( $api_params, 'https://ultimatemember.com/' ), 
							array( 
								'timeout' => 30, 
								'sslverify' => false 
							) 
						);

						if ( is_wp_error( $response ) ){
							return false;
						}

						$license_data = json_decode( wp_remote_retrieve_body( $response ) );

						delete_option( $item_status_key );
						
					} else {
					
						$license = trim( $value );
						$api_params = array( 
							'edd_action'=> 'activate_license', 
							'license' 	=> $license, 
							'item_name' => urlencode( $product ), // the name of our product in EDD
							'url'       => home_url()
						);

						$response = wp_remote_get( add_query_arg( $api_params, 'https://ultimatemember.com/' ), 
							array( 
								'timeout' => 30, 
								'sslverify' => false 
							) 
						);

						if ( is_wp_error( $response ) ){
							return false;
						}

						$license_data = json_decode( wp_remote_retrieve_body( $response ) );

						update_option( $item_status_key, $license_data->license );
						
					}
			}	

			$item_status = get_option( $item_status_key );
				
				$return['value'] = $value;
			if( $item_status == 'invalid' ){
				$field['msg']  = __('Invalid License Key', 'ultimatemember');
				$return['warning'] = $field;
			}


	        return $return;	
	}
