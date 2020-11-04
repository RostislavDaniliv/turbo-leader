<?php

class UM_Social_Login_LinkedIn {

	function __construct() {
		
		add_action('init', array(&$this, 'load'));
		
		add_action('init', array(&$this, 'get_auth'));

	}

	/***
	***	@load
	***/
	function load() {
		global $um_social_login, $ultimatemember;
		
		if( ! class_exists( 'LinkedIn' ) ){
			require_once um_social_login_path . 'providers/linkedin/api/LinkedIn.php';
		}
		
		$this->api_key = trim( um_get_option('linkedin_api_key') );
		$this->api_secret = trim( um_get_option('linkedin_api_secret') );
		if( method_exists ( 'UM_Social_Login_API','get_redirect_url' ) ){
			$this->oauth_callback = $um_social_login->get_redirect_url();
		}
		$this->oauth_callback = add_query_arg( 'provider', 'linkedin', $this->oauth_callback );

		$this->login_url = '';

	}

	/***
	***	@Get auth
	***/
	function get_auth() {
		global $um_social_login;
		
		if( isset( $_REQUEST['um_social_login'] ) &&  $_REQUEST['um_social_login'] == "linkedin" ){
			wp_redirect( $this->login_url() );
			echo '<meta http-equiv="refresh" content="0;URL='.$this->login_url().'" />  ';
		}

		if ( isset($_REQUEST['provider']) && $_REQUEST['provider'] == 'linkedin' && isset( $_REQUEST['code']  ) ) {

				try{
					$provider = new LinkedIn(
						  array(
						    'api_key' => $this->api_key, 
						    'api_secret' => $this->api_secret, 
						    'callback_url' => $this->oauth_callback
						  )
					);

				}catch( Exception $e ){
					exit( wp_redirect( $this->oauth_callback ) );
				}

			$i = 0;

			
			if( ! isset( $_POST ) && empty(  $_POST  ) ||  empty(  $_SESSION['um_social_login_linked_code'] )  ){
				$i = 1;
				$code = $_REQUEST['code'];
				$_SESSION['um_social_login_linked_code'] = $code;

			}

			if( ! isset( $code ) ){
				$i = 2;
				$code = $_SESSION['um_social_login_linked_code'];
			}

			// invalid token: abort
			if ( isset( $code ) ) {
				
				if( ! isset( $_SESSION['um_social_login_linked_info'] ) ){
					try{					
						$request_data = array(
							'id',
							'last-name',
							'first-name',
							'picture-url',
							'email-address', 
							'public-profile-url',
							'picture-urls::(original)', 
						);

						$request_data = apply_filters('um_social_login_linked_request_data', $request_data );

	            		$token = $provider->getAccessToken( $code  );
	            		$token = apply_filters('um_social_login_linked_token', $token );
				
						$info = $provider->get('/people/~:('.implode( ",", $request_data ).')');
						$_SESSION['um_social_login_linked_info'] = serialize( $info );

					}catch( Exception $e ){
					 	wp_die(  "UM Social Login - LinkedIn SDK Error Message:"
					 		."<br/>".$e->getMessage()
					 		."<br/>Error Code: ".$i
					 		."<br/>Callback URL: ".$this->oauth_callback );
					}
				}else{
					$info = unserialize( $_SESSION['um_social_login_linked_info'] );
				}


				if ( isset ( $info['pictureUrls'] ) 
					&& isset( $info['pictureUrls']['values'] ) 
					&& isset( $info['pictureUrls']['values'][0] ) ) {
						$profile['picture-original'] = $info['pictureUrls']['values'][0];
				} else if ( isset( $info['pictureUrl'] ) ) {
						$profile['picture-original'] = $info['pictureUrl'];
				}else{
					$profile['picture-url'] = um_get_option('default_avatar');
					$profile['picture-original'] = um_get_option('default_avatar');
				}

				if ( isset( $profile['picture-original'] ) ) {
						$profile['_save_synced_profile_photo'] = $profile['picture-original'];
				}

				if ( isset( $profile['picture-url'] ) ) {
						$profile['_save_linkedin_photo_url_dyn'] = $profile['picture-url'];
				}
				
				
				// prepare the array that will be sent
				$profile['user_email'] = $info['emailAddress'];
				$profile['first_name'] = $info['firstName'];
				$profile['last_name']  = $info['lastName'];
				
				// username/email exists
				$profile['email_exists'] = $info['emailAddress'];
				$profile['username_exists'] = $info['emailAddress'];
				
				// provider identifier
				$profile['_uid_linkedin'] = $info['id'];
				
				$profile['_save_linkedin_handle'] = $info['firstName'] . ' ' . $info['lastName'];
				$profile['_save_linkedin_link'] = $info['publicProfileUrl'];

				if ( isset( $profile['picture-original'] ) ) {
					$profile['_save_synced_profile_photo'] = $profile['picture-original'];
				}
			
				if ( isset( $profile['picture-url'] ) ) {
					$profile['_save_linkedin_photo_url_dyn'] = $profile['picture-url'];
				}
				
				$profile = apply_filters('um_social_login_linked_profile', $profile, $info );
				// have everything we need?
				$um_social_login->resume_registration( $profile, 'linkedin' );
				
			}
			
		}

	}
		
	/***
	***	@get login uri
	***/
	function login_url() {
		global $ultimatemember, $um_social_login;
		
		if( ! isset( $_REQUEST['um_social_login'] ) ){
			$this->login_url = um_get_core_page('login');
			$this->login_url = add_query_arg('um_social_login','linkedin', $this->login_url );
			$this->login_url = add_query_arg('um_social_login_ref', $um_social_login->shortcode_id, $this->login_url );
		}else{

			if ( ! isset( $_REQUEST['code'] ) && ! isset( $_REQUEST['state'] )  ) {
				
				if( ! isset(  $_SESSION['um_social_login_linked_code']  ) || ! isset( $_POST ) ){
						
						$provider = new LinkedIn(
								  array(
								    'api_key' => $this->api_key, 
								    'api_secret' => $this->api_secret, 
								    'callback_url' => $this->oauth_callback
								  )
						);
						$scope = array(
							    LinkedIn::SCOPE_BASIC_PROFILE, 
							    LinkedIn::SCOPE_EMAIL_ADDRESS, 
						);

						$scope = apply_filters('um_social_login_linked_scope', $scope );
						$url = $provider->getLoginUrl( $scope );

						$this->login_url = $url;

				}

				unset( $_SESSION['um_social_login_linked_code'] );
				unset( $_SESSION['um_social_login_linked_info'] );

				
			}
		}
		
		return $this->login_url;
		
	}
		
}