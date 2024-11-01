<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$doing_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;
$swipezoom_fields = array("billing_address_1","billing_address_2","billing_city","billing_state","billing_postcode");
/** @global WC_Checkout $checkout */

if(!$doing_ajax) {
?>
<div class="woocommerce-billing-fields">
	<span class="required" style="float: right;font-size:12px;position: absolute;margin-left: 370px;margin-top: 8px;">* Required Fields</span>
	<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
		<?php

			if($key == "billing_email") {
				echo "</div>";
			}
		 ?>
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		<?php 
			if($key == "billing_company") {
				echo "<div class='logistic_billing_fields'>";
			} 
		 ?>
	<?php endforeach; ?>
	
	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php } else { ?>
	
		<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
		<?php

			if($key == "billing_company") {
				echo "<div class='logistic_billing_fields'>";
			}  
			if($key == "billing_email") {
				echo "</div>";
			} 

			if($doing_ajax && !in_array($key,$swipezoom_fields))
				continue;
		 ?>
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		
	<?php endforeach; ?>

<?php } ?>
