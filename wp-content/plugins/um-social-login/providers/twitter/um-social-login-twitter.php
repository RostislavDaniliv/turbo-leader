<?php

require um_social_login_path . 'providers/twitter/api/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class UM_Social_Login_Twitter {

	public $login_url_called = 0;

	function __construct() {
		
		add_action('init', array(&$this, 'load'));
		
		add_action('init', array(&$this, 'get_auth'));

	}

	/***
	***	@load
	***/
	function load() {
		global $um_social_login, $ultimatemember;
		
		$this->consumer_key = trim( um_get_option('twitter_consumer_key') );
		$this->consumer_secret = trim( um_get_option('twitter_consumer_secret') );
		if( method_exists ( 'UM_Social_Login_API','get_redirect_url' ) ){
			$this->oauth_callback =  $um_social_login->get_redirect_url() ;
		}
		$this->oauth_callback = add_query_arg( 'provider', 'twitter', $this->oauth_callback );
		$this->oauth_callback = remove_query_arg( 'oauth_token', $this->oauth_callback );
		$this->oauth_callback = remove_query_arg( 'oauth_verifier', $this->oauth_callback );
	}

	/***
	***	@Get auth
	***/
	function get_auth() {
		global $um_social_login;
		
		if( isset( $_REQUEST['um_social_login'] ) &&  $_REQUEST['um_social_login'] == "twitter" ){
			$_SESSION['tw_oath_url'] =  $this->login_url();
			wp_redirect( $this->login_url() );
			echo '<meta http-equiv="refresh" content="0;URL='.$this->login_url().'" />  ';
		}

		if ( isset($_REQUEST['provider']) && $_REQUEST['provider'] == 'twitter' && isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']) ) {
				
				if( ! $this->is_session_started() ){
					session_start();
				}

				$access_token =  null;
				if( ! isset( $_SESSION['tw_access_token'] ) ){
					$_SESSION['tw_landed_callback_url'] = $this->oauth_callback;
					try{ 
						$request_token['oauth_token'] = $_SESSION['tw_oauth_token'];
						$request_token['oauth_token_secret'] = $_SESSION['tw_oauth_token_secret'];
						
						$connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret,$request_token['oauth_token'] , $request_token['oauth_token_secret']);
						$access_token = $connection->oauth("oauth/access_token", 
							array(
								"oauth_verifier" => $_GET['oauth_verifier'], 
								"oauth_callback" => $this->oauth_callback
							)
						);
						$_SESSION['tw_access_token'] = $access_token;

					}catch(Exception $e ){
						wp_die( 'UM Social Login - Twitter Access Token: <br/><strong>'.$e->getMessage().'</strong>'
							.'<br/>Callback URL: '.$this->oauth_callback
							.'<br/>oAuth Verifier: '.esc_html($_GET['oauth_verifier'])
							.'<br/>Access Token: '.esc_html( empty( $access_token ) ? $access_token : 'None'  ) 
							.'<br/>Has oAuth Token: '.esc_html( empty($_SESSION['tw_oauth_token']) ?'No':'Yes' )
							.'<br/>Has oAuth Secret: '.esc_html( empty($_SESSION['tw_oauth_token_secret']) ?'No':'Yes' )
							.'<br/>Referrer URL: '.esc_html( $_SESSION['tw_referral_callback_url'] )
							.'<br/>Landed URL: '.esc_html( $_SESSION['tw_landed_callback_url'] )
							.'<br/>oAuth URL: '.esc_html( $_SESSION['tw_oath_url'] )
							,'UM Social Login - Twitter Error', array('back_link' => true ) );
					}
				}

				if( isset( $_SESSION['tw_access_token'] ) ){
					try{ 
						
						$access_token = $_SESSION['tw_access_token'];
						$connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
						$profile = $connection->get("account/verify_credentials");
						$profile = json_decode(json_encode($profile), true);

					}catch(Exception $e ){
						wp_die( 'UM Social Login - Twitter Verify Credentials: '.$e->getMessage().' - '.$this->oauth_callback,'UM Social Login - Twitter Error', array('back_link' => true ) );
					}
				}

				
				if( isset($profile['errors']) && count($profile['errors']) > 0 ){
					wp_die( 'UM Social Login - Twitter SDK Error: '.$profile['errors'][0]['message'].' - '.$this->oauth_callback,'UM Social Login - Twitter Error', array('back_link' => true ) );
				}

				$name = $profile['name'];
				$name = explode(' ', $name);
				
				// prepare the array that will be sent
				$profile['username'] = $profile['screen_name'];
				$profile['user_login'] = $profile['screen_name'];
				$profile['first_name'] = isset( $name[0] ) ? $name[0]: '';
				$profile['last_name'] =  isset( $name[1] ) ? $name[1]: '';

				// username/email exists
				$profile['email_exists'] = '';
				$profile['username_exists'] = '';
				
				// provider identifier
				$profile['_uid_twitter'] = $profile['id'];
				
				if ( isset( $profile['profile_image_url'] ) && strstr( $profile['profile_image_url'], '_normal' ) ) {
					$profile['_save_synced_profile_photo'] = str_replace('_normal','',$profile['profile_image_url']);
				}
				
				$profile['_save_twitter_handle'] = '@' . $profile['screen_name'];
				$profile['_save_twitter_link'] = 'https://twitter.com/' . $profile['screen_name'];
				$profile['_save_twitter_photo_url_dyn'] = $profile['profile_image_url'];

				// have everything we need?
				$um_social_login->resume_registration( $profile, 'twitter' );
			
			
		}
		
	}
		
	/***
	***	@get login uri
	***/
	function login_url() {
		global $ultimatemember;
		if( ! isset( $_REQUEST['um_social_login'] ) ){
			$this->login_url = um_get_core_page('login');
			$this->login_url = add_query_arg('um_social_login','twitter', $this->login_url );
		}else{
			if( ! isset($_REQUEST['oauth_token']) && ! isset($_REQUEST['oauth_verifier']) && $this->login_url_called == 0 ){
				if( ! $this->is_session_started() ){
						session_start();
				}
				
				if( ! is_user_logged_in() ){
					unset( $_SESSION['tw_access_token'] );
				}

				try{
					$connection = new TwitterOAuth( $this->consumer_key, $this->consumer_secret );
					$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $this->oauth_callback ));
					
					
						$_SESSION['tw_oauth_token'] = $request_token['oauth_token'];
						$_SESSION['tw_oauth_token_secret'] = $request_token['oauth_token_secret'];
						$_SESSION['tw_referral_callback_url'] = $this->oauth_callback;
					if( $connection->getLastHttpCode() ==200 ){
						$this->login_url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));
					}else{
						$this->login_url = '?error=400';
					}

				} catch (Exception $e) {
						$this->login_url = '?error_message='.$e->getMessage();

				}
			}
			$this->login_url_called++;
		}
		return $this->login_url;
		
	}

	/**
	 * Checks if session has been started
	 * @return bool
	*/
	function is_session_started(){
		
		if ( php_sapi_name() !== 'cli' ) {
		        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
		            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
		        } else {
		            return session_id() === '' ? FALSE : TRUE;
		        }
		}
		
		return FALSE;
	}
		
}