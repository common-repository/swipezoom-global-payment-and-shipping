<?php 
/**
 * Check if WooCommerce is active
 */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// Include our Gateway Class and register Payment Gateway with WooCommerce
	function swipezoom_payment_init() {
		
		if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
		
		// If we made it this far, then include our Gateway Class
		/* Swipezoom Payment Gateway Class */

		if ( ! class_exists( 'WC_Swipezoom_Payment' ) ) {
			class WC_Swipezoom_Payment extends WC_Payment_Gateway {

				// Setup our Gateway's id, description and other values
				function __construct() {

					// The global ID for this Payment method
					$this->id = "swipezoom_payment";

					// The Title shown on the top of the Payment Gateways Page next to all the other Payment Gateways
					$this->method_title = __( "Card Payment", 'swipezoom-payment' );

					// The description for this Payment Gateway, shown on the actual Payment options page on the backend
					$this->method_description = __( "Card Payment", 'swipezoom-payment' );

					// The title to be used for the vertical tabs that can be ordered top to bottom
					$this->title = __( "Card Payment", 'swipezoom-payment' );

					// If you want to show an image next to the gateway's name on the frontend, enter a URL to an image.
					$this->icon = null;

					// Bool. Can be set to true if you want payment fields to show on the checkout 
					$this->has_fields = true;

					// Supports the default credit card form
					$this->supports = array( 'default_credit_card_form' );

					// This basically defines your settings which are then loaded with init_settings()
					$this->init_form_fields();

					$this->init_settings();
					
					// Turn these settings into variables we can use
					foreach ( $this->settings as $setting_key => $value ) {
						$this->$setting_key = $value;
					}

					global $woocommerce;

					$status = $_REQUEST['status'];
					$order_id = $_REQUEST['order_id'];
					$redirect_url = $_REQUEST['redirect_url'];

					if(!empty($status) && !empty($order_id) && !empty($redirect_url)) {

							$swipezoomOrderNumber = $woocommerce->session->get('swipezoomOrderNumber');	
							$extraShippingCharges = $woocommerce->session->get('extraShippingCharges');	

							$orderId = $order_id;
							add_post_meta($orderId,'swipezoom_id',$swipezoomOrderNumber,true);
							add_post_meta($orderId,'shipping_charges',$extraShippingCharges["shipping"],true);
							add_post_meta($orderId,'duties',$extraShippingCharges["CustCourierDuties"],true);
							add_post_meta($orderId,'insurance',$extraShippingCharges["CustInsuranceCharges"],true);
							add_post_meta($orderId,'duties_applied',$extraShippingCharges["CustCourierDutiesState"],true);
							add_post_meta($orderId,'insurance_applied',$extraShippingCharges["CustInsuranceChargesState"],true);
							add_post_meta($orderId,'cust_item_subtotal',$extraShippingCharges["CustItemSubtotal"],true);

							$customer_order = new WC_Order( $order_id );

						if($status == 'success') {

							add_post_meta($orderId,'order_confirmed',1,true);

							$customer_order->add_order_note( __( 'Swipezoom Payment completed.', 'swipezoom-payment' ) );
							// Mark order as Paid
							$customer_order->payment_complete();
							// Empty the cart (Very important step)
							$woocommerce->cart->empty_cart();

							wp_redirect( $redirect_url );
							exit;	

						} else {

							add_post_meta($orderId,'order_confirmed',0,true);

							WC()->session->__unset('extraShippingCharges');
							WC()->session->__unset('swipezoomOrderNumber');
							WC()->session->__unset('fingerprint');
							WC()->session->__unset('TransLogisticsReq');
							WC()->session->__unset('TransLogisticsReqData');
							WC()->session->__unset('swipezoomTitle');

							wc_add_notice( 'Something went wrong while trying to process the payment. Please try again.', 'error' );
							// Add note to the order for your reference
							$customer_order->add_order_note( 'Error: Something went wrong while trying to process the payment. Please try again.' );

							wp_redirect( $redirect_url );
							exit;	
						}
					}
						
				} // End __construct()

				// Build the administration fields for this specific Gateway
				public function init_form_fields() {
					$this->form_fields = array(
						'enabled' => array(
							'title'		=> __( 'Enable / Disable', 'swipezoom-payment' ),
							'label'		=> __( 'Enable this payment gateway', 'swipezoom-payment' ),
							'type'		=> 'checkbox',
							'default'	=> 'yes',
						)
					);		
				}
				
				// Submit payment and handle response
				public function process_payment( $order_id ) {
					
					global $woocommerce;
					
					// Get this Order's information so that we know
					// who to charge and how much
					$customer_order = new WC_Order( $order_id );
					$swipezoom_config = get_option('woocommerce_swipezoom_internationalshipping_settings',null);
					
					$extraCharges = $woocommerce->session->get('extraShippingCharges');
					$swipezoom_id = $woocommerce->session->get('swipezoomOrderNumber');

				    $shippingMethodDetail = $customer_order->get_shipping_methods();

					foreach ($shippingMethodDetail as $key => $value) {
						$shippingMethod = $shippingMethodDetail[$key]['method_id'];
					}

					if($swipezoom_config['payment-enabled']=="yes" && $shippingMethod == 'swipezoom_internationalshipping' && $swipezoom_config['enabled'] != 'no') {

						($extraCharges['CustCourierDutiesState'] == "Y")?$PrepaidDuties="Y":$PrepaidDuties="N";
						($extraCharges['CustInsuranceChargesState'] == "Y")?$PrepaidInsurance="Y":$PrepaidInsurance="N";

						$ratesRequest = array("Caller" => array("MerchantID" => $swipezoom_config['merchant-id'],
				        "MerchantKey" => $swipezoom_config['merchant-key'],
				        "Version"=> "SW0101",
				        "Datetime"      => date("Y-m-d h:i:s"),
				        "MerchantRefNo"      => $order_id,
				        "RequestFingerprint" => $woocommerce->session->get('fingerprint')),
				        "OrderNo"=>$swipezoom_id,
				        "PrepaidDuties"=>$PrepaidDuties,
				        "PrepaidInsurance"=>$PrepaidInsurance);

						$site_url = get_site_url();
				        // making sure payment is enabled
				        if($swipezoom_config['payment-enabled']=="yes") {
				              $ratesRequest["Payment"] = array(
				                  "PaymentType" => 'ccard',
				                  "SuccessURL" => $site_url.'?wc-api=WC_Swipezoom_Payment&status=success&order_id='.$order_id.'&redirect_url='.urlencode($this->get_return_url($customer_order)),
				                  "CancelURL" => $site_url.'?wc-api=WC_Swipezoom_Payment&status=cancel&order_id='.$order_id.'&redirect_url='.urlencode($site_url),
				                  "FailureURL" => $site_url.'?wc-api=WC_Swipezoom_Payment&status=failure&order_id='.$order_id.'&redirect_url='.urlencode($site_url),
				                  "ServiceURL" => $site_url,
				                  "CustomerUserAgent" => $_SERVER['HTTP_USER_AGENT'],
				                  "CustomerIpAddress" => $_SERVER['REMOTE_ADDR']
				              );
				        }
				        
						try {
							$client = swCreateSoapClientConnection("frontend");
							$woocommerce->session->set('PaymentRedirectUrl','');

							write_log($ratesRequest);
							$response = $client->TransLogisticsConfirm($ratesRequest);
							write_log($response);

							// if success and redirect url exists
				              if($response->ResponseStatusCode == "000" && !empty($response->OrderPaymentDetails->RedirectUrl)) {
				                // if success and redirect url exists in response
				                $woocommerce->session->set('PaymentRedirectUrl',$response->OrderPaymentDetails->RedirectUrl);

								// Redirect to swipezoom payment
								return array(
									'result'   => 'success',
									'redirect' => $response->OrderPaymentDetails->RedirectUrl,
								);

				              } else {
				                wc_add_notice( 'Something went wrong while trying to process the payment. Please try again.', 'error' );
								// Add note to the order for your reference
								$customer_order->add_order_note( 'Error: Something went wrong while trying to process the payment. Please try again.' );
				              }

						} catch (Exception $e) {
							write_log($e);
							wc_add_notice( 'Something went wrong while trying to process the payment. Please try again.', 'error' );
							// Add note to the order for your reference
							$customer_order->add_order_note( 'Error: Something went wrong while trying to process the payment. Please try again.' );
						}
					
					} else {
						wc_add_notice( 'Something went wrong while trying to process the payment. Please try again.', 'error' );
						// Add note to the order for your reference
						$customer_order->add_order_note( 'Error: Something went wrong while trying to process the payment. Please try again.' );
					}

				}
				
				// Validate fields
				public function validate_fields() {
					return true;
				}

					/**
				 * Core credit card form which gateways can used if needed.
				 *
				 * @param  array $args
				 */
				public function credit_card_form( $args = array(), $fields = array() ) {

					wp_enqueue_script( 'wc-credit-card-form' );

					$default_args = array(
						'fields_have_names' => true, // Some gateways like stripe don't need names as the form is tokenized
					);

					$args = wp_parse_args( $args, apply_filters( 'woocommerce_credit_card_form_args', $default_args, $this->id ) );

					//<img  
					$default_fields = array(
						'images' => ' <div style="margin-top:-20px"><img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/mastercard50.png', __FILE__ ).'"  style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/mastercardseecurecode50.png', __FILE__ ).'" style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/visa50.png', __FILE__ ).'" style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/vbv50.png', __FILE__ ).'"  style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/visaelectron50.png', __FILE__ ).'" style="display:inline"> 
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/maestro50.png', __FILE__ ).'"  style="display:inline"> 
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/cup50.png', __FILE__ ).'"  style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/diners50.png', __FILE__ ).'"  style="display:inline"> 
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/discover50.png', __FILE__ ).'"  style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/sepa50.png', __FILE__ ).'"  style="display:inline">
					      <img class="sz_card_payment" src="'. plugins_url( '/assets/images/payment_logos/jcb50.png', __FILE__ ).'"  style="display:inline">
					     <br><br>',
					    'error-div' => '<div class="cc-checkout-errors"></div>',
						'card-name-field' => '<p class="form-row form-row-first">
							<label for="' . esc_attr( $this->id ) . '-card-name">' . __( 'Name on Card', 'woocommerce' ) . ' <span class="required">*</span></label>
							<input id="' . esc_attr( $this->id ) . '-card-name" class="input-text wc-credit-card-form-card-name" type="text" maxlength="20" autocomplete="off" placeholder="" name="' . ( $args['fields_have_names'] ? $this->id . '-card-name' : '' ) . '" />
						</p>',
						'card-number-field' => '<p class="form-row form-row-first">
							<label for="' . esc_attr( $this->id ) . '-card-number">' . __( 'Card Number', 'woocommerce' ) . ' <span class="required">*</span></label>
							<input id="' . esc_attr( $this->id ) . '-card-number" class="input-text wc-credit-card-form-card-number" type="text" maxlength="20" autocomplete="off" placeholder="•••• •••• •••• ••••" name="' . ( $args['fields_have_names'] ? $this->id . '-card-number' : '' ) . '" />
						</p>',
						'card-expiry-field' => '<p class="form-row form-row-first" style="width:93px">
							<label for="' . esc_attr( $this->id ) . '-card-expiry">' . __( 'Expiry Date', 'woocommerce' ) . ' <span class="required">*</span></label>
							<input id="' . esc_attr( $this->id ) . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="text" autocomplete="off" placeholder="' . esc_attr__( 'MM / YYYY', 'woocommerce' ) . '" name="' . ( $args['fields_have_names'] ? $this->id . '-card-expiry' : '' ) . '" />
						</p>',
						'card-cvc-field' => '<p class="form-row form-row-last" style="width: 93px;float: left;margin-left: 17px;">
							<label for="' . esc_attr( $this->id ) . '-card-cvc">' . __( 'CVC', 'woocommerce' ) . ' <span class="required">*</span></label>
							<input id="' . esc_attr( $this->id ) . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="text" autocomplete="off" maxlength="3" placeholder="' . esc_attr__( 'CVC', 'woocommerce' ) . '" name="' . ( $args['fields_have_names'] ? $this->id . '-card-cvc' : '' ) . '" />
						</p>',
						'save-payment' => '<p class="form-row form-row-wide"><input type="button" class="button alt" name="sz-save-payment" id="sz_save_payment" value="Place Order" data-value="Place Order" onclick="storeData()" style="display: inline-block;"></p>',
						'sz-logo' => '</div>'
					);	
					$fields = wp_parse_args( $fields, apply_filters( 'woocommerce_credit_card_form_fields', $default_fields, $this->id ) );
					?>
					<fieldset id="<?php echo $this->id; ?>-cc-form">
						<?php do_action( 'woocommerce_credit_card_form_start', $this->id ); ?>
						<?php
							foreach ( $fields as $field ) {
								echo $field;
							}
						?>
						<?php do_action( 'woocommerce_credit_card_form_end', $this->id ); ?>
						<div class="clear"></div>
					</fieldset>
					<script>
						jQuery('.place-order').hide();
					</script>
					<?php
				}
				

			} // End of Swipezoom_Payment
		}

	}

	add_action( 'plugins_loaded', 'swipezoom_payment_init');

	// Now that we have successfully included our class,
	// Lets add it too WooCommerce
	function add_swipezoom_payment( $methods ) {
		$methods[] = 'WC_Swipezoom_Payment';
		return $methods;
	}

	add_filter( 'woocommerce_payment_gateways', 'add_swipezoom_payment' );

}