<?php
/**
 * Plugin Name: WooCommerce SwipeZoom Global Payments and Shipping
 * Plugin URI: http://woothemes.com/products/woocommerce-extension/
 * Description: Start to welcome international customers, accept their payment and ship to their doorstep...within minutes!
 * Version: 1.0.1
 * Author: WooThemes
 * Author URI: http://woothemes.com/
 * Developer: Swipezoom
 * Developer URI: http://swipezoom.com
 * Text Domain: woocommerce-extension
 * Domain Path: /languages
 *
 * Copyright: © 2009-2016 WooThemes.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Check if WooCommerce is active
 */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	function swipezoom_internationalshipping_init() {

		if ( ! class_exists( 'WC_Swipezoom_InternationalShipping' ) ) {
			
			class WC_Swipezoom_InternationalShipping extends WC_Shipping_Method {

				/**
				 * Constructor for shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {

					$this->id                 = 'swipezoom_internationalshipping'; // Id of the shipping method. 
					$this->init();
				}
 
				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API
					$this->init_settings(); // This is part of the settings API

					$this->enabled = $this->settings['enabled']; 
					$this->countries = $this->settings['specific-countries'];
					$this->title = $this->settings['title'];
					$this->method_title = $this->settings['title'];
					
					// Save settings in admin 
					add_action('woocommerce_update_options_shipping_'.$this->id, array( $this, 'process_admin_options' ) );
				}

				/**
				 * is_available function.
				 *
				 * @param mixed $package
				 * @return bool
				 */
				function is_available( $package ) {

					if ( 'no' == $this->enabled ) {
						return false;
					}
					
					// check if this plugin applies to specific countries or not
					if ( 'specific' == $this->settings['applicable-countries'] ) {
						$ship_to_countries = $this->countries;
					} else {
						$ship_to_countries = array_keys( WC()->countries->get_shipping_countries() );
					}

					if ( is_array( $ship_to_countries ) && ! in_array( $package['destination']['country'], $ship_to_countries ) ) {
						// return false if destination country is not allowed
						return false;
					}

					$is_available = true;

					return apply_filters( 'woocommerce_shipping_' . $this->id . '_is_available', $is_available, $package );
				}

				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package ) {

					global $woocommerce;
					$countrycode_iso3 = ""; 
					$total = 0;

					// get extra shipping charges from session
					$extraCharges = $woocommerce->session->get('extraShippingCharges');
					
					$total = $extraCharges["shipping"];
					
					// if duties is checked then add to total
					if($extraCharges["CustCourierDutiesState"] == "Y")
						$total += $extraCharges["CustCourierDuties"];

					// if insurance is checked then add to total
					if($extraCharges["CustInsuranceChargesState"] == "Y")
						$total += $extraCharges["CustInsuranceCharges"];					

					
					// rate for the shipping method
					$rate = array(
						'id' => $this->id,
						'label' => '<b>'.$this->title.'</b>'."<br>".$woocommerce->session->get('swipezoomTitle'),
						'cost' => $total,
						'calc_tax' => 'per_item'
					);

					// Register the rate
					$this->add_rate( $rate );
				}

				/**
				 * Initialise Admin Side Settings Form
				 */
				 function init_form_fields() {

				     $this->form_fields = array(
				      'enabled' => array(
				        'title'      => __( 'Enable', 'woocommerce' ),
				        'type'      => 'checkbox',
				        'label'      => __( '', 'woocommerce' ),
				        'default'    => 'yes'
				      ),
				      'title' => array(
				        'title'      => __( 'Title', 'woocommerce' ),
				        'type'      => 'text',
				        'description'  => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
				        'default'    => __( 'Swipezoom Global', 'woocommerce' )
				      ),
				      'url' => array(
				        'title'      => __( 'Swipezoom Client Url', 'woocommerce' ),
				        'type'      => 'text',
				        'description'  => __( '', 'woocommerce' ),
				        'default'    => __( 'http://staging.swipezoom.com/transaction/services/transaction?wsdl', 'woocommerce' )
				      ),
				      'merchant-id' => array(
				        'title'      => __( 'Merchant Id', 'woocommerce' ),
				        'type'      => 'text',
				        'description'  => __( '', 'woocommerce' ),
				        'default'    => __( '100', 'woocommerce' )
				      ),
				      'merchant-key' => array(
				        'title'      => __( 'Merchant Key', 'woocommerce' ),
				        'type'      => 'text',
				        'description'  => __( '', 'woocommerce' ),
				        'default'    => __( 'TESTABCERLHYC100567PKI1001ENCYM00', 'woocommerce' )
				      ),
				      'payment-enabled' => array(
				        'title'      => __( 'Payment Enabled', 'woocommerce' ),
				        'type'      => 'select',
				        'default'    => 'yes',
				        'options'    => array(
				          'yes'    => __( 'Yes', 'woocommerce' ),
				          'no'  => __( 'No', 'woocommerce' )
				        )
				      ),
				      'debug-enabled' => array(
				        'title'      => __( 'Debug Enabled', 'woocommerce' ),
				        'type'      => 'select',
				        'default'    => 'yes',
				        'options'    => array(
				          'yes'    => __( 'Yes', 'woocommerce' ),
				          'no'  => __( 'No', 'woocommerce' )
				        )
				      ),
				      'applicable-countries' => array(
				        'title'      => __( 'Ship to Applicable Countries', 'woocommerce' ),
				        'type'      => 'select',
				        'default'    => 'all',
				        'options'    => array(
				          'all'    => __( 'All Allowed Countries', 'woocommerce' ),
				          'specific'  => __( 'Specific Countries', 'woocommerce' )
				        )
				      ),
				      'specific-countries' => array(
				        'title'      => __( 'Ship to Specific Countries', 'woocommerce' ),
				        'type'      => 'multiselect',
				        'class'      => 'chosen_select',
				        'css'      => 'width: 450px;',
				        'default'    => '',
				        'options'    => WC()->countries->get_shipping_countries(),
				        'custom_attributes' => array(
				          'data-placeholder' => __( 'Select some countries', 'woocommerce' )
				        )
				      )
				    );
				} // End init_form_fields()

				function admin_options() {
					 ?>
					 <h2><?php _e('International Shipping','woocommerce'); ?></h2>
					 <table class="form-table">
					 <?php $this->generate_settings_html(); ?>
					 </table> <?php
				}
			}
		}
	}

	include('woocommerce-swipezoom-payment.php');

	add_action( 'woocommerce_shipping_init', 'swipezoom_internationalshipping_init' );

	// register new shipping method
	function add_swipezoom_internationalshipping( $methods ) {
		$methods[] = 'WC_Swipezoom_InternationalShipping';
		return $methods;
	}
 
	add_filter( 'woocommerce_shipping_methods', 'add_swipezoom_internationalshipping' );

	
	function swipezoom_plugin_settings_link($links) { 

	  $settings_link = '<a href="'.admin_url( 'admin.php?page=wc-settings&tab=shipping&section=wc_swipezoom_internationalshipping' ).'">Settings</a>'; 

	  array_unshift($links, $settings_link); 

	  return $links; 

	}

	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'swipezoom_plugin_settings_link' );


	register_activation_hook( __FILE__, 'swipezoom_shipping_activation' );

	function swipezoom_shipping_activation() {

		update_option( 'woocommerce_status_options', 
			array('shipping_debug_mode' => 1)
		);
		update_option('woocommerce_enable_guest_checkout','yes');
		update_option('woocommerce_calc_shipping','yes');
		update_option('woocommerce_enable_shipping_calc','no');
		update_option('woocommerce_shipping_cost_requires_address','no');
		update_option('woocommerce_ship_to_destination','shipping');
		update_option('woocommerce_enable_signup_and_login_from_checkout','no');
		update_option('woocommerce_enable_myaccount_registration','yes');
		update_option('woocommerce_enable_checkout_login_reminder','yes');
		update_option('woocommerce_registration_generate_username','yes');
		update_option('woocommerce_enable_coupons','no');

		$update_set = array('enabled'=>'yes',
							'title'=>'Swipezoom Global',
							'url'=>'http://staging.swipezoom.com/transaction/services/transaction?wsdl',
							'merchant-id'=>'100',
							'merchant-key'=>'TESTABCERLHYC100567PKI1001ENCYM00',
							'payment-enabled'=>'yes',
							'debug-enabled'=>'yes',
							'applicable-countries'=>'all',
							'specific-countries'=>''
					);
		update_option('woocommerce_swipezoom_internationalshipping_settings',$update_set);

	}

	$swipezoom_config = get_option('woocommerce_swipezoom_internationalshipping_settings',null);

	if($swipezoom_config['enabled'] != 'no')
		include_once('overridden-functions.php');
	
}