<?php
/*
  Plugin Name: Free-Kassa
  Plugin URI: http://free-kassa.ru/
  Description: Модуль для приема платежей в платежной системе Free-Kassa.
  Version: 1.0
  Author: Free-Kassa
  Author URI: http://free-kassa.ru/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'woocommerce_freekassa', 0 );

function woocommerce_freekassa() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}

	if ( class_exists( 'WC_FREEKASSA' ) ) {
		return;
	}

	class WC_FREEKASSA extends WC_Payment_Gateway {
		public function __construct() {
			global $woocommerce;

			$plugin_dir = plugin_dir_url( __FILE__ );

			$this->id         = 'freekassa';
			$this->icon       = apply_filters( 'woocommerce_freekassa_icon', $plugin_dir . 'freekassa.png' );
			$this->has_fields = false;

			$this->init_form_fields();
			$this->init_settings();

			$this->title                  = $this->get_option( 'title' );
			$this->freekassa_url          = $this->get_option( 'freekassa_url' );
			$this->freekassa_merchant     = $this->get_option( 'freekassa_merchant' );
			$this->freekassa_secret_key_1 = $this->get_option( 'freekassa_secret_key_1' );
			$this->freekassa_secret_key_2 = $this->get_option( 'freekassa_secret_key_2' );
			$this->email_error            = $this->get_option( 'email_error' );
			$this->ip_filter              = $this->get_option( 'ip_filter' );
			$this->log_file               = $this->get_option( 'log_file' );
			$this->description            = $this->get_option( 'description' );

			add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'receipt_page' ) );

			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array(
				$this,
				'process_admin_options'
			) );

			add_action( 'woocommerce_api_wc_' . $this->id, array( $this, 'check_ipn_response' ) );

			if ( ! $this->is_valid_for_use() ) {
				$this->enabled = false;
			}
		}

		function is_valid_for_use() {
			return true;
		}

		public function admin_options() {
			$option = '<h3>' . __( 'Freekassa', 'woocommerce' ) . '</h3>';
			$option .= '<p>' . __( 'Настройка приема электронных платежей через Freekassa.', 'woocommerce' ) . '</p>';

			 if ( $this->is_valid_for_use() ) {
			     $option .= '<table class="form-table">';
			     $option .= $this->generate_settings_html();
			     $option .= '</table>';
			 }else {
                $option .= '<div class="inline error"><p>';
                $option .= '<strong>' . __( 'Шлюз отключен', 'woocommerce' ) . '</strong>';
                $option .= __( 'Freekassa не поддерживает валюты Вашего магазина.', 'woocommerce' );
                $option .= '</p></div>';
			 }
			 echo $option;
		}

		function init_form_fields() {
		    $a = $_SERVER['SERVER_NAME'];
			$this->form_fields = array(
				'enabled'                => array(
					'title'   => __( 'Включить/Выключить', 'woocommerce' ),
					'type'    => 'checkbox',
					'label'   => __( 'Включен', 'woocommerce' ),
					'default' => 'yes'
				),
				'title'                  => array(
					'title'       => __( 'Название', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'Это название, которое пользователь видит во время выбора способа оплаты.', 'woocommerce' ),
					'default'     => __( 'Freekassa', 'woocommerce' )
				),
				'freekassa_url'          => array(
					'title'       => __( 'URL мерчанта', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'url для оплаты в системе Freekassa', 'woocommerce' ),
					'default'     => '//free-kassa.ru/merchant/cash.php'
				),
				'freekassa_merchant'     => array(
					'title'       => __( 'Идентификатор магазина', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'Идентификатор магазина, зарегистрированного в системе "Free-kassa".<br/>Узнать его можно в аккаунте Free-kassa".', 'woocommerce' ),
					'default'     => ''
				),
				'freekassa_secret_key_1' => array(
					'title'       => __( 'Секретный ключ 1', 'woocommerce' ),
					'type'        => 'password',
					'description' => __( 'Первый секретный ключ. <br/>Должен совпадать с секретным ключем № 1, указанным в Free-kassa".', 'woocommerce' ),
					'default'     => ''
				),
				'freekassa_secret_key_2' => array(
					'title'       => __( 'Секретный ключ 2', 'woocommerce' ),
					'type'        => 'password',
					'description' => __( 'Второй секретный ключ оповещения о выполнении платежа,<br/>который используется для проверки целостности полученной информации<br/>и однозначной идентификации отправителя.<br/>Должен совпадать с секретным ключем № 2, указанным в Free-kassa".', 'woocommerce' ),
					'default'     => ''
				),
				'log_file'               => array(
					'title'       => __( 'Путь до файла для журнала оплат через Freekassa (например, /freekassa_orders.log)', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'Если путь не указан, то журнал не записывается', 'woocommerce' ),
					'default'     => ''
				),
				'ip_filter'              => array(
					'title'       => __( 'IP фильтр', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'Список доверенных ip адресов, можно указать маску', 'woocommerce' ),
					'default'     => '136.243.38.147, 136.243.38.149, 136.243.38.150, 136.243.38.151, 136.243.38.189, 136.243.38.108'
				),
				'email_error'            => array(
					'title'       => __( 'Email для ошибок', 'woocommerce' ),
					'type'        => 'text',
					'description' => __( 'Email для отправки ошибок оплаты', 'woocommerce' ),
					'default'     => ''
				),
				'description'            => array(
					'title'       => __( 'Description', 'woocommerce' ),
					'type'        => 'textarea',
					'description' => __( 'Описанием метода оплаты которое клиент будет видеть на вашем сайте.', 'woocommerce' ),
					'default'     => 'Оплата с помощью Free-kassa'
				),
				'URL'            => array(
					'title'       => __( 'Настройка URL', 'woocommerce' ),
					'type'        => 'hidden',
					'description' => __( "URL оповещения: <br/>
                                            http://$a/?wc-api=wc_freekassa&freekassa=result<br/>
                                         URL возврата в случае успеха:<br/>
                                            http://$a/?wc-api=wc_freekassa&freekassa=calltrue<br/>
                                         URL возврата в случае неудачи:<br/>
                                            http://$a/?wc-api=wc_freekassa&freekassa=callfalse<br/> ", 'woocommerce'),

				)

			);
		}

		function payment_fields() {
			if ( $this->description ) {
				echo wpautop( wptexturize( $this->description ) );
			}
		}

		public function generate_form( $order_id ) {
			global $woocommerce;

			$order = new WC_Order( $order_id );

			$m_url = $this->freekassa_url;

			$m_shop     = $this->freekassa_merchant;
			$m_order_id = $order_id;
			$m_amount   = number_format( $order->order_total, 2, '.', '' );
			$m_key      = $this->freekassa_secret_key_1;

			$arHash = array
			(
				$m_shop,
				$m_amount,
				$m_key,
				$m_order_id,
			);
			$sign   = md5( implode( ":", $arHash ) );

			return
				'<form method="GET" action="' . $m_url . '">
				<input type="hidden" name="m" value="' . $m_shop . '">
				<input type="hidden" name="oa" value="' . $m_amount . '">
				<input type="hidden" name="o" value="' . $m_order_id . '">	
				<input type="hidden" name="s" value="' . $sign . '">	
				<input type="submit" name="m_process" value="Оплатить" />
			</form>';
		}

		function process_payment( $order_id ) {
			$order = new WC_Order( $order_id );

			return array(
				'result'   => 'success',
				'redirect' => add_query_arg( 'order', $order->id, add_query_arg( 'key', $order->order_key, get_permalink( woocommerce_get_page_id( 'pay' ) ) ) )
			);
		}

		function receipt_page( $order ) {
			echo '<p>' . __( 'Спасибо за Ваш заказ, пожалуйста, нажмите кнопку ниже, чтобы заплатить.', 'woocommerce' ) . '</p>';
			echo $this->generate_form( $order );
		}

		function check_ipn_response() {
			global $woocommerce;

			if ( isset( $_REQUEST['freekassa'] ) && $_REQUEST['freekassa'] == 'result' ) {
				if ( isset( $_REQUEST["MERCHANT_ID"] ) && isset( $_REQUEST["SIGN"] ) ) {

				    $m_key  = $this->freekassa_secret_key_2;
					$arHash = array(
						$_REQUEST['MERCHANT_ID'],
						$_REQUEST['AMOUNT'],
						$m_key,
						$_REQUEST['MERCHANT_ORDER_ID']
					);

					$sign_hash = md5( implode( ":", $arHash ) );

					// проверка принадлежности ip списку доверенных ip
					$valid_ip = true;
					if ( ! empty( $this->ip_filter ) ) {
						$ip_filter_arr = explode(',', str_replace( ' ', '', $this->ip_filter ) );
                        $this_ip       = $_SERVER['REMOTE_ADDR'];

						foreach ( $ip_filter_arr as $key => $value ) {
							$ip_filter_arr[ $key ] = ip2long( $value );
						}

						if ( ! in_array( ip2long( $this_ip ), $ip_filter_arr ) ) {
							$valid_ip = false;
						}

					}

					$log_text =
						"--------------------------------------------------------\n" .
						"id you	shoop   	" . $_REQUEST["MERCHANT_ID"] . "\n" .
						"amount				" . $_REQUEST["AMOUNT"] . "\n" .
						"kassa operation id " . $_REQUEST["intid"] . "\n" .
						"mercant order id	" . $_REQUEST["MERCHANT_ORDER_ID"] . "\n" .
						"e-mail client		" . $_REQUEST["P_EMAIL"] . "\n" .
						"phone client    	" . $_REQUEST["P_PHONE"] . "\n" .
						"currency			" . $_REQUEST["CUR_ID"] . "\n" .
						"sign				" . $_REQUEST["SIGN"] . "\n\n";

					if ( ! empty( $this->log_file ) ) {
						file_put_contents( $_SERVER['DOCUMENT_ROOT'] . $this->log_file, $log_text, FILE_APPEND );
					}

					$order = new WC_Order( $_REQUEST["MERCHANT_ORDER_ID"] );

					if ( $_REQUEST["SIGN"] == $sign_hash && $valid_ip ) {
						$order->update_status( 'completed', __( 'Платеж успешно оплачен', 'woocommerce' ) );
						WC()->cart->empty_cart();
						exit ( 'YES' );
					} else {
						$order->update_status( 'failed', __( 'Платеж не оплачен', 'woocommerce' ) );

						$to      = $this->email_error;
						$subject = "Ошибка оплаты";
						$message = "Не удалось провести платёж через систему Freekassa по следующим причинам:\n\n";
						if ( $_REQUEST["SIGN"] != $sign_hash ) {
							$message .= " - Не совпадают цифровые подписи\n";
						}
						if ( ! $valid_ip ) {
							$message .= " - ip-адрес сервера не является доверенным\n";
							$message .= "   доверенные ip: " . $this->ip_filter . "\n";
							$message .= "   ip текущего сервера: " . $_SERVER['REMOTE_ADDR'] . "\n";
						}
						$message .= "\n" . $log_text;
                            $headers = "From: no-reply@" . $_SERVER['HTTP_SERVER'] . "\r\nContent-type: text/plain; charset=utf-8 \r\n";
						mail( $to, $subject, $message, $headers );
						exit ( $_REQUEST["MERCHANT_ORDER_ID"] . '|error');
					}
				} else {
					wp_die( 'IPN Request Failure' );
				}
			} else if ( isset( $_REQUEST['freekassa'] ) && $_REQUEST['freekassa'] == 'calltrue' ) {

			    WC()->cart->empty_cart();
				$order = new WC_Order( $_REQUEST["MERCHANT_ORDER_ID"] );
				wp_redirect( $this->get_return_url( $order ) );

			} else if ( isset( $_REQUEST['freekassa'] ) && $_REQUEST['freekassa'] == 'callfalse' ) {

			    WC()->cart->empty_cart();
				$order = new WC_Order( $_REQUEST["MERCHANT_ORDER_ID"] );
				$order->update_status( 'failed', __( 'Платеж не оплачен', 'woocommerce' ) );
				wp_redirect( $this->get_return_url( $order ) );
			}
		}
	}

	function add_freekassa_gateway( $methods ) {
		$methods[] = 'WC_FREEKASSA';

		return $methods;
	}

	add_filter( 'woocommerce_payment_gateways', 'add_freekassa_gateway' );
}

?>