<?php
if(!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

/**
 * PayGate Payment Gateway - PayWeb3
 *
 * Provides a PayGate PayWeb3 Payment Gateway.
 *
 * @class       woocommerce_paygate
 * @package     WooCommerce
 * @category    Payment Gateways
 * @author      PayGate
 *
 */
class WC_Gateway_PayGate extends WC_Payment_Gateway {

	const TEST_PAYGATE_ID     = '10011072130';
	const TEST_ENCRYPTION_KEY = 'secret';

	public $version = '1.1.0';

	public $id = 'paygate';

	private $initiate_url = 'https://secure.paygate.co.za/payweb3/initiate.trans';
	private $process_url  = 'https://secure.paygate.co.za/payweb3/process.trans';
	private $query_url    = 'https://secure.paygate.co.za/payweb3/query.trans';

	private $merchant_id;
	private $encryption_key;
	private $payVault;

	private $vaultCard;
	private $vaultId;

	private $initiate_response;
	private $response_url;
	private $data_to_send;

	private $msg;

	public function __construct(){

		$this->method_title       = __('PayGate via PayWeb3', 'paygate');
		$this->method_description = __('PayGate via PayWeb3 works by sending the customer to PayGate to complete their payment.', 'paygate');
		$this->icon               = $this->get_plugin_url() . '/assets/images/logo_small.png';
		$this->has_fields         = true;
		$this->supports           = array(
			'products'
		);

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->merchant_id       = $this->settings['paygate_id'];
		$this->encryption_key    = $this->settings['encryption_key'];
		$this->title             = $this->settings['title'];
		$this->order_button_text = $this->settings['button_text'];
		$this->description       = $this->settings['description'];
		$this->payVault          = $this->settings['payvault'];

		if($this->payVault == 'yes'){
			$this->supports[] = 'tokenization';
		}

		$this->msg['message'] = "";
		$this->msg['class']   = "";

		// Setup the test data, if in test mode.
		if($this->settings['testmode'] == 'yes'){
			$this->add_testmode_admin_settings_notice();
		}

		$this->response_url = str_replace('https:', 'http:', add_query_arg('wc-api', 'WC_Gateway_PayGate', home_url('/')));

		add_action('woocommerce_api_wc_gateway_paygate', array(
			$this,
			'check_paygate_notify_response'
		));

		if(version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>=')){
			add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(
				&$this,
				'process_admin_options'
			));
		} else {
			add_action('woocommerce_update_options_payment_gateways', array(
				&$this,
				'process_admin_options'
			));
		}
		add_action('woocommerce_thankyou_paygate', array(
			$this,
			'check_paygate_response'
		));
		add_action('woocommerce_receipt_paygate', array(
			$this,
			'receipt_page'
		));
	}

	/**
	 * Add a notice to the merchant_key and merchant_id fields when in test mode.
	 *
	 * @since 1.0.0
	 */
	function add_testmode_admin_settings_notice(){
		$this->form_fields['paygate_id']['description'] .= ' <br><br><strong>' . __('PayGate ID currently in use.', 'paygate') . ' ( 10011072130 )</strong>';
		$this->form_fields['encryption_key']['description'] .= ' <br><br><strong>' . __('PayGate Encryption Key currently in use.', 'paygate') . ' ( secret )</strong>';
	}

	/**
	 * Show Message.
	 *
	 * Display message depending on order results.
	 *
	 * @since 1.0.0
	 *
	 * @param $content
	 *
	 * @return string
	 */
	function show_message($content){
		return '<div class="' . $this->msg['class'] . '">' . $this->msg['message'] . '</div>' . $content;
	}

	/**
	 * Get the plugin URL
	 *
	 * @since 1.0.0
	 */
	function get_plugin_url(){
		if(isset($this->plugin_url)){
			return $this->plugin_url;
		}

		if(is_ssl()){
			return $this->plugin_url = str_replace('http://', 'https://', WP_PLUGIN_URL) . "/" . plugin_basename(dirname(dirname(__FILE__)));
		} else {
			return $this->plugin_url = WP_PLUGIN_URL . "/" . plugin_basename(dirname(dirname(__FILE__)));
		}
	}

	/**
	 * @param $resultDescription string
	 */
	function declined_msg($resultDescription){
		echo '<p class="woocommerce-thankyou-order-failed">';
		_e($resultDescription, 'woocommerce');
		echo '</p>';
	}

	function set_vault_details($order_id){
		$vaultCard    = (isset($_POST['wc-' . $this->id . '-new-payment-method'])) ? $_POST['wc-' . $this->id . '-new-payment-method'] : 'no';
		$paymentToken = (isset($_POST['wc-' . $this->id . '-payment-token'])) ? $_POST['wc-' . $this->id . '-payment-token'] : null;

		if($paymentToken == 'new'){
			$vaultCard = 'true';
		}

		if($vaultCard != 'no'){
			update_post_meta($order_id, 'wc-' . $this->id . '-new-payment-method', $vaultCard);
		}

		if($paymentToken != 'no' && $paymentToken != 'new'){
			update_post_meta($order_id, 'wc-' . $this->id . '-payment-token', $paymentToken);
		}
	}

	/**
	 * Initialise Gateway Settings Form Fields
	 *
	 * @since 1.0.0
	 */
	function init_form_fields(){

		$this->form_fields = array(
			'enabled'        => array(
				'title'       => __('Enable/Disable', 'paygate'),
				'label'       => __('Enable PayGate Payment Gateway', 'paygate'),
				'type'        => 'checkbox',
				'description' => __('This controls whether or not this gateway is enabled within WooCommerce.', 'paygate'),
				'desc_tip'    => true,
				'default'     => 'no'
			),
			'title'          => array(
				'title'       => __('Title', 'paygate'),
				'type'        => 'text',
				'description' => __('This controls the title which the user sees during checkout.', 'paygate'),
				'desc_tip'    => false,
				'default'     => __('PayGate Payment Gateway', 'paygate')
			),
			'paygate_id'     => array(
				'title'       => __('PayGate ID', 'paygate'),
				'type'        => 'text',
				'description' => __('This is the PayGate ID, received from PayGate.', 'paygate'),
				'desc_tip'    => true,
				'default'     => ''
			),
			'encryption_key' => array(
				'title'       => __('Encryption Key', 'paygate'),
				'type'        => 'text',
				'description' => __('This is the Encryption Key set in the PayGate Back Office.', 'paygate'),
				'desc_tip'    => true,
				'default'     => ''
			),
			'testmode'       => array(
				'title'       => __('Test mode', 'paygate'),
				'type'        => 'checkbox',
				'description' => __('Uses a PayGate test account. Request test cards from PayGate', 'paygate'),
				'desc_tip'    => true,
				'default'     => 'yes'
			),
			'payvault'       => array(
				'title'       => __('Enable PayVault', 'paygate'),
				'type'        => 'checkbox',
				'description' => __('Provides the ability for users to store their credit card details.', 'paygate'),
				'desc_tip'    => true,
				'default'     => 'no'
			),
			'description'    => array(
				'title'       => __('Description', 'paygate'),
				'type'        => 'textarea',
				'description' => __('This controls the description which the user sees during checkout.', 'paygate'),
				'default'     => 'Pay via PayGate'
			),
			'button_text'    => array(
				'title'       => __('Order Button Text', 'paygate'),
				'type'        => 'text',
				'description' => __('Changes the text that appears on the Place Order button', 'paygate'),
				'default'     => 'Proceed to PayGate'
			)
		);

	}

	/**
	 * Admin Panel Options
	 * - Options for bits like 'title'
	 *
	 * @since 1.0.0
	 */
	public function admin_options(){
		?>
		<h3><?php _e('PayGate Payment Gateway', 'paygate'); ?></h3>
		<p><?php printf(__('PayGate works by sending the user to %sPayGate%s to enter their payment information.', 'paygate'), '<a href="https://www.paygate.co.za/">', '</a>'); ?></p>

		<table class="form-table"><?php
			// Generate the HTML For the settings form.
			$this->generate_settings_html();
			?></table><!--/.form-table-->
		<?php
	}

	/**
	 * Return false to bypass adding Tokenization in "My Account" section
	 *
	 * @return bool
	 */
	function add_payment_method(){
		return false;
	}

	/**
	 * There are no payment fields for PayGate, but we want to show the description if set,
	 * Otherwise show PayVault fields if enabled
	 *
	 * @since 1.0.0
	 */
	function payment_fields(){

		if($this->payVault == 'yes'){
			if(count($_POST) > 0 && $_POST['woocommerce_add_payment_method'] != 1){
				//Display stored credit card selection
				$tokens       = WC_Payment_Tokens::get_customer_tokens(get_current_user_id(), $this->id);
				$defaultToken = WC_Payment_Tokens::get_customer_default_token(get_current_user_id());

				if(count($tokens) > 0){

					echo <<<HTML
				<select name="wc-{$this->id}-payment-token">

HTML;

					/**
					 * @var $token WC_Payment_Token_CC
					 */
					foreach($tokens as $token){

						$cardType = ucwords($token->get_card_type());

						if($token->get_id() == $defaultToken->get_id()){
							$selected = 'selected';
						} else {
							$selected = '';
						}

						echo <<<HTML
					<option value="{$token->get_token()}" {$selected}>Use {$cardType} ending in {$token->get_last4()}</option>

HTML;
					}

					echo <<<HTML
					<option value="new">Use a new card</option>
					<option value="no">Use a new card and don't save</option>
				</select>

HTML;


				} else {
					echo <<<HTML
				<input type="checkbox" name="wc-{$this->id}-new-payment-method" id="wc-paygate-new-payment-method" value="true"> Remember my credit card number

HTML;
				}
			} else {
				//Display message for adding cards via "My Account" screen

				echo <<<HTML
	<p>Cards cannot be added manually. Please select the "Use a new card" option in the checkout process when paying with PayGate</p>

HTML;

			}
		} else if(isset($this->settings['description']) && $this->settings['description'] != ''){
			echo wpautop(wptexturize($this->settings['description']));
		}
	}

	/**
	 * Generate the PayGate button link.
	 *
	 * @since 1.0.0
	 *
	 * @param $order_id
	 *
	 * @return string
	 */
	public function generate_paygate_form($order_id){
		$order = new WC_Order($order_id);

		parse_str($this->initiate_response['body'], $parsed_response);

		$messageText = esc_js(__('Thank you for your order. We are now redirecting you to PayGate to make payment.', 'paygate'));

		$blockUi = <<<JS
$(document).ready(function(){
	$.blockUI({
        message: "<img src=\"{$this->get_plugin_url()}/assets/images/loader.gif\" alt=\"Redirecting...\" /><br>{$messageText}",
        baseZ: 99999,
        overlayCSS:
        {
            background: "#fff",
            opacity: 0.6
        },
        css: {
            padding:        "20px",
            zindex:         "9999999",
            textAlign:      "center",
            color:          "#2b2d30",
            border:         "1px solid #000",
            backgroundColor:"#fff",
            cursor:         "wait",
            lineHeight:		"24px",
        }
	});

	jQuery("#submit_paygate_payment_form").click();
});
JS;
		wc_enqueue_js($blockUi);

		unset($parsed_response['CHECKSUM']);
		$checksum = md5(implode('', $parsed_response) . $this->encryption_key);

		$heading    = __('Thank you for your order, please click the button below to pay via PayGate.', 'paygate');
		$buttonText = __($this->order_button_text, 'paygate');
		$cancelUrl  = esc_url($order->get_cancel_order_url());
		$cancelText = __('Cancel order &amp; restore cart', 'paygate');

		$form = <<<HTML
<p>{$heading}</p>
<form action="{$this->process_url}" method="post" id="paygate_payment_form">
	<input name="PAY_REQUEST_ID" type="hidden" value="{$parsed_response['PAY_REQUEST_ID']}" />
	<input name="CHECKSUM" type="hidden" value="{$checksum}" />
    <!-- Button Fallback -->
    <div class="payment_buttons">
		<input type="submit" class="button alt" id="submit_paygate_payment_form" value="{$buttonText}" /> <a class="button cancel" href="{$cancelUrl}">{$cancelText}</a>
    </div>
</form>
HTML;

		return $form;
	}

	/**
	 * Process the payment and return the result.
	 *
	 * @since 1.0.0
	 *
	 * @param int $order_id
	 *
	 * @return array
	 */
	function process_payment($order_id){
		$order = new WC_Order($order_id);

		$this->set_vault_details($order_id);

		return array(
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url(true)
		);

	}

	/**
	 * Does the initiate to PayGate
	 *
	 * @param $order_id
	 *
	 * @return array|WP_Error
	 */
	function initiate_transaction($order_id){
		$order = new WC_Order($order_id);

		unset($this->data_to_send);

		if($this->settings['testmode'] == 'yes'){
			$this->merchant_id    = self::TEST_PAYGATE_ID;
			$this->encryption_key = self::TEST_ENCRYPTION_KEY;
		}

		$this->vaultCard = get_post_meta($order_id, 'wc-' . $this->id . '-new-payment-method', true);
		$this->vaultId   = get_post_meta($order_id, 'wc-' . $this->id . '-payment-token', true);

		// Construct variables for post
		$this->data_to_send = array(
			'PAYGATE_ID'       => $this->merchant_id,
			'REFERENCE'        => 'Order ' . $order->get_order_number(),
			'AMOUNT'           => number_format($order->order_total, 2, '', ''),
			'CURRENCY'         => get_woocommerce_currency(),
			'RETURN_URL'       => esc_url($this->get_return_url($order)),
			'TRANSACTION_DATE' => date('Y-m-d H:m:s'),
			'LOCALE'           => 'en-za',
			'COUNTRY'          => 'ZAF',
			'EMAIL'            => $order->billing_email,
			'NOTIFY_URL'       => $this->response_url,
			'USER3'            => 'woocommerce-v' . $this->version
		);

		if($this->payVault == 'yes'){
			if($this->vaultCard == 'true'){
				$this->data_to_send['VAULT'] = 1;
			}

			if(!empty($this->vaultId) && $this->vaultId != 'new'){
				$this->data_to_send['VAULT_ID'] = $this->vaultId;
			}
		}

		$this->data_to_send['CHECKSUM'] = md5(implode('', $this->data_to_send) . $this->encryption_key);

		$this->initiate_response = wp_remote_post($this->initiate_url, array(
				'method'      => 'POST',
				'body'        => $this->data_to_send,
				'timeout'     => 70,
				'sslverify'   => false,
				'user-agent'  => 'WooCommerce',
				'httpversion' => '1.1'
			)
		);

		if(is_wp_error($this->initiate_response)){
			return $this->initiate_response;
		}

		parse_str($this->initiate_response['body'], $parsed_response);

		if(empty($this->initiate_response['body']) || array_key_exists('ERROR', $parsed_response) || !array_key_exists('PAY_REQUEST_ID', $parsed_response)){
			$this->msg['class']   = 'woocommerce-error';
			$this->msg['message'] = "Thank you for shopping with us. However, we were unable to initiate your payment. Please try again.";
			$order->update_status('failed');
			$order->add_order_note('Response from initiating payment:' . print_r($this->data_to_send, true) . ' ' . $this->initiate_response['body']);

			return new WP_Error('paygate-error', __($this->show_message('<br><a class="button wc-forward" href="' . esc_url($order->get_cancel_order_url()) . '">' . __('Cancel order &amp; restore cart', 'paygate') . '</a>'), 'paygate'));
		}
	}

	/**
	 * Receipt page.
	 *
	 * Display text and a button to direct the customer to PayGate.
	 *
	 * @since 1.0.0
	 *
	 * @param $order
	 */
	function receipt_page($order){
		$return = $this->initiate_transaction($order);
		if(is_wp_error($return)){
			echo $return->get_error_message();
		} else {
			echo $this->generate_paygate_form($order);
		}
	}

	/**
	 * Check for valid PayGate Redirect
	 *
	 * @since 1.0.0
	 */
	function check_paygate_response(){
		global $woocommerce;

		if(isset($_GET['key']) && isset($_POST['PAY_REQUEST_ID'])){
			$key      = $_GET['key'];
			$order_id = wc_get_order_id_by_order_key($key);

			if($order_id != ''){
				$order = wc_get_order($order_id);

				$pay_request_id = $_POST['PAY_REQUEST_ID'];
				$status         = $_POST['TRANSACTION_STATUS'];
				$checksum       = $_POST['CHECKSUM'];

				if($this->settings['testmode'] == 'yes'){
					$this->merchant_id    = self::TEST_PAYGATE_ID;
					$this->encryption_key = self::TEST_ENCRYPTION_KEY;
				}

				$checksum_source = $this->merchant_id . $pay_request_id . $status . 'Order ' . $order->get_order_number() . $this->encryption_key;
				$test_checksum   = md5($checksum_source);
				if($order->status !== 'processing' || $order->status !== 'completed'){

					if($checksum == $test_checksum){
						$fields             = array(
							'PAYGATE_ID'     => $this->merchant_id,
							'PAY_REQUEST_ID' => $_POST['PAY_REQUEST_ID'],
							'REFERENCE'      => 'Order ' . $order->get_order_number()
						);
						$fields['CHECKSUM'] = md5(implode('', $fields) . $this->encryption_key);

						$response           = wp_remote_post($this->query_url, array(
								'method'      => 'POST',
								'body'        => $fields,
								'timeout'     => 70,
								'sslverify'   => false,
								'user-agent'  => 'WooCommerce/' . WC_VERSION,
								'httpversion' => '1.1'
							)
						);

						if(is_wp_error($response)){
							return false;
						}

						parse_str($response['body'], $parsed_response);

						$vaultCard = get_post_meta($order_id, 'wc-' . $this->id . '-new-payment-method', true);

						if($vaultCard == 'true' && array_key_exists('VAULT_ID', $parsed_response)){
							//Save Token details
							$vaultId  = $parsed_response['VAULT_ID'];
							$card     = $parsed_response['PAYVAULT_DATA_1'];
							$expiry   = $parsed_response['PAYVAULT_DATA_2'];
							$cardType = $parsed_response['PAY_METHOD_DETAIL'];

							$token = new WC_Payment_Token_CC();

							$token->set_token($vaultId);

							$token->set_gateway_id($this->id);
							$token->set_card_type(strtolower($cardType));
							$token->set_last4(substr($card, - 4));
							$token->set_expiry_month(substr($expiry, 0, 2));
							$token->set_expiry_year(substr($expiry, - 4));

							$token->set_user_id(get_current_user_id());

							$token->set_default(true);

							$token->save();
						}

						switch($parsed_response['TRANSACTION_STATUS']){
							case 1:
								$order->payment_complete();
								$order->add_order_note('Response via Redirect: Transaction successful<br/>PayGate Trans Id: ' . $parsed_response['TRANSACTION_ID'] . '<br/>');
								$order->update_status('processing');
								$woocommerce->cart->empty_cart();

								return true;
								break;
							case 2:
								$order->add_order_note('Response via Redirect, RESULT_DESC: ' . $parsed_response['RESULT_DESC'] . '<br/>PayGate Trans Id: ' . $parsed_response['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('failed')){
									$order->update_status('failed');
								}

								return false;
								break;
							case 4:
								$order->add_order_note('Response via Redirect: User cancelled transaction<br/>PayGate Trans Id: ' . $parsed_response['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('failed')){
									$order->update_status('failed');
								}

								return false;
								break;
							default:
								$order->add_order_note('Response via Redirect, RESULT_DESC: ' . $parsed_response['RESULT_DESC'] . '<br/>PayGate Trans Id: ' . $parsed_response['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('pending')){
									$order->update_status('pending');
								}
								$this->declined_msg('Your purchase is either pending or an error has occurred. Please follow up with the whomever necessary.');

								return false;
								break;
						}
					} else {
						$order->add_order_note('Response via Redirect, Security Error: Checksum mismatch. Illegal access detected' . '<br/>');

						if(!$order->has_status('failed')){
							$order->update_status('failed');
						}

						return false;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Check for valid PayGate Notify
	 *
	 * @since 1.0.0
	 */
	function check_paygate_notify_response(){

		if(isset($_POST)){

			// Tell PayGate notify we have received
			echo 'OK';

			$errors       = false;
			$paygate_data = array();
			$notify_data  = array();

			// Get notify data
			if(!$errors){
				$paygate_data = $this->get_post_data();
				if(count($paygate_data) == 0){
					$errors = true;
				}
			}

			// Verify security signature
			$checkSumParams = '';
			if($this->settings['testmode'] == 'yes'){
				$this->encryption_key = 'secret';
			}

			if(!$errors){
				foreach($paygate_data as $key => $val){
					$notify_data[$key] = stripslashes($val);

					if($key == 'PAYGATE_ID'){
						$checkSumParams .= $val;
					}
					if($key != 'CHECKSUM' && $key != 'PAYGATE_ID'){
						$checkSumParams .= $val;
					}

					if(sizeof($notify_data) == 0){
						$errors = true;
					}
				}

				$checkSumParams .= $this->encryption_key;
			}

			// Verify security signature
			if(!$errors){
				$checkSumParams = md5($checkSumParams);
				if($checkSumParams != $paygate_data['CHECKSUM']){
					$errors     = true;
					$error_desc = 'Security Error: Checksum mismatch. Illegal access detected';
				}
			}

			$order_id = str_replace('Order', '', $paygate_data['REFERENCE']);

			if($order_id != ''){
				$order = wc_get_order(trim($order_id));
				if(!$errors){
					if(!$order->has_status('processing') || !$order->has_status('completed')){

						switch($paygate_data['TRANSACTION_STATUS']){
							case 1:
								$order->add_order_note('Response via Notify: Transaction successful<br/>PayGate Trans Id: ' . $paygate_data['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('processing')){
									$order->payment_complete();
								}
								break;
							case 2:
								$order->add_order_note('Response via Notify, RESULT_DESC: ' . $paygate_data['RESULT_DESC'] . '<br/>PayGate Trans Id: ' . $paygate_data['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('failed')){
									$order->update_status('failed');
								}
								break;
							case 4:
								$order->add_order_note('Response via Notify, User cancelled transaction<br/>PayGate Trans Id: ' . $paygate_data['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('failed')){
									$order->update_status('failed');
								}
								break;
							default:
								$order->add_order_note('Response via Notify, RESULT_DESC: ' . $paygate_data['RESULT_DESC'] . '<br/>PayGate Trans Id: ' . $paygate_data['TRANSACTION_ID'] . '<br/>');

								if(!$order->has_status('pending')){
									$order->update_status('pending');
								}
								break;
						}
					}
				} else {
					$order->add_order_note('Response via Notify, ' . $error_desc . '<br/>');

					if(!$order->has_status('failed')){
						$order->update_status('failed');
					}
				}
			}
		}
		die();
	}

}