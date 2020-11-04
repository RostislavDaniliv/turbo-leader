<?php
/**
 * API INFO USER
 */


if (!class_exists('InfoUserApi')) {
    class InfoUserApi
    {
        /**
         * API url
         * @var string
         */
        protected $url = 'https://turbo-leader.com/api/';

        /**
         * API key
         * @var string
         */
        protected $api_key = null;

        /**
         * Format
         * @var string
         */
        protected $format = null; // json, xml, printr, js

        /**
         * Format
         * @var string
         */
        protected $type_request = null; // default, put, delete, js

        /**
         * Curl options
         * @var options
         */
        protected $curl_options = array(
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_TIMEOUT => 8
        );

        /**
         * Error codes
         * @var array
         */
        protected $http_errors = array
        (
            400 => '400 Bad Request',
            401 => '401 Unauthorized',
            403 => '403 Forbidden',
            404 => '404 Not Found',
            422 => '422 Unprocessable Entity',
            500 => '500 Internal Server Error',
            501 => '501 Not Implemented',
        );

        /**
         * Allowed formats
         * @var unknown
         */
        protected $formats = array('json', 'xml', 'js', 'printr');

        /**
         * Constructor
         * @throws Exception
         */
        public function __construct()
        {
            if (false === extension_loaded('curl'))
            {
                throw new Exception('The curl extension must be loaded for using this class!');
            }

            $this->url = isset($_REQUEST['url']) ? $_REQUEST['url'] : $this->url;
            $this->api_key = isset($_REQUEST['api_key']) ? $_REQUEST['api_key'] : $this->api_key;
            $this->format = isset($_REQUEST['format']) && in_array(strtolower($_REQUEST['format']), $this->formats) ? strtolower($_REQUEST['format']) : $this->format;
            $this->type_request = isset($_REQUEST['type_request']) ? $_REQUEST['type_request'] : false;
            $this->user_name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : false;

        }

        public function responseRequest()
        {
            switch ($this->type_request) {
                case null:
                    return $this->get_info_user();
                    break;
                case 'add_invited_user':
                    $this->add_invited_user();
                    return true;
                    break;
                default:
                    $this->get_info_user();
            }

        }

        protected function get_user()
        {
            if ($this->user_name) {
                $uq = new WP_User_Query(array(
                    'search' => $this->user_name,
                    'search_columns' => array('user_email', 'user_nicename', 'user_login')
                ));
                return $uq->results;
            } else
            {
                wp_die();
            }
        }

        protected function get_info_user($format_response = true)
        {
		

            $user = $this->get_user();

            if ( ! empty( $user ) ) {

                foreach ( $user as $u ) {

                  $data_user['ID'] = $u->ID;

                    $user_info = get_userdata($u->ID);

                    $data_user['display_name'] = $u->user_nicename;

                    $data_user['first_name'] = $user_info->first_name;

                    $data_user['last_name'] = $user_info->last_name;

                    $data_user['user_email'] = $u->user_email;

                    $data_user['phone_number'] = get_user_meta( $u->ID, 'phone_number', true );

                    $data_user['regpartner'] = get_user_meta( $u->ID, 'regpartner', true );

                    $data_user['demo_version'] = get_user_meta( $u->ID, 'payproduct', true );

                    $data_user['buy_license'] = get_user_meta( $u->ID, 'payproduct_18', true );

                    $data_user['bot_link'] = get_user_meta( $u->ID, 'arendaproduct', true );

                    $data_user['instagram'] = get_user_meta( $u->ID, 'instagram', true );

                    $data_user['facebook'] = get_user_meta( $u->ID, 'facebook', true );

                    $data_user['vk'] = get_user_meta( $u->ID, 'vk', true );

                    $data_user['vk1'] = get_user_meta( $u->ID, 'googleplus', true );

                    $data_user['whatsapp'] = get_user_meta( $u->ID, 'vkontakte', true );

                    $data_user['telegram'] = get_user_meta( $u->ID, 'skype', true );

                    $data_user['sushi_site'] = get_user_meta( $u->ID, 'arendaproduct', true );

                    $data_user['sushireg'] = get_user_meta( $u->ID, 'yoke_promo', true );

		    $data_user['video_lp5'] = get_user_meta( $u->ID, 'video_lp5', true );
			
		    $data_user['yoke_calc'] = get_user_meta( $u->ID, 'yoke_calc', true );


                    $all_meta_for_user = get_user_meta( $u->ID );

					
} 
					
                    //var_dump($all_meta_for_user);
						    if(get_user_meta( $u->ID, 'role', true ) == "guest-game"){
		echo "Оплати систему";
		exit;

                }
		if(get_user_meta( $u->ID, 'role', true ) == "guest-yoke"){
		echo "Оплати систему";
		exit;

                }
            } else {

                $data_user['message'] = 'Пользователей по заданным критериям не найдено.';

            }
            if (true == $format_response)
            {
                $response = json_encode($data_user, JSON_UNESCAPED_UNICODE);
            } else {
                $response = $data_user;
            }
            return $response;
        }

        public function add_invited_user()
        {
            $request_invited_user['user_ref'] = isset($_REQUEST['ref']) ? $this->specialchars_fild($_REQUEST['ref']) : false;
            $request_invited_user['invited_scr'] = isset($_REQUEST['scr']) ? $this->specialchars_fild($_REQUEST['scr']) : false;
            $request_invited_user['invited_number'] = isset($_REQUEST['number']) ? $this->specialchars_fild($_REQUEST['number']) : false;
            $request_invited_user['invited_firstname'] = isset($_REQUEST['firstname']) ? $this->specialchars_fild($_REQUEST['firstname']) : false;
	    $request_invited_user['question'] = isset($_REQUEST['question']) ? $this->specialchars_fild($_REQUEST['question']) : false;
	    $request_invited_user['task'] = isset($_REQUEST['task']) ? $this->specialchars_fild($_REQUEST['task']) : false;
            $user_arr = $this->get_user();
            $user = $user_arr[0]; 
            if ( !empty( $user ) && $request_invited_user['invited_number'] )
            {
                $user_id = $user->ID;
                //var_dump(get_user_meta( $user_id, 'invited_user', true ));echo '<br>';
                //var_dump($request_invited_user['invited_number']);echo '<br>';
                if (get_user_meta( $user_id, 'invited_user', true ))
                    $invited_user = json_decode(get_user_meta( $user_id, 'invited_user', true ), true);
                else
                    $invited_user = array();
                //var_dump($invited_user);
                //var_dump(json_decode(get_user_meta( $user_id, 'invited_user', true )));echo '<br>';
                if (!array_key_exists($request_invited_user['invited_number'], $invited_user))
                    $invited_user[$request_invited_user['invited_number']] = (array)$request_invited_user;
                print_r($invited_user);echo '<br>';
                update_user_meta( $user_id, 'invited_user', json_encode($invited_user, JSON_UNESCAPED_UNICODE) );
            }
        }

        protected function specialchars_fild($fild)
        {
            $fild = addslashes($fild);
            $fild = htmlspecialchars ($fild);
            $fild = preg_replace("/^[^0-9A-Za-zА-Яа-яЁё]+$/u", "", $fild);
            $fild = trim($fild);
            return $fild;
        }
    }
}