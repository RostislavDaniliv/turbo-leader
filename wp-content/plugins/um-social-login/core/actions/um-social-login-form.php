<?php

	/***
	***	@save extra fields
	***/
	add_action('um_post_registration_save', 'um_social_login_save_extra_fields', 9, 2);
	function um_social_login_save_extra_fields( $user_id, $args ) {
		
		foreach( $_POST as $key => $value ) {
			
			if ( strstr( $key, '_uid_') ) {
				update_user_meta( $user_id, $key, $value );
			}
			
			if ( strstr( $key, '_save_') ) {
				$key = str_replace( '_save_', '', $key );
				update_user_meta( $user_id, $key, $value );
			}

		}


	}

	add_action('um_before_submit_form_post','um_social_before_submit_form_post');
	function um_social_before_submit_form_post( $um_post ){
		if( isset( $um_post['_um_social_login'] ) ){
			add_filter('um_secure_form_post','um_social_secure_form_post__false');
		}
	}

	function um_social_secure_form_post__false( $bool ){
		return false;
	}


	/***
	***	@modal field settings
	***/
	add_action('um_before_register_fields', 'um_social_login_add_buttons');
	add_action('um_before_login_fields', 'um_social_login_add_buttons');
	function um_social_login_add_buttons( $args ) {
		global $um_social_login;
		
		if ( isset( $um_social_login->profile ) ) return;
		
		$show_social = ( isset( $args['show_social'] ) ) ? $args['show_social'] : '-1';
		
		if ( !$show_social ) return;
		
		if ( $args['mode'] == 'register' && !um_get_option('register_show_social') ) return;
		
		if ( $args['mode'] == 'login' && !um_get_option('login_show_social') ) return;
		
		$networks = $um_social_login->networks;
		$networks = $um_social_login->available_networks();

		if( ! isset( $_REQUEST['provider'] ) && ! isset( $_REQUEST['um_social_login'] ) ){
			$_SESSION['um_social_is_shortcode'] = false;
		}

		if ( !$networks ) return;

		$o_networks = $networks;
		
		?>
		
		<div class="um-field">
			
			<div class="um-col-alt">
		
				<?php $i = 0; foreach( $o_networks as $id => $arr ) {
					$i++;
					
					$class = 'um-left';
					
					if ( $i % 2 == 0 ) {
						$class = 'um-right';
					}

					?>
				
				<div class="<?php echo $class; ?> um-half"><a href="<?php echo $um_social_login->login_url( $id ); ?>" title="<?php echo $arr['button']; ?>"  data-redirect-url="<?php echo $um_social_login->get_redirect_url(); ?>" class="um-button um-alt um-button-social um-button-<?php echo $id; ?>"><i class="<?php echo $arr['icon']; ?>"></i><?php echo $arr['button']; ?></a></div>

				<?php 
				
					if ( $i % 2 == 0 && count($o_networks) != $i ) {
						echo '<div class="um-clear"></div></div><div class="um-col-alt um-col-alt-s">';
					}
				
				}
				
				?>
				
				<div class="um-clear"></div>
			
			</div>
			
		</div>
		
		<style type="text/css">
		
			.um-<?php echo $args['form_id']; ?>.um a.um-button.um-button-social {
				padding-left: 5px !important;
				padding-right: 5px !important;
			}
			
			<?php foreach( $o_networks as $id => $arr ) { ?>
			.um-<?php echo $args['form_id']; ?>.um a.um-button.um-button-<?php echo $id; ?> {background-color: <?php echo $arr['bg']; ?>!important}
			.um-<?php echo $args['form_id']; ?>.um a.um-button.um-button-<?php echo $id; ?>:hover {background-color: <?php echo $arr['bg_hover']; ?>!important}
			.um-<?php echo $args['form_id']; ?>.um a.um-button.um-button-<?php echo $id; ?> {color: <?php echo $arr['color']; ?>!important}
			<?php } ?>

		</style>
	
		<?php

	}

	add_action('um_before_register_fields', 'um_social_register_hidden_fields');
	function um_social_register_hidden_fields( $args ){

		if( isset( $args['custom_fields'] ) && ! empty(  $args['custom_fields'] ) ){
			
			$arr_field_keys =  array_keys( $args['custom_fields']  );
			if( ! in_array( 'first_name', $arr_field_keys ) ){
				echo "<input type='hidden' name='first_name' value='".esc_attr( $_SESSION['um_social_profile']['first_name'])."' data-key='first_name' />";
			}
			
			if( ! in_array( 'last_name', $arr_field_keys ) ){
				echo "<input type='hidden' name='last_name' value='".esc_attr( $_SESSION['um_social_profile']['last_name'])."' data-key='last_name' />";
			}

			if( ! in_array( 'user_email', $arr_field_keys ) ){
				echo "<input type='hidden' name='user_email' value='".esc_attr( $_SESSION['um_social_profile']['user_email'])."' data-key='user_email' />";
			}

			if( isset( $_SESSION['um_social_profile'] ) ){
				echo "<input type='hidden' name='_um_social_login' value='1' />";
			}
			
			add_action('um_register_hidden_role_field', array( 'UM_Social_Login_Shortcode', 'custom_user_role'), 1, 1 );
	
		}
		
	}

   	add_filter('um_submit_form_data','um_submit_form_data', 10, 2);
	function um_submit_form_data( $form ,$mode ){

		$fields = unserialize( $form['custom_fields'] );
		$arr_field_keys =  array_keys( $fields  );

		if( ! in_array( 'first_name', $arr_field_keys ) ){
			$first_name = array(
				"editable" => 1,
				"in_column" => 1,
				"in_group" => "",
				"in_row" => "_um_row_1",
				"in_sub_row" => 0,
				"label" => "First Name",
				"metakey" => "first_name",
				"position" => "1",
				"public" => "1",
				"required" => "0",
				"title" => "First Name",
				"type" => "text"
			);
			$fields['first_name'] = $first_name;
		}

		if( ! in_array( 'last_name', $arr_field_keys ) ){
			$last_name = array(
				"editable" => 1,
				"in_column" => 1,
				"in_group" => "",
				"in_row" => "_um_row_1",
				"in_sub_row" => 0,
				"label" => "Last Name",
				"metakey" => "last_name",
				"position" => "1",
				"public" => "1",
				"required" => "0",
				"title" => "Last Name",
				"type" => "text"
			);
			$fields['last_name'] = $last_name;
		}

		if( ! in_array( 'user_email', $arr_field_keys ) ){
			$user_email = array(
				"editable" => 1,
				"in_column" => 1,
				"in_group" => "",
				"in_row" => "_um_row_1",
				"in_sub_row" => 0,
				"label" => "Email Address",
				"metakey" => "user_email",
				"position" => "1",
				"public" => "1",
				"required" => "0",
				"title" => "Email Address",
				"type" => "text",
				'validate' => 'unique_email'
			);
			$fields['user_email'] = $user_email;
		}

		$form['custom_fields'] = serialize( $fields );

		return $form;
}

