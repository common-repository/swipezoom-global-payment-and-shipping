<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$doing_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;
$swipezoom_fields = array("shipping_address_1","shipping_address_2","shipping_city","shipping_state","shipping_postcode");

if(!$doing_ajax) {
?>
<div class="woocommerce-shipping-fields">
	<?php if ( WC()->cart->needs_shipping_address() === true ) : ?>

		<?php
			if ( empty( $_POST ) ) {

				$ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;
				$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

			} else {

				$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

			}
		?>

		<h3 id="ship-to-different-address">
			<label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?></label>
			<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
		</h3>

		<div class="shipping_address">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>

				<?php

				if($key == "shipping_email") {
					echo "</div>";
				} 
			 	
			 	?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php 
					if($key == "shipping_company") {
						echo "<div class='logistic_shipping_fields'>";
					} 
				 ?>

			<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
	
</div>
	<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_continue_button" id="validate_address" value="Continue" data-value="Continue" />' ); ?>
	<input type="hidden" class="input-hidden" name="progress_status" id="progress_status" placeholder="progress_status" value="1" />			
</div>

<?php } else { ?>
		
		<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>
		<?php

			if($key == "shipping_company") {
				echo "<div class='logistic_shipping_fields'>";
			}  
			if($key == "shipping_email") {
				echo "</div>";
			} 

			if($doing_ajax && !in_array($key,$swipezoom_fields))
				continue;
		 ?>
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		
	<?php endforeach; ?>
	
<?php } ?>
